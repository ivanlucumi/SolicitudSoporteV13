<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProgramacionVisitaSiugj extends Model
{
    

    protected $table = "programacion_visita_siugj";
   
    protected $fillable = [
    	'codigo_despacho',
    	'despacho', 
    	'direccion', 
    	'telefono',
        'correo',
        'numero_colaboradores',
        'fecha_visita',
        'jornada'
    						];

       
        
        
        public static function fechaVisita()
            {
                return $fecha= [ 
                                '2024-11-05',
                                '2024-11-06',
                                '2024-11-07',
                                '2024-11-08',
                                '2024-11-12',
                                '2024-11-13',
                                '2024-11-14',
                                '2024-11-15',
                                '2024-11-19',
                                '2024-11-20',
                                '2024-11-21',
                                '2024-11-22',
                                '2024-11-26',
                                '2024-11-27',
                                '2024-11-28',
                                '2024-11-29',
                                '2024-12-04',
                                '2024-12-05',
                                '2024-12-06',
                                '2024-12-11',
                                '2024-12-12',
                                '2024-12-13'
                               ];                     
            }
            
        public static function jornadaVisita()
            {
                return $jornada= ['MAÑANA','TARDE'];  
                                
            }


public static function TotalRegistros(){
            $total = DB::select('select fecha_visita,jornada, COUNT(despacho) as cantidad FROM `programacion_visita_siugj` WHERE fecha_visita >"2024-10-31"  GROUP BY fecha_visita,jornada ORDER BY fecha_visita,jornada asc');
           // dd( $total);
 	        return $total;
            
        }

        

}
