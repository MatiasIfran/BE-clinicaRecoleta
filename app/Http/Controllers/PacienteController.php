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
        $limit = $request->input('limit', 25); 

        $pacientes = Paciente::orderBy('updated_at', 'desc')
        ->take($limit)
        ->get();
        
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

    public function getPacienteByNombreApellido(Request $request)
    {
        $search = $request->input('search');

        $query = Paciente::query();

        if ($search) {
            // Si se proporciona un parámetro de búsqueda, realizar la búsqueda por nombre o apellido
            $query->where('nombre', 'LIKE', "%$search%")
                  ->orWhere('apellido', 'LIKE', "%$search%");
        }

        $paciente = $query->get();

        if (!$paciente) {
            $data = [
                'status' => false,
                'error'  => 'Paciente no encontrado por nombre o apellido',
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

        if ($this->isJsonResponse($paciente)) {
            return $paciente;
        }
        $data = [
            'status'    => true,
            'paciente'  => new UserResource($paciente),
        ];

        return response()->json($data, 201);
    }


}
