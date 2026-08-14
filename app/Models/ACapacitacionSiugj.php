<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ACapacitacionSiugj extends Model
{
    

    protected $table = "a_capacictacion_siugj";
   
    protected $fillable = [
    	'categoria',
    	'role', 
    	'fecha', 
    	'horario',
        'modalidad',
        'ubicacion',
        'cantidad',
    						];


        

}
