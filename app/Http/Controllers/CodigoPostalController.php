<?php

namespace App\Http\Controllers;
use App\Models\CodigoPostal;

use Illuminate\Http\Request;

class CodigoPostalController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:sanctum');
    }

    public function allCodigoPostal()
    {
        $codigosPostales = CodigoPostal::all();
        $data = [
            'status'         => true,
            'codigos_postales' => $codigosPostales,
        ];
        return response()->json($data, 200);
    }

    public function getCodPostById($codigoPostalId)
    {
        $codigoPostal = CodigoPostal::find($codigoPostalId);

        if (!$codigoPostal) {
            $data = [
                'status' => false,
                'error'  => 'Código postal no encontrado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'        => true,
            'codigo_postal' => $codigoPostal,
        ];
        return response()->json($data, 200);
    }

    public function getCodPostByCodigo($codigo)
    {
        $codigoPostal = CodigoPostal::where('codigo', $codigo)->first();

        if (!$codigoPostal) {
            $data = [
                'status' => false,
                'error'  => 'Código postal no encontrado',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status'        => true,
            'codigo_postal' => $codigoPostal,
        ];
        return response()->json($data, 200);
    }
}
