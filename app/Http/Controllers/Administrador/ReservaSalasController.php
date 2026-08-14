<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller\Administrador;
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

class ReservaSalasController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

    /**reservas juzgados**/
    public function reservasJuzgados(){
    	$reservas = ReservaSalas::verReservasAdmin();
    	
        
    	return view('administrador.reservasalas.reserva', compact('reservas'));
    }

    public function registrarReserva(){
        $salas    = Sala::salasPisospluck();
        $despacho = Despacho::pluck('nombreDespacho','codigoDespacho');
        $fdia     = Carbon::now();
        $fechaA   = $fdia->format('Y-m-d');
        return view('administrador.reservasalas.modals.createReserva', compact('salas','fechaA','despacho'));
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
            return Redirect::to('administrador/reservas-juzgados');
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
            return Redirect::to('administrador/reservas-juzgados');
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
        return view('administrador.reservasalas.modals.editReserva', compact('reserva','salas','fechaA','despacho'));    	
    } 

    public function reservasUpdate($id, ReservaSalaUpdateRequest $request){
    	
        $otro     = ReservaSalas::where('rs_numero_radicado',$request['rs_numero_radicado'])->get();
        $deel     = ReservaSalas::where('id',$id)->get();
    	$reserva  = ReservaSalas::findOrFail($id);
    		
        $comprobar = count(ReservaSalas::all());
        $verifico = ReservaSalas::pregunto($request['rs_sala'], $request['rs_estado'], $request['rs_fecha'], $request['rs_hora_inicio'], $request['rs_hora_fin']);
        $noguardar = ReservaSalas::verificar($request['rs_fecha'],$request['rs_hora_inicio'], $request['rs_hora_fin'],$request['rs_sala']);
        //dd($noguardar);

        if($otro[0]->rs_fecha ==$request['rs_fecha'] && $otro[0]->rs_hora_inicio == $request['rs_hora_inicio'] && $otro[0]->rs_hora_fin == $request['rs_hora_fin'] && $otro[0]->rs_estado == $request['rs_estado']){
            
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

            Session::flash('message','Reserva agregada exitosamente 1 ');
            return Redirect::to('administrador/reservas-juzgados');
        }

        if($noguardar == null && $verifico[0]->t == 0){
            
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

                 Session::flash('message','Reserva agregada exitosamente 2 ');
            return Redirect::to('administrador/reservas-juzgados');
        }else{
            Session::flash('message','Reserva agregada exitosamente');
            return Redirect::back()->with('message-error', 'Las horas escogidas se encuentran en un rango ocupado!');
        }      

       
    }

    public function reservasDelete($id){
    	
        //dd($comprobar);
        $reserva = ReservaSalas::findOrFail($id);
        $reserva->rs_estado = 'DESHABILITADA';
        $reserva->save();
        Session::flash('message','Reserva deshabilitada');
        return Redirect::to('/administrador/reservas-juzgados');
    }
    /**reservas juzgados**/
}
