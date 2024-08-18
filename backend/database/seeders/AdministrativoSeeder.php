<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administrativo;

class AdministrativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Administrativo::create(['cargo' => 'administrativo', 'grado' => 'doctor', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 1,]);
        Administrativo::create(['cargo' => 'administrativo', 'grado' => 'licenciatura', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 2,]);
    }
}
