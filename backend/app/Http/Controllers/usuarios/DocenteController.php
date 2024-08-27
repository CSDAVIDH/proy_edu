<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\usuarios\DocenteRequest;
use App\Models\Docente;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class DocenteController extends Controller
{
    public function index()
    {
        $docentes = DB::table('personas', 'p')
            ->select(
                'd.id as id',
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
                'd.especialidad as especialidad',
                'd.grado as grado',
                'u.imagen as imagen',
                'd.cv as cv',
            )
            ->join('docentes as d', 'd.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->orderBy('d.id', 'desc')
            ->get();

        return response()->json($docentes);
    }

    public function show($persona_id)
    {
        $docente = DB::table('personas', 'p')
            ->select(
                'd.id as id',
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
                'd.especialidad as especialidad',
                'd.grado as grado',
                'u.imagen as imagen',
                'd.cv as cv',
            )
            ->join('docentes as d', 'd.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->where('p.id', $persona_id)
            ->get();

        return response()->json(['status' => true, 'data' => $docente]);
    }

    public function store(DocenteRequest $request)
    {

        if ($request->hasFile('imagen')) {
            $user = User::create([
                'name' => mb_strtoupper($request->nombre, 'UTF-8'),
                'email' => $request->email,
                'password' => bcrypt($request->ci),
                'imagen' => $request->imagen->store('docentes', 'public'),
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


        $docente = Docente::create([
            'especialidad' => mb_strtoupper($request->especialidad, 'UTF-8'),
            'grado' => mb_strtoupper($request->grado, 'UTF-8'),
            'cv' => $request->cv->store('docentes', 'public'),
            'persona_id' => $persona->id,
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Creado satisfatoriamente',
            'data' => $persona,
        ], 200);
    }

    public function update(DocenteRequest $request)
    {
        $docente = Docente::find($request->id);
        $user = User::find($request->user_id);
        $persona = Persona::find($request->persona_id);
        $nombres = $request->nombre . ' ' . $request->paterno . ' ' . $request->matero;
        $user->name = mb_strtoupper($nombres, 'UTF-8');
        $user->email = $request->email;
        if ($request->hasFile('imagen')) {
            Storage::disk('public')->delete($user->imagen);
            $user->imagen = $request->imagen->store('docentes', 'public');
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

        $docente->especialidad = mb_strtoupper($request->especialidad, 'UTF-8');
        $docente->grado = mb_strtoupper($request->grado, 'UTF-8');
        if ($request->hasFile('cv')) {
            Storage::disk('public')->delete($docente->cv);
            $docente->cv = $request->cv->store('administrativos', 'public');
        } 
        $docente->save();
       
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
