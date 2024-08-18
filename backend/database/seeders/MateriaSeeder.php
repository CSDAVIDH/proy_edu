<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Materia;
class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Materia::create([
            'nombre' => 'ANÁLISIS MATEMÁTICO',
            'sigla' => 'MAT-101',
            'grado_id' => 1,
            'tipo' => 1,
            'porcentaje' => 10,
            'especialidad_id' => 1,
            'horas_cademicas' => 304      
        ]);
        Materia::create([
            'nombre' => 'FISICA',
            'sigla' => 'FIS-102',
            'grado_id' => 1,
            'tipo' => 1,
            'porcentaje' => 10,
            'especialidad_id' => 1,
            'horas_cademicas' => 304      
        ]);
        Materia::create([
            'nombre' => 'QUÍMICA',
            'sigla' => 'QUI-103',
            'grado_id' => 1,
            'tipo' => 1,
            'porcentaje' => 10,
            'especialidad_id' => 1,
            'horas_cademicas' => 304      
        ]);
        
        Materia::create([
            'nombre' => 'METODOLOGIA DE LA INVESTIGACION',
            'sigla' => 'METI-104',
            'grado_id' => 1,
            'tipo' => 1,
            'porcentaje' => 10,
            'especialidad_id' => 1,
            'horas_cademicas' => 304      
        ]);
        
        Materia::create([
            'nombre' => 'HISTORIA MILITAR',
            'sigla' => 'HIS-105',
            'grado_id' => 1,
            'tipo' => 1,
            'porcentaje' => 10,
            'especialidad_id' => 1,
            'horas_cademicas' => 304      
        ]);
        
        Materia::create([
            'nombre' => 'INGLES I',
            'sigla' => 'ING-106',
            'grado_id' => 1,
            'tipo' => 1,
            'porcentaje' => 10,
            'especialidad_id' => 1,
            'horas_cademicas' => 304      
        ]);
        Materia::create([
            'nombre' => 'DESQUITE',
            'sigla' => 'DESQ-001',
            'grado_id' => 1,
            'tipo' => 3,
            'porcentaje' => 100,
            'especialidad_id' => 1,
            'horas_cademicas' => 0      
        ]);
        Materia::create([
            'nombre' => 'APTITUD NAVAL MILITAR',
            'sigla' => 'ANM-107',
            'grado_id' => 1,
            'tipo' => 2,
            'porcentaje' => 10,
            'especialidad_id' => 1,
            'horas_cademicas' => 0      
        ]);
        Materia::create([
            'nombre' => 'APTITUD FISCA Y DEPORTE',
            'sigla' => 'AFD-108',
            'grado_id' => 1,
            'tipo' => 2,
            'porcentaje' => 10,
            'especialidad_id' => 1,
            'horas_cademicas' => 0      
        ]);
        Materia::create([
            'nombre' => 'DISCIPLINA',
            'sigla' => 'DISC-109',
            'grado_id' => 1,
            'tipo' => 2,
            'porcentaje' => 10,
            'especialidad_id' => 1,
            'horas_cademicas' => 0      
        ]);
        Materia::create([
            'nombre' => 'MARINERIA',
            'sigla' => 'MAR-110',
            'grado_id' => 1,
            'tipo' => 2,
            'porcentaje' => 10,
            'especialidad_id' => 1,
            'horas_cademicas' => 0      
        ]);
    }
}
