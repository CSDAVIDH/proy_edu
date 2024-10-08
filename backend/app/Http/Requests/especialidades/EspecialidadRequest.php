<?php

namespace App\Http\Requests\especialidades;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EspecialidadRequest extends FormRequest
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
                'nombre' => 'required',
                'descripcion' => 'required|string|max:200',
              ];
        } else {
            return [
                'nombre' => 'required',
                'descripcion' => 'required|string|max:200',
            ];
        }
    }
}
