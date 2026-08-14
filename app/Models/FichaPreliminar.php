<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GrupoReparto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FichaPreliminar extends Model
{
    //
    protected $table      = "ficha_preliminar";
    protected $primaryKey = 'id';
    protected $fillable   = [
    'numero_radicado_proceso',
    'procesado',
    'cedula_procesado',
    'tipo_solicitud',
    'url_expediente',
    'anexos',
    'escrito_acusacion',
    'email_notificacion',
    'telefono',
    'despacho_remite',
    'quien_solicita',
    'cedula_quien_solicita',
    'seguimiento',
    'ip',
    'id_usuario_atiende',
    'id_usuario_cambia_solicitud',
    'fecha_solicitud',
    'fecha_solucion',
    'fecha_cambio_tipo_solicitud',
    'observaciones',
    'acta_reparto',
    'id_despacho_reparto',
    'despacho_reparto',
    'observaciones_reparto',
    'fecha_reparto',
    'anexo_sas',
    'acta_reparto_sas',
    'despacho_turno'
    
    
    ];
    
    /* public static function  tipoAudiencia()
 {
      $equipo=['AUDIENCIA PRELIMINAR'=>'AUDIENCIA PRELIMINAR','AUDIENCIA PROGRAMADA'=>'AUDIENCIA PROGRAMADA','AUDIENCIA CONOCIMIENTO MUNICIPAL'=>'AUDIENCIA CONOCIMIENTO MUNICIPAL',
      'AUDIENCIA CONOCIMIENTO CIRCUITO'=>'AUDIENCIA CONOCIMIENTO CIRCUITO','AUDIENCIA SALA PENAL TRIBUNAL SUPERIOR'=>'AUDIENCIA SALA PENAL TRIBUNAL SUPERIOR'];
      ksort($equipo);
      return $equipos = collect($equipo);
      
 }*/
 
  public static function  tipoAudiencia()
 {
      $equipo=['AUDIENCIA GARANTIAS PROGRAMADAS'=>'AUDIENCIA GARANTIAS PROGRAMADAS',
      'PRESENTACION ESCRITO ACUSACION'=>'PRESENTACION ESCRITO ACUSACION',
      'PRESENTACION PRECLUSION'=>'PRESENTACION PRECLUSION',
      'PRESENTACION IPS'=>'PRESENTACION IPS',
      'PRESENTACION PREACUERDO'=>'PRESENTACION PREACUERDO',
      'AUDIENCIA GARANTIAS ACTOS URGENTES'=>'AUDIENCIA GARANTIAS ACTOS URGENTES'
      ];
      //ksort($equipo);
      return $equipos = collect($equipo);
      
 }
 
 public function scopeRadicado($query, $radicado){
        //dd( $cuidad);
        if($radicado){
            $query->where('numero_radicado_proceso',$radicado);
            //dd( $query);
        }
    }
    
    public function scopeProcesado($query, $procesado){
        //dd( $cuidad);
        if($procesado){
            $query->where('procesado','LIKE', '%' .$procesado.'%');
            //dd( $query);
        }
    }

    public function scopeFecha($query, $fecha){
        //dd( $entidad);
        if($fecha){
            $query->where('fecha_reparto','LIKE', '%' .$fecha.'%' );
            //dd( $query);
        }
    }

 
}


