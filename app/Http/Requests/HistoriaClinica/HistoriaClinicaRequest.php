<?php

namespace App\Http\Requests\historiaClinica;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseFormRequest;
use App\Models\HistoriaClinica;
use Illuminate\Validation\Rule;


class HistoriaClinicaRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', new HistoriaClinica);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_paciente' => 'required|exists:pacientes,id',
            'prof_cod' => 'required|exists:profesionales,Codigo',
            'trata' => 'nullable|string',
            'observ' => 'nullable|string',
            'link_imagen' => 'nullable|string',
            'fecha' => 'nullable|date_format:Y-m-d',
            'usuario' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'id_paciente.required' => 'El campo id_paciente es obligatorio.',
            'id_paciente.exists' => 'El id_paciente proporcionado no existe en la tabla pacientes.',
            'prof_cod.required' => 'El campo prof_cod es obligatorio.',
            'prof_cod.exists' => 'El prof_cod proporcionado no existe en la tabla profesionales.',
            'trata.string' => 'El campo trata debe ser una cadena de texto.',
            'observ.string' => 'El campo observ debe ser una cadena de texto.',
            'link_imagen.string' => 'El campo link_imagen debe ser una cadena de texto.',
            'fecha.date_format' => 'El formato de la fecha debe ser YYYY-MM-DD.',
            'usuario.required' => 'El campo usuario es obligatorio.',
            'usuario.string' => 'El campo usuario debe ser una cadena de texto.',
            'usuario.max' => 'El campo usuario no debe exceder los :max caracteres.',
        ];
    }
}
