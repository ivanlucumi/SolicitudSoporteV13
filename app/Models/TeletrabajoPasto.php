<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeletrabajoPasto extends Model
{
    use HasFactory;
    protected $table = "teletrabajo_pasto";
    protected $fillable = [
        'identificacion',
        'nombre',
        'dependencia',
        'seccional',
        'fecha_solicitud',
        'estado',
        'acuerdo_voluntades',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'dias_teletrabajo',

        ];
        
        
      
        
        
}