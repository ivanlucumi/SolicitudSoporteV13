<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Parqueadero extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table      = "parqueadero";
    protected $fillable   = [
        'parqueadero_id',
        'no_parqueadero',
    	'calidad', 
    	'tipo_vehiculo', 
        'placa',
        'descripcion_vehiculo',
        'cedula',
        'nombre',
        'empresa',
        'cargo',
        'juzgado',
        'especialidad',
        'placa_vehiculo_temp',
        'ing_vehiculo_tipo',
        'cedula_ingreso_temp',
        'nombre_temp',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'ocupado',
        'tipo_ingreso',
        'direccion_porteria',
        'codigo_despacho',
        'despacho',
        'email_despacho',
        'observaciones',
        'calidad_vehiculo',
        'zona',
        'estado_funcionario'
    ];
    
    /**
     * Puesto físico al que está vinculado este funcionario.
     */
    public function puesto()
    {
        return $this->belongsTo(UsoParqueadero::class, 'parqueadero_id');
    }

    /**
     * Opciones para el tipo de ingreso permitido.
     */
    public static function tiposIngreso()
    {
        return [
            'RESTRINGIDO' => 'SOLO ESTA PORTERÍA (Puesto Asignado)',
            'GLOBAL'      => 'CUALQUIER PORTERÍA (Permiso Global)'
        ];
    }

    /**
     * Verifica si el puesto asignado está ocupado.
     */
    public function isOcupado(): bool
    {
        return $this->ocupado === 'OCUPADO';
    }
}


