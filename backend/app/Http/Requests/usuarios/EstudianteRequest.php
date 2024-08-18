<?php

namespace App\Http\Requests\usuarios;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EstudianteRequest extends FormRequest
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

            return [
                'paterno' => 'required|string|max:90',
                'materno' => 'required|string|max:90',
                'nombre' => 'required|string|max:90',
                'ci' => 'required|string|max:20|unique:personas,ci',
                'expedido' => 'required',
                'email' => 'required|email|unique:users',
                'nota' => 'required',
                'genero' => 'required'
            ];
        } else {
            return [
                'paterno' => 'required|string|max:90',
                'materno' => 'required|string|max:90',
                'nombre' => 'required|string|max:90',
                'ci' => 'required|string|max:20|unique:personas,ci'.$request->id,
                'expedido' => 'required',
                'email' => 'required|email|unique:users'.$request->id,
                'nota' => 'required',
                'genero' => 'required'
            ];
        }
    }
}
