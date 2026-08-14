<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoraJornadaSalud extends Model
{
     protected $table      = "hora_jornada_salud";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'cita', 
    	'hora',
    	'cedula',
    	'odontologia',
    	'citologia',
    	'confirmado'
    ];
}
