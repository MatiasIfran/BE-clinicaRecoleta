<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Horario\HorarioRequest;
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

    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }
}
