<?php

namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use App\Http\Requests\HistoriaClinica\HistoriaClinicaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            return response()->json($data, 204);
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
        DB::beginTransaction();
                $storedPaths = [];
        try {
            $hc = (new HistoriaClinica)
                ->createHistoriaClinicaModel($request);

            foreach ($request->file('files', []) as $file) {
                $path = $file->store("hc_files/{$hc->id}", 'public');
                $storedPaths[] = $path;
            }

            if (!empty($storedPaths)) {
                $hc->link_imagen = $storedPaths;
                $hc->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'hc'     => $hc->refresh(),
            ], 201);
        
        } catch (\Throwable  $e) {
            foreach ($storedPaths as $p) {
                Storage::disk('public')->delete($p);
            }

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Error al guardar historia clínica: '.$e->getMessage(),
            ], 500);
        }
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
