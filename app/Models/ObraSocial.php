<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\obraSocial\ObraSocialRequest;
use Illuminate\Http\Request;

class ObraSocial extends Model
{
    use HasFactory;
    protected $table = 'obra_social';

    protected $fillable = [
        'codigo',
        'descripcion',
        'activa',
        'orden',
        'maxAnual',
        'maxMensual',
        'vigencia',
        'mensaje1',
        'usuario',
    ];

    public function createObraSocialModel(ObraSocialRequest $request)
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
        info($data);

        $codigoPostal = $this->create($data);

        return $codigoPostal;
    }

    public function updateObraSocial(Request $request, $obraSocialId)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => 'El nombre de usuario es obligatorio.'], 400);
        }

        $filtered = array_filter($request->all(), function ($value) { // Conservar 0 y '0' en la matriz
            return $value !== null || $value !== '';
        });

        $obraSocial = ObraSocial::where('id', $obraSocialId)->first();

        if (!$obraSocial) {
            $data = [
                'status' => false,
                'error' => 'Obra social no encontrada',
            ];
            return response()->json($data, 404);
        }

        $obraSocial->fill($request->only([
            'codigo',
            'descripcion',
            'activa',
            'orden',
            'maxAnual',
            'maxMensual',
            'vigencia',
            'mensaje1',
            'usuario',
        ]));

        if ($obraSocial->save()) {
            $data = [
                'status' => true,
                'message' => 'obra social actualizado correctamente',
                'result' => $obraSocial,
            ];
            return response()->json($data, 200);
        }

        $data = [
            'status' => false,
            'error' => 'No se pudo actualizar la obra social',
        ];
        return response()->json($data, 400);
    }
}
