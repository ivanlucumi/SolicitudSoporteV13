<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoArchivoJudicial extends Model
{
    use HasFactory;

    protected $table      = "ingreso_archivo_judiciales";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	    'fecha_solicitud',
            'despacho_id',
            'despacho',
            'funcionario_titular',
            'persona_que_autoriza',
            'cedula',
            'eps',
            'arl',
            'fecha_ingreso',
            'fecha_salida',
            'horario_permanencia',
            'empleado_responsable',
            'cargo',
            'contacto_emergencia',
            'telefono_emergencia',
            'actividad_realiza',
            'doc_autorizacion',
            'doc_responsabilidad',
            'autorizado',
            'disaj_autoriza',
            'fecha_autorisa_disaj',
            'ofjudicial_autoriza',
            'fecha_autorisa_ofjudicial',
            'hora_ingreso',
            'hora_salida',
            'usuario_da_ingreso',
            'usuario_da_salida',
    ];
    
      public static function  estado()
 {
      $equipo=['AUTORIZADO'=>'AUTORIZADO','NO_AUTORIZADO'=>'NO_AUTORIZADO'];
      ksort($equipo);
      return $equipos = collect($equipo);
      
 }
}

