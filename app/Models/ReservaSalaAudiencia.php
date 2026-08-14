<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Ubicacion;
use App\Models\SalaAudiencia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class ReservaSalaAudiencia extends Model
{
    use HasFactory;
   // use SoftDeletes;
    
    protected $table = "reserva_sala_audiencias";

    protected $fillable = [
        'radicacion',
        'despacho_id',
        'correo_despacho',
        'despacho',
        'nombre_fiscal',
        'nombre_indiciado',
        'correo_despacho',
        'sala_id',
        'fecha_inicio',
        'hora_inicio',
        'fecha_fin',
        'hora_fin',
        'description',
        'editable',
        'user_id',
        'color',
        'user_id',
        'reservado',
    ];
    
    
        public function Sala()
    {
       return $this->belongsTo(SalaAudiencia::class,'sala_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
     
    
    
    
     public static function ReservasHoy()
	{
	  
	  $fechaA =Carbon::now()->toDateString();
	  //dd($fechaA);
	  $user = auth()->user()->sede_ciudad;
	  $horarios =DB::select("select reserva_sala_audiencias.id, reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,reserva_sala_audiencias.despacho,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal,
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_inicio, reserva_sala_audiencias.hora_inicio) AS start, 
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_fin, reserva_sala_audiencias.hora_fin) AS end,
	  CONCAT_WS(' ',reserva_sala_audiencias.description, reserva_sala_audiencias.sala_id) AS description,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_fin
	  FROM reserva_sala_audiencias, sala_audiencias,ubicaciones,edificios 
	  WHERE reserva_sala_audiencias.sala_id = sala_audiencias.id 
      AND ubicaciones.edificio_id = edificios.id
      AND sala_audiencias.ubicacion_id = ubicaciones.id 
	  AND edificios.ciudad_id ="."'$user'"."AND fecha_inicio ="."'$fechaA'"."GROUP by reserva_sala_audiencias.id,reserva_sala_audiencias.despacho,reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,
	  reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_fin,reserva_sala_audiencias.hora_fin,reserva_sala_audiencias.description,reserva_sala_audiencias.sala_id,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal ");

     //dd($horarios);

       /*$horarios =  DB::select("select reserva_sala_audiencias.id, 
     CONCAT_WS(' ',reserva_sala_audiencias.despacho,'. RADICACION:',reserva_sala_audiencias.radicacion,'. SALA :',sala_audiencias.sala_nombre) AS title,
     CONCAT_WS(' ',reserva_sala_audiencias.fecha_inicio, reserva_sala_audiencias.hora_inicio) AS start,
     CONCAT_WS(' ',reserva_sala_audiencias.fecha_fin, reserva_sala_audiencias.hora_fin) AS end, 
     CONCAT_WS(' ',reserva_sala_audiencias.description, reserva_sala_audiencias.sala_id) AS description, 
     reserva_sala_audiencias.color
     FROM reserva_sala_audiencias,
     sala_audiencias,ubicaciones,edificios,
     WHERE reserva_sala_audiencias.sala_id = sala_audiencias.id"); */
     //dd($horarios);
     return $horarios;    
        }
    
      public static function ReservasHoyCali()
	{
	    $hora_fin =\Carbon\Carbon::Now()->subMinutes(15)->toDateTimeString();
	  $fechaA =Carbon::now()->toDateString();
	  //dd($fechaA);
	  $user ="76001";
	  $edificio_id=1;
	  $horarios =DB::select("select reserva_sala_audiencias.id, reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,reserva_sala_audiencias.despacho,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal,
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_inicio, reserva_sala_audiencias.hora_inicio) AS start, 
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_fin, reserva_sala_audiencias.hora_fin) AS end,
	  CONCAT_WS(' ',reserva_sala_audiencias.description, reserva_sala_audiencias.sala_id) AS description,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_fin
	  FROM reserva_sala_audiencias, sala_audiencias,ubicaciones,edificios 
	  WHERE reserva_sala_audiencias.sala_id = sala_audiencias.id 
      AND ubicaciones.edificio_id = edificios.id
      AND sala_audiencias.ubicacion_id = ubicaciones.id 
	  AND edificios.id ="."'$edificio_id'"."AND reserva_sala_audiencias.hora_fin >="."'$hora_fin'"."AND fecha_inicio ="."'$fechaA'"."GROUP by reserva_sala_audiencias.id,reserva_sala_audiencias.despacho,reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,
	  reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_fin,reserva_sala_audiencias.hora_fin,reserva_sala_audiencias.description,reserva_sala_audiencias.sala_id,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal ORDER BY reserva_sala_audiencias.hora_inicio");

     //dd($horarios);
     //dd($horarios);
     return $horarios;    
        }
        
    public static function ReservasHoyCaliPalacioNacional()
	{
	    $hora_fin =\Carbon\Carbon::Now()->subMinutes(15)->toDateTimeString();
	  $fechaA =Carbon::now()->toDateString();
	  //dd($fechaA);
	  $user ="76001";
	  $palacioNacionalId=9;
	  $horarios =DB::select("select reserva_sala_audiencias.id, reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,reserva_sala_audiencias.despacho,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal,
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_inicio, reserva_sala_audiencias.hora_inicio) AS start, 
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_fin, reserva_sala_audiencias.hora_fin) AS end,
	  CONCAT_WS(' ',reserva_sala_audiencias.description, reserva_sala_audiencias.sala_id) AS description,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_fin
	  FROM reserva_sala_audiencias, sala_audiencias,ubicaciones,edificios 
	  WHERE reserva_sala_audiencias.sala_id = sala_audiencias.id 
	  
      AND ubicaciones.edificio_id = edificios.id
      AND sala_audiencias.ubicacion_id = ubicaciones.id 
	  AND edificios.id ="."'$palacioNacionalId'"."AND reserva_sala_audiencias.hora_fin >="."'$hora_fin'"."AND fecha_inicio ="."'$fechaA'"."GROUP by reserva_sala_audiencias.id,reserva_sala_audiencias.despacho,reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,
	  reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_fin,reserva_sala_audiencias.hora_fin,reserva_sala_audiencias.description,reserva_sala_audiencias.sala_id,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal ORDER BY reserva_sala_audiencias.hora_inicio");

     //dd($horarios);
     //dd($horarios);
     return $horarios;    
        }
        
    public static function ReservasHoyCaliEdificioOtero()
	{
	    $hora_fin =\Carbon\Carbon::Now()->subMinutes(15)->toDateTimeString();
	  $fechaA =Carbon::now()->toDateString();
	  //dd($fechaA);
	  $user ="76001";
	  $oteroId=10;
	  $horarios =DB::select("select reserva_sala_audiencias.id, reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,reserva_sala_audiencias.despacho,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal,
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_inicio, reserva_sala_audiencias.hora_inicio) AS start, 
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_fin, reserva_sala_audiencias.hora_fin) AS end,
	  CONCAT_WS(' ',reserva_sala_audiencias.description, reserva_sala_audiencias.sala_id) AS description,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_fin
	  FROM reserva_sala_audiencias, sala_audiencias,ubicaciones,edificios 
	  WHERE reserva_sala_audiencias.sala_id = sala_audiencias.id 
	  
      AND ubicaciones.edificio_id = edificios.id
      AND sala_audiencias.ubicacion_id = ubicaciones.id 
	  AND edificios.id ="."'$oteroId'"."AND reserva_sala_audiencias.hora_fin >="."'$hora_fin'"."AND fecha_inicio ="."'$fechaA'"."GROUP by reserva_sala_audiencias.id,reserva_sala_audiencias.despacho,reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,
	  reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_fin,reserva_sala_audiencias.hora_fin,reserva_sala_audiencias.description,reserva_sala_audiencias.sala_id,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal ORDER BY reserva_sala_audiencias.hora_inicio");

     //dd($horarios);
     //dd($horarios);
     return $horarios;    
        }
        
        public static function ReservasHoyPalmira()
	{
	    $hora_fin =\Carbon\Carbon::Now()->subMinutes(15)->toDateTimeString();
	  $fechaA =Carbon::now()->toDateString();
	  //dd($fechaA);
	  $user ="76520";
	  $horarios =DB::select("select reserva_sala_audiencias.id, reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,reserva_sala_audiencias.despacho,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal,
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_inicio, reserva_sala_audiencias.hora_inicio) AS start, 
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_fin, reserva_sala_audiencias.hora_fin) AS end,
	  CONCAT_WS(' ',reserva_sala_audiencias.description, reserva_sala_audiencias.sala_id) AS description,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_fin
	  FROM reserva_sala_audiencias, sala_audiencias,ubicaciones,edificios 
	  WHERE reserva_sala_audiencias.sala_id = sala_audiencias.id 
	 
      AND ubicaciones.edificio_id = edificios.id
      AND sala_audiencias.ubicacion_id = ubicaciones.id 
	  AND edificios.ciudad_id ="."'$user'"."AND reserva_sala_audiencias.hora_fin >="."'$hora_fin'"."AND fecha_inicio ="."'$fechaA'"."GROUP by reserva_sala_audiencias.id,reserva_sala_audiencias.despacho,reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,
	  reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_fin,reserva_sala_audiencias.hora_fin,reserva_sala_audiencias.description,reserva_sala_audiencias.sala_id,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal ORDER BY reserva_sala_audiencias.hora_inicio");

     //dd($horarios);
     //dd($horarios);
     return $horarios;    
        }
    
    public static function Reservas()
	{
	    $user = auth()->user()->sede_ciudad;
	  $horarios =DB::select("select reserva_sala_audiencias.id, 
	  CONCAT_WS(' ',reserva_sala_audiencias.despacho,'. RADICACION:',reserva_sala_audiencias.radicacion,'. SALA :',sala_audiencias.sala_nombre, ubicaciones.ubicacion_nombre) AS title,
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_inicio, reserva_sala_audiencias.hora_inicio) AS start, 
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_fin, reserva_sala_audiencias.hora_fin) AS end,
	  CONCAT_WS(' ',reserva_sala_audiencias.description, reserva_sala_audiencias.sala_id) AS description,
	  reserva_sala_audiencias.color, reserva_sala_audiencias.radicacion
	  FROM reserva_sala_audiencias, sala_audiencias,ubicaciones,edificios 
	  WHERE reserva_sala_audiencias.sala_id = sala_audiencias.id 
	  
      AND ubicaciones.edificio_id = edificios.id
      AND sala_audiencias.ubicacion_id = ubicaciones.id 
	  AND edificios.ciudad_id ="."'$user'"."GROUP by reserva_sala_audiencias.id,reserva_sala_audiencias.despacho,reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,
	  reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_fin,reserva_sala_audiencias.hora_fin,reserva_sala_audiencias.description,reserva_sala_audiencias.sala_id,
	  reserva_sala_audiencias.color");

    // dd($horarios);

       /*$horarios =  DB::select("select reserva_sala_audiencias.id, 
     CONCAT_WS(' ',reserva_sala_audiencias.despacho,'. RADICACION:',reserva_sala_audiencias.radicacion,'. SALA :',sala_audiencias.sala_nombre) AS title,
     CONCAT_WS(' ',reserva_sala_audiencias.fecha_inicio, reserva_sala_audiencias.hora_inicio) AS start,
     CONCAT_WS(' ',reserva_sala_audiencias.fecha_fin, reserva_sala_audiencias.hora_fin) AS end, 
     CONCAT_WS(' ',reserva_sala_audiencias.description, reserva_sala_audiencias.sala_id) AS description, 
     reserva_sala_audiencias.color
     FROM reserva_sala_audiencias,
     sala_audiencias,ubicaciones,edificios,
     WHERE reserva_sala_audiencias.sala_id = sala_audiencias.id"); */
     //dd($horarios);
     return $horarios;    
        }
    
    public static function fullcalendarSala($sala)
	{

       $horarios =  DB::select("select reserva_sala_audiencias.id, 
     CONCAT_WS(' ',reserva_sala_audiencias.despacho,'. RADICACION:',reserva_sala_audiencias.radicacion,'. ',sala_audiencias.sala_nombre,'. IND O DEM :',reserva_sala_audiencias.nombre_indiciado) AS title,
     CONCAT_WS(' ',reserva_sala_audiencias.fecha_inicio, reserva_sala_audiencias.hora_inicio) AS start,
     CONCAT_WS(' ',reserva_sala_audiencias.fecha_fin, reserva_sala_audiencias.hora_fin) AS end, 
     CONCAT_WS(' ',reserva_sala_audiencias.description, reserva_sala_audiencias.sala_id) AS description, 
     reserva_sala_audiencias.color, reserva_sala_audiencias.radicacion,reserva_sala_audiencias.despacho,reserva_sala_audiencias.user_id,reserva_sala_audiencias.nombre_fiscal,reserva_sala_audiencias.nombre_indiciado
     FROM reserva_sala_audiencias,
     sala_audiencias 
     WHERE reserva_sala_audiencias.sala_id = sala_audiencias.id
     
     AND reserva_sala_audiencias.sala_id ="."'$sala'"); 
    
     return $horarios;    
        }
        
    public static function ubicaciones(){
        
        if( auth()->user()->email == "root10@gmail.com"){
        
         /*$ubicaciones = SalaAudiencia::query()
            ->join('ubicaciones', 'sala_audiencias.ubicacion_id', '=', 'ubicaciones.id')
            ->join('edificios', 'ubicaciones.edificio_id', '=', 'edificios.id')
            ->whereIn('edificios.id', [1])
            ->whereIn('ubicaciones.id', [27])
            ->select(
                'sala_audiencias.*',
                'ubicaciones.*',
                'edificios.*'
            )
            ->get(); */
       // $ubicaciones = Ubicacion::whereIn('edificio_id', [1])->get();
       
      $ubicaciones = Ubicacion::with('ciudad')
        ->where('edificio_id', 1)
        ->whereIn('id', [27])
        ->orderBy('ubicacion_nombre')
        ->get();
            
         //dd($ubicaciones);
            
          return $ubicaciones;  
        }
        
        $edificio = explode(",",  auth()->user()->reserva_edificio);
        
        //$edificio = $edificio->toArray();
        
        //dd($edificio);
        $Ubicacion = Ubicacion::whereIn('edificio_id', $edificio)->get();
        //dd($Ubicacion);
        
        /*for($i=0; $i < Count($edificio);$i++){
           
           $Ubicacion = Ubicacion::where('edificio_id',$edificio[$i])->get(); 
           //dd($Ubicacion);
        }
    */
    return $Ubicacion;  
    
    }
    
    public static function validarReserva($fecha_inicio,$hora_inicio,$fecha_fin,$hora_fin,$sala_id){
        
        $validacion = ReservaSalaAudiencia::where('fecha_inicio',$fecha_inicio)
        ->where('hora_inicio',$hora_inicio)
        ->where('fecha_fin',$fecha_fin)
        ->where('hora_fin',$hora_fin)
        ->where('sala_id',$sala_id)
        ->get();
        
        return $validacion;  
        
    }
    
    public static function verificar($fechaI, $fechaF, $horaI, $horaF,$sala_id)
		{

				$FI = (string) $fechaI;
				$FF = (string) $fechaF;

				if($FI != $FF )
				  {
						 $verificacion = DB::select("
									select *
									FROM reserva_sala_audiencias
									WHERE fecha_inicio = "."'$FI'"."
									and hora_inicio >= "."'$horaI'"." 
									AND  hora_inicio < "."'$horaF'"."
									AND sala_id ="."'$sala_id'".""
									 );
					$verificacion1 = DB::select("
									select *
									FROM reserva_sala_audiencias
									WHERE fecha_inicio = "."'$FI'"."
									and hora_fin > "."'$horaI'"." 
									AND hora_fin < "."'$horaF'"."
									AND sala_id ="."'$sala_id'"."
									AND sala_id ="."'$sala_id'"."");
					//definir la ultima hora de el dia para poder comparar
					$verificacion2 = DB::select("
									select *
									FROM reserva_sala_audiencias
									WHERE fecha_inicio = "."'$FI'"."
									and hora_fin > "."'$horaI'"." 
									AND hora_fin <= '23:59:00'"."
									AND sala_id ="."'$sala_id'"."");
						 $verificacion3 = DB::select("
									select *
									FROM reserva_sala_audiencias
									WHERE fecha_fin = "."'$FF'"."
									and hora_inicio >= '07:00:00' 
									AND  hora_inicio < "."'$horaF'"."
									AND sala_id ="."'$sala_id'"."");
					$verificacion4 = DB::select("
									select *
									FROM reserva_sala_audiencias
									WHERE fecha_fin = "."'$FF'"."
									and hora_fin > '07:00:00'  
									AND hora_fin < "."'$horaF'"."
									AND sala_id ="."'$sala_id'"."");
					

						 if($verificacion != null || $verificacion1 != null || $verificacion2 != null || $verificacion3 != null || $verificacion4 != null){
						 	return $verificacion  ;
						 }else{
						 	return null; 
						 }
					}else{
						 $verificacion = DB::select("
									select *
									FROM reserva_sala_audiencias
									WHERE fecha_inicio = "."'$FI'"."
									and hora_inicio >= "."'$horaI'"." 
									AND  hora_inicio < "."'$horaF'"."
									AND sala_id ="."'$sala_id'"."");
					$verificacion1 = DB::select("
									select *
									FROM reserva_sala_audiencias
									WHERE fecha_inicio = "."'$FI'"."
									and hora_fin > "."'$horaI'"." 
									AND hora_fin < "."'$horaF'"."
									AND sala_id ="."'$sala_id'"."");
					$verificacion2 = DB::select("
									select *
									FROM reserva_sala_audiencias
									WHERE fecha_inicio = "."'$FI'"."
									and hora_fin > "."'$horaI'"." 
									AND hora_fin <= "."'$horaF'"."
									AND sala_id ="."'$sala_id'"."");

							 if($verificacion != null || $verificacion1 != null || $verificacion2 != null){
													 	return $verificacion ;
													 }else{
													 	return null;
													 }
					}
		}
		
		
		
		//CONSULTA GENERAL DE RESERVA DE SALAS DE AUDIENCIA
		public static function ReservasSalasAudienciaHoy($edificio)
	{
	    $hora_fin =\Carbon\Carbon::Now()->subMinutes(15)->toDateTimeString();
	  $fechaA =Carbon::now()->toDateString();
	  //dd($fechaA);
	  //$user =$ciudad;
	  $oteroId=$edificio;
	  $horarios =DB::select("select reserva_sala_audiencias.id, reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,reserva_sala_audiencias.despacho,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal,
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_inicio, reserva_sala_audiencias.hora_inicio) AS start, 
	  CONCAT_WS(' ',reserva_sala_audiencias.fecha_fin, reserva_sala_audiencias.hora_fin) AS end,
	  CONCAT_WS(' ',reserva_sala_audiencias.description, reserva_sala_audiencias.sala_id) AS description,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_fin
	  FROM reserva_sala_audiencias, sala_audiencias,ubicaciones,edificios 
	  WHERE reserva_sala_audiencias.sala_id = sala_audiencias.id 
	  
      AND ubicaciones.edificio_id = edificios.id
      AND sala_audiencias.ubicacion_id = ubicaciones.id 
	  AND edificios.id ="."'$oteroId'"."AND reserva_sala_audiencias.hora_fin >="."'$hora_fin'"."AND fecha_inicio ="."'$fechaA'"."GROUP by reserva_sala_audiencias.id,reserva_sala_audiencias.despacho,reserva_sala_audiencias.radicacion,sala_audiencias.sala_nombre,ubicaciones.ubicacion_nombre,
	  reserva_sala_audiencias.fecha_inicio,reserva_sala_audiencias.hora_inicio,reserva_sala_audiencias.fecha_fin,reserva_sala_audiencias.hora_fin,reserva_sala_audiencias.description,reserva_sala_audiencias.sala_id,
	  reserva_sala_audiencias.color,reserva_sala_audiencias.nombre_indiciado,reserva_sala_audiencias.nombre_fiscal ORDER BY reserva_sala_audiencias.hora_inicio");

     //dd($horarios);
     //dd($horarios);
     return $horarios;    
        }
    
}
