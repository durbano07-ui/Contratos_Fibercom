<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternetPlan;
use App\Models\InternetType;

class InternetPlanSeeder extends Seeder
{
    public function run(): void
    {
        $fibra = InternetType::firstOrCreate(['nombre_tipo' => 'Fibra Óptica']);
        $radio = InternetType::firstOrCreate(['nombre_tipo' => 'Radio Enlace']);

        if ($fibra) {
            $planesFibra = [
                ['nombre_plan' => 'FIBER PLAN DISCAPACIDAD', 'precio' => 15.00, 'velocidad' => '100 MEGAS'],
                ['nombre_plan' => 'FIBER PLAN TERCERA EDAD', 'precio' => 15.00, 'velocidad' => '100 MEGAS'],
                ['nombre_plan' => 'PLAN ESTUDIANTIL 400 MEGAS', 'precio' => 20.00, 'velocidad' => '400 MEGAS'],
                ['nombre_plan' => 'PLAN FAMILIA 500 MEGAS', 'precio' => 25.00, 'velocidad' => '500 MEGAS'],
                ['nombre_plan' => 'PLAN FULL 550 MEGAS', 'precio' => 30.00, 'velocidad' => '550 MEGAS'],
                ['nombre_plan' => 'PLAN PYMES ULTRA', 'precio' => 50.00, 'velocidad' => '150 MEGAS'],
            ];

            foreach ($planesFibra as $plan) {
                InternetPlan::updateOrCreate(
                    ['id_tipo' => $fibra->id_tipo, 'nombre_plan' => $plan['nombre_plan']],
                    $plan
                );
            }
        }

        if ($radio) {
            $planesRadio = [
                // Planes PYMES Signal (Radioenlace, compartición 1:1 Simétrico)
                ['nombre_plan' => 'PYMES PLUS 30 MEGAS', 'precio' => 51.75, 'velocidad' => '30 MEGAS'],
                ['nombre_plan' => 'PYMES FULL 40 MEGAS', 'precio' => 80.50, 'velocidad' => '40 MEGAS'],
                ['nombre_plan' => 'PYMES EXTREME 50 MEGAS', 'precio' => 103.50, 'velocidad' => '50 MEGAS'],

                // Planes Home Signal (Radioenlace, compartición 2:1 Simétrico)
                ['nombre_plan' => 'HOME PLAN DISCAPACIDAD', 'precio' => 15.00, 'velocidad' => '8 MEGAS'],
                ['nombre_plan' => 'HOME PLAN TERCERA EDAD', 'precio' => 15.00, 'velocidad' => '8 MEGAS'],
                ['nombre_plan' => 'HOME ESTUDIANTIL', 'precio' => 20.00, 'velocidad' => '12 MEGAS'],
                ['nombre_plan' => 'SIGNAL HOME PLUS', 'precio' => 22.00, 'velocidad' => '15 MEGAS'],
                ['nombre_plan' => 'HOME FAMILIA', 'precio' => 25.00, 'velocidad' => '20 MEGAS'],
                ['nombre_plan' => 'HOME FULL', 'precio' => 30.00, 'velocidad' => '30 MEGAS'],
                ['nombre_plan' => 'HOME EXCLUSIVO', 'precio' => 35.00, 'velocidad' => '35 MEGAS'],
            ];

            foreach ($planesRadio as $plan) {
                InternetPlan::updateOrCreate(
                    ['id_tipo' => $radio->id_tipo, 'nombre_plan' => $plan['nombre_plan']],
                    $plan
                );
            }
        }
    }
}

