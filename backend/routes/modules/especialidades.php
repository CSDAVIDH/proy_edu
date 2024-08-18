<?php

use App\Http\Controllers\especialidades\EspecialidadController;
use Illuminate\Support\Facades\Route;

// materias

Route::middleware(['auth:sanctum'])
    ->get('/especialidades', [EspecialidadController::class, 'index'])
    ->name('especialidad.index');

   


Route::middleware(['auth:sanctum'])
    ->get('/especialidades/{especialidad_id}', [EspecialidadController::class, 'show'])
    ->name('especialidad.show');

Route::middleware(['auth:sanctum'])
    ->post('/especialidades/store', [EspecialidadController::class, 'store'])
    ->name('especialidad.store');

Route::middleware(['auth:sanctum'])
    ->post('/especialidades/update', [EspecialidadController::class, 'update'])
    ->name('especialidad.update');

Route::middleware(['auth:sanctum'])
    ->delete('/especialidades/{especialidad_id}', [EspecialidadController::class, 'delete'])
    ->name('especialidad.delete');

