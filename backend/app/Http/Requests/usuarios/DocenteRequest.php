<?php

namespace App\Http\Requests\usuarios;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DocenteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(Request $request): array
    {
        if ($request->id == 0) {
            if ($request->hasFile('imagen')) {
                return [
                    'nombre' => 'required|string|max:90',
                    'paterno' => 'required|string|max:90',
                    'materno' => 'required|string|max:90',
                    'ci' => 'required|string|max:20|unique:personas,ci',
                    'expedido' => 'required',
                    'email' => 'required|email|unique:users',
                    'estado_civil' => 'required',
                    'genero' => 'required',
                    'especialidad' => 'required|string|max:90',
                    'grado' => 'required|string|max:90',
                    'imagen' => 'file|max:2048|mimes:jpeg,jpg,png',
                    'cv' => 'required|file|max:5000|mimes:pdf,docx,doc'
                ];
            } else {
                return [
                    'nombre' => 'required|string|max:90',
                    'paterno' => 'required|string|max:90',
                    'materno' => 'required|string|max:90',
                    'ci' => 'required|string|max:20|unique:personas,ci',
                    'expedido' => 'required',
                    'email' => 'required|email|unique:users',
                    'estado_civil' => 'required',
                    'genero' => 'required',
                    'especialidad' => 'required|string|max:90',
                    'grado' => 'required|string|max:90',
                    'cv' => 'required|file|max:5000|mimes:pdf,docx,doc'
                ];
            }
        } else {
            if ($request->hasFile('imagen')) {
                if ($request->hasFile('cv')) {
                    return [
                        'nombre' => 'required|string|max:90',
                        'paterno' => 'required|string|max:90',
                        'materno' => 'required|string|max:90',
                        'ci' => 'required|string|max:20|unique:personas,ci'.$request->persona_id,
                        'expedido' => 'required',
                        'email' => 'required|email|unique:users,email,'. $request->user_id,
                        'estado_civil' => 'required',
                        'genero' => 'required',
                        'especialidad' => 'required|string|max:90',
                        'grado' => 'required|string|max:90',
                        'imagen' => 'file|max:2048|mimes:jpeg,jpg,png',
                        'cv' => 'required|file|max:5000|mimes:pdf,docx,doc'
                    ];
                } else {
                    return [
                        'nombre' => 'required|string|max:90',
                        'paterno' => 'required|string|max:90',
                        'materno' => 'required|string|max:90',
                        'ci' => 'required|string|max:20|unique:personas,ci,'. $request->persona_id,
                        'expedido' => 'required',
                        'email' => 'required|email|unique:users,email,'. $request->user_id,
                        'estado_civil' => 'required',
                        'genero' => 'required',
                        'especialidad' => 'required|string|max:90',
                        'grado' => 'required|string|max:90',
                        'imagen' => 'file|max:2048|mimes:jpeg,jpg,png',
                    ];
                }
            } else {
                if ($request->hasFile('cv')) {
                    return [
                        'nombre' => 'required|string|max:90',
                        'paterno' => 'required|string|max:90',
                        'materno' => 'required|string|max:90',
                        'ci' => 'required|string|max:20|unique:personas,ci,'. $request->persona_id,
                        'expedido' => 'required',
                        'email' => 'required|email|unique:users,email,'. $request->user_id,
                        'estado_civil' => 'required',
                        'genero' => 'required',
                        'especialidad' => 'required|string|max:90',
                        'grado' => 'required|string|max:90',
                        'cv' => 'required|file|max:5000|mimes:pdf,docx,doc'
                    ];
                } else {
                    return [
                        'nombre' => 'required|string|max:90',
                        'paterno' => 'required|string|max:90',
                        'materno' => 'required|string|max:90',
                        'ci' => 'required|string|max:20|unique:personas,ci,'. $request->persona_id,
                        'expedido' => 'required',
                        'email' => 'required|email|unique:users,email,'. $request->user_id,
                        'estado_civil' => 'required',
                        'genero' => 'required',
                        'especialidad' => 'required|string|max:90',
                        'grado' => 'required|string|max:90',
                    ];
                }
            }
        }
    }
}
