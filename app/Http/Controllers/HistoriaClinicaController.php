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
            'hc' => $historiaClinica,
        ];
        return response()->json($data, 200);
    }

    public function getHistoriaClinicaByProfesionalCodigo($prof_cod)
    {
        $historiaClinica = new HistoriaClinica;
        $historiaClinica = $historiaClinica->obtenerHCxProf($prof_cod);
        return $historiaClinica;
    }

    public function getHistoriaClinicaByPacienteId($pacienteId)
    {
        $historiaClinica = new HistoriaClinica;
        $historiaClinica = $historiaClinica->obtenerHCxPacienteId($pacienteId);
        return $historiaClinica;
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
            'hc' => $historiaClinica,
        ];

        return response()->json($data, 201);
    }

    public function deleteHistoriaClinica($historiaClinicaId)
    {
        $historiaClinica = new HistoriaClinica;
        $historiaClinica = $historiaClinica->deleteHistoriaClinicaModel($historiaClinicaId);
        return $historiaClinica;
    }

    public function updateHistoriaClinica(Request $request, $historiaClinicaId)
    {
        $historiaClinica = new HistoriaClinica();
        $historiaClinica = $historiaClinica->updateHistoriaClinicaModel($request, $historiaClinicaId);
        return $historiaClinica;
    }
}
