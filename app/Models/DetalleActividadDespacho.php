<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleActividadDespacho extends Model
{
    protected $table = 'detalles_actividad_despacho';

    protected $fillable = [
        'actividad_id',
        'fecha',
        'numero_visitas',
        'observaciones',
        'usuarios_solicitados'
    ];

    public function actividad()
    {
        return $this->belongsTo(ActividadDespacho::class, 'actividad_id');
    }
}