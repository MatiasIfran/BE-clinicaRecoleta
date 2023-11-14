<?php

namespace App\Http\Requests\Persona;

use App\Http\Requests\BaseFormRequest;

class CreatePersonaRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Nombre' => 'required|string|max:50',
            'Apellido' => 'required|string|max:50',
            'FechaNacimiento' => 'date',
            'Genero' => 'nullable|string',
            'Direccion' => 'nullable|string|max:100',
            'Telefono' => 'nullable|string|max:15',
            'Mail' => 'required|string|email|unique:personas',
            'NumDocumento' => 'required|integer|unique:personas',
        ];
    }

    public function messages()
    {
        return [
            'Nombre.required' => 'El campo Nombre es obligatorio.',
            'Nombre.string' => 'El campo Nombre debe ser una cadena de texto.',
            'Nombre.max' => 'El campo Nombre no debe tener más de :max caracteres.',
            'Apellido.required' => 'El campo Apellido es obligatorio.',
            'Apellido.string' => 'El campo Apellido debe ser una cadena de texto.',
            'Apellido.max' => 'El campo Apellido no debe tener más de :max caracteres.',
            'Mail.unique' => 'La dirección de correo electrónico ya está en uso.',
            'NumDocumento.unique' => 'El numero de documento ya está en uso.',
        ];
    }
}
