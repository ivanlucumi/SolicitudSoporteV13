<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VigilanciaJudicial extends Model
{
    protected $table      = "vigilancia_judiciales";
    protected $fillable   = [
        'seguimiento',
          'tipo_solicitante' ,
          'nombre_apellido' ,
          'cedula' ,
          'direccion' ,
          'correo' ,
          'telefono' ,
          'barrio' ,
          'municipio' ,
          'despacho_encuentra' ,
          'codigo_despacho' ,
          'tipo_proceso' ,
          'num_radicado' ,
          'demandante' ,
          'demandado' ,
          'motivo_determinante' ,
          'descrip_otro' ,
          'formato' ,
          'fecha_recibido',
          'user_id',
          'funcionario_reparte',
          'acta_reparto',
          'fecha_reparto',
          'reparto_asignado_codigodespa',
          'reparto_asignado_a',
          'observaciones'
    ];
}