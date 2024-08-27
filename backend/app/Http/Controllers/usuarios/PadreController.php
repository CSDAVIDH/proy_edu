<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\usuarios\PadreResquest;
use App\Models\Padre;
use App\Models\Persona;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PadreController extends Controller
{
    public function index()
    {
        $padres = DB::table('personas', 'p')
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
                'p.direccion as direccion',
                'p.telefono as telefono',
                'u.email as  email',
                'p.estado as estado',
                'e.profesion as profesion',
                'u.imagen as imagen',
            )
            ->join('padres as e', 'e.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->orderBy('e.id', 'desc')
            ->get();

        return response()->json($padres);
    }

    public function show($persona_id)
    {
        $padre = DB::table('personas', 'p')
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
                'p.direccion as direccion',
                'p.telefono as telefono',
                'p.genero as genero',
                'u.email as  email',
                'p.estado as estado',
                'e.profesion as profesion',
                'u.imagen as imagen',
            )
            ->join('padres as e', 'p.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->where('p.id', $persona_id)
            ->get();

        return response()->json(['status' => true, 'data' => $padre]);
    }

    public function store(PadreResquest $request)
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
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'genero' => $request->genero,
            'user_id' => $user->id,
        ]);


        $padre = Padre::create([
            'profesion' => mb_strtoupper($request->profesion, 'UTF-8'),
            'persona_id' => $persona->id,
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Creado satisfatoriamente',
            'data' => $persona,
        ], 200);
    }

    public function update(PadreResquest $request)
    {
        $padre = Padre::find($request->id);
        $user = User::find($request->user_id);
        $persona = Persona::find($request->persona_id);
        $nombres = $request->nombre . ' ' . $request->paterno . ' ' . $request->matero;
        $user->name = mb_strtoupper($nombres, 'UTF-8');
        $user->email = $request->email;
        if ($request->hasFile('imagen')) {
            Storage::disk('public')->delete($user->imagen);
            $user->imagen = $request->imagen->store('padres', 'public');
        }
        $user->save();

        $persona->nombre = mb_strtoupper($request->nombre, 'UTF-8');
        $persona->paterno = mb_strtoupper($request->paterno, 'UTF-8');
        $persona->materno = mb_strtoupper($request->materno, 'UTF-8');
        $persona->ci = $request->ci;
        $persona->expedido = $request->expedido;
        $persona->estado_civil = $request->estado_civil;
        $persona->genero = $request->genero;
        $persona->telefono = $request->telefono;
        $persona->direccion = $request->direccion;
        $persona->save();

        $padre->profesion = mb_strtoupper($request->profesion, 'UTF-8');        
        $padre->save();

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
