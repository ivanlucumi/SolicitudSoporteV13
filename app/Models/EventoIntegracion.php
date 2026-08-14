<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\FamiliarEvento;

class EventoIntegracion extends Model
{
    protected $table      = "evento_integracions";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'cedula',
    	'nombre', 
    	'apellido',
        'cargo',
        'despacho',
        
    ];
    
     public function Familiar()
    {
       return $this->hasMany(FamiliarEvento::class,'evento_integracions_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
}
