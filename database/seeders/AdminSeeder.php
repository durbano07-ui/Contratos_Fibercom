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
            ['email' => 'admin@fibercom.com'],
            [
                'name'     => 'Admin Fibercom',
                'password' => bcrypt('admin123'),
                'role'     => 'administrador',
            ]
        );

        // Administrativo: solo puede gestionar sus contratos
        User::updateOrCreate(
            ['email' => 'operador@fibercom.com'],
            [
                'name'     => 'Operador Fibercom',
                'password' => bcrypt('op123456'),
                'role'     => 'administrativo',
            ]
        );
        // Técnico (jefe de grupo): llena el Anexo 2 en su panel
        User::updateOrCreate(
            ['email' => 'tecnico@fibercom.com'],
            [
                'name'     => 'Jefe Técnico Fibercom',
                'password' => bcrypt('tec123456'),
                'role'     => 'tecnico',
            ]
        );
    }
}

