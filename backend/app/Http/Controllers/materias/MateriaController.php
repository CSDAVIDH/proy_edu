<?php

namespace App\Http\Controllers\materias;

use App\Http\Controllers\Controller;
use App\Http\Requests\materias\MateriaRequest;
use Illuminate\Support\Facades\DB;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = DB::table('materias', 'm')
            ->join('especialidads as e', 'e.id', '=', 'm.especialidad_id')
            ->join('grados as g', 'g.id', '=', 'm.grado_id')
            ->select(
                'm.id as id',
                'm.nombre as nombre',
                'm.sigla as sigla',
                'm.tipo as tipo',
                'm.horas_cademicas as horas',
                'm.sigla as sigla',
                'm.porcentaje as porcentaje',
                'g.descripcion as grado',
                'e.nombre as especialidad',
                'm.estado as estado',
            )
            ->get();

        return response()->json($materias);
    }

    public function grado_especialidad()
    {
        $grados =  DB::table('grados')->where('estado',1)
            ->get();

        $especialidades =  DB::table('especialidads')->where('estado',1)
            ->get();

        return response()->json([
            'status' => true, 
            'grados' => $grados,
            'especialidades' => $especialidades,
        ]);
    }

    public function show($materia_id)
    {
        $materia =  DB::table('materias')
            ->where('id', $materia_id)
            ->first();

        return response()->json(['status' => true, 'data' => $materia]);
    }

    public function store(MateriaRequest $request)
    {
        DB::table('materias')->insert([
            'nombre' => $request->nombre,
            'sigla' => $request->sigla,
            'porcentaje'=> $request->porcentaje,
            'tipo'=>$request->tipo,
            'horas_cademicas' => $request->horas_cademicas,
            'grado_id' => $request->grado_id,
            'especialidad_id'=>$request->especialidad_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Creado satisfatoriamente'
        ], 200);
    }

    public function update(MateriaRequest $request)
    {
        $materia = DB::table('materias')
            ->where('id', $request->id)
            ->update([
                'nombre' => $request->nombre,
                'sigla' => $request->sigla,
                'porcentaje'=> $request->porcentaje,
                'tipo'=>$request->tipo,
                'horas_cademicas' => $request->horas_cademicas,
                'grado_id' => $request->grado_id,
                'especialidad_id'=>$request->especialidad_id,
          
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Actualizado satisfatoriamente'
        ], 200);
    }

    public function delete($materia_id)
    {
        $course = DB::table('materias')
            ->where('id', $materia_id)
            ->update([
                'estado' => 0,
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Eliminado satisfatoriamente'
        ], 200);
    }
}
