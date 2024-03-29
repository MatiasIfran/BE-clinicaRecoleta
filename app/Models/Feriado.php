<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\Feriado\FeriadoRequest;


class Feriado extends Model
{
    use HasFactory;
    protected $table = 'feriados';

    protected $fillable = [
        'fecha',
        'prof_cod',
        'titulo',
        'motivo',
        'usuario',
    ];

    public function createFeriadoModal(FeriadoRequest $request)
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

        $feriado = $this->create($data);

        return $feriado;
    }
}
