<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Horario\HorarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'horarios';

    protected $fillable = [
        'prof_cod',
        'dia',
        'desde',
        'hasta',
        'tiempo',
        'usuario'
    ];

    public function createHorarioModel(HorarioRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            $data = [
                'status' => false,
                'error'  => $validator->errors()->first(),
            ];
            return response()->json($data, 400);
        }

        $data = $request->validated();
        $data['dia'] = strtoupper($data['dia']);

        $horario = $this->create($data);

        return $horario;
    }

    public function deleteHorarioModel($horarioId)
    {
        $horario = $this->find($horarioId);

        if (!$horario) {
            $data = [
                'status' => false,
                'error' => 'El horario no existe',
            ];
            return response()->json($data, 404);
        }

        if ($horario->delete()) {
            $data = [
                'status' => true,
                'message' => 'Horario eliminado correctamente',
            ];
            return response()->json($data, 200);
        }

        $data = [
            'status' => false,
            'error' => 'No se pudo eliminar el horario',
        ];
        return response()->json($data, 400);
    }

    public function updateHorario(Request $request, $horarioId)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => 'El nombre de usuario es obligatorio.'], 400);
        }

        if (empty(array_diff_key(array_filter($request->all()), array_flip(['usuario'])))) {
            $data = [
                'status' => false,
                'error' => 'Debe proporcionar al menos un campo para actualizar.',
            ];
            return response()->json($data, 400);
        }

        $horario = Horario::find($horarioId);
        if (!$horario) {
            $data = [
                'status' => false,
                'error' => 'Horario no encontrado',
            ];
            return response()->json($data, 404);
        }

        $horario->fill($request->only([
            'dia',
            'desde',
            'hasta',
            'tiempo',
            'usuario'
        ]));

        if ($horario->save()) {
            $data = [
                'status' => true,
                'message' => 'Horario actualizado correctamente',
                'result' => $horario,
            ];
            return response()->json($data, 200);
        }

        $data = [
            'status' => false,
            'error' => 'No se pudo actualizar el horario',
        ];
        return response()->json($data, 400);
    }
}
