<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoAdjunto extends Model
{
    use HasFactory;

    protected $table = 'archivos_adjuntos';

    protected $fillable = [
        'attachable_id',
        'attachable_type',
        'nombre_original',
        'nombre_almacenado',
        'ruta',
        'mime_type',
        'peso_bytes',
        'usuario_id',
    ];

    /**
     * Get the parent attachable model (Solicitud or Response).
     */
    public function attachable()
    {
        return $this->morphTo();
    }
}
