<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


use App\Models\EscalafonCarrera;

use App\Models\EscalafonProvisionalidad;




class DespachoEscalafon extends Model
{
    //
    protected $table = "despacho_escalafon";
   
    protected $fillable = [
    	'distrito',
    	'circuito',
    	'municipio',
    	'codigo_despacho',
    	'despacho_judicial',
    	'orden',
    	'estado_nomina',	
    	'Corporacion_observacion',	
    	'estado_actual_corporacion',
    	'lista',
    	'oficio_csjvo',
    	'fecha_oficio',
    	'solicitud_actualizacion',	
    	'codigo_cargo',
    	'codigo_registro_elegibles',
    	'cargo',
    	'grado',
    	'acogido',	
    	'antes_asistente_social',
    	'fecha_vinculacion',
    	'acta_posesion',
    	'observaciones',
    	'despacho_incorporacion_id',
    	'despacho_provisionalidad_id'
    						];
    						
     public function Provisionalidad()
   {
       return $this->hasOne(EscalafonProvisionalidad::class);
   }
   
    public function Carrera()
   {
       return $this->hasOne(EscalafonCarrera::class);
   }


	   						
}