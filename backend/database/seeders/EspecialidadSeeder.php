<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Especialidad::create([
            'nombre' => 'SIN ORIENTACION',
            'descripcion' => 'SIN ORIENTACION',
            'estado'=>1
        ]);
        Especialidad::create([
            'nombre' => 'MAR Y CUBIERTA',
            'descripcion' => 'ORIENTACION DE MAR Y CUBIERTA',
            'estado'=>1
        ]);
        Especialidad::create([
            'nombre' => 'ELECTRICIDAD',
            'descripcion' => 'ORIENTACION DE ELECTRICIDAD',
            'estado'=>1
        ]);
        Especialidad::create([
            'nombre' => 'COMUNICACIONES',
            'descripcion' => 'ORIENTACION DE COMUNICACIONES',
            'estado'=>1
        ]);
        Especialidad::create([
            'nombre' => 'INFANTERÍA DE MARINA',
            'descripcion' => 'ORIENTACION DE INFANTERÍA DE MARINA',
            'estado'=>1
        ]);
        Especialidad::create([
            'nombre' => 'ADMINISTRACIÓN',
            'descripcion' => 'ORIENTACION DE ADMINISTRACIÓN',
            'estado'=>1
        ]);
        Especialidad::create([
            'nombre' => 'MÚSICA',
            'descripcion' => 'ORIENTACION DE MÚSICA',
            'estado'=>1
        ]);
    }
}
