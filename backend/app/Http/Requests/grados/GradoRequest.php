<?php

namespace App\Http\Requests\grados;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GradoRequest extends FormRequest
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
                'nivel' => 'required',
                'descripcion' => 'required|string|max:200',
              ];
        } else {
            return [
                'nivel' => 'required',
                'descripcion' => 'required|string|max:200',
            ];
        }
    }
}
