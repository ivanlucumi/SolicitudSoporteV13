<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\JornadaSalud;
use App\Models\HoraJornadaSalud;
use App\Models\horariosDias;
use Illuminate\Support\Facades\DB;

class JornadaSaludController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        
        $this->middleware('usuario');
    }
    
    public function index(){
        
        $vacunacion = new JornadaSalud(); 
        $reserva = 0;
        $hora= HoraJornadaSalud::where('cedula',null)->where('odontologia',null)->pluck('hora','hora');
        $horaCitologia = HoraJornadaSalud::where('cedula',null)->where('cita','citologia')->pluck('hora','hora');
        $horaOdontologia = HoraJornadaSalud::where('cedula',null)->where('cita','odontologia')->pluck('hora','hora');
        //dd($horaOdontologia);
        return view('usuario.JornadaSalud.jornadaSalud',compact('vacunacion','horaCitologia','horaOdontologia','reserva','hora'));
        
    }
    
    public function Asignacionhorario(Request $request){
       // dd($request->all());
          $vacunacion = HoraJornadaSalud::where('cita','odontologia')->where('hora',$request->horaOdontologia)->first(); 
         // dd($vacunacion);
         $hora= HoraJornadaSalud::where('cedula',null)->where('odontologia',null)->pluck('hora','hora');
         $sexo=$request->sexo;
         $cedula= $request->cedula;
        if($request->sexo== "HOMBRE"){
            //dd('hola');
            $vacunacion = HoraJornadaSalud::where('cita','odontologia')->where('hora',$request->horaOdontologia)->first(); 
             
            if($vacunacion->cedula == null){
                $vacunacion = HoraJornadaSalud::where('cita','odontologia')->where('hora',$request->horaOdontologia)->first(); 
                $vacunacion= HoraJornadaSalud::findOrFail($vacunacion->id);
                $vacunacion->cedula = $request->cedula;
                $vacunacion->hora = $request->horaOdontologia;
                $vacunacion->save(); 
                
                $reserva = 0;
                $hora= HoraJornadaSalud::where('cedula',null)->where('odontologia',null)->pluck('hora','hora');
                $horaCitologia = HoraJornadaSalud::where('cedula',$cedula)->where('cita','citologia')->first();
                $horaOdontologia = HoraJornadaSalud::where('cedula',$cedula)->where('cita','odontologia')->first();
                
                if(empty($horaCitologia)){
                  $horaCitologia="sin definir";
                }else{
                  $horaCitologia=$horaCitologia->hora;  
                }
                if(empty($horaOdontologia)){
                 $horaOdontologia= "sin definir";  
                }else{
                    $horaOdontologia= $horaOdontologia->hora;  
                }
                
                return view('usuario.JornadaSalud.confirmacion',compact('cedula','horaOdontologia','horaCitologia','hora','sexo'));
            }else{
                $vacunacion = HoraJornadaSalud::where('cita','odontologia')->where('hora',$request->horaOdontologia)->where('cedula',$cedula)->first();
                $salud = JornadaSalud::where('cedula',$cedula)->first();
                
                if($vacunacion != null && $salud == null){
                $horaCitologia = HoraJornadaSalud::where('cedula',$cedula)->where('cita','citologia')->first();
                $horaOdontologia = HoraJornadaSalud::where('cedula',$cedula)->where('cita','odontologia')->first();
                //dd(empty($horaCitologia),empty($horaOdontologia));
                
                
                if(empty($horaCitologia)){
                  $horaCitologia="sin definir";
                }else{
                  $horaCitologia=$horaCitologia->hora;  
                }
                if(empty($horaOdontologia)){
                 $horaOdontologia= "sin definir";  
                }else{
                    $horaOdontologia= $horaOdontologia->hora;  
                }
                
                
                
                
                
                return view('usuario.JornadaSalud.confirmacion',compact('cedula','horaOdontologia','horaCitologia','hora','sexo'));
                }else{
                   Session::flash('error','HORA NO DISPONIBLE!');
                return redirect()->back();  
                }
                
            }
        }
        if($request->sexo== "MUJER"){ //mujer
        
        
        
        if(!empty($request->horaOdontologia)){
           $vacunacionOd = HoraJornadaSalud::where('cita','odontologia')->where('hora',$request->horaOdontologia)->first();
           
           if(empty($vacunacionOd)){
                 
                 $vacunacionO = HoraJornadaSalud::where('cita','odontologia')->where('hora',$request->horaOdontologia)->first(); 
                 $vacunacion= HoraJornadaSalud::findOrFail($vacunacionOd->id);
                 $vacunacion->cedula = $cedula;
                 $vacunacion->save(); 
                
             }
            if($vacunacionOd->cedula =$cedula){
                 //dd('hola2');
                 $vacunacionO = HoraJornadaSalud::where('cita','odontologia')->where('hora',$request->horaOdontologia)->first(); 
                 $vacunacion= HoraJornadaSalud::findOrFail($vacunacionOd->id);
                 $vacunacion->cedula = $cedula;
                 $vacunacion->save(); 
             }
           
        }
        if(!empty($request->horaCitologia)){
           $vacunacionCi = HoraJornadaSalud::where('cita','citologia')->where('hora',$request->horaCitologia)->first();  
           
            if( empty($vacunacionCi)){
                //dd('hola');
                 $vacunacionO1 = HoraJornadaSalud::where('cita','citologia')->where('hora',$request->horaCitologia)->first(); 
                 $vacunacion1= HoraJornadaSalud::findOrFail($vacunacionCi->id);
                 $vacunacion1->cedula = $request->cedula;
                 $vacunacion1->save();
                 
                
             }
              if($vacunacionCi->cedula =$cedula){
                 
                 $vacunacionO1 = HoraJornadaSalud::where('cita','citologia')->where('hora',$request->horaCitologia)->first(); 
                 $vacunacion1= HoraJornadaSalud::findOrFail($vacunacionCi->id);
                 $vacunacion1->cedula = $request->cedula;
                 $vacunacion1->save();
                
                
             }
        }
        
          /*   $vacunacionOd = HoraJornadaSalud::where('cita','odontologia')->where('hora',$request->horaOdontologia)->first(); 
             $vacunacionCi = HoraJornadaSalud::where('cita','citologia')->where('hora',$request->horaCitologia)->first(); 
             
             if(empty($vacunacionOd) && empty($vacunacionCi)){
                 
                 $vacunacionO = HoraJornadaSalud::where('cita','odontologia')->where('hora',$request->horaOdontologia)->first(); 
                 $vacunacion= HoraJornadaSalud::findOrFail($vacunacionOd->id);
                 $vacunacion->cedula = $cedula;
                 $vacunacion->save(); 
                
                 $vacunacionO1 = HoraJornadaSalud::where('cita','citologia')->where('hora',$request->horaCitologia)->first(); 
                 $vacunacion1= HoraJornadaSalud::findOrFail($vacunacionCi->id);
                 $vacunacion1->cedula = $request->cedula;
                 $vacunacion1->save();
                
                
             }
             if($vacunacionOd->cedula =$cedula){
                 
                 $vacunacionO = HoraJornadaSalud::where('cita','odontologia')->where('hora',$request->horaOdontologia)->first(); 
                 $vacunacion= HoraJornadaSalud::findOrFail($vacunacionOd->id);
                 $vacunacion->cedula = $cedula;
                 $vacunacion->save(); 
             }
             
             if($vacunacionCi->cedula =$cedula){
                 
                 $vacunacionO1 = HoraJornadaSalud::where('cita','citologia')->where('hora',$request->horaCitologia)->first(); 
                 $vacunacion1= HoraJornadaSalud::findOrFail($vacunacionCi->id);
                 $vacunacion1->cedula = $request->cedula;
                 $vacunacion1->save();
                
                
             }*/
             
          // dd($vacunacionOd,$vacunacionCi);
                
                $reserva = 0;
                $hora= HoraJornadaSalud::where('cedula',null)->where('odontologia',null)->pluck('hora','hora');
                $horaCitologia = HoraJornadaSalud::where('cedula',$cedula)->where('cita','citologia')->first();
                $horaOdontologia = HoraJornadaSalud::where('cedula',$cedula)->where('cita','odontologia')->first();
                
                if(empty($horaCitologia)){
                  $horaCitologia="sin definir";
                }else{
                  $horaCitologia=$horaCitologia->hora;  
                }
                if(empty($horaOdontologia)){
                 $horaOdontologia= "sin definir";  
                }else{
                    $horaOdontologia= $horaOdontologia->hora;  
                }
                
                return view('usuario.JornadaSalud.confirmacion',compact('cedula','horaOdontologia','horaCitologia','hora','sexo'));
                
                Session::flash('error','HORA NO DISPONIBLE!');
                return redirect()->back(); 
            
        }
    }
    
  
 
     public function saveFormularioSalud(Request $request){
         
         //dd($request->all());
         
         $this->validate($request, [
                    'cedula'=> 'required',
                    //'hora_asistencia'=>'required'
                   /* 'nombres' => 'required',
                    'apellidos' => 'required',
                    'sexo' => 'required',
                    'fecha_nacimiento' => 'required'*/  
                ]);
      
        $vacunacion = new JornadaSalud();
        $vacunacion->cedula = $request->cedula;
        $vacunacion->nombre = $request->nombre;
        $vacunacion->apellido = $request->apellido;
        $vacunacion->correo = $request->correo;
        $vacunacion->celular = $request->telefono;
        $vacunacion->eps = $request->eps;
        $vacunacion->sexo = $request->sexo;
        $vacunacion->odontologia = $request->hora_odontologia;
         if( empty($request->hora_odontologia )){
            if($request->hora_odontologia == "sin definir"){
               $vacunacion->hora_odntologia = NULL; 
            }else{
                $vacunacion->hora_odntologia = $request->hora_odontologia;
            }
         }else{
             $vacunacion->hora_odntologia = NULL;  
         }
        if( empty($request->hora_citologia )){
        if($request->hora_citologia == "sin definir"){
           $vacunacion->hora_citologia = NULL; 
        }else{
            $vacunacion->hora_citologia = $request->hora_citologia;
        }
        }else{
             $vacunacion->hora_citologia = NULL;
        }
        
        $vacunacion->citologia = $request->hora_citologia;
        
        $vacunacion->despacho =  auth()->user()->name ;
        $vacunacion->correo_despacho =  auth()->user()->email ;
        
        $vacunacion->save();
        
       // dd($vacunacion->save());
        
        if($vacunacion->save()){
            //confirmar diligenciado
             if($request->sexo == "HOMBRE"){
               // if( empty($request->hora_odontologia )){
                $horarioCon = HoraJornadaSalud::where('odontologia')->where('hora',$request->hora_odontologia)
                 ->where('cedula',$request->cedula)
                 ->first(); 
                $horarioCon->confirmado="CONFIRMADO";
                $horarioCon->save();
               // }
           // dd('hola');
             }
            
            if($request->sexo == "MUJER"){
             if( empty($request->hora_citologia )){ 
               $horarioConM = HoraJornadaSalud::where('citologia')->where('hora',$request->hora_citologia)
             ->where('cedula',$request->cedula)
             ->first(); 
            $horarioConM->confirmado="CONFIRMADO";
            $horarioConM->save();
             }
            //dd('mujer');
             if( empty($request->hora_odontologia )){
            $horarioCon = HoraJornadaSalud::where('odontologia')->where('hora',$request->hora_odontologia)
             ->where('cedula',$request->cedula)
             ->first();
             //dd($request->hora_odontologia,$horarioCon);
            $horarioCon->confirmado="CONFIRMADO";
            $horarioCon->save();
            }
            }
            //cerrar confiracion
            
            
            $data              =  json_decode(json_encode($vacunacion), true);
            
             Mail::send('emails.ConfirmacionJornadaSalud', $data, function ($message) use ($vacunacion) {
                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                        $message->to( auth()->user()->email);
                        $message->subject('Registro Jornada Salud');
                        
                    });
            
             Session::flash('success', 'Reserva creada con éxito !');
                        return Redirect::to('usuarios/formulario/consultar/jornada/salud');
        }
        
        
         
        
    }


    public function AsignacionOptometria(){
        
        $vacunacion = new JornadaSalud(); 
        $cedula = null;
        $reserva = 0;
        $fecha_1='2022-07-26';
        $fecha_2='2022-07-27';
        $fecha_3='2022-07-28';

        $jornada_1 = horariosDias::where('fecha',$fecha_1)->where('consulta',null)->orderBy('hora', 'ASC')->pluck('hora','hora');
        $jornada_2 = horariosDias::where('fecha',$fecha_2)->where('consulta',null)->orderBy('hora', 'ASC')->pluck('hora','hora');
        $jornada_3 = horariosDias::where('fecha',$fecha_3)->where('consulta',null)->orderBy('hora', 'ASC')->pluck('hora','hora');
       //dd($jornada_1,$jornada_2,$jornada_3);

        return view('usuario.optometria.jornadaSalud',compact('vacunacion','cedula','fecha_1','fecha_2','fecha_3','jornada_1','jornada_2','jornada_3'));
    }

    public function optometria(Request $request){

        //dd($request->all());
        $this->validate($request, [
                    'fecha'=> 'required',
                    'cedula'=>'required'
                   /* 'nombres' => 'required',
                    'apellidos' => 'required',
                    'sexo' => 'required',
                    'fecha_nacimiento' => 'required'*/  
                ]);
      
        
        $fecha=$request->fecha;
        $hora=null;
        $vacio=null;

        if($request->hora_1){
            $hora=$request->hora_1;  
        }
        if($request->hora_2){
            $hora=$request->hora_2;  
        }
        if($request->hora_3){
            $hora=$request->hora_3;  
        }

        $cedula=$request->cedula;

        //dd($fecha,$hora);
        
        $jornada= horariosDias::where('fecha',$fecha)
        ->where('hora',$hora)
        ->where('consulta',null)
        ->get();
       // dd($jornada,'hola');

        foreach($jornada as $jorna){
            
            if(!empty($jorna)){
                //dd('hola');
                $jornada=horariosDias::findOrFail($jorna->id);
                $jornada->consulta = $cedula;
                $jornada->save();
                $vacio="GUARDO";                
            }  
            if($vacio == "GUARDO"){
                break;
            }
        }

        if($vacio != "GUARDO" ){
            Session::flash('error','RESERVA NO DISPONIBLE!');
            return redirect()->back(); 
        }

       // dd( $jornada,$hora,$cedula);
     
            

        return view('usuario.optometria.confirmacion',compact('cedula','fecha','hora'));
        
         
    }

    public function saveOptometria(Request $request){
        
        $this->validate($request, [
                    'fecha'=> 'required',
                    'cedula'=>'required',
                    'hora'=>'required',
                    'nombre' => 'required',
                    'apellido' => 'required',
                    'correo' => 'required',
                    'telefono' => 'required' ,
                    'eps' => 'required',
                    'despacho' => 'required',
                    'email_despacho' => 'required'
                ]);
        //dd($request->all());
        $optometria = new JornadaSalud();
        $optometria->cedula = $request->cedula;
        $optometria->nombre = $request->nombre;
        $optometria->apellido = $request->apellido;
        $optometria->correo = $request->correo;
        $optometria->celular = $request->telefono;
        $optometria->eps = $request->eps;
        $optometria->despacho = $request->despacho;
        $optometria->correo_despacho = $request->email_despacho;
        $optometria->fecha = $request->fecha;
        $optometria->hora = $request->hora;
        $optometria->save();

        Session::flash('success', 'Reserva creada con éxito !');
        return Redirect::to('usuarios/agendamiento/optometria');
    }
    
}
