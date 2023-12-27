<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class ObraSocial extends Model
{
    use HasFactory;
    protected $table = 'obra_social';

    protected $fillable = [
        'codigo',
        'descripcion',
        'codArancel',
        'activa',
        'valor',
        'maxAnual',
        'maxMensual',
        'obraSocial',
        'usuario',
    ];
}
