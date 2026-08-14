<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudNotificacion extends Model
{
    use HasFactory;
    protected $table = "solicitud_notificaciones";
    protected $fillable = [
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
        'observaciones'

        ];

        public static function  clase_audiencia()
        {
             $equipo=['VIRTUAL'=>'VIRTUAL','PRESENCIAL'=>'PRESENCIAL'];
            
            //orden ascendente
            ksort($equipo);
            //var_export($equipo);
            
             return $equipos = collect($equipo);
             
        }

        public static function  tipo_identificacion()
        {
             $identificacion=['CC'=>'CC','CE'=>'CE','TI'=>'TI','PASAPORTE'=>'PASAPORTE','NUIR'=>'NIUR','NIT'=>'NIT','SIN_IDENTIFICACION'=>'SIN_IDENTIFICACION'];
            
            //orden ascendente
            ksort($identificacion);
            //var_export($equipo);
            
             return $identificacion = collect($identificacion);
             
        }
        public static function  tipo_parte()
        {
             $identificacion=['FISCALIA'=>'FISCALIA','INDICIADO'=>'INDICIADO','IMPUTADO'=>'IMPUTADO'];
            
            //orden ascendente
            ksort($identificacion);
            //var_export($equipo);
            
             return $identificacion = collect($identificacion);
             
        }

        public static function  tipo_notificacion()
        {
             $identificacion=['CORREO'=>'CORREO','DIRECCION'=>'DIRECCION','CENTRO CARCELARIO'=>'CENTRO CARCELARIO','DOMICILIARIA'=>'DOMICILIARIA'];
            
            //orden ascendente
            ksort($identificacion);
            //var_export($equipo);
            
             return $identificacion = collect($identificacion);
             
        }
}

