<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngresoContratista extends Model
{
    protected $table = 'ingreso_contratistas';
    
    protected $fillable = [
        'cedula',
        'nombre',
        'empresa',
        'foto',
        'activo'
    ];

    public function ingresos()
    {
        return $this->hasMany(RegistroIngresoContratista::class, 'contratista_id');
    }
}
