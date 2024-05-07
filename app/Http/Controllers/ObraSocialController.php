<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\User\IndexRequest; 
use App\Models\ObraSocial;
use App\Http\Resources\UserResource;
use App\Http\Requests\obraSocial\ObraSocialRequest;


class ObraSocialController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:sanctum')->except('allObrasSociales');
    }

    public function allObrasSociales(IndexRequest $request)
    {
        $obrasSociales = ObraSocial::orderBy('descripcion', 'asc')->get();
        if ($obrasSociales->isEmpty()) {
            $data = [
                'status' => false,
                'message' => 'No hay obras sociales disponibles en este momento.',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'         => true,
            'obras_sociales' => $obrasSociales,
        ];
        return response()->json($data, 200);
    }

    public function allActivasObrasSociales(IndexRequest $request)
    {
        $obrasSociales = ObraSocial::where('activa', '!=', false)
            ->orderBy('descripcion', 'asc')
            ->get();
            
        if ($obrasSociales->isEmpty()) {
            $data = [
                'status' => false,
                'message' => 'No hay obras sociales activas en este momento.',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'         => true,
            'obras_sociales' => $obrasSociales,
        ];
        return response()->json($data, 200);
    }

    public function getObraSocialById($obraSocialId)
    {
        $obraSocial = ObraSocial::find($obraSocialId);

        if (!$obraSocial) {
            $data = [
                'status' => false,
                'error'  => 'Obra Social no encontrada',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'       => true,
            'obra_social'  => $obraSocial,
        ];
        return response()->json($data, 200);
    }

    public function getObraSocialByCodigo($obraSocialCodigo)
    {
        $obraSocial = ObraSocial::where('codigo', $obraSocialCodigo)->first();

        if (!$obraSocial) {
            $data = [
                'status' => false,
                'error'  => 'Obra Social no encontrada',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'       => true,
            'obra_social'  => $obraSocial,
        ];
        return response()->json($data, 200);
    }

    public function createObraSocial(ObraSocialRequest $request)
    {
        $obraSocial = new ObraSocial();
        $obraSocial = $obraSocial->createObraSocialModel($request);

        if ($this->isJsonResponse($obraSocial)) {
            return $obraSocial;
        }
        $data = [
            'status'    => true,
            'obraSocial'  => new UserResource($obraSocial),
        ];

        return response()->json($data, 201);
    }

    public function updateObraSocial(Request $request, $obraSocialId)
    {
        $obraSocial = new ObraSocial();
        $obraSocial = $obraSocial->updateObraSocial($request, $obraSocialId);
        return $obraSocial;
    }

}
