<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternetPlan;
use App\Models\InternetType;

class InternetPlanSeeder extends Seeder
{
    public function run(): void
    {
        $fibra = InternetType::where('nombre_tipo', 'Fibra Óptica')->first();
        $radio = InternetType::where('nombre_tipo', 'Radio Enlace')->first();

        if ($fibra) {
            InternetPlan::create(['id_tipo' => $fibra->id_tipo, 'nombre_plan' => 'Plan Básico 100Mbps', 'precio' => 20.00, 'velocidad' => '100 Mbps']);
            InternetPlan::create(['id_tipo' => $fibra->id_tipo, 'nombre_plan' => 'Plan Pro 300Mbps', 'precio' => 35.00, 'velocidad' => '300 Mbps']);
            InternetPlan::create(['id_tipo' => $fibra->id_tipo, 'nombre_plan' => 'Plan Gamer 500Mbps', 'precio' => 50.00, 'velocidad' => '500 Mbps']);
        }

        if ($radio) {
            InternetPlan::create(['id_tipo' => $radio->id_tipo, 'nombre_plan' => 'Plan Rural 20Mbps', 'precio' => 15.00, 'velocidad' => '20 Mbps']);
            InternetPlan::create(['id_tipo' => $radio->id_tipo, 'nombre_plan' => 'Plan Rural 50Mbps', 'precio' => 25.00, 'velocidad' => '50 Mbps']);
        }
    }
}
