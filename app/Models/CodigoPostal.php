<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CodigoPostal extends Model
{
    use HasFactory;
    protected $table = 'codpos';

    protected $fillable = [
        'codigo',
        'descripcion',
        'usuario',
    ];
}
