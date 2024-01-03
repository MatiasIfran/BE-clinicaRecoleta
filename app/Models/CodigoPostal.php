<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\codigoPostal\CodigoPostalRequest;

class CodigoPostal extends Model
{
    use HasFactory;
    protected $table = 'codpos';

    protected $fillable = [
        'codigo',
        'descripcion',
        'usuario',
    ];

    public function createCodigoPostalModel(CodigoPostalRequest $request)
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

        $codigoPostal = $this->create($data);

        return $codigoPostal;
    }
}
