<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Feriado\FeriadoRequest;
use App\Http\Requests\User\IndexRequest;
use App\Models\Feriado;

class FeriadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function allFeriados()
    {
        $feriados = Feriado::all();
        if ($feriados->isEmpty()) {
            $data = [
                'status' => false,
                'message' => 'No hay feriados disponibles en este momento.',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'turnos' => $feriados,
        ];
        return response()->json($data, 200);
    }

    public function getFeriadoById($feriadoId)
    {
        $feriado = Feriado::find($feriadoId);

        if (!$feriado) {
            $data = [
                'status' => false,
                'error'  => 'Feriado no encontrado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'        => true,
            'codigo_postal' => $feriado,
        ];
        return response()->json($data, 200);
    }


    public function createFeriado(FeriadoRequest $request)
    {
        $feriado = new Feriado();
        info("request en createFeriado: " . $request);
        $feriado = $feriado->createFeriadoModal($request);

        if ($this->isJsonResponse($feriado)) {
            return $feriado;
        }
        $data = [
            'status'    => true,
            'codigoPostal'  => $feriado,
        ];

        return response()->json($data, 201);
    }

    public function createFeriadoV2(FeriadoRequest $request)
    {
        try {
            $feriado = new Feriado();
            $feriado = $feriado->createFeriadoModal($request);
    
            $data = [
                'status' => true,
                'feriado' => $feriado,
            ];
    
            return response()->json($data, 201);
        } catch (\Exception $e) {
            $data = [
                'status' => false,
                'error' => 'Error al crear el feriado',
            ];

            return response()->json($data, 500);
        }
    }
}
