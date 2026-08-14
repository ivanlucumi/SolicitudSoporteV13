<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudCreacionUsuario extends Model
{
    use HasFactory;

    protected $table = "solicitud_creacion_usuario";

    protected $fillable = [
        'codigo_despacho',
        'despacho',
        'email_despacho',
        'id_encuesta',
        'aplicativo',
        'cedula',
        'nombre',
        'correo',
        'usuario_dominio',
        'cargo'
        
    ];
}