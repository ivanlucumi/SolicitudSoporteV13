<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProgramacionCapcitacion extends Model
{
    

    protected $table = "programacion_capacitacion";
   
    protected $fillable = [
    	'codigo_despacho',
    	'despacho', 
    	'identificacion', 
    	'nombre',
        'correo',
        'fecha',
        'jornada',
        'tipo_capacitacion'
    						];

        
        public static function TotalRegistros(){
            $total = DB::select('select fecha,jornada,tipo_capacitacion, COUNT(despacho) as cantidad FROM `programacion_capacitacion` WHERE fecha >= "2025-10-27" AND tipo_capacitacion != "SIUGJ" GROUP BY fecha,tipo_capacitacion,jornada ORDER BY fecha,jornada asc');
           // dd( $total);
 	        return $total;
            
        }
        
        public static function TotalRegistrosSiugj(){
            $total = DB::select('select fecha,jornada,tipo_capacitacion, COUNT(despacho) as cantidad FROM `programacion_capacitacion` WHERE tipo_capacitacion = "SIUGJ" GROUP BY fecha,tipo_capacitacion,jornada ORDER BY fecha,jornada asc');
           // dd( $total);
 	        return $total;
            
        }
        
        
        public static function fechaSiugj()
            {
                return $fecha= [ 
                                '2024-11-04',
                                '2024-11-05',
                                '2024-11-06',
                                '2024-11-07',
                                /*'2024-10-22',
                                '2024-10-23',
                                '2024-10-24',
                                '2024-10-25',*/
                               ];                     
            }
            
        public static function jornadaSiugj()
            {
                return $jornada= ['08:00 a.m a 10:00 a.m','13:00 p.m a 15:00 p.m','15:00 p.m a 17:00 p.m'];  
                                
            }

         public static function fecha()
            {
                return $fecha= [ 
                                '2025-11-04',
                                '2025-11-05',
                                '2025-11-06',
                                '2025-11-07',
                                /*'2024-10-11',
                                '2024-10-15',
                                '2024-10-16',
                                '2024-10-17',
                                '2024-10-18',
                                '2022-09-05',
                                '2022-09-06',
                                '2022-09-07',
                                '2022-09-08',
                                '2022-09-09',
                                '2022-09-12',
                                '2022-09-13',
                                '2022-09-14',
                                '2022-09-15',
                                '2022-09-16'
                                '2025-02-25',
                                '2025-02-26',
                                '2025-02-27',
                                '2025-02-28',
                                '2025-03-03',
                                '2025-03-06',
                                '2025-03-07'
                                '2025-04-24'*/];                     
            }

        public static function jornada()
            {
                return $jornada= ['08:00 a.m a 10:00 a.m','10:00 a.m a 12:00 m','13:00 p.m a 15:00 p.m','15:00 p.m a 17:00 p.m'];  
                                
            }

        public static function participacion()
            {
                return $participacion= ['VIRTUAL','PRESENCIAL'];                  
            }

}
