<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OficinasReparto extends Model
{
     protected $table      = "oficinas_repartos";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'nombre',
    	'email', 
    	'ciudad',
    	'observaciones',
    ];
}
