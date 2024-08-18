<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\usuarios\AdministrativoRequest;
use App\Models\Administrativo;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdministrativoController extends Controller
{
    public function index()
    {
        $administrativos = DB::table('personas', 'p')
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
                'a.cargo as cargo',
                'a.grado as grado',
                'a.cv as cv',
            )
            ->join('administrativos as a', 'a.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->get();

        return response()->json($administrativos);
    }

    public function show($persona_id)
    {
        $administrativo = DB::table('personas', 'p')
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
                'a.cargo as cargo',
                'a.grado as grado',
                'a.cv as cv',
                'p.estado as estado',
            )
            ->join('administrativos as a', 'a.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->where('p.id', $persona_id)
            ->get();

        return response()->json(['status' => true, 'data' => $administrativo]);
    }

    public function store(AdministrativoRequest $request)
    {

        $user = User::create([
            'name' => mb_strtoupper($request->nombre, 'UTF-8'),
            'email' => $request->email,
            'password' => bcrypt($request->ci),
        ]);

        $persona = Persona::create([
            'nombres' => $request->nombre,
            'paterno' => $request->paterno,
            'materno' => $request->materno,
            'ci' => $request->ci,
            'estado_civil' => $request->estado_civil,
            'genero' => $request->genero,
            'user_id' => $user->id,
        ]);

        $administrativo = Administrativo::create([
            'cargo' => $request->cargo,
            'grado' => $request->grado,
            'cv' => $request->cv->store('administrartivos', 'public'),
            'persona_id' => $persona->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Curso creado satisfatoriamente'
        ], 200);
    }
    
}
