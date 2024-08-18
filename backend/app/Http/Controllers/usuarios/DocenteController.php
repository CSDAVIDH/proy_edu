<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Models\Administrativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    public function index()
    {
        $administrativos = Administrativo::where('estado','!=',0)->orderBy('id','DESC')->with('persona')->get();
        /*$administrativos = DB::table('personas', 'p')
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
                'd.grado as grado',
                'd.especialidad as especialidad',
                'd.cv as cv',
                'p.estado as estado',
            )
            ->join('docentes as d', 'd.persona_id', '=', 'p.id')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->get();*/

        return response()->json($administrativos);
    }
}
