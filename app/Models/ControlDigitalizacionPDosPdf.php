<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ControlDigitalizacionPDosPdf extends Model
{
    protected $table = "control_digitalizacion_p_dos_pdf";
    protected $fillable = [
				    	'control_digitalizacion_id',
                         'nombre_pdf',
                         'cantidad_paginas'
    						];
    						
    						
   /* public function ControIngresos()
    {
       return $this->belongsToMany(ControlIngreso::class,'identificacion');// se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos 
    }*/
    
    public static function ConteoUser($user){
     $inventario =  DB::select('select count(reviso_servisoft) as cantidad, reviso as name from control_digitalizacion WHERE reviso_servisoft LIKE "%'.$user.'%"  ');
     return $inventario;
 }
 
 public function scopeRadicado($query, $radicado){
        //dd( $cuidad);
        if($radicado){
            $query->where('radicacion',$radicado);
            //dd( $query);
        }
    }
    
}
