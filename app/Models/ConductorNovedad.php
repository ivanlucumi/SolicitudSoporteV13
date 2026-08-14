<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConductorNovedad extends Model
{
    use HasFactory;

    protected $table = 'conductores_novedades';

    protected $fillable = [
        'placa',
        'conductor_cedula',
        'inspeccion_id',
        'fecha',
        'descripcion',
        'estado'
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    /**
     * Relación con la inspección.
     */
    public function inspeccion()
    {
        return $this->belongsTo(Inspeccion::class, 'inspeccion_id');
    }

    /**
     * Relación con el conductor.
     */
    public function conductor()
    {
        return $this->belongsTo(User::class, 'conductor_cedula', 'cedula');
    }

    /**
     * Relación con el vehículo.
     */
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'placa', 'placa');
    }
}
