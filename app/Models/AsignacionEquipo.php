<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\TodoEnUnoInstalacion;

use Illuminate\Support\Facades\DB;


class AsignacionEquipo extends Model
{
    
     protected $table = "asignacion_equipo";
   
    protected $fillable = [
    	'id', 
    	'cedula', 
    	'nombre', 
    	'correo', 
		'usuario',
		'ip',
		'nombre_pc',
        'despacho_id'
    						];




}
