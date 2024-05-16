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
        'Plan2',
        'Mail',
        'Genero',
        'Modulo',
        'hc',
        'Cabecera',
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

    public function obra_social()
    {
        return $this->belongsTo(ObraSocial::class, 'Plan', 'codigo');
    }

    public function obra_social_2()
    {
        return $this->belongsTo(ObraSocial::class, 'Plan2', 'codigo');
    }


    public function updatePaciente(Request $request, $pacienteDni, $pacienteId)
    {
        $validator = Validator::make($request->all(), [
            'Nombre' => 'string',
            'Direccion' => 'string',
            'CodPos' => 'string',
            'TipoDocumento' => 'numeric',
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
            'Plan' => 'numeric',
            'Plan2' => 'numeric',
            'Mail' => 'string',
            'Genero' => 'string',
            'Modulo' => 'string',
            'hc' => 'string',
            'Cabecera' => 'numeric',
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

        $paciente = $pacienteId ? Paciente::where('id', $pacienteDni)->first() : Paciente::where('NumDocumento', $pacienteDni)->first();

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
            'Antecedentes', 'Iva', 'Cuit', 'DetaPlan', 'Plan', 'Plan2', 'Mail', 'Genero',
            'Modulo', 'hc', 'Cabecera','Categoria', 'usuario'
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
