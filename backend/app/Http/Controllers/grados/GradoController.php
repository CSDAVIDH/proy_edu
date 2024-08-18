<?php

namespace App\Http\Controllers\grados;

use App\Http\Controllers\Controller;
use App\Http\Requests\grados\GradoRequest;
use Illuminate\Support\Facades\DB;

class GradoController extends Controller
{
    public function index()
    {
        $grados = DB::table('grados', 'g')
            ->select(
                'g.id as id',
                'g.nivel as nivel',
                'g.descripcion as descripcion',
                'g.estado as estado',
            )
            ->get();

        return response()->json($grados);
    }


    public function show($grado_id)
    {
        $grado =  DB::table('grados')
            ->where('id', $grado_id)
            ->first();

        return response()->json(['status' => true, 'data' => $grado]);
    }

    public function store(GradoRequest $request)
    {
        DB::table('grados')->insert([
            'nivel' => $request->nivel,
            'descripcion' => $request->descripcion,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Creado satisfatoriamente'
        ], 200);
    }

    public function update(GradoRequest $request)
    {
        $grado = DB::table('grados')
            ->where('id', $request->id)
            ->update([
                'nivel' => $request->nivel,
                'descripcion' => $request->descripcion,
                
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Actualizado satisfatoriamente'
        ], 200);
    }

    public function delete($grado_id)
    {
        $grado = DB::table('grados')
            ->where('id', $grado_id)
            ->update([
                'estado' => 0,
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Eliminado satisfatoriamente'
        ], 200);
    }
}
