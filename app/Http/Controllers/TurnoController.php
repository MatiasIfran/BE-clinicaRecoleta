<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Turno\TurnoRequest;
use App\Http\Requests\User\IndexRequest;
use App\Models\Turno;
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
                'error' => 'No se encontraron turnos para la fecha especificada',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'turnos' => $turnos,
        ];
        return response()->json($data, 200);
    }

    public function createTurno(TurnoRequest $request)
    {
        $validated = $request->validated();

        $turno = Turno::create([
            'fecha' => $validated['fecha'],
            'usuario' => $validated['usuario'],
        ]);

        $data = [
            'status' => true,
            'turno' => $turno,
        ];

        return response()->json($data, 201);
    }
}
