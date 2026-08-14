<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiaFamilia extends Model
{
    //
     protected $table = "dia_de_la_familia";

    protected $fillable = ['nombre_servidor', 'identificacion', 'codigo_despacho', 'despacho', 'cargo',
    'email','confirma','acompanante_1','identificacion_a1','parentezco_1','confirma_1','acompanante_2',
    'identificacion_a2','parentezco_2','confirma_2','observaciones'];

    

}
