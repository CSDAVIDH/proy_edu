<?php

namespace App\Http\Controllers\inscripciones;

use App\Http\Controllers\Controller;
use App\Models\Inscrito;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteInscripcionController extends Controller
{
    public function index()
    {
        $estudiantes = DB::table('estudiantes', 'e')
            ->join('personas as p', 'p.id', '=', 'e.persona_id')
            ->select(
                'e.id as id',
                'e.matricula as matricula',
                'e.reincidencia as reincidencia',
                'e.observacion as observacion',
                'e.estado as estado',
                'p.nombre as nombre',
                'p.paterno as paterno',
                'p.ci as ci',
                'p.expedido as expedido',
                'p.materno as materno',
                'e.grado_id as grado_id',
                'e.especialidad_id as especialidad_id'
            )
            ->where('e.estado', 1)
            ->get();

        return response()->json($estudiantes);
    }

    public function estudiante($estudiante_id)
    {
        $date = Carbon::now();
        $fecha = $date->format('Y-m-d');
        $mes = $date->format('m');
        $anio = $date->format('y');
        if ($mes > 6) {
            $periodo = 2;
        } else {
            $periodo = 1;
        }
        $estudiante = DB::table('estudiantes', 'e')
            ->join('personas as p', 'p.id', '=', 'e.persona_id')
            ->join('especialidads as es', 'es.id', '=', 'e.especialidad_id')
            ->join('grados as g', 'g.id', '=', 'e.grado_id')
            ->select(
                'e.id as id',
                'e.matricula as matricula',
                'e.reincidencia as reincidencia',
                'e.observacion as observacion',
                'e.estado as estado',
                'e.grado_id as grado_id',
                'e.especialidad_id as especialidad_id',
                'p.nombre as nombre',
                'p.paterno as paterno',
                'p.ci as ci',
                'p.expedido as expedido',
                'p.materno as materno',
                'g.descripcion as grado',
                'es.nombre as especialidad',
            )
            ->where('e.estado', 1)
            ->where('e.id', $estudiante_id)
            ->first();

        $inscripcion = DB::table('inscritos', 'i')
            ->where('i.estudiante_id', $estudiante->id)
            ->where('i.grado_id', $estudiante->grado_id)
            ->first();

        $materias = DB::table('grados', 'g')
            ->join('materias as m', 'm.grado_id', '=', 'g.id')
            ->join('inscritos as i', 'i.grado_id', '=', 'g.id')
            ->join('paralelos as p', 'p.id', '=', 'i.paralelo_id')
            ->join('especialidads as e', 'e.id', '=', 'm.especialidad_id')
            ->where('i.grado_id', $estudiante->grado_id)
            ->where('i.estudiante_id', $estudiante->id)
            ->where('i.periodo', $periodo)
            ->whereYear('fecha', $fecha)
            ->select(
                'm.id as id',
                'm.nombre as nombre',
                'm.sigla as sigla',
                'm.tipo as tipo',
                'm.horas_cademicas as horas',
                'm.sigla as sigla',
                'm.porcentaje as porcentaje',
                'g.descripcion as grado',
                'm.estado as estado',
                'p.nombre as paralelo',
                'e.nombre as especialidad',
            )
            ->get();

        $paralelos = DB::table('paralelos', 'p')
            ->where('p.grado_id', $estudiante->grado_id)
            ->get();

        $especialidades = DB::table('especialidads', 'es')
            ->get();

        return response()->json([
            'estudiante' => $estudiante,
            'paralelos' => $paralelos,
            'especialidades' => $especialidades,
            'inscripcion' => $inscripcion,
            'materias' => $materias,
        ]);
    }

    public function asignar_paralelo(Request $request)
    {
        $date = Carbon::now();
        $fecha = $date->format('Y-m-d');
        $mes = $date->format('m');
        if ($mes > 6) {
            $periodo = 2;
        } else {
            $periodo = 1;
        }

        DB::table('inscritos')->insert([
            'grado_id' => $request->grado_id,
            'paralelo_id' => $request->paralelo_id,
            'estudiante_id' => $request->estudiante_id,
            'fecha' => $fecha,
            'periodo' => $periodo,
        ]);

        DB::table('estudiantes')
            ->where('id', $request->estudiante_id)
            ->update([
                'observacion' => 1,
            ]);

        return response()->json([
            'status' => true,
            'mensaje' => 'agregado correctamente',
        ]);
    }

    public function actualizar_paralelo(Request $request)
    {
        DB::table('inscritos')
            ->where('estudiante_id', $request->estudiante_id)
            ->where('grado_id', $request->grado_id)
            ->update([
                'paralelo_id' => $request->paralelo_id,
            ]);

        DB::table('estudiantes')
            ->where('id', $request->estudiante_id)
            ->update([
                'observacion' => 1,
            ]);

        return response()->json([
            'status' => true,
            'mensaje' => 'actualizado correctamente',
        ]);
    }
}
