<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\usuarios\AdministrativoController;
use App\Http\Controllers\usuarios\DocenteController;
use App\Http\Controllers\usuarios\EstudianteController;
use App\Http\Controllers\usuarios\PadreController;
use Illuminate\Support\Facades\Route;

// administrativos

Route::middleware(['auth:sanctum'])
    ->get('/administrativos', [AdministrativoController::class, 'index'])
    ->name('administrativo.index');

Route::middleware(['auth:sanctum'])
    ->get('/administrativos/{administrativo_id}', [AdministrativoController::class, 'show'])
    ->name('administrativo.show');

Route::middleware(['auth:sanctum'])
    ->post('/administrativo/store', [AdministrativoController::class, 'store'])
    ->name('administrativo.store');

Route::middleware(['auth:sanctum'])
    ->post('/administrativo/update', [AdministrativoController::class, 'update'])
    ->name('administrativo.update');

Route::middleware(['auth:sanctum'])
    ->delete('/administrativo/delete/{persona}', [AdministrativoController::class, 'delete'])
    ->name('administrativo.delete');


// docentes 

Route::middleware(['auth:sanctum'])
    ->get('/docentes', [DocenteController::class, 'index'])
    ->name('docentes.index');

Route::middleware(['auth:sanctum'])
    ->get('/docente/{docente_id}', [DocenteController::class, 'show'])
    ->name('docente.show');

Route::middleware(['auth:sanctum'])
    ->post('/docente/store', [DocenteController::class, 'store'])
    ->name('docente.store');

Route::middleware(['auth:sanctum'])
    ->post('/docente/update', [DocenteController::class, 'update'])
    ->name('docente.update');

Route::middleware(['auth:sanctum'])
    ->delete('/docente/delete/{persona}', [DocenteController::class, 'delete'])
    ->name('docente.delete');


// estudiantes 

Route::middleware(['auth:sanctum'])
    ->get('/estudiantes', [EstudianteController::class, 'index'])
    ->name('estudiantes.index');

Route::middleware(['auth:sanctum'])
    ->get('/estudiante/{estudiante_id}', [EstudianteController::class, 'show'])
    ->name('estudiante.show');

Route::middleware(['auth:sanctum'])
    ->post('/estudiante/store', [EstudianteController::class, 'store'])
    ->name('estudiante.store');

Route::middleware(['auth:sanctum'])
    ->post('/estudiante/update', [EstudianteController::class, 'update'])
    ->name('estudiante.update');

Route::middleware(['auth:sanctum'])
    ->delete('/estudiante/delete/{persona}', [EstudianteController::class, 'delete'])
    ->name('estudiante.delete');

// padre 

Route::middleware(['auth:sanctum'])
    ->get('/padres', [PadreController::class, 'index'])
    ->name('padres.index');

Route::middleware(['auth:sanctum'])
    ->get('/padre/{padre_id}', [PadreController::class, 'show'])
    ->name('padre.show');

Route::middleware(['auth:sanctum'])
    ->post('/padre/store', [PadreController::class, 'store'])
    ->name('padre.store');

Route::middleware(['auth:sanctum'])
    ->post('/padre/update', [PadreController::class, 'update'])
    ->name('padre.update');

Route::middleware(['auth:sanctum'])
    ->delete('/padre/delete/{persona}', [PadreController::class, 'delete'])
    ->name('padre.delete');

// dashboard 
Route::middleware(['auth:sanctum'])
    ->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index');