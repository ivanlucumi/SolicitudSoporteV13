<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\EscalafonDespacho;

class EscalafonCarrera extends Model
{
    //
    protected $table = "escalafon_carrera";
   
    protected $fillable = [
    	'genero_propiedad',
    	'cedula_propiedad',
    	'apellido_propiedad',
    	'nombres_propiedad',
    	'novedad_escalafon_propiedad',	
    	'tipo_acto',
    	'num',
    	'fecha',
    	'entidad',
    	'concurso_convocatoria',
    	'tipo_nombramiento',
    	'tipo_acto_administrativo',
    	'num_acto_administrativo',
    	'fecha_administrativo',
    	'fecha_posecion',	
    	'num_resolucion',	
    	'fecha_licencia',	
    	'tiempo_licencia',	
    	'observaciones'	,
    	'escalafon_despacho_id',
    						];


public function EscalafonP()
    {
       return $this->hasMany(EscalafonDespacho::class,'escalafon_despacho_id');
    }
	   						
}