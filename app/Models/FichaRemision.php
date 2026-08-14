<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GrupoReparto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FichaRemision extends Model
{
    //
    protected $table      = "ficha_remision";
    protected $primaryKey = 'id';
    protected $fillable   = [
    'despacho_id',
    'codigo_despacho',
    'despacho_remite',
    'm_remision',
    'especialidad',
    'circuito',
    'numero_radicado_proceso',
    'gr_reparto',
    'demandante',
    'demandado',
    'concocimiento_pre',
    'url_expediente',
    'id_despacho_corresponde',
    'despacho_corresponde',
    'acta_reparto',
    'consulta',
    'estado',
    'hora_remision'
    
    ];

 
}


