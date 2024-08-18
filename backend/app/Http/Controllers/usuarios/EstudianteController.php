<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\usuarios\EstudianteRequest;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    public function index()
    {

        $estudiantes = Estudiante::where('estado','!=',0)->orderBy('id','DESC')->with('persona.user')->get();
        //dd($estudiantes);
       /* $estudiantes = DB::table('personas', 'p')
            ->select(
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
                'e.fecha_alta as ingreso',
                'p.estado as estado',
            )
            ->join('estudiantes as e', 'e.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->get();*/

        return response()->json($estudiantes);
    }

    public function store(EstudianteRequest $request)
    {
        $user = User::create([ //AGREGAMOS PERSONA
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => bcrypt('"#$%%&&/jjj8')
        ]);

        if ($user) {
            $persona = Persona::create([
                'nombre' => mb_strtoupper($request->nombres, 'UTF-8'),
                'paterno' => mb_strtoupper($request->paterno, 'UTF-8'),
                'materno' => mb_strtoupper($request->materno, 'UTF-8'),
                'ci' => $request->ci,
                'expedido' => $request->expedido,
                'estado_civil' => 'SOLTERO',               
                'genero' => $request->genero,
                'user_id' => $user->id
            ]);
        }

        if($persona){
            $estudiante = Estudiante::create([
              'matricula' => 'ooo-45-024',
              'nota_ingreso' => $request->nota_ingreso,
              'fecha_alta' => Carbon::now(),
              'persona_id' => $persona->id,
              'grado_id' => 1,
              'especialidad_id' => 1
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Creado satisfatoriamente'
        ], 200);
    }
}
