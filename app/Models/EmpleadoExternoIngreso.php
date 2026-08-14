<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\EmpleadoExterno;

class EmpleadoExternoIngreso extends Model
{
    //
    protected $table = "empleado_externo_ingreso";
   
    protected $fillable = [
    	'id',
    	'emplead_externo_id', 
    	'registro', 
    	'hora_evento'
    						];
    						
       public function Empleado()
    {
       return $this->belongsTo(EmpleadoExterno::class,'emplead_externo_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
 						
}

