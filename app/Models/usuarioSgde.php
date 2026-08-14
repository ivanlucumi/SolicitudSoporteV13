<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usuarioSgde extends Model
{
    protected $table      = "usuario_sgde";
    protected $fillable   = [
        'codigo_despacho',
    	'correo_despaho', 
    	'despacho', 
        'cedula',
        'nombre',
        'cargo',
        'usuario',
        'email'
    ];
}
