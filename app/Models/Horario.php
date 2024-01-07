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
        'profesional_id', 
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

        // Convierte las horas desde y hasta en objetos Carbon para operar con el tiempo
        $desde = Carbon::createFromFormat('H:i', $data['desde']);
        $hasta = Carbon::createFromFormat('H:i', $data['hasta']);

        $intervaloMinutos = $data['tiempo'];
        $horarios = [];

        while ($desde < $hasta) {
            $nuevoHorario = [
                'profesional_id' => $data['profesional_id'],
                'dia' => $data['dia'],
                'desde' => $desde->format('H:i'),
                'hasta' => $desde->addMinutes($intervaloMinutos)->format('H:i'),
                'tiempo' => $intervaloMinutos,
                'usuario' => $data['usuario'],
            ];
    
            $horarios[] = $nuevoHorario;
        }
    
        $horarios = Horario::insert($horarios);

        return $horarios;
    }

}
