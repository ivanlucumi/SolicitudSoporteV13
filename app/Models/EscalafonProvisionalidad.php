<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


use App\Models\EscalafonDespacho;

class EscalafonProvisionalidad extends Model
{
    //
    protected $table = "escalafon_provisionalidad";
   
    protected $fillable = [
    	'genero_provisionalidad',
    	'cedula_provisionalidad',	
    	'apellido_provisionalidad',
    	'nombre_provisionalidad',
    	'fecha_posecion_provisionalidad',
    	'observaciones_provisionalidad',
    	'escalafon_despacho_id', 
    						];

	   						
}