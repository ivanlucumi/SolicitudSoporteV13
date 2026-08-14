<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservaSalaAudiencia;
use App\Models\Ubicacion;
use App\Models\SalaAudiencia;
use App\Models\Despacho;
use App\Models\Edificio;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Illuminate\Support\Facades\DB;


class ReservaSalaAudienciaController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('adminSalas');
    }
    
    
    public function index()
    {
    
   // $ciudad=
       $Ubicaciones = ReservaSalaAudiencia::ubicaciones();
       
       return view('reservaSalas.Index',compact('Ubicaciones')); 
    }
    
    public function Salas($sala){
        
       /* $Ubicaciones = ReservaSalaAudiencia::ubicaciones();
        //dd($Ubicaciones);
        $ubicacion =Ubicacion::where('id',$sala)->first();
        
        $edificio =Edificio::where('id',$ubicacion->edificio_id)->first();
        
        $salas = SalaAudiencia::where('ubicacion_id',$sala)
        //->where('estado',1)
        ->get();
        
       return view('reservaSalas.Salas',compact('salas','Ubicaciones','ubicacion','edificio'));*/
       
        $fechaActual = Carbon::today();

        // Todas las ubicaciones
        $Ubicaciones = ReservaSalaAudiencia::ubicaciones();
    
        // Buscar la ubicación por ID
        $ubicacion = Ubicacion::findOrFail($sala);
    
        // Buscar el edificio relacionado
        $edificio = Edificio::find($ubicacion->edificio_id);
    
        // Obtener las salas asociadas a la ubicación
        $salas = SalaAudiencia::where('ubicacion_id', $sala)
        ->where('estado',1)
        ->get();
    
        // Agrupar y contar reservas por sala a partir de hoy
        $reservasPorSala = ReservaSalaAudiencia::query()
            ->select('sala_id', \DB::raw('count(*) as total_reservas'))
            ->whereIn('sala_id', $salas->pluck('id'))
            ->whereDate('fecha_inicio', '>=', $fechaActual)
            ->groupBy('sala_id')
            ->pluck('total_reservas', 'sala_id');
    
        // Añadir el total de reservas a cada sala
        $salas->transform(function ($salaItem) use ($reservasPorSala) {
            $salaItem->total_reservas = $reservasPorSala[$salaItem->id] ?? 0;
            return $salaItem;
        });

    return view('reservaSalas.Salas', compact('salas', 'Ubicaciones', 'ubicacion', 'edificio'));

       
       
    }  
    
    
    public function ReservasAll()
    {
       $Ubicaciones = ReservaSalaAudiencia::ubicaciones();
        
        $reserva= true;
        
       return view('reservaSalas.Index',compact('reserva','Ubicaciones')); 
    }
    
    
    
    public function ReservarSalas(Request $request,$sala){
        
        
        
        if( auth()->user()->email == "correoofjcali@cendoj.ramajudicial.gov.co"){
          // $despachos = Despacho::pluck('nombreDespacho','codigoDespacho'); 
        }else{
          // $despachos = Despacho::where('codCiudad', auth()->user()->sede_ciudad)->pluck('nombreDespacho','codigoDespacho'); 
        }
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        
        $Ubicaciones = ReservaSalaAudiencia::ubicaciones();
        $reserva= true;
        $salon = $sala;
        
        $nombre = SalaAudiencia::where('id',intval($sala))->first();
        
        $ubicacion =Ubicacion::where('id',$nombre->ubicacion_id)->first();
        //dd($ubicacion,$nombre);
        
        $edificio =Edificio::where('id',$ubicacion->edificio_id)->first();
        
        //dd($nombre,$salon,$ubicacion,$edificio);
        
        
        //dd(intval($sala),$nombre);
       return view('reservaSalas.Reserva',compact('salon','reserva','Ubicaciones','nombre','despachos','ubicacion','edificio')); 
        
    }
    
    
    
    public function Eventos($sala){
        $data = ReservaSalaAudiencia::fullcalendarSala($sala);
	    //dd($data);
	     return response()->json($data);
        
    }
    
    public function ReservasSalas(){
        $data = ReservaSalaAudiencia::Reservas();
	    //dd($data);
	     return response()->json($data);
        
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        
        $this->validate($request, [
            'despacho_id' => 'required',
            'radicacion'=> 'required|numeric|digits:23',
            'nombre_fiscal' => 'required',
            'nombre_indiciado' => 'required',
            'fechaI' => 'required|date',
            'horaI' => 'required',
            'fechaF' => 'required|date',            
            'horaF' => 'required|max:150'
        ]);
        
        
        $despacho = Despacho::where('codigoDespacho',$request['despacho_id'])->first();
		
        $verificacion1 =ReservaSalaAudiencia::validarReserva($request['fechaI'],$request['horaI'],$request['fechaF'],$request['horaF'],$request['sala_id']);
        
        //dd($verificacion1);
       /* if(!empty($verificacion1)){
            return "Esta reservando en espacio que no esta disponible";
            Session::flash('success', 'Error al enviar correo Electrónico !');
            return Redirect::back();
        }*/
		

			if($request->ajax())
			{
				$verificacion =ReservaSalaAudiencia::verificar($request['fechaI'],$request['fechaF'],$request['horaI'],$request['horaF'],$request['sala_id']);
				//dd($verificacion);
						
					if(is_null($verificacion))
					{
						
					
						if($request->ajax())
							{
								$reserva= ReservaSalaAudiencia::create
								([
								  	'radicacion' => $request['radicacion'],
								  	'despacho_id' => $request['despacho_id'],
								  	'correo_despacho' => $despacho->correoD,
								  	'despacho' => $despacho->nombreDespacho,
								  	'nombre_fiscal' => $request['nombre_fiscal'],
								  	'nombre_indiciado' => $request['nombre_indiciado'],
								  	'fecha_inicio' => $request['fechaI'],
								  	'hora_inicio' => $request['horaI'],
								  	'fecha_fin' => $request['fechaF'],
								  	'hora_fin' => $request['horaF'],
								  	'sala_id' => $request['sala_id'],
								  	'description' =>$request['description'],	  	
								  	'editable' => true,
								  	'user_id' =>  auth()->user()->id,
								  	'color'	  =>  '#B3DAB3',
								  	'reservado'	  =>  true
								  ]);
								  
								  	
								  	//$sala= ReservaSalaAudiencia::where('id',$reserva->id)->with('Sala')->get();
								  	
								  	$sala = SalaAudiencia::where('id',$reserva->sala_id)->first();
								  	//dd($sala);
								  	
								  	 $reservas=[
								  	'radicacion' => $reserva->radicacion,
								  	'despacho_id' => $reserva->despacho_id,
								  	'correo_despacho' =>$reserva->correo_despacho,
								  	'despacho' => $reserva->despacho,
								  	'nombre_fiscal' => $reserva->nombre_fiscal,
								  	'nombre_indiciado' => $reserva->nombre_indiciado,
								  	'fecha_inicio' => $reserva->fecha_inicio,
								  	'hora_inicio' => $reserva->hora_inicio,
								  	'fecha_fin' => $reserva->fecha_fin,
								  	'hora_fin' => $reserva->hora_fin,
								  	'sala_id' => $reserva->sala_id,
								  	'description' =>$reserva->description,
								  	'sala_nombre'=> $sala->sala_nombre,
								  	
								  ];
								  	
								  	
								  	//dd($reserva[0]->sala);
								   $data=  json_decode(json_encode($reservas), true);
								   
								  // dd($data);
								 // dd( $despacho,$data);
								 if(ltrim( auth()->user()->email) =='correoofjcali@cendoj.ramajudicial.gov.co'){
								   $reparto = 'rsaofjudicialcali@cendoj.ramajudicial.gov.co';
								 }else{
								   $reparto = ltrim( auth()->user()->email);  
								 }
								 
								 $despacho =ltrim($reserva->correo_despacho);;
								 
								 //dd($reparto,$despacho);
								 
								  Mail::send('emails.ReservaSalas',$data, function ($message) use ($reserva,$reparto,$despacho) {
                             
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                                        $message->to($despacho);
                                        $message->cc($reparto);
                                        $message->subject('ASIGNACION SALA PARA AUDIENCIA: '.$reserva->despacho);
                                        });
                    
								  

								return "Reserva realizada correctamente!";
								
						    }
					

					}else{
							return "Esta reservando en espacio que no esta disponible";
						}
			}
		
		
    }

    public function ReservasHoy()
    {
        $eventos = ReservaSalaAudiencia::ReservasHoy();
        //dd($eventos);
         $Ubicaciones = ReservaSalaAudiencia::ubicaciones();
       
        
        //dd(intval($sala),$nombre);
       return view('reservaSalas.ReservasDia',compact('Ubicaciones','eventos')); 
        
    }

    public function publico()
    {
        $eventos = ReservaSalaAudiencia::ReservasHoy();
        //dd($eventos);
       
        
        //dd(intval($sala),$nombre);
       return view('reservaSalas.ReservasPublico',compact('eventos')); 
    }

    public function update(Request $request, ReservaSalaAudiencia $reservaSalaAudiencia)
    {
        //
    }

    public function ReservarSalasEliminar(Request $request)
    {
        
      $reserva = ReservaSalaAudiencia::findOrFail($request->id);
       // auth()->user()->id
      if(ltrim( auth()->user()->email) =='correoofjcali@cendoj.ramajudicial.gov.co'){
			$reparto = 'rsaofjudicialcali@cendoj.ramajudicial.gov.co';
		}else{
			$reparto = ltrim( auth()->user()->email);  
		 }
     // $reparto = ltrim( auth()->user()->email);    //'correoofjcali@cendoj.ramajudicial.gov.co';
	  $despacho =ltrim($reserva->correo_despacho);
       
       $sala = SalaAudiencia::where('id',$reserva->sala_id)->first();
								  	//dd($sala);
	
       
       if( auth()->user()->id == $reserva->user_id){
           
         $reserva=[
					'radicacion' => $reserva->radicacion,
				  	'despacho_id' => $reserva->despacho_id,
				  	'correo_despacho' =>$reserva->correo_despacho,
				  	'despacho' => $reserva->despacho,
				  	'nombre_fiscal' => $reserva->nombre_fiscal,
				  	'nombre_indiciado' => $reserva->nombre_indiciado,
				  	'fecha_inicio' => $reserva->fecha_inicio,
				  	'hora_inicio' => $reserva->hora_inicio,
				  	'fecha_fin' => $reserva->fecha_fin,
				  	'hora_fin' => $reserva->hora_fin,
				  	'sala_id' => $reserva->sala_id,
				  	'description' =>$reserva->description,
				  	'sala_nombre'=> $sala->sala_nombre,
				];
       $data=  json_decode(json_encode($reserva), true);
           
         //dd('hola');  
         $reserva1 = ReservaSalaAudiencia::findOrFail($request->id);
         $reserva1->delete();	 
								 
								 Mail::send('emails.EliminacionReservaSala',$data, function ($message) use ($reserva,$reparto,$despacho) {
                             
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                                        $message->to($despacho);
                                        $message->cc($reparto);
                                        $message->subject('ELIMANACION DE RESERVA DE AUDIENCIA: '.$despacho);
                                        });
                    
       }
       
       //dd($reserva);
    }
}
