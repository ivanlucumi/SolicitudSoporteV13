<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroDigitalizacion extends Model
{
    protected $table = "registro_digitalizacion";
    protected $fillable = [
				    	'radicado',
                         'demandante',
                         'demandado',
                         'folios',
                         'cuadernos',
                         'tipo_expediente',
                         'despacho',
                         'id_despacho',
                         'ciudad',
                         'observacion'
    						];
}
