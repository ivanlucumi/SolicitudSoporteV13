<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\PortatilInstalacion;

use Illuminate\Support\Facades\DB;


class Portatil extends Model
{
    
     protected $table = "portatiles";
   
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
		'instalacion_portatil_id'
    						];

 

public function IntalacionP()
    {
       return $this->belongsTo(PortatilInstalacion::class,'instalacion_portatil_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }


}
