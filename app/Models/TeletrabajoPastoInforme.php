<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeletrabajoPastoInforme extends Model
{
    use HasFactory;
    protected $table = "teletrabajo_pasto_informe";
    protected $fillable = [
        'identificacion',
        'nombre',
        'dependencia',
        'seccional',
        'fecha_solicitud',
        'teletrabajo',
        'novedad',
        'fecha_registro_asistencia',
        'ip',
        ];
        
        
      
        
        
}