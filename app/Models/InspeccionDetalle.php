<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspeccionDetalle extends Model
{
    use HasFactory;

    protected $table = 'inspeccion_detalles';

    protected $fillable = [
        'inspeccion_id',
        'grupo',
        'item',
        'nombre_item',
        'resultado',
        'observacion'
    ];

    /**
     * Relación con la cabecera de inspección.
     */
    public function inspeccion()
    {
        return $this->belongsTo(Inspeccion::class, 'inspeccion_id');
    }
}
