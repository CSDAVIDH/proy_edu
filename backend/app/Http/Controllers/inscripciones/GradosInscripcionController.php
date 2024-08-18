<?php

namespace App\Http\Controllers\inscripciones;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradosInscripcionController extends Controller
{
    public function index()
    {
        $grados = DB::table('grados', 'g')
            ->get();

        return response()->json($grados);
    }

    public function datos(Request $request)
    {
        $date = Carbon::now();
        $fecha = $date->format('Y-m-d');
        if ($request->grado_id == 1) {
            $especialidades = DB::table('especialidads', 'es')
                ->where('id', 1)
                ->get();
        } else {
            $especialidades = DB::table('especialidads', 'es')
                ->get();
        }

        $paralelos = DB::table('paralelos', 'pa')
            ->where('grado_id', $request->grado_id)
            ->where('especialidad_id', $request->especialidad_id)
            ->get();

        $grado = DB::table('grados', 'g')
            ->where('id', $request->grado_id)
            ->first();

        $inscritos = DB::table('inscritos', 'in')
            ->get();

        return response()->json([
            'especialidades' => $especialidades,
            'inscritos' => $inscritos,
            'paralelos' => $paralelos,
            'fecha' => $fecha,
            'grado' => $grado,
            'datos' => $request->all()
        ]);
    }

    public function inscritos(Request $request)
    {

        $paralelos = DB::table('paralelos', 'pa')
            ->where('grado_id', $request->grado_id)
            ->where('especialidad_id', $request->especialidad_id)
            ->get();

        $inscritos = DB::table('estudiantes', 'e')
            ->select(
                'e.id as id',
                'p.id as persona_id',
                'p.nombre as nombre',
                'p.paterno as paterno',
                'p.materno as materno',
                'p.ci as ci',
                'p.expedido as expedido',
                'p.estado_civil as estado_civil',
                'p.genero as genero',
                'p.estado as esatdo',
                'e.matricula as matricula',
                'e.observacion as observacion',
                'e.fecha_alta as ingreso',
                'p.estado as estado',
            )
            ->join('inscritos as i', 'i.estudiante_id', '=', 'e.id')
            ->join('personas as p', 'p.id', '=', 'e.persona_id')
            ->where('e.grado_id', $request->grado_id)
            ->where('e.especialidad_id', $request->especialidad_id)
            ->where('i.periodo', $request->periodo)
            ->where('i.paralelo_id', $request->paralelo_id)
            ->whereYear('fecha', $request->fecha)
            ->get();
        

        return response()->json([
            'inscritos' => $inscritos,
            'paralelos' => $paralelos,
            'data' => $request->all()
        ]);
    }

    public function estudiantes(Request $request)
    {

        if ($request->grado_id == 1) {
            $grado = $request->grado_id;
            $observacion = [0, 3];
        } else {
            $grado = $request->grado_id;
            $observacion = [2, 3];
        }

        $estudiantes = DB::table('personas', 'p')
            ->select(
                'e.id as id',
                'p.id as persona_id',
                'p.nombre as nombre',
                'p.paterno as paterno',
                'p.materno as materno',
                'p.ci as ci',
                'p.expedido as expedido',
                'p.estado_civil as estado_civil',
                'p.genero as genero',
                'u.email as  email',
                'p.estado as esatdo',
                'e.matricula as matricula',
                'e.observacion as observacion',
                'e.fecha_alta as ingreso',
                'p.estado as estado',
            )
            ->join('estudiantes as e', 'e.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->where('e.grado_id', $grado)
            ->where('e.especialidad_id', $request->especialidad_id)
            ->whereIn('e.observacion', $observacion)
            ->get();

        $estudiantes_count = $estudiantes->count();

        return $estudiantes;
    }

    public function store(Request $request)
    {
        foreach ($request->estudiantes as $estudiante) {

            DB::table('inscritos')->insert([
                'fecha' => $request->fecha,
                'periodo' => $request->periodo,
                'grado_id' => $request->grado_id,
                'paralelo_id' => $request->paralelo_id,
                'estudiante_id' => $estudiante['id'],
            ]);

            DB::table('estudiantes')
                ->where('id', $estudiante['id'])
                ->update([
                    'observacion' => 1,
                ]);
        };
        // $respuesta = $request->studiantes['id'];

        return response()->json([
            'status' => true,
            'data' => $request->all(),
        ]);
    }
}
