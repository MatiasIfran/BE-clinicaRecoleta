<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Paciente\CreatePacienteRequest;
use Illuminate\Support\Facades\Validator;

class Paciente extends Model
{
    use HasFactory;
    protected $table = 'pacientes';

    protected $fillable = [
        'Nombre',
        'Apellido',
        'FechaNacimiento',
        'Genero',
        'CodPos',
        'Direccion',
        'Telefono',
        'Mail',
        'tipoDocumento',
        'NumDocumento',
        'Cuit',
        'NumAfiliado',
        'Empres',
        'DetaPlan',
        'Plan',
        'Antecedentes',
        'usuario',
    ];

    public function createPacienteModel(CreatePacienteRequest $request)
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

        $paciente = $this->create($data);

        return $paciente;
    }
}
