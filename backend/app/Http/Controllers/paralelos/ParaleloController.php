<?php

namespace App\Http\Controllers\paralelos;

use App\Http\Controllers\Controller;
use App\Http\Requests\paralelos\ParaleloRequest;
use Illuminate\Support\Facades\DB;

class ParaleloController extends Controller
{
    public function index()
    {
        $paralelos = DB::table('paralelos', 'p')
            ->join('especialidads as e', 'e.id', '=', 'p.especialidad_id')
            ->join('grados as g', 'g.id', '=', 'p.grado_id')
            ->select(
                'p.id as id',
                'e.id as especialidad_id',
                'e.nombre as especialidad',
                'g.id as grado_id',
                'g.descripcion as grado',
                'p.nombre as nombre',
                'p.estado as estado',
            )
            ->get();

        return response()->json($paralelos);
    }

    public function grado_especialidad()
    {
        $grados =  DB::table('grados')
            ->where('estado', 1)
            ->get();

        $especialidades =  DB::table('especialidads')
            ->where('estado', 1)
            ->get();

        return response()->json([
            'status' => true,
            'grados' => $grados,
            'especialidades' => $especialidades,
        ]);
    }

    public function show($paralelo_id)
    {
        $paralelo =  DB::table('paralelos')
            ->where('id', $paralelo_id)
            ->first();

        return response()->json(['status' => true, 'data' => $paralelo]);
    }

    public function store(ParaleloRequest $request)
    {
        DB::table('paralelos')->insert([
            'nombre' => $request->nombre,
            'grado_id' => $request->grado_id,
            'especialidad_id' => $request->especialidad_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Creado satisfatoriamente'
        ], 200);
    }

    public function update(ParaleloRequest $request)
    {
        $paralelo = DB::table('paralelos')
            ->where('id', $request->id)
            ->update([
                'nombre' => $request->nombre,
                'grado_id' => $request->grado_id,
                'especialidad_id' => $request->especialidad_id,
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Actualizado satisfatoriamente'
        ], 200);
    }

    public function delete($paralelo_id)
    {
        $paralelo = DB::table('paralelos')
            ->where('id', $paralelo_id)
            ->update([
                'estado' => 0,
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Eliminado satisfatoriamente'
        ], 200);
    }
}
