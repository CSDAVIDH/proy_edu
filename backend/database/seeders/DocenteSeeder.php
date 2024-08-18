<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Docente;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Docente::create(['grado' => 'Licenciatura', 'especialidad' => 'Matematica', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 3,]);
        Docente::create(['grado' => 'Licenciatura', 'especialidad' => 'Fisica', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 4,]);
        Docente::create(['grado' => 'Licenciatura', 'especialidad' => 'Quimica', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 5,]);
        Docente::create(['grado' => 'Licenciatura', 'especialidad' => 'Historia', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 6,]);
        Docente::create(['grado' => 'Licenciatura', 'especialidad' => 'Ingles', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 7,]);
        Docente::create(['grado' => 'Licenciatura', 'especialidad' => 'Matematica', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 8,]);
        Docente::create(['grado' => 'Licenciatura', 'especialidad' => 'Fisica', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 9,]);
        Docente::create(['grado' => 'Licenciatura', 'especialidad' => 'Quimica', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 10,]);
        Docente::create(['grado' => 'Licenciatura', 'especialidad' => 'Historia', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 11,]);
        Docente::create(['grado' => 'Licenciatura', 'especialidad' => 'Ingles', 'cv' => 'docentes/curriculum.pdf',  'persona_id' => 12,]);
    }
}
