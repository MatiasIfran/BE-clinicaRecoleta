<?php

namespace App\Http\Requests\Feriado;

use App\Http\Requests\BaseFormRequest;
use App\Models\Feriado;

class FeriadoRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', new Feriado);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fecha' => 'required|date|unique:feriados',
            'motivo' => 'string',
            'titulo' => 'required|string',
            'usuario' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.unique' => 'La fecha ya está en uso.',
            'fecha.date' => 'Formato de fecha inválido.',
            'motivo.string' => 'El motivo debe ser una cadena de texto.',
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'usuario.required' => 'El nombre de usuario es obligatorio.',
            'usuario.max' => 'El nombre de usuario no puede superar los 50 caracteres.',
        ];
    }
}
