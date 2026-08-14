<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Levantamiento extends Model
{
    protected $table      = "levantamiento_sgde";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'despacho_id',
        'despacho',
    	'correo_despacho', 
    	'procesos_act_sin_sentencia',
        'procesos_act_con_tramite_post',
        'cantidas_exp_cumplimiento_pena',
        'cantidad_onedrive_ver_uno',
        'cantidad_onedrive_ver_dos',
        'cantidad_bestdoc',
        'cantidad_samai',
        'cantidad_just_xxi_web'
        
    ];
    
    
}
