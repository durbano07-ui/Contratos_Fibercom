<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador: acceso completo al sistema
        User::updateOrCreate(
            ['cedula' => '1710034065'],
            [
                'name' => 'Admin Fibercom',
                'role' => 'administrador',
            ]
        );

        // Administrativo: solo puede gestionar sus contratos
        User::updateOrCreate(
            ['cedula' => '1721528659'],
            [
                'name' => 'Operador Fibercom',
                'role' => 'administrativo',
            ]
        );
        // Técnico (jefe de grupo): llena el Anexo 2 en su panel
        User::updateOrCreate(
            ['cedula' => '1710034073'],
            [
                'name' => 'Jefe Técnico Fibercom',
                'role' => 'tecnico',
            ]
        );
    }
}

