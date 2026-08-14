<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ListadoEvento extends Model
{
    protected $table      = "asitencia_actividad";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'num',
        'identificacion',
    	'nombre', 
    	'cargo_ocupacion',
        'telefono',
        'correo',
        'asistencia',
        'pago',
        'persona_inscribe',
        'observacion',
        'form',
        'asistencia_ingreso_26',
        'asistencia_ingreso_27',
        'asistencia_ingreso_28'
        
    ];
    
    
}
