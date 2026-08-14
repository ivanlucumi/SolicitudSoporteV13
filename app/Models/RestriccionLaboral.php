<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RestriccionLaboral extends Model
{
    //
    protected $table      = "resttriccion_laboral";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'cedula',
    	'nombre',
    	'correo', 
    	'cargo',
    	'seccional',
    	'edad',
    	'genero',
    	'orientacion_para_seccional',
    	'recomendaciones'
    ];

 

}
