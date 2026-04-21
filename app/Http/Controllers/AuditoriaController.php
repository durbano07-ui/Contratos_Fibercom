<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditLog;
use App\Models\Contract;
use App\Models\User;
use Carbon\Carbon;

class AuditoriaController extends Controller
{
    public function index()
    {
        // Totales de auditoria pura
        $eventos_totales = AuditLog::count();
        $criticos_24h = AuditLog::where('created_at', '>=', now()->subHours(24))->where('action', 'like', '%Baja%')->count();
        $usuarios_activos = User::count() ?: 1; // Mínimo 1 para efectos de inicio
        
        $ultima_actividad = AuditLog::latest()->first()->created_at ?? now();
        $diff = now()->diff($ultima_actividad);
        $ultima_actividad_formatted = "Hace " . ($diff->h > 0 ? $diff->h.'h ' : '') . $diff->i . "m";

        // Ingresos Mensuales (derivado de contratos vigentes)
        // Sumamos el valor de todos los planes atados a contratos en el sistema.
        $ingresos_mensuales = Contract::join('internet_plans', 'contracts.id_plan', '=', 'internet_plans.id_plan')->sum('internet_plans.precio');
        if ($ingresos_mensuales >= 1000) {
            $ingresos_mensuales_str = number_format($ingresos_mensuales / 1000, 1) . 'k';
        } else {
            $ingresos_mensuales_str = number_format($ingresos_mensuales, 2);
        }

        $logs = AuditLog::with('user')->latest()->paginate(10);

        return view('auditoria.index', compact(
            'eventos_totales', 
            'criticos_24h', 
            'usuarios_activos', 
            'ultima_actividad_formatted', 
            'ingresos_mensuales_str', 
            'logs'
        ));
    }
}
