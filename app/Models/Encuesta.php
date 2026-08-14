<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table      = "encuesta";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'usuario',
        'correo_usuario',
        'despacho', 
    	'email',
    	'observaciones_email',
        'pagina_rama_judicial',
        'observaciones_paginaramajudicial', 
    	'justiciaxxi',
    	'observaciones_justiciaxxi',
    	'tybajusticiaxxi',
    	'observaciones_tybajusticiaxxi',
        'internet',
        'observaciones_internet', 
    	'usuariodominio',
    	'observaciones_usuariodominio',
        'firmaelectronica',
        'observaciones_firmaelectronica', 
    	'bestdoc',
    	'observaciones_bestdoc', 
    	
    	'mesadeayuda',
    	'observaciones_mesadeayuda',
        'salaaudiencia',
        'observaciones_salaaudiencia', 
    	'audienciasvirtuales',
    	'observaciones_soporteaudienciasvirtuales'
    ];
    
    
   /* public function Audiencia()
    {
       return $this->belongsTo(SolicitudAudiencia::class,'solicitud_audiencias_id','id');
    }*/
    
    
    
    
}
