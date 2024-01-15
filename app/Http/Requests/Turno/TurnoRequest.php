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
            'prof_cod' => 'required|integer|exists:profesionales,codigo',
            "fechaInicio" => 'required',
            "fechaFin"  => 'required',
            "fecha" => 'date_format:Y-m-d',
            'paciente_id' => 'integer|exists:pacientes,id',
            'usuario' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'prof_cod.required' => 'El id del prof_cod es obligatorio.',
            'prof_cod.exists' => 'El prof_cod seleccionado no existe.',
            'fechaInicio.required' => 'La fecha inicio es requerida',
            'fechaFin.required' => 'La fecha fin es requerida',
            'fecha.date_format' => 'El formato de la fecha debe ser YYYY-MM-DD.',
            'paciente_id.exists' => 'El paciente seleccionado no existe.',
            'usuario.required' => 'El nombre de usuario es obligatorio.',
            'usuario.max' => 'El nombre de usuario no puede superar los 50 caracteres.',
        ];
    }
}
