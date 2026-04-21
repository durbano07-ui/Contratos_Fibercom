<?php

namespace App\Http\Controllers;

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
        $query = Contract::with(['client', 'plan', 'user']);

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
        return view('contracts.create', compact('tiposConexion', 'tecnicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client.nombre'    => 'required',
            'client.cedula'    => 'required',
            'contract.id_plan' => 'required|exists:internet_plans,id_plan',
        ]);

        // Usar el usuario autenticado real (no User::first())
        $contract = $this->contractService->createContract(
            $request->all(),
            Auth::id(),
            $request->input('id_tecnico') // puede ser null si no se asigna
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

    // -------------------------------------------------------
    // Métodos exclusivos del Administrador
    // -------------------------------------------------------

    public function edit($id)
    {
        $contract      = Contract::with(['client', 'plan', 'user'])->findOrFail($id);
        $tiposConexion = \App\Models\InternetType::with('plans')->get();
        $usuarios      = \App\Models\User::orderBy('name')->get();

        return view('contracts.edit', compact('contract', 'tiposConexion', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);

        $data = $request->validate([
            'id_plan' => 'required|exists:internet_plans,id_plan',
            'fecha'   => 'required|date',
        ]);

        $planAnterior = $contract->plan->nombre_plan ?? '—';
        $contract->update($data);

        \App\Models\AuditLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Contrato Modificado',
            'module'  => 'Contratos',
            'details' => "Contrato #ISP-{$contract->id_contrato}: plan anterior '{$planAnterior}', fecha actualizada a {$data['fecha']}",
        ]);

        return redirect()->route('contracts.index')->with('success', 'Contrato actualizado correctamente.');
    }

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
