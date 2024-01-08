<?php

namespace App\Http\Requests\Turno;

use App\Models\Turno;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class TurnoRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', new Turno);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'horario_id' => 'required|integer|exists:horarios,id',
            'paciente_id' => 'required|integer|exists:pacientes,id',
            'usuario' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'horario_id.required' => 'El id del horario es obligatorio.',
            'horario_id.exists' => 'El horario seleccionado no existe.',
            'paciente_id.required' => 'El id del paciente es obligatorio.',
            'paciente_id.exists' => 'El paciente seleccionado no existe.',
            'usuario.required' => 'El nombre de usuario es obligatorio.',
            'usuario.max' => 'El nombre de usuario no puede superar los 50 caracteres.',
        ];
    }
}
