<?php

namespace App\Http\Requests\obraSocial;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ObraSocial;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Requests\BaseFormRequest;

class ObraSocialRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', new ObraSocial);
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
            'descripcion' => 'required|string',
            'activa' => 'string|max:50',
            'orden' => 'string|max:50',
            'maxAnual' => 'string|max:50',
            'maxMensual' => 'string|max:50',
            'vigencia' => 'date_format:Y-m-d',
            'mensaje1' => 'string',
            'usuario' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'El campo codigo es obligatorio.',
            'codigo.string' => 'El campo codigo debe ser una cadena de texto.',
            'codigo.max' => 'El campo Nombre no debe tener más de :max caracteres.',
            'descripcion.required' => 'El campo codigo es obligatorio.',
            'descripcion.string' => 'El campo codigo debe ser una cadena de texto.',
            'usuario.required' => 'El campo Nombre es obligatorio.',
        ];
    }
}
