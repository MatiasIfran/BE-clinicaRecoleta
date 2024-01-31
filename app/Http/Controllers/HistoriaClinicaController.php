<?php

namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use App\Http\Requests\HistoriaClinica\HistoriaClinicaRequest;
use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function allHistoriaClinica()
    {
        $historiaClinica = HistoriaClinica::all();

        if ($historiaClinica->isEmpty()) {
            $data = [
                'status' => false,
                'message' => 'No hay historias clinicas disponibles en este momento.',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'historia Clinica' => $historiaClinica,
        ];
        return response()->json($data, 200);
    }

    public function getHistoriaClinicaByProfesionalCodigo($prof_cod)
    {
        $historiaClinica = HistoriaClinica::where('prof_cod', $prof_cod)->get();

        if ($historiaClinica->isEmpty()) {
            $data = [
                'status' => false,
                'error' => 'No se encontraron historias clinicas para el profesional especificado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'historias clinicas' => $historiaClinica,
        ];
        return response()->json($data, 200);
    }

    public function getHistoriaClinicaByPacienteId($pacienteId)
    {
        $historiaClinica = HistoriaClinica::where('id_paciente', $pacienteId)->get();

        if ($historiaClinica->isEmpty()) {
            $data = [
                'status' => false,
                'error' => 'No se encontraron historias clinicas para el paciente especificado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => true,
            'historias clinicas' => $historiaClinica,
        ];
        return response()->json($data, 200);
    }

    public function createHistoriaClinica(HistoriaClinicaRequest $request)
    {
        $historiaClinica = new HistoriaClinica;
        $historiaClinica = $historiaClinica->createHistoriaClinicaModel($request);

        if ($this->isJsonResponse($historiaClinica)) {
            return $historiaClinica;
        }
        $data = [
            'status' => true,
            'historias Clinicas' => $historiaClinica,
        ];

        return response()->json($data, 201);
    }

    public function deleteHistoriaClinica($historiaClinicaId)
    {
        $historiaClinica = new HistoriaClinica;
        $historiaClinica = $historiaClinica->deleteHistoriaClinicaModel($historiaClinicaId);
        return $historiaClinica;
    }
}
