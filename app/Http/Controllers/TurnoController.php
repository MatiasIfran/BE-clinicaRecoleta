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
            return response()->json($data, 204);
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
        $turno = new Turno;
        $turno = $turno->obtenerTurnosxDia($turnoDate);
        return $turno;
    }

    public function getTurnoByPaciente($pacienteId)
    {
        $turnos = Turno::where('paciente_id', $pacienteId)->get();

        if ($turnos->isEmpty()) {
            $data = [
                'status' => false,
                'error' => 'No se encontraron turnos para el paciente especificado',
            ];
            return response()->json($data, 204);
        }

        $data = [
            'status' => true,
            'turnos' => $turnos,
        ];
        return response()->json($data, 200);
    }

    public function getTurnosxProfxDia(Request $request)
    {
        $turno = new Turno;
        $turno = $turno->obtenerTurnosxProfxDia($request);
        return $turno;
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

            return response()->json($data, 204);
        }
        $data = [
            'status' => true,
            'turnos' => $turno,
        ];
        return response()->json($data, 200);
    }

    public function getTurnosDisponiblesProfesional(Request $request)
    {
        $turno = new Turno;
        $turno = $turno->obtenerTurnosLibresProfesional($request);

        if ($this->isJsonResponse($turno)) {
            return $turno;
        } else if ($turno->isEmpty()) {
            $data = [
                'status' => false,
                'turno' => 'No se encontraron turnos disponibles.',
            ];

            return response()->json($data, 204);
        }
        $data = [
            'status' => true,
            'turnos' => $turno,
        ];
        return response()->json($data, 200);
    }

    public function allTurnosProfesional(Request $request)
    {
        $turnos = new Turno;
        $turnos = $turnos->obtenerTurnosProfesional($request);
        return $turnos;
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

    public function createTurnoIndividual(TurnoRequest $request)
    {
        $turno = new Turno;
        $turno = $turno->createIndividualTurn($request);
        return $turno;
    }

    public function deleteTurno($turnoId)
    {
        $turno = new Turno;
        $turno = $turno->deleteTurnoModel($turnoId);
        return $turno;
    }

    public function updateTurno(Request $request, $turnoId)
    {
        $turno = new Turno;
        $turno = $turno->updateTurno($request, $turnoId);
        return $turno;
    }
}
