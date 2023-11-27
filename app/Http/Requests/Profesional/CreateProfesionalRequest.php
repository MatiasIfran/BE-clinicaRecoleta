<?php

namespace App\Http\Requests\Profesional;

use App\Models\Profesional;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class CreateProfesionalRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', new Profesional);
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
            'Mail' => 'nullable|string|email|unique:profesionales',
            'NumDocumento' => 'required|integer|unique:profesionales',
            'tipoDocumento' => ['required',
                                'integer', 
                                Rule::exists('tipoDocumento', 'idTipoDocumento')
            ],
            'usuario' => 'required|string|max:50',
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
            'tipoDocumento.required' => 'El tipo de documento es obligatorio.',
            'NumDocumento.required' => 'El numero de documento es obligatorio.',
            'NumDocumento.unique' => 'El numero de documento ya está en uso.',
        ];
    }
}
