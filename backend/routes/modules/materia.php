<?php

use App\Http\Controllers\materias\MateriaController;
use App\Http\Controllers\paralelos\ParaleloController;
use Illuminate\Support\Facades\Route;

// materias

Route::middleware(['auth:sanctum'])
    ->get('/materias', [MateriaController::class, 'index'])
    ->name('materia.index');

Route::middleware(['auth:sanctum'])
    ->get('/materias/grado-especialidad', [MateriaController::class, 'grado_especialidad'])
    ->name('materias.grado.especialidad');

Route::middleware(['auth:sanctum'])
    ->get('/materias/{materia_id}', [MateriaController::class, 'show'])
    ->name('materias.show');

Route::middleware(['auth:sanctum'])
    ->post('/materias/store', [MateriaController::class, 'store'])
    ->name('materia.store');

Route::middleware(['auth:sanctum'])
    ->post('/materias/update', [MateriaController::class, 'update'])
    ->name('materia.update');

Route::middleware(['auth:sanctum'])
    ->delete('/materias/{id_course}', [MateriaController::class, 'delete'])
    ->name('materia.delete');

// paralelos

Route::middleware(['auth:sanctum'])
    ->get('/paralelos', [ParaleloController::class, 'index'])
    ->name('paralelos.index');

Route::middleware(['auth:sanctum'])
    ->get('/paralelos/{paralelo_id}', [ParaleloController::class, 'show'])
    ->name('paralelos.show');

Route::middleware(['auth:sanctum'])
    ->get('/paralelos/grado-especialidad', [ParaleloController::class, 'grado_especialidad'])
    ->name('paralelos.grado.especialidad');

Route::middleware(['auth:sanctum'])
    ->post('/paralelos/store', [ParaleloController::class, 'store'])
    ->name('paralelos.store');

Route::middleware(['auth:sanctum'])
    ->post('/paralelos/update', [ParaleloController::class, 'update'])
    ->name('paralelos.update');

Route::middleware(['auth:sanctum'])
    ->delete('/paralelos/{paralelo_id}', [ParaleloController::class, 'delete'])
    ->name('paralelos.delete');
