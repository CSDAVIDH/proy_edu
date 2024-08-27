<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $estudiantes = DB::table('estudiantes')
            ->where('estado', 1)
            ->count();

        $docentes = DB::table('docentes')
            ->where('estado', 1)
            ->count();

        $padres = DB::table('padres')
            ->where('estado', 1)
            ->count();

        $administrativos = DB::table('administrativos')
            ->where('estado', 1)
            ->count();

        return response()->json([
            'estudiantes' => $estudiantes,
            'docentes' => $docentes,
            'padres' => $padres,
            'administrativos' => $administrativos,
        ]);
    }
}
