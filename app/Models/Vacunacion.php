<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Vacunacion extends Model
{
    //
    protected $table      = "vacunacion";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'cedula', 
    	'nombres', 
    	'apellidos',
    	'sexo',
    	'fecha_nacimiento',
    	'edad',
    	'empleado',
    	'familiar',
    	'dosis',
    	'vacuna',
    	'hora_asistencia',
    	'despacho'
    ];
}
