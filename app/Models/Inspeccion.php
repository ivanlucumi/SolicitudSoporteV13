<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
{
    use HasFactory;

    protected $table = 'inspecciones';

    protected $fillable = [
        'placa',
        'conductor_cedula',
        'fecha',
        'hora',
        'tipo_vehiculo',
        'kilometraje',
        'estado',
        'observaciones',
        'firma_conductor',
        'quien_registro'
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    /**
     * Relación con los detalles de la inspección.
     */
    public function detalles()
    {
        return $this->hasMany(InspeccionDetalle::class, 'inspeccion_id');
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
