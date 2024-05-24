<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Turno\TurnoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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

    public function createIndividualTurn(TurnoRequest $request)
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
        $data['fecha'] = strtoupper($data['fecha']);
        $turno = null;
        try {
            $turno = $this->create($data);
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->errorInfo[1] === 1062) { // 1062 es el código de error para duplicados en MySQL
                $data = [
                    'status' => false,
                    'error' => 'Error al guardar turno: El turno ya existe',
                ];
                return response()->json($data, 400);
            } else {
                $errorType = get_class($ex);
                $errorMessage = $ex->getMessage();
                $data = [
                    'status' => false,
                    'error' => 'Error al guardar turno: ' . $errorMessage . ' (' . $errorType . ')',
                ];
                return response()->json($data, 500);
            }
        }
        $data = [
            'status' => isset($turno),
            'turno' => $turno,
        ];
        return response()->json($data, 200);
    }

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

        $feriadosProf = Feriado::where('prof_cod', $profesionalCodigo)
        ->orWhereNull('prof_cod')
        ->orWhere('prof_cod', '')
        ->get();

        $fechasFeriados = $feriadosProf->pluck('fecha')->toArray();
      
        foreach ($horariosDisponibles as $horario) {
            $fechaHorario = $this->calculateFechaHorario($fechaInicio, $fechaFin, $horario->dia);
            $horaActual = $horario->desde;

            if ($fechaHorario != null) {
                foreach ($fechaHorario as $fecha) {
                    if (in_array($fecha, $fechasFeriados)) {
                        continue;
                    }
                    while ($horaActual < $horario->hasta) {
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
                                $message = 'Error al guardar turno: El turno ya existe para la fecha '.$fecha.' a la hora '.$horaActual;
                                Log::error($message);
                                $errores[] = $message;
                            }
                            else {
                                Log::error('Error al guardar turno: ' . $ex->getMessage());
                                $errores[] = $ex->getMessage();
                            }
                        }
                        $horaActual = Carbon::parse($horaActual)->addMinutes($horario->tiempo)->format('H:i');
                    }
                }
            } else {
                $data = [
                    'status' => false,
                    'error' => 'No se encontraron horarios disponibles del profesional para el rango de fecha seleccionado.',
                ];
                return response()->json($data, 400);
            }
        }
        return response()->json(['status' => true, 'message' => 'Turnos creados correctamente.', 'errores' => empty($errores) ? null : $errores]);
    }

    public function obtenerTurnosxProfxDia(Request $request)
    {
        $fecha = $request->input('fecha');
        $profCod = $request->input('prof_cod');
    
        $turnos = Turno::with(['paciente', 'profesional', 'obraSocial'])
        ->whereDate('fecha', $fecha)
        ->where('prof_cod', $profCod)
        ->orderBy('fecha')
        ->orderBy('hora')
        ->get();
    
        if ($turnos->isEmpty()) {
            $data = [
                'status' => false,
                'error' => 'No se encontraron turnos para la fecha ' . $fecha . ' y prof_cod ' . $profCod,
            ];
            return response()->json($data, 404);
        }
    
        $data = [
            'status' => true,
            'turnos' => $turnos,
        ];
        return response()->json($data, 200);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }

    public function obraSocial()
    {
        return $this->belongsTo(ObraSocial::class, 'obra_social', 'codigo');
    }

    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'prof_cod', 'Codigo');
    }

    public function obtenerTurnosxDia(Request $turnoDate)
    {
        $fecha = $turnoDate->input('fecha');

        $turnos = Turno::with(['paciente', 'profesional', 'obra_social'])
        ->whereDate('fecha', $fecha)
        ->orderBy('fecha')
        ->orderBy('hora')
        ->get();

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

    public function obtenerTurnosLibres(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prof_cod' => 'required|integer',
            'fecha' => 'required|date_format:Y-m-d',
        ], [
            'prof_cod.required' => 'El codigo del profesional es obligatorio. (prof_cod)',
            'prof_cod.integer' => 'El id del profesional debe ser un número entero.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date_format' => 'El formato de la fecha debe ser YYYY-MM-DD.',
        ]);

        if ($validator->fails()) {
            $data = [
                'status' => false,
                'error'  => $validator->errors()->first(),
            ];
            return response()->json($data, 400);
        }

        $profesionalCodigo = $request->input('prof_cod');
        $fecha = $request->input('fecha');

        $horariosDisponibles = Turno::where('prof_cod', $profesionalCodigo)
            ->where('fecha', $fecha)
            ->whereNull('paciente_id')
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return $horariosDisponibles;
    }

    public function obtenerTurnosLibresProfesional(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prof_cod' => 'required|integer',
            'obraSocial' => 'string',
        ], [
            'prof_cod.required' => 'El codigo del profesional es obligatorio. (prof_cod)',
            'prof_cod.integer' => 'El id del profesional debe ser un número entero.',
        ]);

        if ($validator->fails()) {
            $data = [
                'status' => false,
                'error'  => $validator->errors()->first(),
            ];
            return response()->json($data, 400);
        }

        $profesionalCodigo = $request->input('prof_cod');
        $obraSocialCodigo = $request->input('obraSocial');
        $limitPerDay = 4;
        $totalLimit = 50;
        
        $fechaActual = Carbon::now()->format('Y-m-d');

        if ($obraSocialCodigo == '10') {
            $horariosDisponibles = DB::table('turnos as l')
            ->select('l.fecha', 'l.hora', 'l.id')
            ->selectRaw('ROW_NUMBER() OVER (PARTITION BY l.fecha ORDER BY l.hora ASC) AS rowNum')
            ->leftJoin('profesionales as prof', 'prof.codigo', '=', 'l.prof_cod')
            ->leftJoin(DB::raw('(SELECT fecha, COUNT(id) cantPami
                                 FROM turnos tmp
                                 WHERE obra_social = ?
                                   AND fecha >= CURDATE()
                                   AND prof_cod = ? 
                                 GROUP BY fecha) as tomaPami'), 'tomaPami.fecha', '=', 'l.fecha')
            ->setBindings([$obraSocialCodigo, $profesionalCodigo])
            ->whereRaw('l.fecha > LEFT(CURDATE(), 10)')
            ->whereNull('l.paciente_id')
            ->where('l.prof_cod', $profesionalCodigo)
            ->where(function ($query) use ($obraSocialCodigo, $profesionalCodigo) {
                $query->whereRaw('(IF(prof.pami = 0, 1, 0) = 1 OR DAYOFWEEK(l.fecha) = prof.pami)')
                      ->whereRaw('IF(prof.pami = 0, 4, 99) > COALESCE(tomaPami.cantPami, 0)');
            })
            ->whereRaw('l.fecha < LAST_DAY(l.fecha) - 2')
            ->orderBy('l.fecha')
            ->orderBy('l.hora')
            ->limit($totalLimit);
            $horariosDisponibles->whereRaw('tomaPami.fecha IS NOT NULL');
        } else {
            $horariosDisponibles = Turno::where('prof_cod', $profesionalCodigo)
                ->whereNull('paciente_id')
                ->where('fecha', '>=', $fechaActual) // Filtrar turnos a partir de hoy
                ->orderBy('fecha')
                ->orderBy('hora');
        }
         
        $horariosFiltrados = $horariosDisponibles->get();
        $horariosPorDia = collect();

        foreach ($horariosDisponibles as $turno) {
            info($turno);
            $fecha = Carbon::createFromFormat('Y-m-d', $turno->fecha)->format('d-m-y');
            if (!$horariosPorDia->has($fecha)) {
                $horariosPorDia->put($fecha, collect());
            }
            $horariosPorDia[$fecha]->push($turno);
        }
    
        foreach ($horariosPorDia as $fecha => $turnos) {
            $limit = min($limitPerDay, $turnos->count());
            $horariosFiltrados = $horariosFiltrados->merge($turnos->take($limit));
        }
    
        $horariosFiltrados = $horariosFiltrados->take($totalLimit);
    
        return $horariosFiltrados;    
    }

    public function obtenerTurnosProfesional(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prof_cod' => 'required|integer',
        ], [
            'prof_cod.required' => 'El código del profesional es obligatorio. (prof_cod)',
            'prof_cod.integer' => 'El código del profesional debe ser un número entero.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error'  => $validator->errors()->first(),
            ], 400);
        }

        $profesionalCodigo = $request->input('prof_cod');

        $fechaActual = Carbon::now();
        $fechaInicio = $fechaActual->copy()->subDays(10);
        $fechaFin = $fechaActual->copy()->addDays(30);

        // Obtener todas las fechas en el rango especificado
        $fechasEnRango = Turno::where('prof_cod', $profesionalCodigo)
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->distinct()
            ->pluck('fecha');

        if ($fechasEnRango->isEmpty()) {
            $data = [
                'status' => false,
                'error' => 'No se encontraron turnos para las fechas especificadas.',
            ];
            return response()->json($data, 404);
        }

        $fechasDisponibles = collect();
        $fechasNoDisponibles = collect();

        // Filtrar fechas disponibles y no disponibles
        $fechasEnRango->each(function ($fecha) use ($profesionalCodigo, $fechasDisponibles, $fechasNoDisponibles) {
            $totalTurnos = Turno::where('prof_cod', $profesionalCodigo)
                ->where('fecha', $fecha)
                ->count();

            $turnosOcupados = Turno::where('prof_cod', $profesionalCodigo)
                ->where('fecha', $fecha)
                ->whereNotNull('paciente_id')
                ->count();

            if ($totalTurnos > 0 && $totalTurnos == $turnosOcupados) {
                $fechasNoDisponibles->push($fecha);
            } else {
                $fechasDisponibles->push($fecha);
            }
    });

    return response()->json([
        'status' => true,
        'fechasDisponibles' => $fechasDisponibles->values(),
        'fechasNoDisponibles' => $fechasNoDisponibles->values(),
    ]);
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
        $replacementMap = [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
            'ñ' => 'n', 'Ñ' => 'N',
        ];
    
        $translationMap = [
            'lunes' => 'Monday',
            'martes' => 'Tuesday',
            'miercoles' => 'Wednesday',
            'jueves' => 'Thursday',
            'viernes' => 'Friday',
        ];
        $lowercaseDay = strtolower(strtr($day, $replacementMap));
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

    public function updateTurno(Request $request, $turnoId)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => 'El nombre de usuario es obligatorio.'], 400);
        }

        $turno = Turno::find($turnoId);
        if (!$turno) {
            $data = [
                'status' => false,
                'error' => 'Turno no encontrado',
            ];
            return response()->json($data, 404);
        }

        $pacienteId = $request->input('paciente_id');

        if ($pacienteId != null) {
            $profCod = $turno->prof_cod;
            $profesional = Profesional::where('Codigo', $profCod)->first();
            if (!$profesional) {
                $data = [
                    'status' => false,
                    'error' => 'Profesional no encontrado para el turno elegido',
                ];
                return response()->json($data, 404);
            }
            $pami = $profesional->pami;
            $obra_social_input = $request->input('obra_social');
            $fechaTurno = $turno->fecha;
            $diaSemanaTurno = Carbon::parse($fechaTurno)->format('N');
            if ($pami == 0) {
                $cantidadTurnosOS10 = Turno::whereDate('fecha', $fechaTurno)
                    ->where('prof_cod', $profCod)
                    ->where('obra_social', 10)
                    ->count();

                if ($cantidadTurnosOS10 >= 4 && $obra_social_input === '10') {
                    $data = [
                        'status' => false,
                        'error' => 'Ya existen más de 4 turnos para obra social con código 10 en esta fecha.',
                    ];
                    return response()->json($data, 400);
                }
            } else {
                if ($diaSemanaTurno != $pami && $obra_social_input === '10') {
                    $data = [
                        'status' => false,
                        'error' => 'No se pueden asignar turnos para el día especificado con la obra social PAMI.',
                    ];
                    return response()->json($data, 400);
                }
            }
        }

        $turno->fill($request->only([
            'paciente_id',
            'observ',
            'atendido',
            'presente',
            'primeraVisita',
            'obra_social',
        ]));
        
        if($pacienteId) {
            $primeraVezPaciente = HistoriaClinica::where('id_paciente', $pacienteId)->get();
            if($primeraVezPaciente->isEmpty()) {
                $turno->primeraVisita = true;
            }
        }

        if ($turno->save()) {
            $data = [
                'status' => true,
                'message' => 'Turno actualizado correctamente',
                'result' => $turno,
            ];
            return response()->json($data, 200);
        }

        $data = [
            'status' => false,
            'error' => 'No se pudo actualizar el turno',
        ];
        return response()->json($data, 400);
    }
}