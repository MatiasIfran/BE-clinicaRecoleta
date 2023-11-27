<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Paciente\CreatePacienteRequest;
use App\Http\Requests\User\IndexRequest;
use App\Models\Paciente;
use App\Http\Resources\UserResource;

class PacienteController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:sanctum');
    }

    public function allPacientes(IndexRequest $request)
    {
        $pacientes = Paciente::all();
        $data = [
            'status'    => true,
            'pacientes' => $pacientes,
        ];
        return response()->json($data, 200);
    }

    public function getPacienteById($pacienteId)
    {
        $paciente = Paciente::find($pacienteId);

        if (!$paciente) {
            $data = [
                'status' => false,
                'error'  => 'Paciente no encontrado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'   => true,
            'paciente' => $paciente,
        ];
        return response()->json($data, 200);
    }

    public function getPacienteByDni($dni)
    {
        $paciente = Paciente::where('NumDocumento', $dni)->first();

        if (!$paciente) {
            $data = [
                'status' => false,
                'error'  => 'Paciente no encontrado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'   => true,
            'paciente' => $paciente,
        ];
        return response()->json($data, 200);
    }

    public function createPaciente(CreatePacienteRequest $request)
    {
        $paciente = new Paciente;
        $paciente = $paciente->createPacienteModel($request);

        $data = [
            'status'    => true,
            'paciente'  => new UserResource($paciente),
        ];

        return response()->json($data, 201);
    }


}
