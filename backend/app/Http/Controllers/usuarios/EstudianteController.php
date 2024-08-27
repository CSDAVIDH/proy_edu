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
use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = DB::table('personas', 'p')
            ->select(
                'e.id as id',
                'u.id as user_id',
                'p.id as persona_id',
                'p.nombre as nombre',
                'p.paterno as paterno',
                'p.materno as materno',
                'p.ci as ci',
                'p.expedido as expedido',
                'p.estado_civil as estado_civil',
                'p.genero as genero',
                'u.email as  email',
                'p.estado as estado',
                'e.fecha_alta as fecha_alta',
                'e.matricula as matricula',
                'u.imagen as imagen',
            )
            ->join('estudiantes as e', 'e.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->orderBy('e.id', 'desc')
            ->get();

        return response()->json($estudiantes);
    }

    public function show($persona_id)
    {
        $estudiante = DB::table('personas', 'p')
            ->select(
                'e.id as id',
                'u.id as user_id',
                'p.id as persona_id',
                'p.nombre as nombre',
                'p.paterno as paterno',
                'p.materno as materno',
                'p.ci as ci',
                'p.expedido as expedido',
                'p.estado_civil as estado_civil',
                'p.genero as genero',
                'u.email as  email',
                'p.estado as estado',
                'e.fecha_alta as fecha_alta',
                'e.matricula as matricula',
                'u.imagen as imagen',
            )
            ->join('estudiantes as e', 'e.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->where('p.id', $persona_id)
            ->get();

        return response()->json(['status' => true, 'data' => $estudiante]);
    }

    public function store(EstudianteRequest $request)
    {
        $date = Carbon::now();
        $fecha = $date->format('Y-m-d');
        if ($request->hasFile('imagen')) {
            $user = User::create([
                'name' => mb_strtoupper($request->nombre, 'UTF-8'),
                'email' => $request->email,
                'password' => bcrypt($request->ci),
                'imagen' => $request->imagen->store('estudiantes', 'public'),
            ]);
        } else {
            $user = User::create([
                'name' => mb_strtoupper($request->nombre, 'UTF-8'),
                'email' => $request->email,
                'password' => bcrypt($request->ci),
            ]);
        }
        $persona = Persona::create([
            'nombre' => mb_strtoupper($request->nombre, 'UTF-8'),
            'paterno' => mb_strtoupper($request->paterno, 'UTF-8'),
            'materno' => mb_strtoupper($request->materno, 'UTF-8'),
            'ci' => $request->ci,
            'expedido' => $request->expedido,
            'estado_civil' => $request->estado_civil,
            'genero' => $request->genero,
            'user_id' => $user->id,
        ]);


        $estudiante = Estudiante::create([
            'fecha_alta' => $fecha,
            'matricula' => mb_strtoupper($request->matricula, 'UTF-8'),
            'persona_id' => $persona->id,
            'grado_id' => 1,
            'especialidad_id' => 1
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Creado satisfatoriamente',
            'data' => $persona,
        ], 200);
    }

    public function update(EstudianteRequest $request)
    {
        $estudiante = Estudiante::find($request->id);
        $user = User::find($request->user_id);
        $persona = Persona::find($request->persona_id);
        $nombres = $request->nombre . ' ' . $request->paterno . ' ' . $request->matero;
        $user->name = mb_strtoupper($nombres, 'UTF-8');
        $user->email = $request->email;
        if ($request->hasFile('imagen')) {
            Storage::disk('public')->delete($user->imagen);
            $user->imagen = $request->imagen->store('estudiantes', 'public');
        }
        $user->save();

        $persona->nombre = mb_strtoupper($request->nombre, 'UTF-8');
        $persona->paterno = mb_strtoupper($request->paterno, 'UTF-8');
        $persona->materno = mb_strtoupper($request->materno, 'UTF-8');
        $persona->ci = $request->ci;
        $persona->expedido = $request->expedido;
        $persona->estado_civil = $request->estado_civil;
        $persona->genero = $request->genero;
        $persona->save();

        $estudiante->fecha_alta = $request->fecha_alta;
        $estudiante->matricula = mb_strtoupper($request->matricula, 'UTF-8');        
        $estudiante->save();

        return response()->json([
            'status' => true,
            'message' => 'Actualizado satisfatoriamente',
            'data' => $persona,
        ], 200);
    }

    public function delete(Persona $persona)
    {
        $persona->estado = 0;
        $persona->save();

        return response()->json([
            'status' => true,
            'message' => 'Eliminado satisfatoriamente',
            'data' => $persona,
        ], 200);
    }
}
