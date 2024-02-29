<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Paciente\CreatePacienteRequest;
use App\Http\Requests\User\IndexRequest;
use App\Models\Paciente;
use App\Models\CodigoPostal;
use App\Http\Resources\UserResource;
use App\Models\Profesional;

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
        
        foreach ($pacientes as $paciente) {
            $codigoPostal = CodigoPostal::where('codigo', $paciente->CodPos)->first();
            $paciente->ciudad = ($codigoPostal) ? $codigoPostal->ciudad . " - " .  $codigoPostal->provincia : null;
        
            $MedCabecera = Profesional::where('codigo', $paciente->MedCabecera)->first();
            $paciente->MedCabeceraNombre = ($MedCabecera) ? $MedCabecera->Apellido . " " .  $MedCabecera->Nombre : null;
    
            $data['pacientes'][] = $paciente;
        }   
    
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
            $query->where('nombre', 'LIKE', "%$search%");
        }

        $paciente = $query->get();

        if (!$paciente) {
            $data = [
                'status' => false,
                'error'  => 'Paciente no encontrado por nombre',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'   => true,
            'paciente' => $paciente,
        ];
        return response()->json($data, 200);
    }

    public function searchPaciente(Request $request)
    {
        $search = $request->input('search');
        $limit = $request->input('limit', 25); 

        $searchParts = preg_split('/(?<=\D)(?=\d)|(?<=\d)(?=\D)/', $search);
        $query = Paciente::query();

        foreach ($searchParts as $part) {
            if (is_numeric($part)) {
                $query->orWhere('numDocumento', $part);
            } else {
                $query->orWhere('nombre', 'LIKE', "%$part%");
            }
        }
        $pacientes = $query->take($limit)->get();
        
        if ($pacientes->isEmpty()) {
            $data = [
                'status' => false,
                'error'  => 'No se encontraron pacientes',
            ];
            return response()->json($data, 404);
        }

        foreach ($pacientes as $paciente) {
            $codigoPostal = CodigoPostal::where('codigo', $paciente->CodPos)->first();
        
            $paciente->ciudad = ($codigoPostal) ? $codigoPostal->ciudad . " - " .  $codigoPostal->provincia : null;
        
            $MedCabecera = Profesional::where('codigo', $paciente->MedCabecera)->first();
            $paciente->MedCabeceraNombre = ($MedCabecera) ? $MedCabecera->Apellido . " " .  $MedCabecera->Nombre : null;
    
            $data['pacientes'][] = $paciente;
        }

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

    public function updatePaciente(Request $request, $pacienteDni)
    {
        $paciente = new Paciente();
        $paciente = $paciente->updatePaciente($request, $pacienteDni);
        return $paciente;
    }

}
