<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmpleadoExterno extends Model
{
    //
    protected $table = "empleado_externo";
   
    protected $fillable = [
    	'id',
    	'cedula', 
    	'nombre', 
    	'cargo',
    	'empresa'
    						];

 						
}

