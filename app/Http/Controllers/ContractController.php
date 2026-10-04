<?php

namespace App\Http\Controllers;

use App\Rules\CedulaRuc;
use App\Models\Contract;
use App\Models\InternetType;
use App\Services\ContractService;
use App\Services\PdfGenerationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    private $contractService;
    private $pdfService;

    public function __construct(ContractService $contractService, PdfGenerationService $pdfService)
    {
        $this->contractService = $contractService;
        $this->pdfService      = $pdfService;
    }

    public function index(Request $request)
    {
        $user   = Auth::user();
        $search = $request->get('search');

        // Base query con relaciones necesarias
        $query = Contract::with(['client', 'plan', 'user', 'tecnico']);

        // El Administrativo solo ve sus propios contratos
        if ($user->isAdministrativo()) {
            $query->where('id_usuario', $user->id);
        }

        // Búsqueda por cédula del cliente (ambos roles)
        if ($search) {
            $query->whereHas('client', function ($q) use ($search) {
                $q->where('cedula', 'like', "%{$search}%")
                  ->orWhere('nombre', 'like', "%{$search}%")
                  ->orWhere('apellido', 'like', "%{$search}%");
            });
        }

        $contracts = $query->orderBy('fecha', 'desc')->paginate(10)->withQueryString();

        // Estadísticas adaptadas al scope del usuario
        $statsQuery = Contract::query();
        if ($user->isAdministrativo()) {
            $statsQuery->where('id_usuario', $user->id);
        }

        $total_contratos = $statsQuery->count();
        $activos         = $total_contratos;
        $nuevos_mes      = (clone $statsQuery)
            ->whereMonth('fecha', now()->month)
            ->whereYear('fecha', now()->year)
            ->count();

        return view('contracts.index', compact(
            'total_contratos', 'activos', 'nuevos_mes', 'contracts', 'search'
        ));
    }

    public function create()
    {
        $tiposConexion = InternetType::all();
        $tecnicos      = \App\Models\User::where('role', 'tecnico')->orderBy('name')->get();
        $equipos       = \App\Models\Equipment::orderBy('categoria')->orderBy('nombre')->get();
        return view('contracts.create', compact('tiposConexion', 'tecnicos', 'equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client.nombre'    => 'required',
            'client.cedula'    => ['required', new CedulaRuc()],
            'contract.id_plan' => 'required|exists:internet_plans,id_plan',
            'id_tecnico'       => 'nullable|exists:users,id',
            'firma_prestador'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('firma_prestador')) {
            $file = $request->file('firma_prestador');
            $ext = strtolower($file->getClientOriginalExtension());
            $filename = 'firma_prestador.' . (in_array($ext, ['jpg', 'jpeg']) ? $ext : 'png');
            $file->storeAs('public', $filename);

            $publicImgDir = public_path('img');
            if (!file_exists($publicImgDir)) {
                @mkdir($publicImgDir, 0777, true);
            }
            @copy($file->getRealPath(), $publicImgDir . '/' . $filename);
        }

        // Usar el usuario autenticado real (no User::first())
        $contract = $this->contractService->createContract(
            $request->all(),
            Auth::id(),
            $request->input('id_tecnico') // opcional / nullable
        );

        // Generar y guardar el PDF
        $pdfPath = $this->pdfService->generateAndSave($contract);
        $this->contractService->savePdfPath($contract, $pdfPath);

        return response()->json([
            'success'     => true,
            'message'     => 'Contrato generado y guardado exitosamente.',
            'contract_id' => $contract->id_contrato,
        ]);
    }

    public function downloadPdf($id)
    {
        $user     = Auth::user();
        $contract = Contract::findOrFail($id);

        // El Administrativo solo puede descargar sus propios contratos
        if ($user->isAdministrativo() && $contract->id_usuario !== $user->id) {
            abort(403, 'No puedes acceder a contratos de otros usuarios.');
        }

        return $this->pdfService->streamPdf($contract);
    }

    public function downloadAnexosPdf($id)
    {
        $user     = Auth::user();
        $contract = Contract::findOrFail($id);

        if ($user->isAdministrativo() && $contract->id_usuario !== $user->id) {
            abort(403, 'No puedes acceder a contratos de otros usuarios.');
        }

        return $this->pdfService->streamAnexosPdf($contract);
    }

    // -------------------------------------------------------
    // Edición: Administrador (todos) y Administrativo (solo los suyos)
    // -------------------------------------------------------

    public function edit($id)
    {
        $contract      = Contract::with(['client', 'plan', 'user', 'tecnico'])->findOrFail($id);
        $this->authorizeOwnership($contract);

        $tiposConexion = \App\Models\InternetType::with('plans')->get();
        $tecnicos      = \App\Models\User::where('role', 'tecnico')->orderBy('name')->get();

        return view('contracts.edit', compact('contract', 'tiposConexion', 'tecnicos'));
    }

    public function update(Request $request, $id)
    {
        $contract = Contract::with(['plan', 'tecnico'])->findOrFail($id);
        $this->authorizeOwnership($contract);

        $data = $request->validate([
            'id_plan'    => 'required|exists:internet_plans,id_plan',
            'fecha'      => 'required|date',
            'id_tecnico' => 'nullable|exists:users,id',
        ]);

        $data['id_tecnico'] = !empty($data['id_tecnico']) ? $data['id_tecnico'] : null;

        $planAnterior    = $contract->plan->nombre_plan ?? '—';
        $tecnicoAnterior = $contract->tecnico->name ?? 'Sin asignar';

        $contract->update($data);
        $contract->load('tecnico');

        $tecnicoNuevo = $contract->tecnico->name ?? 'Sin asignar';

        \App\Models\AuditLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Contrato Modificado',
            'module'  => 'Contratos',
            'details' => "Contrato #ISP-{$contract->id_contrato}: plan anterior '{$planAnterior}', fecha {$data['fecha']}, técnico: {$tecnicoAnterior} → {$tecnicoNuevo}",
        ]);

        return redirect()->route('contracts.index')->with('success', 'Contrato actualizado correctamente.');
    }

    /**
     * El Administrativo solo puede editar los contratos que él generó.
     */
    private function authorizeOwnership(Contract $contract): void
    {
        $user = Auth::user();

        if ($user->isAdministrativo() && (int) $contract->id_usuario !== (int) $user->id) {
            abort(403, 'No puedes editar contratos de otros usuarios.');
        }
    }

    // -------------------------------------------------------
    // Métodos exclusivos del Administrador
    // -------------------------------------------------------

    public function destroy($id)
    {
        $contract = Contract::with(['client'])->findOrFail($id);

        $clienteNombre = $contract->client->nombre ?? 'Desconocido';

        // Eliminar el PDF físico si existe
        if ($contract->pdf_ruta && \Illuminate\Support\Facades\Storage::exists($contract->pdf_ruta)) {
            \Illuminate\Support\Facades\Storage::delete($contract->pdf_ruta);
        }

        \App\Models\AuditLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Contrato Eliminado',
            'module'  => 'Contratos',
            'details' => "Contrato #ISP-{$contract->id_contrato} del cliente '{$clienteNombre}' eliminado por el administrador",
        ]);

        $contract->delete();

        return redirect()->route('contracts.index')->with('success', 'Contrato eliminado del sistema.');
    }
}
