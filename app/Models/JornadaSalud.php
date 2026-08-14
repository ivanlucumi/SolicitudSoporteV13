<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JornadaSalud extends Model
{
    //jornada_salud

    protected $table = "jornada_salud";
   
    protected $fillable = [
    	'id',
    	'cedula', 
    	'nombre', 
    	'apellido',
        'correo',
        'celular',
        'sexo',
        'odontologia',
        'hora_odontologia',
        'citologia',
        'hora_citologia'
    						];
}
