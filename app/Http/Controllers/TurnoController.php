<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Turno\TurnoRequest;
use App\Http\Requests\User\IndexRequest;
use App\Models\Turno;

class TurnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function allTurnos(IndexRequest $request)
    {
        $turnos = Turno::all();
        if ($turnos->isEmpty()) {
            $data = [
                'status' => false,
                'message' => 'No hay turnos disponibles en este momento.',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'turnos' => $turnos,
        ];
        return response()->json($data, 200);
    }

    public function getTurnoById($turnoId)
    {
        $turno = Turno::find($turnoId);

        if (!$turno) {
            $data = [
                'status' => false,
                'error' => 'Turno no encontrado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'turno' => $turno,
        ];
        return response()->json($data, 200);
    }

    public function getTurnoByDate(Request $turnoDate)
    {
        $fecha = $turnoDate->input('fecha'); // Obtiene la fecha del request

        $turnos = Turno::whereDate('fecha', $fecha)->get();

        if ($turnos->isEmpty()) {
            $data = [
                'status' => false,
                'error' => 'No se encontraron turnos para la fecha ' . $fecha,
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'turnos' => $turnos,
        ];
        return response()->json($data, 200);
    }

    public function getTurnoByPaciente($pacienteId)
    {
        $turnos = Turno::where('paciente_id', $pacienteId)->get();

        if ($turnos->isEmpty()) {
            $data = [
                'status' => false,
                'error' => 'No se encontraron turnos para el paciente especificado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'turnos' => $turnos,
        ];
        return response()->json($data, 200);
    }

    public function getTurnosDisponibles(Request $request)
    {
        $turno = new Turno;
        $turno = $turno->obtenerTurnosLibres($request);

        if ($this->isJsonResponse($turno)) {
            return $turno;
        } else if ($turno->isEmpty()) {
            $data = [
                'status' => false,
                'turno' => 'No se encontraron turnos para la fecha especificada.',
            ];

            return response()->json($data, 400);
        }
        $data = [
            'status' => true,
            'turnos' => $turno,
        ];
        return response()->json($data, 201);
    }

    public function createTurno(TurnoRequest $request)
    {
        $turno = new Turno;
        $turno = $turno->createTurnoModel($request);

        if ($this->isJsonResponse($turno)) {
            return $turno;
        }
        $data = [
            'status' => true,
            'turno' => $turno,
        ];

        return response()->json($data, 201);
    }

    public function deleteTurno($turnoId)
    {
        $turno = new Turno;
        $turno = $turno->deleteTurnoModel($turnoId);
        return $turno;
    }
}
