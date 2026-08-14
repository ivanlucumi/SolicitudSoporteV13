<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class MesaTrabajoCorte extends Model
{
   
    protected $table = "mesa_trabajo_corte";
    protected $fillable = [
				    	'cedula',
                         'nombre',
                         'correo',
                         'ciudad',
                         'cargo',
                         'mesa_trabajo',
                         'entidad',
                         'numero_contacto'
    						];
    						

    
      public static function TotalRegistros(){
            $total = DB::select('select mesa_trabajo, COUNT(mesa_trabajo) as participantes FROM `mesa_trabajo_corte` WHERE mesa_trabajo is not null GROUP by mesa_trabajo');
           // dd( $total);
 	        return $total;
            
        }

         public static function mesaTrabajo()
            {
                return $fecha= ['MESA 1'=>'MESA 1',
                                'MESA 2'=>'MESA 2',
                                'MESA 3'=>'MESA 3',
                                'MESA 4'=>'MESA 4',
                                'MESA 5'=>'MESA 5',
                                'SOLO ASISTENTE'=>'SOLO ASISTENTE'];                     
            }

    						
    						
 
}

