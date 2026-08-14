<?php

namespace App\Http\Controllers\Reservas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\ReservaSalas;
use App\Models\Torre;
use App\Models\Pisos;
use App\Models\Sala;
use App\Models\Despacho;
use App\Http\Requests\ReservaSalaCreateRequest;
use App\Http\Requests\ReservaSalaUpdateRequest;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;



class ReservasController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('reservas');
    }

    public function reserva(){
    	$reservas = ReservaSalas::verReservasAdmin();
    	//dd($reservas);
    	$sinPublicar = ReservaSalas::verReservasSinPublicar();
    	//dd($sinPublicar);
    	return view('reservas.index', compact('reservas'));
  
    }
    
    public function calendarioReservas(Request $request){
    
    if(!empty($request->all())){
        $sala = Sala::findOrFail($request->rs_sala);
    //dd($sala);
    $salas    = Sala::salasPisospluck();
    $salon=$sala->id;
    $salaN =$sala->s_nombre;
    //dd( $salon,$salaN); 
    }else{
         
    $salas    = Sala::salasPisospluck();
    $salon=101;
    $salaN = "SALA 1";
    //dd( $salon,$salaN);
    }
   
    $reserva = 'true';
    $asignaturas = null;
    return view('reservas.fullcalendar.calendario',compact('salon','reserva','asignaturas','salas','salaN')); 
    }
    
    public function reservaSinPublicar(){
    	$reservas = ReservaSalas::verReservasSinPublicar();
    //	dd($reservas);
    	return view('reservas.sin_publicar', compact('reservas'));
    }
    
    public function reservaPublicada(){
    	$reservas = ReservaSalas::verReservasPublicadas();
    //	dd($reservas);
    	return view('reservas.reservas_publicadas', compact('reservas'));
    }

    public function registrarReserva(Request $request){
        $salas    = Sala::salasPisospluck();
        $despacho = Despacho::pluck('nombreDespacho','codigoDespacho');
        $fdia     = Carbon::now();
        $fechaA   = $fdia->format('Y-m-d');
        return view('reservas.modals.createReserva', compact('salas','fechaA','despacho'));
    }

    public function reservasStore(ReservaSalaCreateRequest $request){
        
        $comprobar = count(ReservaSalas::all());
        $verifico = ReservaSalas::pregunto($request['rs_sala'], $request['rs_estado'], $request['rs_fecha'], $request['rs_hora_inicio'], $request['rs_hora_fin']);
        $noguardar = ReservaSalas::verificar($request['rs_fecha'],$request['rs_hora_inicio'], $request['rs_hora_fin'],$request['rs_sala']);
        //dd($noguardar);
        if($comprobar == 0){
            $evento = ReservaSalas::create([
                'rs_sala'              => $request['rs_sala'],
                'rs_numero_radicado'   => $request['rs_numero_radicado'],
                'rs_nombre_fiscal'     => strtoupper($request['rs_nombre_fiscal']),
                'rs_nombre_indiciado'  => strtoupper($request['rs_nombre_indiciado']),
                'rs_fecha'             => $request['rs_fecha'],
                'rs_hora_inicio'       => $request['rs_hora_inicio'],
                'rs_hora_fin'          => $request['rs_hora_fin'],
                'rs_estado'            => $request['rs_estado'],
                'rs_codigo_juzgado'    => $request['rs_codigo_juzgado'],
                'rs_creador'           =>  auth()->user()->name,            
            ]);
            Session::flash('message','Reserva agregada exitosamente 1');
            return Redirect::to('reservas');
        }else if($noguardar == null && $verifico[0]->t == 0 && $noguardar == null){
            $evento = ReservaSalas::create([
                'rs_sala'              => $request['rs_sala'],
                'rs_numero_radicado'   => $request['rs_numero_radicado'],
                'rs_nombre_fiscal'     => strtoupper($request['rs_nombre_fiscal']),
                'rs_nombre_indiciado'  => strtoupper($request['rs_nombre_indiciado']),
                'rs_fecha'             => $request['rs_fecha'],
                'rs_hora_inicio'       => $request['rs_hora_inicio'],
                'rs_hora_fin'          => $request['rs_hora_fin'],
                'rs_estado'            => $request['rs_estado'],
                'rs_codigo_juzgado'    => $request['rs_codigo_juzgado'],                
                'rs_creador'           =>  auth()->user()->name,            
            ]);

            Session::flash('message','Reserva agregada exitosamente 2 ');
            return Redirect::back();
        }else{
            Session::flash('message','Reserva agregada exitosamente');
            return Redirect::back()->with('message-error', 'Las horas escogidas se encuentran en un rango ocupado!');
        }  
            
    }

    public function reservasEdit($id, Request $request){
    	$reserva  = ReservaSalas::findOrFail($id);
        $salas    = Sala::salasPisospluck();
        $despacho = Despacho::pluck('nombreDespacho','codigoDespacho');
        $fdia     = Carbon::now();
        $fechaA   = $fdia->format('Y-m-d');
        return view('reservas.modals.editReserva', compact('reserva','salas','fechaA','despacho'));    	
    } 

    public function reservasUpdate($id, ReservaSalaUpdateRequest $request){
    	
        $otro     = ReservaSalas::where('rs_numero_radicado',$request['rs_numero_radicado'])->get();
        
        
        $deel     = ReservaSalas::where('id',$id)->get();
        
    	$reserva  = ReservaSalas::findOrFail($id);
    		
        $comprobar = count(ReservaSalas::all());
        
        $verifico = ReservaSalas::pregunto($request['rs_sala'], $request['rs_estado'], $request['rs_fecha'], $request['rs_hora_inicio'], $request['rs_hora_fin']);
        
        $noguardar = ReservaSalas::verificar($request['rs_fecha'],$request['rs_hora_inicio'], $request['rs_hora_fin'],$request['rs_sala']);
        
        //dd($otro,$deel,$reserva, $noguardar, $verifico);

       // if($otro[0]->rs_fecha ==$request['rs_fecha'] && $otro[0]->rs_hora_inicio == $request['rs_hora_inicio'] && $otro[0]->rs_hora_fin == $request['rs_hora_fin'] && $otro[0]->rs_estado == $request['rs_estado']){
            
            $reserva->rs_sala              =  $request['rs_sala'];
            $reserva->rs_numero_radicado   =  $request['rs_numero_radicado'];
            $reserva->rs_nombre_fiscal     =  strtoupper($request['rs_nombre_fiscal']);
            $reserva->rs_nombre_indiciado  =  strtoupper($request['rs_nombre_indiciado']);
            $reserva->rs_fecha             =  $request['rs_fecha'];
            $reserva->rs_hora_inicio       =  $request['rs_hora_inicio'];
            $reserva->rs_hora_fin          =  $request['rs_hora_fin'];
            $reserva->rs_estado            =  "ACTIVO";
            $reserva->rs_codigo_juzgado    =  $request['rs_codigo_juzgado'];
            $reserva->rs_modificador       =   auth()->user()->name;           
            $reserva->save();

            Session::flash('message','Reserva agregada exitosamente ');
            return Redirect::to('/reservas/sin_publicar');
       // }

       /* //if($noguardar != null && $verifico[0]->t != 0){
           
            
                $reserva->rs_sala              =  $request['rs_sala'];
                $reserva->rs_numero_radicado   =  $request['rs_numero_radicado'];
                $reserva->rs_nombre_fiscal     =  strtoupper($request['rs_nombre_fiscal']);
                $reserva->rs_nombre_indiciado  =  strtoupper($request['rs_nombre_indiciado']);
                $reserva->rs_fecha             =  $request['rs_fecha'];
                $reserva->rs_hora_inicio       =  $request['rs_hora_inicio'];
                $reserva->rs_hora_fin          =  $request['rs_hora_fin'];
                $reserva->rs_estado            =  $request['rs_estado'];
                $reserva->rs_codigo_juzgado    =  $request['rs_codigo_juzgado'];
                $reserva->rs_modificador       =   auth()->user()->name;           
                $reserva->save();
                
            dd( $noguardar, $verifico);
            
                 Session::flash('message','Reserva agregada exitosamente 2 ');
            return Redirect::back();*/
       /* }else{
            Session::flash('message','Reserva agregada exitosamente');
            return Redirect::back()->with('message-error', 'Las horas escogidas se encuentran en un rango ocupado!');
        }  */   

       
    }

    public function reservasDelete($id){
    	
        //dd($comprobar);
        $reserva = ReservaSalas::findOrFail($id);
        $reserva->rs_estado = 'DESHABILITADA';
        $reserva->save();
        Session::flash('message','Reserva deshabilitada');
        return Redirect::to('/reservas');
    }
    /**reservas juzgados**/
    
    public function agendar(Request $request){
        
    }
    
    public function borrar(Request $request){
        
    }
    
    public function getevents($sala)
	
	{
			
	     $data = ReservaSalas::reservasSalas($sala);
	    // dd($data);
	     return response()->json($data);
	}
}
