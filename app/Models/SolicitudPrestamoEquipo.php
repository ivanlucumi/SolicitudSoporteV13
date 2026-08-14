<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudPrestamoEquipo extends Model
{
    use HasFactory;

    protected $table = 'solicitud_prestamo_equipos';

    protected $fillable = [
        'cedula_solicitante',
        'nombre_solicitante',
        'cedula_juez',
        'nombre_juez',
        'cargo_titular',
        'correo_titular',
        'lugar_funciones',
        'fecha_acta',
        'codigo_despacho',
        'despacho',
        'circuito',
        'equipos',
        'archivo_pdf',
        'estado',
        'observaciones_almacen',
    ];

    protected $casts = [
        'equipos'    => 'array',
        'fecha_acta' => 'date',
    ];
}
