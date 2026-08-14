<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermisoEspecialParqueadero extends Model
{
    protected $table = 'permisos_especiales_parqueadero';

    protected $fillable = [
        'cedula',
        'fecha_permiso',
        'motivo',
        'user_id',
    ];

    protected $casts = [
        'fecha_permiso' => 'date',
    ];

    /**
     * Coordinador que otorgó el permiso.
     */
    public function coordinador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * ¿Existe un permiso activo para la cédula y fecha dadas?
     */
    public static function tienePermiso(string $cedula, string $fecha): bool
    {
        return static::where('cedula', $cedula)
            ->where('fecha_permiso', $fecha)
            ->exists();
    }
}
