<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Profesional\CreateProfesionalRequest;
use Illuminate\Support\Facades\Validator;

class Profesional extends Model
{
    use HasFactory;
    protected $table = 'profesionales';

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
        'Matricula',
        'Categoria',
        'Cuit',
        'Codigo',
        'usuario',
    ];

    public function createProfesionalModel(CreateProfesionalRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            // Maneja el error según tus necesidades, puede lanzar una excepción o devolver un mensaje de error
            // Puedes personalizar esta lógica según tus necesidades
            // Por ejemplo, puedes lanzar una excepción BadRequestHttpException con el mensaje de error
            $data = [
                'status' => false,
                'error'  => $validator->errors()->first(),
            ];
            return response()->json($data, 400);
        }

        $data = $request->validated();

        $profesional = $this->create($data);

        return $profesional;
    }
}
