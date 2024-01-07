<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Horario\HorarioRequest;
use App\Http\Requests\User\IndexRequest;
use App\Models\Horario;
use App\Http\Resources\UserResource;


class HorarioController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:sanctum');
    }

    public function allHorarios()
    {
        $horarios = Horario::all();

        if ($horarios->isEmpty()) {
            $data = [
                'status' => false,
                'message' => 'No hay horarios disponibles en este momento.',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'horarios' => $horarios,
        ];
        return response()->json($data, 200);
    }

    public function getHorarioById($horarioId)
    {
        $horario = Horario::find($horarioId);

        if (!$horario) {
            $data = [
                'status' => false,
                'error' => 'Horario no encontrado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'horario' => $horario,
        ];
        return response()->json($data, 200);
    }

    public function getHorarioByDate(Request $request)
    {
        $fecha = $request->input('fecha');

        $horarios = Horario::whereDate('dia', $fecha)->get();

        if ($horarios->isEmpty()) {
            $data = [
                'status' => false,
                'error' => 'No se encontraron horarios para la fecha '.$fecha
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'horarios' => $horarios,
        ];
        return response()->json($data, 200);
    }

    public function getHorarioByProfesionalId($profesionalId)
    {
        $horarios = Horario::where('profesional_id', $profesionalId)->get();

        if ($horarios->isEmpty()) {
            $data = [
                'status' => false,
                'error' => 'No se encontraron horarios para el profesional especificado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'horarios' => $horarios,
        ];
        return response()->json($data, 200);
    }

    public function createHorario(HorarioRequest $request)
    {
        $horario = new Horario;
        $horario = $horario->createHorarioModel($request);

        $data = [
            'status' => true,
            'horario' => $horario,
        ];

        return response()->json($data, 201);
    }
    
}
