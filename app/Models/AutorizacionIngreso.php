<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutorizacionIngreso extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_ingreso';

    protected $fillable = [
        'numero_seguimiento',
        'id_usuario',
        'codigo_despacho',
        'despacho',
        'fecha_solicitud',
        'correo_usuario',
        'cedula_titular',
        'nombre_titular',
        'cargo_titular',
        'correo_titular',
        'cedula_empleado',
        'nombre_empleado',
        'cargo_empleado',
        'motivo_ingreso',
        'estado',
        'fecha_ingreso',
        'hora_ingreso',
        'observaciones_almacen',
        'circuito',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
        // hora_ingreso could also be cast if using Carbon
    ];
}
