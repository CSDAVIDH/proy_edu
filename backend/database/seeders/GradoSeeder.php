<?php

namespace Database\Seeders;

use App\Models\Grado;
use Illuminate\Database\Seeder;

class GradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grado::create([
            'nivel' => 1,
            'descripcion' => 'PRIMER SEMESTRE',
            'estado'=>1
        ]);
        Grado::create([
            'nivel' => 2,
            'descripcion' => 'SEGUNDO SEMESTRE',
            'estado'=>1
        ]);
        Grado::create([
            'nivel' => 2,
            'descripcion' => 'TERCER SEMESTRE',
            'estado'=>1


        ]);
        Grado::create([
            'nivel' => 4,
            'descripcion' => 'CUARTO SEMESTRE',
            'estado'=>1
        ]);
        Grado::create([
            'nivel' => 5,
            'descripcion' => 'QUINTO SEMESTRE',
            'estado'=>1
        ]);
        Grado::create([
            'nivel' => 6,
            'descripcion' => 'SEXTO SEMESTRE',
            'estado'=>1
        ]);
    }
}
