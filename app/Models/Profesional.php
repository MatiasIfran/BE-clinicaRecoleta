<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Profesional\CreateProfesionalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Profesional extends Model
{
    use HasFactory;
    protected $table = 'profesionales';

    protected $fillable = [
        'Nombre',
        'Apellido',
        'FechaNacimiento',
        'Genero',
        'Direccion',
        'Telefono',
        'Mail',
        'tipoDocumento',
        'NumDocumento',
        'Matricula',
        'Categoria',
        'Cuit',
        'Codigo',
        'daTurnos',
        'usuario',
    ];

    public function createProfesionalModel(CreateProfesionalRequest $request)
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

        $profesional = $this->create($data);

        return $profesional;
    }

    public function updateProfesional(Request $request, $profesionalId)
    {
        $validator = Validator::make($request->all(), [
            'usuario' => 'required|max:50',
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

        $profesional = Profesional::find($profesionalId);
        if (!$profesional) {
            $data = [
                'status' => false,
                'error' => 'Profesional no encontrado',
            ];
            return response()->json($data, 404);
        }

        $profesional->fill($request->only([
            'Direccion',
            'Telefono',
            'Mail',
            'Categoria',
            'daTurnos',
            'usuario'
        ]));

        if ($profesional->save()) {
            $data = [
                'status' => true,
                'message' => 'Profesional actualizado correctamente',
                'result' => $profesional,
            ];
            return response()->json($data, 200);
        }

        $data = [
            'status' => false,
            'error' => 'No se pudo actualizar el profesional.',
        ];
        return response()->json($data, 400);
    }
}
