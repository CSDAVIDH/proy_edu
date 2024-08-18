<?php

namespace App\Http\Requests\paralelos;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ParaleloRequest extends FormRequest
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
                'nombre' => 'required|string|max:90',
                'grado_id' => 'required',
                'especialidad_id'=>'required',
            ];
        } else {
            return [
                'nombre' => 'required|string|max:90',
                'especialidad_id'=>'required',
                'grado_id' => 'required',
            ];
        }
    }
}
