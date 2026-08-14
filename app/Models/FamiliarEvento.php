<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamiliarEvento extends Model
{
    protected $table      = "familiar_funcionarios";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'evento_integracions_id',
        'identificacion',
    	'tipo_identificacion', 
    	'parentesco',
        'nombre_acompanhante',
        'apellido_acompanhante',
        
    ];
}
