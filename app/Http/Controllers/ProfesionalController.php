<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Profesional\CreateProfesionalRequest;
use App\Http\Requests\User\IndexRequest;
use App\Models\Profesional;
use App\Http\Resources\UserResource;

class ProfesionalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function allProfesionales()
    {
        $Profesionales = Profesional::all();
        $data = [
            'status'    => true,
            'users'     => $Profesionales,
        ];
        return response()->json($data, 200);
    }

    public function allProfesionalesActivos()
    {
        $Profesionales = Profesional::where('daTurnos', '!=', false)->get();
        $data = [
            'status'    => true,
            'profesionales'     => $Profesionales,
        ];
        return response()->json($data, 200);
    }

    public function getProfesionalById($profesionalId)
    {
        $profesional = Profesional::find($profesionalId);

        if (!$profesional) {
            $data = [
                'status'    => false,
                'error' => 'Profesional no encontrada',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'user' => $profesional,
        ];
        return response()->json($data, 200);
    }

    public function getProfesionalByDni($dni)
    {
        $profesional = Profesional::where('NumDocumento', $dni)->first();

        if (!$profesional) {
            $data = [
                'status'    => false,
                'error' => 'Profesional no encontrada',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'user' => $profesional,
        ];
        return response()->json($data, 200);
    }

    public function createProfesional(CreateProfesionalRequest $request)
    {
        $profesional = new Profesional;
        $profesional = $profesional->createProfesionalModel($request);

        if ($this->isJsonResponse($profesional)) {
            return $profesional;
        }
        $data = [
            'status'   =>  true,
            'profesional'  => new UserResource($profesional),
        ];

        return response()->json($data, 201);
    }

    public function updateProfesional(Request $request, $profesionalId)
    {
        $profesional = new Profesional();
        $profesional = $profesional->updateProfesional($request, $profesionalId);
        return $profesional;
    }
}
