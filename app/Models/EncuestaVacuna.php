<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EncuestaVacuna extends Model
{
    protected $table = "encuesta_vacunacion";
    protected $fillable = [
				    	'cedula',
             			'nombre',
                         'apellido',
                         'despacho',
                         'despacho_id',
                         'esquema',
                         'vacuna',
                         'estado'

    						];
}
