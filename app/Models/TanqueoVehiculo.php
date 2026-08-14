<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanqueoVehiculo extends Model
{
    
     use HasFactory;
    protected $table = "tanqueo_vehiculos";
    protected $fillable = [
        "id_user",
        "user",
        'id_vehiculo',
        'conductor',
        'nombre_conductor',
        'nivel_tanque',
        "fecha_registro",
        "semana_regsitro",
        "semana_dia_i",
        "semana_dia_fin",
        "kilometraje" ,
        "foto",
        "observaciones" 

        ];
        
       public static function  nivel()
 {
      $nivel=['VACIO'=>'VACIO','NIVEL(1/4)'=>'NIVEL(1/4)','MEDIO(1/2)'=>'MEDIO(1/2)','NIVEL(3/4)'=>'NIVEL(3/4)','LLENO'=>'LLENO'];
     // ksort($equipo);
      return $nivel = collect($nivel);
      
 }
 public function vehiculo(){
    return $this->belongsTo(Vehiculo::class,'id_vehiculo');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
        
}
