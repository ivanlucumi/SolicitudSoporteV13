<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table      = "vehiculos";
    protected $fillable   = [
        'id',
    	'tipo', 
    	'placa', 
        'marca',
        'color',
        'caracteristicas',
        'calidad',
        'observaciones'
    ];
}
