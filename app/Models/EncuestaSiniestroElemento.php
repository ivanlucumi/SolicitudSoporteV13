<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaSiniestroElemento extends Model
{
    use HasFactory;

    protected $table = 'encuesta_siniestro_elementos';

    protected $fillable = [
        'encuesta_siniestro_id',
        'inventario_id',
        'tipo_elemento',
        'nombre_elemento',
        'placa',
        'serial',
        'marca',
        'modelo',
        'estado_anterior',
        'estado_posterior',
        'descripcion_dano',
        'observaciones',
    ];

    // ─── Relaciones ────────────────────────────────────────────────────────────

    public function siniestro()
    {
        return $this->belongsTo(EncuestaSiniestro::class, 'encuesta_siniestro_id');
    }

    public function fotos()
    {
        return $this->hasMany(EncuestaSiniestroFoto::class, 'elemento_id');
    }

    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'inventario_id');
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    /**
     * Nombre descriptivo del elemento para mostrar en UI
     */
    public function getNombreCompletoAttribute(): string
    {
        $partes = array_filter([
            $this->tipo_elemento,
            $this->nombre_elemento,
            $this->placa ? "Placa: {$this->placa}" : null,
        ]);
        return implode(' – ', $partes) ?: 'Elemento sin nombre';
    }
}
