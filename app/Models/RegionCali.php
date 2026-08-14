<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionCali extends Model
{
    protected $table = "regison_cali";
    protected $fillable = [
				    	'nombre_completo',
                         'ciudad_trabajo',
                         'cargo',
                         'cedula',
                         'telefono',
                         'correo',
                         'ya_adjunto_cedula',
                         'fecha_de_viaje',
                         'de_ciudad',
                         'a_ciudad',
                         'hora_salida',
                         'tipo_viajes',
                         'valor_estimado',
                         'a_ciudad_regreso',
                         'de_ciudad_regreso',
                         'fecha_regreso',
                         'hora_regreso',
                         'valor_estimado_regreso',
                         'requiere_hotel',
                         'fecha_llegada_hotel',
                         'fecha_salida_hotel',
                         'valor_total_viajes'
    						];
    						

     public static function  viaje()
 {
      $equipo=['TERESTRE'=>'TERESTRE','AEREO'=>'AEREO'];
      ksort($equipo);
      return $equipos = collect($equipo);
      
 }
}
