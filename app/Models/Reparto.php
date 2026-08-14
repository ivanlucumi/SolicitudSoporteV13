<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reparto extends Model
{
    protected $table      = "repartos";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'id_grupo',
        'codigo',
    	'nombre_grupo', 
    	'observaciones'
    ];
    
   
}
