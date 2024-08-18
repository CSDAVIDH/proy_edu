<?php

namespace App\Http\Requests\materias;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MateriaRequest extends FormRequest
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
                'nombre' => 'required|string|max:90|unique:materias,nombre',
                'sigla' => 'required|string|max:20|unique:materias,sigla',
                'horas_cademicas' => 'required',
                'grado_id' => 'required',
            ];
        } else {
            return [
                'nombre' => 'required|string|max:90|unique:materias,nombre,'.$request->id,
                'sigla' => 'required|string|max:20|unique:materias,sigla,'.$request->id,
                'horas_cademicas' => 'required',
                'grado_id' => 'required',
            ];
        }
    }
}
