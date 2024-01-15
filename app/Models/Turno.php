<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Turno\TurnoRequest;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class Turno extends Model
{
    use HasFactory;
    protected $table = 'turnos';

    protected $fillable = [
        'prof_cod',
        'paciente_id',
        'fecha',
        'hora',
        'observ',
        'atendido',
        'presente',
        'primeraVisita',
        'obra_social',
        'usuario'
    ];

    public function createTurnoModel(TurnoRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) {
            $data = [
                'status' => false,
                'error'  => $validator->errors()->first(),
            ];
            return response()->json($data, 400);
        }

        $profesionalCodigo = $request->input('prof_cod');
        $pacienteId = $request->input('paciente_id');
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');

        if ($fechaFin < $fechaInicio) {
            $data = [
                'status' => false,
                'error' => 'La fecha fin debe ser igual o mayor a la fecha actual',
            ];
            return response()->json($data, 400);
        }

        $horariosDisponibles = Horario::where('prof_cod', $profesionalCodigo)
        ->whereIn('dia', ['LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES'])
        ->get();

        foreach ($horariosDisponibles as $horario) {
            $fechaHorario = $this->calculateFechaHorario($fechaInicio, $fechaFin, $horario->dia);
            $horaActual = $horario->desde;
            info($fechaHorario);
  
            if($fechaHorario != null) {
                foreach ($fechaHorario as $fecha) {
                    while($horaActual < $horario->hasta) {
                        $turno = new Turno([
                            'prof_cod' => $profesionalCodigo,
                            'paciente_id' => $pacienteId,
                            'fecha' => $fecha,
                            'hora' => $horaActual,
                            'observ' => $request->input('observ'),
                            'atendido' => $request->input('atendido'),
                            'presente' => $request->input('presente'),
                            'primeraVisita' => $request->input('primeraVisita'),
                            'obra_social' => $request->input('obra_social'),
                            'usuario' => $request->input('usuario'),
                        ]);
                        try {
                            $turno->save();
                        } catch (\Illuminate\Database\QueryException $ex) {
                            if ($ex->errorInfo[1] === 1062) { // 1062 es el código de error para duplicados en MySQL
                                $data = [
                                    'status' => false,
                                    'error' => 'El turno ya existe',
                                ];
                                return response()->json($data, 400);
                            }
                        }
                        $horaActual = Carbon::parse($horaActual)->addMinutes($horario->tiempo)->format('H:i');
                    }
                }
            }
            else {
                $data = [
                    'status' => false,
                    'error' => 'No se encontraron horarios disponibles del profesional para el rango de fecha seleccionado.',
                ];
                return response()->json($data, 400);
            }
        }
        return response()->json(['status' => true, 'message' => 'Turnos creados correctamente']);
    }

    private function calculateFechaHorario($fechaInicio, $fechaFin, $dia)
    {
        $carbonFechaInicio = Carbon::parse($fechaInicio);
        $carbonFechaFin = Carbon::parse($fechaFin);
    
        $translatedDay = strtolower($this->translateDayToEnglish($dia));
        $fechas = [];

        while ($carbonFechaInicio->lessThanOrEqualTo($carbonFechaFin)) {
            if (strtolower($carbonFechaInicio->translatedFormat('l')) == $translatedDay) {
                $fechas[] = $carbonFechaInicio->toDateString();
            }
    
            $carbonFechaInicio->addDay();
        }
        return $fechas;
    }

    private function translateDayToEnglish($day)
    {
        $translationMap = [
            'lunes' => 'Monday',
            'martes' => 'Tuesday',
            'miércoles' => 'Wednesday',
            'jueves' => 'Thursday',
            'viernes' => 'Friday',
        ];
        $lowercaseDay = strtolower($day);
        return array_key_exists($lowercaseDay, $translationMap) ? $translationMap[$lowercaseDay] : $day;
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
