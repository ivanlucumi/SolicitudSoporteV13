<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contador extends Model
{
protected $table = "contador_visitas";
    protected $fillable = 
   						 [
				    	'visitas',
				    	'fecha_visita',
				    	'user_visita',
				    	'ip_visita'
   						 ];
}