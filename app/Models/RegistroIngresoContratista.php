<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroIngresoContratista extends Model
{
    protected $table = 'registro_ingreso_contratistas';
    
    protected $fillable = [
        'contratista_id',
        'fecha_ingreso',
        'hora_ingreso',
        'puerta',
        'tipo',
        'user_id'
    ];

    public function contratista()
    {
        return $this->belongsTo(IngresoContratista::class, 'contratista_id');
    }

    public function portero()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
