<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Persona;
use App\Models\Vehiculo;
use App\Models\Parqueadero;

class ControlIngreso extends Model
{
    //use \OwenIt\Auditing\Auditable;
    protected $table = 'control_ingresos';
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
        'vehiculo',
        'vehiculo_autorizado',
        'placa',
        'tipo',
        'caracteristicas',
        'ingreso_fuera_horario',
        'motivo_ingreso',
        'porteria',
        'ciudad',
        'edificio'
    ];


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
    
     public function scopeCedulai($query, $cedula){
        //dd( $cuidad);
        if($cedula != ""){
            $query->where('identificacion', strtoupper($cedula));
            //dd( $query);
        }
    }
    
    public function scopeFechai($query, $fecha){
        //dd( $cuidad);
        if($fecha != ""){
            $query->where('fecha_ingreso', strtoupper($fecha));
            //dd( $query);
        }
    }
    
    public function scopeRadicadoi($query, $radicado){
        //dd( $cuidad);
        if($radicado != ""){
            $query->where('radicado', strtoupper($radicado));
            //dd( $query);
        }
    }

    public static function  torre()
    {
         $torre=['TORRE A'=>'TORRE A','TORRE B'=>'TORRE B'];
         ksort($torre);
         return $torres = collect($torre);
         
    }
    public static function  piso()
    {
         $piso=['PISO 1'=>'PISO 1','PISO 2'=>'PISO 2','PISO 3'=>'PISO 3','PISO 4'=>'PISO 4','PISO 5'=>'PISO 5','PISO 6'=>'PISO 6','PISO 7'=>'PISO 7','PISO 8'=>'PISO 8'
         ,'PISO 9'=>'PISO 9','PISO 10'=>'PISO 10','PISO 11'=>'PISO 11','PISO 12'=>'PISO 12','PISO 13'=>'PISO 13','PISO 14'=>'PISO 14','PISO 15'=>'PISO 15','PISO 16'=>'PISO 16'
         ,'PISO 17'=>'PISO 17','PISO 18'=>'PISO 18'];
         //ksort($piso);
         return $pisos = collect($piso);
         
    }
}
