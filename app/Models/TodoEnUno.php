<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\TodoEnUnoInstalacion;

use Illuminate\Support\Facades\DB;


class TodoEnUno extends Model
{
    
     protected $table = "todo_en_uno";
   
    protected $fillable = [
    	'id', 
    	'num_caja', 
    	'serial_equipo', 
    	'placa_equipo', 
		'modelo',
		'marca',
		'placa_teclado',
        'serial_teclado',
        'placa_mouse',
        'serial_mouse',
		'estado', 
		'observaciones', 
		'tecnico_id',
		'instalacion_todo_en_uno_id'
    						];

 

public function IntalacionP()
    {
       return $this->belongsTo(TodoEnUnoInstalacion::class,'instalacion_portatil_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }


}
