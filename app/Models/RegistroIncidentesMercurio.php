<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroIncidentesMercurio extends Model
{

    protected $table = "registro_incidentes_mercurio";

    protected $fillable = [
     'usuario',
     'solicitud',
     'radicacion',
     'fecha_solicitud',
     'estado',
     'solucion',
     'quien_soluciono',
     'fecha_solucion', 
     'despacho_que_solicita'];
     
        public static function  estado()
 {
      $equipo=['CARGADO_COMPLETO'=>'CARGADO_COMPLETO','EXPEDIENTE_INACTIVO'=>'EXPEDIENTE_INACTIVO','SE_INACTIVAN_DOCS'=>'SE_INACTIVAN_DOCS','SOLO_SE_REPORTA'=>'SOLO_SE_REPORTA'];
      ksort($equipo);
      return $equipos = collect($equipo);
      
 }

}
