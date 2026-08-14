<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;    

class UsoParqueadero extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = "uso_parqueadero";

    protected $fillable = [
        "parqueadero",
        "ciudad",
        "edificio",
        "ubicacion",
        "estado",
        "capacidad",
        "zona",
    ];

    /**
     * Asignaciones (funcionarios) vinculados a este puesto.
     */
    public function asignaciones()
    {
        return $this->hasMany(Parqueadero::class, "parqueadero_id");
    }

    /**
     * Primera asignación activa del puesto (para compatibilidad).
     */
    public function asignacionActiva()
    {
        return $this->hasOne(Parqueadero::class, "parqueadero_id")->where("estado", "ACTIVO");
    }

    /**
     * Scope para obtener puestos libres.
     */
    public function scopeLibre($query)
    {
        return $query->where("estado", "LIBRE");
    }

    /**
     * Cuenta vehículos ACTUALMENTE adentro de este puesto hoy.
     * Consulta ControlIngreso real (salida IS NULL) para los parqueadero.id asignados.
     */
    public function vehiculosAdentro(): int
    {
        $parqueaderoIds = $this->asignaciones()->pluck("id");
        
        return \App\Models\ControlIngreso::whereIn("parqueadero", $parqueaderoIds)
            ->whereNull("salida")
            ->count();
    }

    /**
     * ¿Hay cupo disponible? (vehículos adentro < capacidad)
     */
    public function tieneCapacidad(): bool
    {
        return $this->vehiculosAdentro() < ($this->capacidad ?? 1);
    }
}
