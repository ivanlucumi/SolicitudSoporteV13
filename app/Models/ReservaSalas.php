<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservaSalas extends Model
{
    //
    protected $table      = "reservasalas";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'rs_numero_radicado', 
    	'rs_sala', 
    	'rs_nombre_fiscal',
    	'rs_nombre_indiciado',
    	'rs_fecha',
    	'rs_hora_inicio',
    	'rs_hora_fin',
    	'rs_estado',
    	'rs_creador',
    	'rs_modificador',
    	'rs_codigo_juzgado',
    	'solicitud_audiencia_id'
    ];

    public static function verReservas(){
    	$fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');

    	$ver = DB::select('select reservasalas.*, (select nombreDespacho from despachos where despachos.codigoDespacho = reservasalas.rs_codigo_juzgado) as ndespacho, torres.t_nombre as torre, pisos.p_nombre as piso, salas.s_nombre as sala
			from reservasalas
			inner join salas
			on salas.id = reservasalas.rs_sala
			inner join pisos
			on pisos.id = salas.s_pisos
			inner join torres
			on torres.id = pisos.p_torre
			where reservasalas.rs_fecha = "'.$fdia.'" '
		);

		if($ver != null){
			return $ver;
		}else{
			return null;
		}
    }

    public static function verReservasAdmin(){
    	$fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');

    	$ver = DB::select('select reservasalas.*, (select nombreDespacho from despachos where despachos.codigoDespacho = reservasalas.rs_codigo_juzgado) as ndespacho, torres.t_nombre as torre, pisos.p_nombre as piso, salas.s_nombre as sala
			from reservasalas
			inner join salas
			on salas.id = reservasalas.rs_sala
			inner join pisos
			on pisos.id = salas.s_pisos
			inner join torres
			on torres.id = pisos.p_torre
			order by reservasalas.id desc
			'
		);

		if($ver != null){
			return $ver;
		}else{
			return null;
		}
    }
    
    
    public static function verReservasSinPublicar(){
    	$fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');

    	$ver = DB::select('select reservasalas.*, (select nombreDespacho from despachos where despachos.codigoDespacho = reservasalas.rs_codigo_juzgado) as ndespacho
            from reservasalas
            WHERE rs_sala IS NULL AND
            rs_estado = "SIN PUBLICAR" AND
            rs_fecha >= "'.$fdia.'"'
		);

		if($ver != null){
			return $ver;
		}else{
			return null;
		}
    }
    
    //RESERVAS PUBLICADAS
     public static function verReservasPublicadas(){
    	$fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');

    	$ver = DB::select('select reservasalas.*, (select nombreDespacho from despachos where despachos.codigoDespacho = reservasalas.rs_codigo_juzgado) as ndespacho,
    	 (select s_nombre from salas where salas.id = reservasalas.rs_sala) as sala_nombre 
            from reservasalas
            WHERE rs_estado = "ACTIVO" AND
            rs_fecha >= "'.$fdia.'" order by rs_fecha ASC'
		);

		if($ver != null){
			return $ver;
		}else{
			return null;
		}
    }

    public static function verReservasBuscar($dato,$dato1){
    	$fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');

    	$ver = DB::select('select reservasalas.*, (select nombreDespacho from despachos where despachos.codigoDespacho = reservasalas.rs_codigo_juzgado) as ndespacho, torres.t_nombre as torre, pisos.p_nombre as piso, salas.s_nombre as sala
			from reservasalas
			inner join salas
			on salas.id = reservasalas.rs_sala
			inner join pisos
			on pisos.id = salas.s_pisos
			inner join torres
			on torres.id = pisos.p_torre
			where reservasalas.rs_fecha = "'.$dato.'"
			and reservasalas.rs_estado = "ACTIVO"
			and torres.t_nombre = "'.$dato1.'"
			order by torres.id, pisos.id, salas.s_nombre'
		);

		if($ver != null){
			return $ver;
		}else{
			return null;
		}
    }

    public static function pregunto($dato1, $dato2, $dato3, $dato4, $dato5){
    	$ver = DB::select('
    		select count(*) as t 
    		from reservasalas 
    		where rs_sala = "'.$dato1.'" 
    		and rs_estado = "'.$dato2.'" 
    		and rs_fecha = "'.$dato3.'" 
    		and rs_hora_inicio = "'.$dato4.'"
    		and rs_hora_fin = "'.$dato5.'" ');

    	if($ver != null){
    		return $ver;
    	}else{
    		return null;
    	}
    }
    
    //mostar reservas IVAN
    public static function reservasSalas($sala)
	{

       $reservas =  DB::select("select reservasalas.id, 
 CONCAT(' ','Radicado:',reservasalas.rs_numero_radicado,'Despacho:', (select name from users where users.cedula = reservasalas.rs_codigo_juzgado) ) AS title,
 CONCAT(' ',reservasalas.rs_fecha,' ', reservasalas.rs_hora_inicio) AS start,
 CONCAT(' ',reservasalas.rs_fecha,' ', reservasalas.rs_hora_fin) AS end, 
 reservasalas.rs_nombre_fiscal,
 reservasalas.rs_numero_radicado as radicado,
 (select name from users where users.cedula = reservasalas.rs_codigo_juzgado) as despacho,
 reservasalas.rs_nombre_indiciado as indiciado,
 reservasalas.rs_fecha as fecha,
 reservasalas.rs_hora_inicio as horaini,
 reservasalas.rs_hora_fin as horafin,
 reservasalas.rs_sala
 FROM reservasalas
 WHERE  reservasalas.rs_sala ="."'$sala'"); 

 return $reservas;    
    }

    public static function verificar($fechaI,  $horaI, $horaF, $sala)
	{
		//primero traemos los registros que estan con la fecha a buscar 
		//$fecha = DB::select('select * from reservasalas where rs_fecha = "'.$fechaI.'" ');
		//busco con la fecha y con la hora de inicio en el siguiente 
		//$busquedad1 = DB::select('select * from reservasalas where rs_fecha = "'.$fechaI.'" and rs_hora_inicio  >="'.$horaI.'" and rs_hora_inicio < "'.$horaF.'" ');
		//return $busquedad1;
		$FI = (string) $fechaI;
				//$FF = (string) $fechaF;
		/*$verificacion = DB::select("
				select *
				FROM reservasalas
				WHERE rs_fecha = "."'$FI'"."
				and rs_hora_inicio >= "."'$horaI'"." 
				AND  rs_hora_inicio < "."'$horaF'"."");
			$verificacion1 = DB::select("
				select *
				FROM reservasalas
				WHERE rs_fecha = "."'$FI'"."
				and rs_hora_fin > "."'$horaI'"." 
				AND rs_hora_fin < "."'$horaF'"."");
				//definir la ultima hora de el dia para poder comparar
			$verificacion2 = DB::select("
				select *
				FROM reservasalas
				WHERE rs_fecha = "."'$FI'"."
				and rs_hora_fin > "."'$horaI'"." 
				AND rs_hora_fin <= '18:00:00'");
			$verificacion3 = DB::select("
				select *
				FROM reservasalas
				WHERE  rs_hora_inicio >= '07:00:00' 
				AND  rs_hora_inicio < "."'$horaF'"."");
			$verificacion4 = DB::select("
				select *
				FROM reservasalas
				WHERE  rs_hora_fin > '07:00:00'  
				AND rs_hora_fin < "."'$horaF'"."");
					

			if($verificacion != null || $verificacion1 != null || $verificacion2 != null || $verificacion3 != null || $verificacion4 != null){
				return $verificacion;
			}else{
				return null;
			}*/

		$est = "ACTIVO";
		
		$verificacion = DB::select("
			select *
			FROM  reservasalas
			WHERE rs_fecha        =  "."'$FI'"."
			AND   rs_sala         =  "."'$sala'"."			
			AND   rs_hora_inicio  >= "."'$horaI'"." 
			AND   rs_hora_inicio  <  "."'$horaF'"."
			AND   rs_estado       =  "."'$est'"."
		");

		$verificacion1 = DB::select("
			select *
			FROM  reservasalas
			WHERE rs_fecha     = "."'$FI'"."
			AND   rs_sala      = "."'$sala'"."			
			AND   rs_hora_fin  > "."'$horaI'"." 
			AND   rs_hora_fin  < "."'$horaF'"."
			AND   rs_estado    = "."'$est'"."				
		");

		$verificacion2 = DB::select("
			select *
			FROM  reservasalas
			WHERE rs_fecha     =  "."'$FI'"."
			AND   rs_sala      =  "."'$sala'"."			
			AND   rs_hora_fin  >  "."'$horaI'"." 
			AND   rs_hora_fin  <= "."'$horaF'"."
			AND   rs_estado    =  "."'$est'"."				
		");

		//dd($verificacion2);
		if($verificacion != null || $verificacion1 != null || $verificacion2 != null){
			return $verificacion ;
		}else{
			return null;
		}
	}

	/*con muestro las salas de un piso de una torre*/
    public static function salasTorrePluck($dato){
        //$ver = DB::select('select  concat(torres.t_nombre,"   ",pisos.p_nombre) as organizado from pisos, torres where pisos.p_torre = torres.id')->lists('organizado','pisos.id');

        $ver = DB::table('salas')

        ->select(DB::raw('CONCAT(pisos.p_nombre, ", ", salas.s_nombre) AS organizado'),'salas.id')
        ->join('pisos', 'pisos.id',  '=', 'salas.s_pisos')
        ->join('torres','torres.id', '=', 'pisos.p_torre')
        ->where('torres.t_nombre',$dato)
        //->orderBy('salas.s_pisos','salas.s_nombre','ASC')
        ->pluck('organizado','salas.id');
        //dd($ver);
        if($ver != null){
            return $ver;
        }else{
            return null;
        }
    }
}
