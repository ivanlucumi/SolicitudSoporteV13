<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudHistorial extends Model
{
    use HasFactory;

    protected $table = 'solicitud_historial';

    protected $fillable = [
        'solicitud_id',
        'usuario_id',
        'usuario_nombre',
        'accion',
        'estado_anterior',
        'estado_nuevo',
        'comentario',
    ];

    /**
     * Get the request that owns the history.
     */
    public function solicitud()
    {
        return $this->belongsTo(SolicitudServicio::class, 'solicitud_id');
    }
}
