<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteIncidente extends Model
{
    protected $table = "reporte_incidente";
    protected $fillable = [
				    	'id_usuario',
				    	'consecutivo',
				    	'nombre_despacho',
				    	'email_despacho',
				    	'ubicacion',
				    	'zona',
				    	'piso',
				    	'identificacion',
				    	'nombre_funcionario',
                         'nombre_usuario',
                         'categoria',
                         'item',
                         'descripcion',
                         'id_asignado_a',
                         'asignado_a',
                         'id_trasladado_a',
                         'trasladado_a',
                         'estado',
                         'observaciones',
                         'reportado_a',
                         'respuesta_tecnico',
                         'fecha_cerrado',
                         'fecha_visita',
                         'segunda_visita',
                         'comentarios_internos'
    						];

    public function usuario(){
    return $this->belongsTo(User::class,'id','trasladado_a');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }

}



