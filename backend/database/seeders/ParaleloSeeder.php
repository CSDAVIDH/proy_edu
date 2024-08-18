<?php

namespace Database\Seeders;

use App\Models\Paralelo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParaleloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paralelo::create([
            'nombre' => 'ALFA',
            'grado_id' => 1,
            'especialidad_id' => 1,
            'estado'=>1

        ]);
        Paralelo::create([
            'nombre' => 'CHARLY',
            'grado_id' => 1,
            'especialidad_id' => 1,
            'estado'=>1
        ]);
        Paralelo::create([
            'nombre' => 'BRAVO',
            'grado_id' => 1,
            'especialidad_id' => 1,
            'estado'=>1
        ]);
        Paralelo::create([
            'nombre' => 'DELTA',
            'grado_id' => 1,
            'especialidad_id' => 1,
            'estado'=>1
        ]);
    }
}
