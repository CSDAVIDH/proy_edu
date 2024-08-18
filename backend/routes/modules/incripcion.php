<?php

use App\Http\Controllers\inscripciones\EstudianteInscripcionController;
use App\Http\Controllers\inscripciones\GradosInscripcionController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])
    ->get('/inscripciones', [EstudianteInscripcionController::class, 'index'])
    ->name('inscripciones.index');

Route::middleware(['auth:sanctum'])
    ->get('/inscripciones/estudiante/{estudiante_id}', [EstudianteInscripcionController::class, 'estudiante'])
    ->name('inscripciones.estudiante.id');

Route::middleware(['auth:sanctum'])
    ->post('/inscripciones/estudiante/asignar', [EstudianteInscripcionController::class, 'asignar_paralelo'])
    ->name('inscripciones.estudiante.asignar');

Route::middleware(['auth:sanctum'])
    ->post('/inscripciones/estudiante/actualizar', [EstudianteInscripcionController::class, 'actualizar_paralelo'])
    ->name('inscripciones.estudiante.actualizar');

// rutas materias - paralelos - estudiantes 

Route::middleware(['auth:sanctum'])
    ->get('/inscripciones/grados', [GradosInscripcionController::class, 'index'])
    ->name('inscripciones.grados');

// Route::middleware(['auth:sanctum'])
//     ->post('/inscripciones/inscritos', [GradosInscripcionController::class, 'inscritos'])
//     ->name('inscripciones.inscritos');

Route::post('/inscripciones/datos', [GradosInscripcionController::class, 'datos'])
    ->name('inscripciones.datos');


Route::post('/inscripciones/inscritos', [GradosInscripcionController::class, 'inscritos'])
    ->name('inscripciones.inscritos');

Route::post('/inscripciones/estudiantes', [GradosInscripcionController::class, 'estudiantes'])
    ->name('inscripciones.estudiantes');

Route::post('/inscripciones/estudiantes/store', [GradosInscripcionController::class, 'store'])
    ->name('inscripciones.estudiantes.store');
