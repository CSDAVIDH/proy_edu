<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\usuarios\AdministrativoRequest;
use App\Models\Administrativo;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdministrativoController extends Controller
{
    public function index()
    {
        $administrativos = DB::table('personas', 'p')
            ->select(
                'a.id as id',
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
                'a.cargo as cargo',
                'a.grado as grado',
                'u.imagen as imagen',
                'a.cv as cv',
            )
            ->join('administrativos as a', 'a.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->orderBy('a.id', 'desc')
            ->get();

        return response()->json($administrativos);
    }

    public function show($persona_id)
    {
        $administrativo = DB::table('personas', 'p')
            ->select(
                'a.id as id',
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
                'a.cargo as cargo',
                'a.grado as grado',
                'u.imagen as imagen',
                'a.cv as cv',
            )
            ->join('administrativos as a', 'a.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->where('p.id', $persona_id)
            ->get();

        return response()->json(['status' => true, 'data' => $administrativo]);
    }

    public function store(AdministrativoRequest $request)
    {

        if ($request->hasFile('imagen')) {
            $user = User::create([
                'name' => mb_strtoupper($request->nombre, 'UTF-8'),
                'email' => $request->email,
                'password' => bcrypt($request->ci),
                'imagen' => $request->imagen->store('administrativos', 'public'),
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


        $administrativo = Administrativo::create([
            'cargo' => mb_strtoupper($request->cargo, 'UTF-8'),
            'grado' => mb_strtoupper($request->grado, 'UTF-8'),
            'cv' => $request->cv->store('administrativos', 'public'),
            'persona_id' => $persona->id,
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Creado satisfatoriamente',
            'data' => $persona,
        ], 200);
    }

    public function update(AdministrativoRequest $request)
    {
        $administrativo = Administrativo::find($request->id);
        $user = User::find($request->user_id);
        $persona = Persona::find($request->persona_id);
        $nombres = $request->nombre . ' ' . $request->paterno . ' ' . $request->matero;
        $user->name = mb_strtoupper($nombres, 'UTF-8');
        $user->email = $request->email;
        if ($request->hasFile('imagen')) {
            Storage::disk('public')->delete($user->imagen);
            $user->imagen = $request->imagen->store('administrativos', 'public');
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

        $administrativo->cargo = mb_strtoupper($request->cargo, 'UTF-8');
        $administrativo->grado = mb_strtoupper($request->grado, 'UTF-8');
        if ($request->hasFile('cv')) {
            Storage::disk('public')->delete($administrativo->cv);
            $administrativo->cv = $request->cv->store('administrativos', 'public');
        } 
        $administrativo->save();
       
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
