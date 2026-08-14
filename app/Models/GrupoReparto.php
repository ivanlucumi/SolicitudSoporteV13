<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoReparto extends Model
{
    protected $table      = "grupo_repartos";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'tipo',
    	'especialidad', 
    	'observaciones',
    ];
    
  
}

