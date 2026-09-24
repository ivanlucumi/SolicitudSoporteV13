<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroCorreo extends Model
{
    use HasFactory;

    protected $table = 'registro_correos';

    protected $fillable = [
        'ficha_id',
        'vista',
        'datos_json',
        'destinatario',
        'con_copia',
        'asunto',
        'adjuntos_json',
        'estado',
        'intentos',
        'mensaje_error'
    ];
}
