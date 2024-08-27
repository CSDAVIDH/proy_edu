<?php

namespace Database\Seeders;

use App\Models\Padre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PadreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Padre::create(['profesion' => 'Ama de Casa', 'persona_id' => 88,]);
        Padre::create(['profesion' => 'Administrador de Empresas', 'persona_id' => 89,]);
        Padre::create(['profesion' => 'Ingeniero Ambiental', 'persona_id' => 90,]);
    }
}
