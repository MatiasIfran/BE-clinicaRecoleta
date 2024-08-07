<?php

namespace App\Http\Requests\Paciente;

use App\Models\Paciente;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class CreatePacienteRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', new Paciente);
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
            'FechaNacimiento' => 'date',
            'Genero' => 'nullable|string',
            'Direccion' => 'nullable|string|max:100',
            'Telefono' => 'nullable|string|max:15',
            'Mail' => 'nullable|string|email|unique:pacientes',
            'NumDocumento' => 'required|integer|unique:pacientes',
            'TipoDocumento' => ['required',
                                'integer', 
                                Rule::exists('tipoDocumento', 'idTipoDocumento')
            ],
            'CodPos'  => 'nullable|string',
            'Celular' => 'nullable',
            'NumAfiliado'  => 'nullable|string',
            'Plan'  => 'nullable|string',
            'Plan2'  => 'nullable|string',
            'Antecedentes' => 'nullable|string',
            'hc' => 'nullable|string',
            'Cabecera' => 'nullable|string',
            'usuario' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'Nombre.required' => 'El campo Nombre es obligatorio.',
            'Nombre.string' => 'El campo Nombre debe ser una cadena de texto.',
            'Nombre.max' => 'El campo Nombre no debe tener más de :max caracteres.',
            'Mail.unique' => 'La dirección de correo electrónico ya está en uso.',
            'TipoDocumento.required' => 'El tipo de documento es obligatorio.',
            'NumDocumento.required' => 'El numero de documento es obligatorio.',
            'NumDocumento.unique' => 'El numero de documento ya está en uso.',
            'usuario.required' => 'El campo usuario es obligatorio.',
            'usuario.string' => 'El campo usuario debe ser una cadena de texto.',
            'usuario.max' => 'El campo usuario no debe tener más de :max caracteres.',
        ];
    }
}
