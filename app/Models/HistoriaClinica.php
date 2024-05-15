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
                 'error' => 'No se encontraron historias clinicas para el profesional especificado',
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
                 'error' => 'No se encontraron historias clinicas para el paciente especificado',
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
                'error' => 'La historia clinica no existe',
            ];
            return response()->json($data, 404);
        }

        if ($historiaClinica->delete()) {
            $data = [
                'status' => true,
                'message' => 'Historia clinica eliminado correctamente',
            ];
            return response()->json($data, 200);
        }

        $data = [
            'status' => false,
            'error' => 'No se pudo eliminar la historia clinica',
        ];
        return response()->json($data, 400);
    }


}
