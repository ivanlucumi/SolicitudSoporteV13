<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disponible extends Model
{
   protected $table      = "disponibles_audiencias";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'nombre',
        'email',
        'telefono', 
    	'fecha_inicio',
    	'fecha_fin',
    	'estado'
    ];
}
