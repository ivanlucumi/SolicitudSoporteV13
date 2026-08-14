<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Despacho;

class SeguimientoPresencialidad extends Model
{
    use HasFactory;
    
    
    protected $table = "seguimiento_presencialidad";
    
     protected $fillable = [
        'codigoDespacho_id',
        'identificacion',
        'nombre_servidor',
        'teletrabajo',
        'cargo',
        'asistencia',
        'jornada',
        'fecha_registro_asistencia',
        'hora',
        'num_funcionarios',
        'despacho_r',
        'codigo_despacho_r',
        'vigencia_solicitud'];
        
  
    
      public function Despacho()
    {
       return $this->belongsTo(Despacho::class,'codigoDespacho_id');
    }
    
}
