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

    public function getHorarioByNameDay(Request $request)
    {
        $dia = $request->input('dia');

        $horarios = Horario::where('dia', $dia)->get();

        if ($horarios->isEmpty()) {
            $data = [
                'status' => false,
                'error' => 'No se encontraron horarios para la fecha ' . $dia
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'horarios' => $horarios,
        ];
        return response()->json($data, 200);
    }

    public function getHorarioByProfesionalCodigo($prof_cod)
    {
        $horarios = Horario::where('prof_cod', $prof_cod)->get();

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

        if ($this->isJsonResponse($horario)) {
            return $horario;
        }
        $data = [
            'status' => true,
            'horario' => $horario,
        ];

        return response()->json($data, 201);
    }

    public function deleteHorario($horarioId)
    {
        $horario = new Horario;
        $horario = $horario->deleteHorarioModel($horarioId);
        return $horario;
    }

    public function updateHorario(Request $request, $turnoId)
    {
        $turno = new Horario();
        $turno = $turno->updateHorario($request, $turnoId);
        return $turno;
    }
}
