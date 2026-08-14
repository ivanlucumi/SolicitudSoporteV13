<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;
    protected $table = "notificaciones";
    protected $fillable = [
        'id_seguimiento',
        'codigoDespacho',
        'correo_despacho',
        'despacho',
        'numero_radicado_proceso',
        'oficio',
        'delito',
        'clase_audiencia',
        'fecha_audiencia',
        'hora_inicio',
        'lugar',
        'tipo_identificacion',
        'identificacion',
        'nombre_apellido',
        'tipo_parte',
        'tipo_notificacion',
        'direccion',
        'ciudad',
        'telefono_citado',
        'observaciones',
        'estado',
        'quien_registro'
        ];

        public static function  estado()
        {
             $equipo=['NOTIFICADO'=>'NOTIFICADO'];
             ksort($equipo);
             return $equipos = collect($equipo);

        }
}
