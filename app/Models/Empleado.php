<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empleado extends Model
{
    //
    protected $table = "empleados";
   
    protected $fillable = [
    	'id',
    	'cedulaE', 
    	'fecha_expedicion',
    	'nameE', 
    	'lastnameE',
    	'genero',
    	'clase_nombramiento',
    	'cod_cargo',
    	'cargo_titular',
    	'cod_dependencia',
    	'dependencia_titular',
    	'ciudad_ubicacion_laboral',
    	'cod_despacho',
    	'estado',
    	'observacion',
    	'foto',
    	'carnet_token',
        'fecha_retiro',
        'dispositivo_id'
    ];

 public static function Selectemplados($id){
    	$empleados = DB::select("select CONCAT(empleados.nameE,' ', empleados.lastnameE)as name FROM empleados WHERE empleados.id =".$id);
    	return $empleados;
	}
	
	// Registros donde es propietario
    public function registrosPropietario()
    {
        return $this->hasMany(EscalafonRegistro::class, 'persona_propietario_id');
    }

    // Registros donde es provisional
    public function registrosProvisional()
    {
        return $this->hasMany(EscalafonRegistro::class, 'persona_provisional_id');
    }

	    protected $casts = [
        'fecha_retiro' => 'date',
        'activo'       => 'boolean',
    ];
 
    // ─── Verifica si el empleado está ACTIVO según el campo `estado` de la BD ───
    // Acepta: 'A', 'ACTIVO', 'ACTIVE', 'activo', 'active', '1', 1, true
    public function estaActivo(): bool
    {
        $estado = strtoupper(trim((string) $this->estado));
        return in_array($estado, ['A', 'ACTIVO', 'ACTIVE', '1', 'TRUE'], true)
               || $this->estado === true
               || $this->estado === 1;
    }

    // ─── Compatible con código existente: activo + vigencia futura o igual al día de hoy ──
    public function estaVigente(): bool
    {
        // Si hay campo activo (boolean), lo usamos como respaldo
        if (! $this->estaActivo()) {
            return false;
        }

        // Si existe fecha_retiro, debe ser mayor o igual al día de hoy para estar vigente
        if (!empty($this->fecha_retiro)) {
            return $this->fecha_retiro->startOfDay()->greaterThanOrEqualTo(now()->startOfDay());
        }

        // Sin vigencia (en blanco o nulo): solo basta con estar activo
        return true;
    }

    // ─── Label legible del estado para mostrar en vistas ────────────────────
    public function getEstadoLabelAttribute(): string
    {
        return $this->estaActivo() ? 'ACTIVO' : 'INACTIVO';
    }

    // Scope: solo empleados activos y con vigencia futura
    public function scopeActivos($query)
    {
        return $query->whereIn('estado', ['A', 'ACTIVO', 'ACTIVE', 'activo', 'active'])
                     ->where(function($q) {
                         $q->whereNull('fecha_retiro')
                           ->orWhere('fecha_retiro', '>=', now());
                     });
    }


    // Accessor: fecha_retiro formateada d/m/Y
    public function getFechaRetiroFormateadaAttribute(): string
    {
        return $this->fecha_retiro ? $this->fecha_retiro->format('d/m/Y') : 'Sin fecha';
    }

    // Accessor: URL de la foto (storage o imagen por defecto)
    public function getFotoUrlAttribute($value): ?string
    {
        // 1. Si existe valor directamente en DB (columna 'foto'), priorizarlo
        if (!empty($value)) {
            // Si es una URL completa, retornarla tal cual
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                return $value;
            }
            // Si es solo el nombre del archivo, buscarlo en public/img/carnet/
            return asset('img/carnet/' . $value);
        }

        // 2. Respaldo: Buscar archivo con la cédula en la carpeta public/img/carnet (como antes)
        $extensions = ['jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG'];
        $basePath = public_path('img/carnet/');

        foreach ($extensions as $ext) {
            $filename = $this->cedulaE . '.' . $ext;
            if (file_exists($basePath . $filename)) {
                return asset('img/carnet/' . $filename);
            }
        }

        // Retornar null para que el "onerror" en la vista dibuje las iniciales
        return null;
    }

}

