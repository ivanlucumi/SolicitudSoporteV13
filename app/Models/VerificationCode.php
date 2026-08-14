<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    protected $table      = "verificacion_codigos";
    protected $fillable   = [
        'email',
    	'codigo', 
    	'is_valid',
    	'ip',
    	'fecha_disponible'
    ];
}
