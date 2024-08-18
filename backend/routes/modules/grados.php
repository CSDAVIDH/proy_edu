<?php

use App\Http\Controllers\grados\GradoController;
use Illuminate\Support\Facades\Route;

// materias

// Route::middleware(['auth:sanctum'])
//     ->get('/grados', [GradoController::class, 'index'])
//     ->name('grado.index');

Route::get('/grados', [GradoController::class, 'index'])
    ->name('grado.index');


Route::middleware(['auth:sanctum'])
    ->get('/grados/{grado_id}', [GradoController::class, 'show'])
    ->name('grado.show');

Route::middleware(['auth:sanctum'])
    ->post('/grados/store', [GradoController::class, 'store'])
    ->name('grado.store');

Route::middleware(['auth:sanctum'])
    ->post('/grados/update', [GradoController::class, 'update'])
    ->name('grado.update');

Route::middleware(['auth:sanctum'])
    ->delete('/grados/{id_course}', [GradoController::class, 'delete'])
    ->name('grado.delete');
