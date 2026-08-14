<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Persona;
use App\Models\Vehiculo;
use App\Models\Parqueadero;

class ControlIngresoHistorico extends Model
{
    protected $table = 'control_ingresos_historico';
    protected $fillable = [
        'identificacion',
        'fullname',
        'sexo',
        'fecha_nacimiento',
        'tipo_sangre',
        'torre',
        'piso',
        'fecha_ingreso',
        'hora_ingreso',
        'despacho',
        'radicado',
        'hora_salida',
        'ingreso',
        'salida',
        'quien_solicito',
        'tipo_solicitud',
        'parqueadero',
        'placa',
        'vehiculo',
        'vehiculo_autorizado',
        'placa',
        'tipo',
        'caracterisiticas',
        'ingreso_fuera_horario',
        'motivo_ingreso'];


    public function scopeCedula($query, $cedula){
        //dd( $cuidad);
        if($cedula != ""){
           $query->where('identificacion', $cedula);
        //dd( $query);
        }
    }
    
     public function persona()
    {
       return $this->belongsTo(Persona::class,'identificacion','cedula');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
     public function parqueado()
    {
       return $this->belongsTo(Parqueadero::class,'parqueadero','id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
    public function vehicu()
    {
       return $this->belongsTo(Vehiculo::class,'vehiculo','id');
    }
    
  
}
