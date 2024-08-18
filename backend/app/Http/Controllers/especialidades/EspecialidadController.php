<?php

namespace App\Http\Controllers\especialidades;

use App\Http\Controllers\Controller;
use App\Http\Requests\especialidades\EspecialidadRequest;
use Illuminate\Support\Facades\DB;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = DB::table('especialidads', 'e')
            ->select(
                'e.id as id',
                'e.nombre as nombre',
                'e.descripcion as descripcion',
                'e.estado as estado'
                
            )
            ->get();

        return response()->json($especialidades);
    }


    public function show($especialidad_id)
    {
        $especialidad =  DB::table('especialidads')
            ->where('id', $especialidad_id)
            ->first();

        return response()->json(['status' => true, 'data' => $especialidad]);
    }

    public function store(EspecialidadRequest $request)
    {
        DB::table('especialidads')->insert([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Creado satisfatoriamente'
        ], 200);
    }

    public function update(EspecialidadRequest $request)
    {
        $especialidad = DB::table('especialidads')
            ->where('id', $request->id)
            ->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Actualizado satisfatoriamente'
        ], 200);
    }

    

public function delete($especialidad_id)
{
    $especialidad = DB::table('especialidads')
        ->where('id', $especialidad_id)
        ->update([
            'estado' => 0,
        ]);

    return response()->json([
        'status' => true,
        'message' => 'Eliminado satisfatoriamente'
    ], 200);
}

}
