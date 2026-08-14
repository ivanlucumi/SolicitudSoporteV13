<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendamientoCapacitacion extends Model
{
    protected $table = "agendamiento_capacitacion";
    protected $fillable = [
				    	'cedula',
             			'nombre',
                         'apellido',
                         'despacho',
                         'despacho_id',
                         'cargo',
                         'tipo_asistencia'

    						];
}
