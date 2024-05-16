<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\historiaClinica\HistoriaClinicaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class HistoriaClinica extends Model
{
    use HasFactory;
    protected $table = 'historias_clinicas';

    protected $fillable = [
        'id_paciente',
        'prof_cod',
        'trata',
        'observ',
        'link_imagen',
        'fecha',
        'usuario',
    ];

    public function createHistoriaClinicaModel(HistoriaClinicaRequest $request)
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

        $historiaClinica = $this->create($data);

        return $historiaClinica;
    }

     public function obtenerHCxProf($prof_cod)
     {
        $historiaClinica = HistoriaClinica::with(['paciente', 'profesional'])
        ->where('prof_cod', $prof_cod)
        ->get();

         if ($historiaClinica->isEmpty()) {
             $data = [
                 'status' => false,
                 'error' => 'No se encontraron historias clínicas para el profesional especificado',
             ];
             return response()->json($data, 404);
         }

         $data = [
             'status' => true,
             'hc' => $historiaClinica,
         ];
         return response()->json($data, 200);
     }

     public function obtenerHCxPacienteId($pacienteId)
     {
        $historiaClinica = HistoriaClinica::with(['paciente', 'profesional'])
        ->where('id_paciente', $pacienteId)
        ->orderBy('fecha', 'desc') // Ordena por fecha de forma ascendente
        ->get();

         if ($historiaClinica->isEmpty()) {
             $data = [
                 'status' => false,
                 'error' => 'No se encontraron historias clínicas para el paciente especificado',
             ];
             return response()->json($data, 404);
         }

         $data = [
             'status' => true,
             'hc' => $historiaClinica,
         ];
         return response()->json($data, 200);
     }

    public function profesional()
    {
        return $this->belongsTo(Profesional::class, 'prof_cod', 'Codigo');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }

    public function deleteHistoriaClinicaModel($historiaClinicaId)
    {
        $historiaClinica = HistoriaClinica::find($historiaClinicaId);

        if (!$historiaClinica) {
            $data = [
                'status' => false,
                'error' => 'La historia clínica no existe',
            ];
            return response()->json($data, 404);
        }

        if ($historiaClinica->delete()) {
            $data = [
                'status' => true,
                'message' => 'Historia clínica eliminado correctamente',
            ];
            return response()->json($data, 200);
        }

        $data = [
            'status' => false,
            'error' => 'No se pudo eliminar la historia clínica',
        ];
        return response()->json($data, 400);
    }

    public function updateHistoriaClinicaModel(Request $request, $historiaClinicaId)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required',
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

        $historiaClinica = HistoriaClinica::find($historiaClinicaId);
        if (!$historiaClinica) {
            $data = [
                'status' => false,
                'error' => 'Historia clínica no encontrada.',
            ];
            return response()->json($data, 404);
        }

        $historiaClinica->fill($request->only([
            'observ',
            'usuario'
        ]));

        $fechaHoy = Carbon::now()->toDateString();
        if ($historiaClinica->fecha !== $fechaHoy) {
                $data = [
                    'status' => false,
                    'error' => 'La historia clínica no es de hoy, no se puede actualizar.',
                ];
                return response()->json($data, 400);
            }
        if ($historiaClinica->save()) {
            $data = [
                'status' => true,
                'message' => 'Historia clínica actualizada correctamente',
                'result' => $historiaClinica,
            ];
            return response()->json($data, 200);
        }

        $data = [
            'status' => false,
            'error' => 'No se pudo actualizar la historia clínica.',
        ];
        return response()->json($data, 400);
    }

}
