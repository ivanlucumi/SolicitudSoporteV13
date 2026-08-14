<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Digitalizacion extends Model
{
    
     protected $table = "digitalizacion";

    protected $fillable = ['despacho_id','despacho','email',/*'p_sin_sentencia', 'p_con_sentencia', 'cant_proceso_despacho', 'cant_proceso_secretaria', 'proceso_activos', 'procesos_inactivos'*/ 'procesos_activos','autoriza_digitalizacion'];

    
}
