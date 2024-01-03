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
            'codigo' => 'required|string|max:50',
            'descripcion' => 'required|string|max:50',
            'usuario' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'El campo codigo es obligatorio.',
            'codigo.string' => 'El campo codigo debe ser una cadena de texto.',
            'descripcion.required' => 'El campo descripcion es obligatorio.',
            'descripcion.string' => 'El campo descripcion debe ser una cadena de texto.',
            'usuario.required' => 'El campo Nombre es obligatorio.',
        ];
    }
}
