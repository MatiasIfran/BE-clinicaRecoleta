<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Turno\TurnoRequest;
use Illuminate\Support\Facades\Validator;

class Turno extends Model
{
    use HasFactory;
    protected $table = 'turnos';

    protected $fillable = [
        'horario_id',
        'paciente_id',
        'usuario'
    ];

    public function createTurnoModel(TurnoRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            // Maneja el error según tus necesidades, puede lanzar una excepción o devolver un mensaje de error
            // Puedes personalizar esta lógica según tus necesidades
            // Por ejemplo, puedes lanzar una excepción BadRequestHttpException con el mensaje de error
            $data = [
                'status' => false,
                'error'  => $validator->errors()->first(),
            ];
            return response()->json($data, 400);
        }

        $data = $request->validated();

        try {
            $turno = $this->create($data);
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->errorInfo[1] === 1062) { // 1062 es el código de error para duplicados en MySQL
                $data = [
                    'status' => false,
                    'error' => 'El turno para este horario y paciente ya existe',
                ];
                return response()->json($data, 400);
            } else {
                // Otro manejo de errores si es necesario
                $data = [
                    'status' => false,
                    'error' => 'Error al crear el turno: ' . $ex->getMessage(),
                ];
                return response()->json($data, 400);
            }
        }

        return $turno;
    }

    public function deleteTurnoModel($turnoId)
    {
        $turno = Turno::find($turnoId);

        if (!$turno) {
            $data = [
                'status' => false,
                'error' => 'El turno no existe',
            ];
            return response()->json($data, 404);
        }

        if ($turno->delete()) {
            $data = [
                'status' => true,
                'message' => 'Turno eliminado correctamente',
            ];
            return response()->json($data, 200);
        }

        $data = [
            'status' => false,
            'error' => 'No se pudo eliminar el turno',
        ];
        return response()->json($data, 400);
    }

}
