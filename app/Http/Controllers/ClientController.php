<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->isAdministrativo()) {
            // El Administrativo solo ve los clientes de sus propios contratos
            $clienteIds = $user->contracts()->pluck('id_cliente');
            $clientes   = Client::with(['contracts.plan'])
                            ->whereIn('id_cliente', $clienteIds)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

            $total_clientes = $clientes->total();
            $nuevos_mes     = Client::whereIn('id_cliente', $clienteIds)
                                ->whereMonth('created_at', \Carbon\Carbon::now()->month)
                                ->whereYear('created_at', \Carbon\Carbon::now()->year)
                                ->count();
        } else {
            // El Administrador ve todos los clientes
            $total_clientes = Client::count();
            $clientes_baja  = Client::where('estado', 'baja')->count();
            $nuevos_mes     = Client::whereMonth('created_at', \Carbon\Carbon::now()->month)
                                    ->whereYear('created_at', \Carbon\Carbon::now()->year)
                                    ->count();
            $clientes = Client::with(['contracts.plan'])->orderBy('estado')->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('clientes.index', compact(
            'total_clientes',
            'nuevos_mes',
            'clientes',
        ) + ['clientes_baja' => $clientes_baja ?? 0]);
    }

    // -------------------------------------------------------
    // CRUD (solo Administrador)
    // -------------------------------------------------------

    public function edit($id)
    {
        $cliente = Client::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Client::findOrFail($id);

        $data = $request->validate([
            'nombre'     => 'required|string|max:100',
            'apellido'   => 'nullable|string|max:100',
            'cedula'     => 'required|string|max:20|unique:clients,cedula,' . $id . ',id_cliente',
            'email'      => 'nullable|email|max:150',
            'direccion'  => 'nullable|string|max:255',
            'ciudad'     => 'nullable|string|max:100',
            'canton'     => 'nullable|string|max:100',
            'provincia'  => 'nullable|string|max:100',
            'n_telefono' => 'nullable|string|max:20',
        ]);

        $cliente->update($data);

        \App\Models\AuditLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Cliente Actualizado',
            'module'  => 'Clientes',
            'details' => "Cliente '{$cliente->nombre} {$cliente->apellido}' (cédula: {$cliente->cedula}) modificado",
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function darDeBaja(Request $request, $id)
    {
        $cliente = Client::findOrFail($id);

        if ($cliente->isBaja()) {
            return redirect()->route('clientes.index')
                ->with('error', "El cliente '{$cliente->nombre}' ya está dado de baja.");
        }

        $request->validate([
            'motivo_baja' => 'required|string|min:10|max:500',
        ]);

        $cliente->update([
            'estado'      => 'baja',
            'fecha_baja'  => now(),
            'motivo_baja' => $request->motivo_baja,
        ]);

        \App\Models\AuditLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Cliente Dado de Baja',
            'module'  => 'Clientes',
            'details' => "Cliente '{$cliente->nombre} {$cliente->apellido}' (cédula: {$cliente->cedula}) dado de baja. Motivo: {$request->motivo_baja}",
        ]);

        return redirect()->route('clientes.index')->with('success', "Cliente '{$cliente->nombre}' dado de baja correctamente.");
    }

    public function reactivar($id)
    {
        $cliente = Client::findOrFail($id);

        $cliente->update([
            'estado'      => 'activo',
            'fecha_baja'  => null,
            'motivo_baja' => null,
        ]);

        \App\Models\AuditLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Cliente Reactivado',
            'module'  => 'Clientes',
            'details' => "Cliente '{$cliente->nombre} {$cliente->apellido}' reactivado en el sistema",
        ]);

        return redirect()->route('clientes.index')->with('success', "Cliente '{$cliente->nombre}' reactivado correctamente.");
    }

    // -------------------------------------------------------
    // API (búsqueda de clientes para formularios)
    // -------------------------------------------------------

    public function search(Request $request)
    {
        $query = $request->get('q');
        if (!$query) {
            return response()->json([]);
        }
        $clients = $this->clientService->searchClient($query);
        return response()->json($clients);
    }
}

