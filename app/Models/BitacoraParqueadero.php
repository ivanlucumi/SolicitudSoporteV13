<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BitacoraParqueadero extends Model
{
    use HasFactory;

    protected $table = 'bitacora_parqueadero';

    protected $fillable = [
        'cedula',
        'nombre',
        'vehiculo',
        'placa',
        'fecha',
        'hora_ingreso',
        'hora_salida',
        'quien_registro_ingreso',
        'quien_registro_salida',
        'parqueadero',
        // Campos de ubicación (agregados en migración 2026_05_06)
        'ciudad',       // Seccional / ciudad donde ocurrió el ingreso
        'porteria',     // Portería por donde entró el vehículo
        'edificio',     // Edificio / torre del puesto asignado
        'no_puesto',    // Número visible del puesto (ej: P-01)
        'tipo_ingreso', // EMPLEADO | VISITANTE | TEMPORAL
        'novedades',    // Observaciones registradas en portería
    ];

    /**
     * Relación con la asignación de parqueo (Parqueadero).
     */
    public function puesto()
    {
        return $this->belongsTo(Parqueadero::class, 'parqueadero');
    }

    /**
     * Relación con el empleado mediante la cédula.
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'cedula', 'cedulaE');
    }
}

