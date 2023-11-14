<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Persona\CreatePersonaRequest;
use App\Http\Requests\User\IndexRequest;
use App\Models\Persona;
use App\Http\Resources\UserResource;


class PersonaController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:sanctum');
    }

    public function allPersonas(IndexRequest $request)
    {
        $personas = Persona::all();
        $data = [
            'status'    => true,
            'users'     => $personas,
        ];
        return response()->json($data, 200);
    }

    public function getPersonaById($personaId)
    {
        $persona = Persona::find($personaId);

        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }

        $data = [
            'status' => true,
            'user' => $persona,
        ];
        return response()->json($data, 200);
    }

    public function getPersonaByDni($dni)
    {
        $persona = Persona::where('NumDocumento', $dni)->first();

        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }

        $data = [
            'status' => true,
            'user' => $persona,
        ];
        return response()->json($data, 200);
    }

    public function createPersona(CreatePersonaRequest $request)
    {
        $persona = new Persona;
        $persona = $persona->createPersonaModel($request);

        $data = [
            'status'   =>  true,
            'persona'  => new UserResource($persona),
        ];

        return response()->json($data, 201);
    }
}
