<?php

use App\Http\Controllers\usuarios\AdministrativoController;
use App\Http\Controllers\usuarios\DocenteController;
use App\Http\Controllers\usuarios\EstudianteController;
use Illuminate\Support\Facades\Route;

// administrativos

Route::middleware(['auth:sanctum'])
    ->get('/administrativos', [AdministrativoController::class, 'index'])
    ->name('administrativo.index');

Route::middleware(['auth:sanctum'])
    ->get('/administrativos/{persona_id}', [AdministrativoController::class, 'show'])
    ->name('administrativo.show');


Route::middleware(['auth:sanctum'])
    ->get('/docentes', [DocenteController::class, 'index'])
    ->name('docentes.index');

Route::middleware(['auth:sanctum'])
    ->get('/estudiantes', [EstudianteController::class, 'index'])
    ->name('estudiantes.index');

Route::middleware(['auth:sanctum'])
    ->post('/estudiantes/store', [EstudianteController::class, 'store'])
    ->name('estudiante.store');

// Route::middleware(['auth:sanctum'])
//     ->post('/cursos/store', [AdministrativoController::class, 'store'])
//     ->name('curso.store');

// Route::middleware(['auth:sanctum'])
//     ->post('/cursos/update', [AdministrativoController::class, 'update'])
//     ->name('curso.update');

// Route::middleware(['auth:sanctum'])
//     ->delete('/cursos/{id_course}', [AdministrativoController::class, 'delete'])
//     ->name('curso.delete');