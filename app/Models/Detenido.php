<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detenido extends Model
{
    protected $table      = "audiencia_con_detenidos";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'solicitud_audiencias_id',
        'nombre_interno',
        'ciudad', 
    	'nombre_estalecimiento'
    ];
    
    
    public function Audiencia()
    {
       return $this->belongsTo(SolicitudAudiencia::class,'solicitud_audiencias_id','id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
    
    
    
}

