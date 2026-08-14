<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ControlIngreso;

class Persona extends Model
{
   
    protected $table = "personas";
    protected $primaryKey = 'cedula';
    protected $fillable = [
				    	'cedula',
                         'nombre',
                         'apellidos',
                         'genero',
                         'fecha_contrato',
                         'fecha_inicio',
                         'fecha_vencimiento',
                         'despacho_id',
                         'cargo_id',
                         'estado_cargo',
                         'descripcion_cargo'
    						];
    						
    						
    public function ControIngresos()
    {
       return $this->belongsToMany(ControlIngreso::class,'identificacion');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
   
}

