<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscalafonRegistro extends Model
{
    protected $fillable = [
        'cargo_id', 'persona_propietario_id', 'persona_provisional_id',
        'escalafon_id', 'posesion_id', 'licencia_id',
        'fecha_posesion_provisional', 'act_csjvac',
        'estado_actual','reporte_lista', 'observaciones', 'comentarios',
    ];

    protected $casts = ['fecha_posesion_provisional' => 'date'];

   public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
    
    public function propietario()
    {
        return $this->belongsTo(Empleado::class, 'persona_propietario_id');
    }
    
    public function provisional()
    {
        return $this->belongsTo(Empleado::class, 'persona_provisional_id');
    }
    
    public function escalafon()
    {
        return $this->belongsTo(Escalafon::class);
    }
    
    public function posesion()
    {
        return $this->belongsTo(Posesion::class);
    }
    
    public function licencia()
    {
        return $this->belongsTo(Licencia::class);
    }
    
    public function notas()
    {
        return $this->belongsTo(NotasEscalafon::class);
    }
    
    //
    public function observaciones()
    {
        return $this->belongsTo(ObservacionEscalafon::class);
    }
    
   

    // Helper: tiene propietario Y provisional
    public function tienePropiedadYProvisionalidad(): bool
    {
        return !is_null($this->persona_propietario_id)
            && !is_null($this->persona_provisional_id);
    }
}