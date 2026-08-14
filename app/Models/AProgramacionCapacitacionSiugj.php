<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AProgramacionCapacitacionSiugj extends Model
{
    

    protected $table = "a_programacion_capacitacion_siugj";
   
    protected $fillable = [
    	'codigo_despacho',
    	'despacho', 
    	'identificacion', 
    	'nombre',
        'correo',
        'fecha',
        'horario',
        'tipo_capacitacion',
        'categoria',
        'role',
        'modalidad',
        'ubicacion',
    						];


        

}