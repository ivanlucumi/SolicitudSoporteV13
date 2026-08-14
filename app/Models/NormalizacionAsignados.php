<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class NormalizacionAsignados extends Model
{
    protected $table = "normallizacion_asignado";
    protected $fillable = [
                        'radicacion',
				    	'codigo_despacho',
				    	'despacho',
                        'user',
    						];
    						

 
    
}