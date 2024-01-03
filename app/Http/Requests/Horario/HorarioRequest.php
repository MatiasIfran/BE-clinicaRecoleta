<?php

namespace App\Http\Requests\Horario;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
use App\Models\Horario;
 
class HorarioRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', new Horario);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'profesional_id' => 'required|integer',
            'dia' => 'required|date',
            'desde' => 'required|string|max:5',
            'hasta' => 'required|string|max:5',
            'tiempo' => 'required|integer|min:0|max:99',
            'usuario' => 'required|max:50',
        ];
    }

    public function messages()
{
    return [
        'profesional_id.required' => 'El campo de profesional_id es obligatorio.',
        'dia.required' => 'El campo dia es obligatorio.',
        'dia.date' => 'El campo dia debe ser una fecha válida.',
        'desde.required' => 'El campo desde es obligatorio.',
        'desde.max' => 'El campo desde no puede tener más de :max caracteres.',
        'hasta.required' => 'El campo hasta es obligatorio.',
        'hasta.max' => 'El campo hasta no puede tener más de :max caracteres.',
        'tiempo.required' => 'El campo tiempo es obligatorio.',
        'tiempo.integer' => 'El campo tiempo debe ser un número entero.',
        'tiempo.min' => 'El campo tiempo no puede ser menor que :min.',
        'tiempo.max' => 'El campo tiempo no puede ser mayor que :max.',
        'usuario.required' => 'El nombre de usuario es obligatorio.',
        'usuario.max' => 'El nombre de usuario no puede superar los 50 caracteres.',
    ];
}

}
