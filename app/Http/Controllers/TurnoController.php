<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Turno\TurnoRequest;
use App\Http\Requests\User\IndexRequest;
use App\Models\Turno;
use App\Models\Horario;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;

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
                'error' => 'No se encontraron turnos para la fecha '.$fecha,
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
        $validator = Validator::make($request->all(), [
            'profesional_id' => 'required|integer',
            'fecha' => 'required|date_format:Y-m-d',
        ], [
            'profesional_id.required' => 'El id del profesional es obligatorio.',
            'profesional_id.integer' => 'El id del profesional debe ser un número entero.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date_format' => 'El formato de la fecha debe ser YYYY-MM-DD.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['status' => false, 'errors' => $errors], 400);
        }    

        $profesionalId = $request->input('profesional_id');
        $fecha = $request->input('fecha');

        $horariosDisponibles = Horario::where('profesional_id', $profesionalId)
        ->whereDate('dia', $fecha)
        ->whereDoesntHave('turnos')
        ->get();

        if ($horariosDisponibles->isEmpty()) {
            $data = [
                'status' => false,
                'error' => 'No se encontraron horarios disponibles para el dia '.$fecha,
            ];
            return response()->json($data, 404);
        }

        return response()->json([
            'status' => true,
            'horarios_disponibles' => $horariosDisponibles,
        ]);
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
