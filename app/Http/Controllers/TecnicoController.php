<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Anexo2;
use App\Models\Equipment;
use App\Services\PdfGenerationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TecnicoController extends Controller
{
    protected $pdfService;

    public function __construct(PdfGenerationService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Panel del técnico: lista de contratos asignados.
     */
    public function index()
    {
        $tecnico = Auth::user();

        $pendientes = Contract::with(['client', 'plan'])
            ->where('id_tecnico', $tecnico->id)
            ->where('estado_anexo2', 'pendiente')
            ->orderBy('fecha', 'desc')
            ->get();

        $completados = Contract::with(['client', 'plan', 'anexo2'])
            ->where('id_tecnico', $tecnico->id)
            ->where('estado_anexo2', 'completado')
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        return view('tecnico.index', compact('pendientes', 'completados'));
    }

    /**
     * Formulario del Anexo 2 para un contrato asignado.
     */
    public function editAnexo2($id)
    {
        $tecnico = Auth::user();
        $contract = Contract::with(['client', 'plan', 'anexo2'])
            ->where('id_tecnico', $tecnico->id)
            ->findOrFail($id);

        // Cargar inventario agrupado por categoría para el selector
        $equipmentCatalog = Equipment::where('stock', '>', 0)
            ->orderBy('categoria')
            ->orderBy('nombre')
            ->get()
            ->groupBy('categoria');

        return view('tecnico.anexo2', compact('contract', 'equipmentCatalog'));
    }

    /**
     * Guarda los datos del Anexo 2 y marca el contrato como completado.
     */
    public function storeAnexo2(Request $request, $id)
    {
        $tecnico = Auth::user();
        $contract = Contract::where('id_tecnico', $tecnico->id)->findOrFail($id);

        $request->validate([
            'equipos' => 'required|array|min:1',
            'equipos.*.categoria' => 'required|string',
            'equipos.*.marca' => 'required|string|max:100',
            'equipos.*.modelo' => 'required|string|max:100',
            'equipos.*.cantidad' => 'required|integer|min:1',
            'equipos.*.serial' => 'nullable|string|max:100',
            'equipos.*.estado_equipo' => 'required|in:Nuevo,Usado',
            'compra_credito' => 'nullable|boolean',
            'arrendamiento' => 'nullable|boolean',
            'compra_contado' => 'nullable|boolean',
            'valor_mensual_arrendamiento' => 'nullable|numeric|min:0',
            'valor_mensual_compra_credito' => 'nullable|numeric|min:0',
            'cantidad_meses' => 'nullable|integer|min:1',
            'firma_cliente' => 'required|string',
            'datos_anexo3' => 'nullable|array',
        ]);

        // Mapear los datos manuales de los equipos
        $equiposData = collect($request->equipos)->map(function ($item) {
            return [
                'equipment_id' => null, // Manual
                'nombre' => ($item['marca'] ?? '') . ' ' . ($item['modelo'] ?? ''),
                'categoria' => $item['categoria'] ?? 'Otro',
                'marca' => $item['marca'] ?? '',
                'modelo' => $item['modelo'] ?? '',
                'cantidad' => (int) ($item['cantidad'] ?? 1),
                'precio_unitario' => (float) ($item['precio_unitario'] ?? 0),
                'serial' => $item['serial'] ?? null,
                'estado_equipo' => $item['estado_equipo'] ?? 'Nuevo',
            ];
        })->toArray();

        // Crear o actualizar el Anexo 2
        Anexo2::updateOrCreate(
            ['id_contrato' => $contract->id_contrato],
            [
                'equipos' => $equiposData,
                'compra_credito' => (bool) $request->compra_credito,
                'arrendamiento' => (bool) $request->arrendamiento,
                'compra_contado' => (bool) $request->compra_contado,
                'valor_mensual_arrendamiento' => $request->valor_mensual_arrendamiento,
                'valor_mensual_compra_credito' => $request->valor_mensual_compra_credito,
                'cantidad_meses' => $request->cantidad_meses,
                'firma_cliente' => $request->firma_cliente,
                'datos_anexo3' => $request->datos_anexo3,
                'completado_en' => now(),
            ]
        );

        try {
            // Marcar el contrato como completado
            $contract->update(['estado_anexo2' => 'completado']);

            // REGENERAR EL PDF para incluir los datos del Anexo 2
            $nuevaRuta = $this->pdfService->generateAndSave($contract);
            $contract->update(['pdf_ruta' => $nuevaRuta]);

            \App\Models\AuditLog::create([
                'user_id' => $tecnico->id,
                'action' => 'Anexo 2 Completado',
                'module' => 'Técnico / Anexo 2',
                'details' => "Contrato #ISP-{$contract->id_contrato} — Anexo 2 llenado por {$tecnico->name}",
            ]);
        } catch (\Exception $e) {
            \Log::error("Error al finalizar instalación: " . $e->getMessage());
            return back()->withErrors(['general' => 'Ocurrió un error al generar el contrato: ' . $e->getMessage()])->withInput();
        }

        return redirect()->route('tecnico.index')
            ->with('success', 'Anexo 2 registrado correctamente. El contrato está listo.');
    }
}
