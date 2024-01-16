<?php

namespace App\Http\Requests\codigoPostal;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CodigoPostal;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class CodigoPostalRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', new CodigoPostal);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codigo' => 'required|string|max:5',
            'ciudad' => 'required|string|max:50',
            'provincia' => 'required|string|max:50',
            'usuario' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'El campo codigo es obligatorio.',
            'codigo.string' => 'El campo codigo debe ser una cadena de texto.',
            'codigo.max' => 'El campo Nombre no debe tener más de :max caracteres.',
            'ciudad.required' => 'El campo ciudad es obligatorio.',
            'ciudad.string' => 'El campo ciudad debe ser una cadena de texto.',
            'provincia.required' => 'El campo provincia es obligatorio.',
            'provincia.string' => 'El campo provincia debe ser una cadena de texto.',
            'usuario.required' => 'El campo Nombre es obligatorio.',
        ];
    }
}
