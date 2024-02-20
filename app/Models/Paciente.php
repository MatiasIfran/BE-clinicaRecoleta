<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Paciente\CreatePacienteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Paciente extends Model
{
    use HasFactory;
    protected $table = 'pacientes';

    protected $fillable = [
        'Nombre',
        'Direccion',
        'CodPos',
        'TipoDocumento',
        'NumDocumento',
        'Telefono',
        'Celular',
        'FechaNacimiento',
        'NumAfiliado',
        'Empres',
        'Antecedentes',
        'Iva',
        'Cuit',
        'DetaPlan',
        'Plan',
        'Mail',
        'Genero',
        'Modulo',
        'hc',
        'MedCabecera',
        'usuario',
    ];

    public function createPacienteModel(CreatePacienteRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
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

    public function updatePaciente(Request $request, $pacienteDni)
    {
        $validator = Validator::make($request->all(), [
            'Nombre' => 'string',
            'Direccion' => 'string',
            'CodPos' => 'string',
            'TipoDocumento' => 'string',
            'NumDocumento' => 'numeric',
            'Telefono' => 'string',
            'Celular' => 'string',
            'FechaNacimiento' => 'date',
            'NumAfiliado' => 'string',
            'Empres' => 'string',
            'Antecedentes' => 'string',
            'Iva' => 'string',
            'Cuit' => 'string',
            'DetaPlan' => 'string',
            'Plan' => 'string',
            'Mail' => 'string',
            'Genero' => 'string',
            'Modulo' => 'string',
            'hc' => 'string',
            'MedCabecera' => 'string',
            'usuario' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => 'El nombre de usuario es obligatorio.'], 400);
        }

        $filtered = array_filter($request->all(), function ($value) {
            return $value !== null || $value !== '';
        });

        if (empty(array_diff_key($filtered, array_flip(['usuario'])))) 
        {
            $data = [
                'status' => false,
                'error' => 'Debe proporcionar al menos un campo para actualizar.',
            ];
            return response()->json($data, 400);
        }

        $paciente = Paciente::where('NumDocumento', $pacienteDni)->first();

        info($paciente);
        if (!$paciente) {
            $data = [
                'status' => false,
                'error' => 'Paciente no encontrado',
            ];
            return response()->json($data, 404);
        }

        $paciente->fill($request->only([
            'Nombre', 'Direccion', 'CodPos', 'TipoDocumento', 'NumDocumento',
            'Telefono', 'Celular', 'FechaNacimiento', 'NumAfiliado', 'Empres',
            'Antecedentes', 'Iva', 'Cuit', 'DetaPlan', 'Plan', 'Mail', 'Genero',
            'Modulo', 'hc', 'MedCabecera', 'usuario'
        ]));

        if ($paciente->save()) {
            $data = [
                'status' => true,
                'message' => 'Paciente actualizado correctamente',
                'result' => $paciente,
            ];
            return response()->json($data, 200);
        }

        $data = [
            'status' => false,
            'error' => 'No se pudo actualizar el paciente.',
        ];
        return response()->json($data, 400);
    }
}
