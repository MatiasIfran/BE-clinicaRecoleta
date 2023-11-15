<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Persona\CreatePersonaRequest;
use Illuminate\Support\Facades\Validator;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'personas';

    protected $fillable = [
        'Nombre',
        'Apellido',
        'FechaNacimiento',
        'Genero',
        'Direccion',
        'Telefono',
        'Mail',
        'tipoDocumento',
        'NumDocumento',
        'updated_at',
        'created_at',
        'usuario',
    ];

    public function createPersonaModel(CreatePersonaRequest $request) 
    {

        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            // Maneja el error según tus necesidades, puede lanzar una excepción o devolver un mensaje de error
            // Puedes personalizar esta lógica según tus necesidades
            // Por ejemplo, puedes lanzar una excepción BadRequestHttpException con el mensaje de error
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException($validator->errors()->first());
        }

        $data = $request->validated();

        $persona = $this->create($data);

        return $persona;
    }
}
