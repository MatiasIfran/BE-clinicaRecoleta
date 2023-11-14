<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'personas';

    protected $fillable = [
        'Nombre',
        'Apellido',
        'FechaNacimiento',
        'Genero',
        'Direccion',
        'Telefono',
        'Mail',
        'NumDocumento',
        'fechaultmdf',
        'usuario',
    ];

    public function createPersonaModel($request) 
    {
        $data = $request->validated();

        $persona = $this->create($data);

        return $persona;
    }
}
