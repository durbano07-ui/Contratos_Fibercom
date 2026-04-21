<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InternetType;

class InternetTypeSeeder extends Seeder
{
    public function run(): void
    {
        InternetType::create(['nombre_tipo' => 'Fibra Óptica']);
        InternetType::create(['nombre_tipo' => 'Radio Enlace']);
    }
}
