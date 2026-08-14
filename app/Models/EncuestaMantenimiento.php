<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EncuestaMantenimiento extends Model
{
    protected $table      = "reporte_incidentes_encuestas";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'consecutivo',
        'problema_solucionado',
        'tiempo_respuesta', 
    	'atencion_personal',
    	'calidad_tecnica',
        'satisfaccion_general',
        'comentario', 
    ];
    
    
    /*public function Reporte()
    {
       return $this->belongsTo(ReporteIncidente::class,'consecutivo');
    }*/
    
    public function reporte()
    {
        return $this->belongsTo(ReporteIncidente::class, 'consecutivo', 'id');
    }
    
    
    
}
