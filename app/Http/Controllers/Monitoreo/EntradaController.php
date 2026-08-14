<?php

namespace App\Http\Controllers\Monitoreo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Carbon;

use App\Models\ControlIngreso;
use App\Models\Vehiculo;
use App\Models\User;
use App\Models\Despacho;
use App\Models\Persona;
use App\Models\ContratoActivo;
use App\Models\RestriccionLaboral;
use Illuminate\Support\Facades\DB;

class EntradaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('ingresoporteria');
    }
    
    
       public function index()
    {
        
        $fechaA = Carbon::now()->toDateString();
        
        $ingresos = ControlIngreso::where('fecha_ingreso','>=',$fechaA)
        //->where('vehiculo_autorizado','!=',"AUTORIZADO")
        //->where('ingreso',null)
        //->where('salida',null)
        ->get();
        
        //dd($ingresos);
        $torres = ControlIngreso::torre();
        $pisos = ControlIngreso::piso();
        
        $contarUsuario = ControlIngreso::where('salida',null)
        ->where('ingreso','!=',null)
        ->where('fecha_ingreso',$fechaA)
        ->distinct('identificacion')
        ->count('identificacion');
        
        //dd($contarUsuario,$torres,$pisos);
        return view('monitoreo.ingreso.index',compact('ingresos','contarUsuario','torres','pisos'));
    }

    public function registrarVisitante(Request $request){
        dd('hola');
    }
     public function registrarVisitanteStore(Request $request){
        //dd($request->all());
         $fechaA = Carbon::now()->toDateString();
         $numdia = Carbon::now();
         
         //hora actual menos 30 min
         $horaIngreso = Carbon::now()->totimeString();

            $visita = new ControlIngreso();

            $visita->identificacion = $request['identificacion'];
            $visita->fullname = strtoupper($request['fullname']);
            $visita->sexo = $request['sexo'];
            $visita->fecha_nacimiento = $request['fecha_nacimiento'];
            $visita->tipo_sangre = $request['tipo_sangre'];
            $visita->torre = $request['torre'];
            $visita->piso = $request['piso'];
            $visita->hora_ingreso = $horaIngreso;
            $visita->ingreso =  auth()->user()->name.' a las '.$horaIngreso;
            $visita->fecha_ingreso = $fechaA ;
            $visita->save();
            return redirect()->back();

     }
    
    
    public function enviarsectionajax(){
        $view = View::make('monitoreo.parqueadero',compact('comprobanteEntregas','estados','contador','consecutivo'));
		if($request->ajax())
        {

			$sections = $view->renderSections();
            return Response::json($sections['content']); 
        }else return $view;
    
    }
    
    public function registrarIngreso(Request $request, $id){
        dd($id);
        
        $restriccion = RestriccionLaboral::where('cedula',$id)
         ->where('orientacion_para_seccional','TRABAJO EN CASA')
         ->select('orientacion_para_seccional','cedula','nombre')
         ->first();
         
         //dd($restriccion);
         
         if(!empty($restriccion)){
             //dd('hola');
             $restric []= array("Restriccion" => $restriccion->orientacion_para_seccional,
                                    "cedula"=>$restriccion->cedula,
                                    "nombre"=>$restriccion->nombre,
                                    "impedimento"=>"rest");
            
            
            //dd($restric);
            
                if($request->ajax())
                    {                    
                    return response()->json($restric);
                    }
                 exit();   
                
         }
        
        $hora = Carbon::now()->totimeString();
        
        if($request->ajax())
        {
            
            $control = ControlIngreso::find($id);
            
            if($control->ingreso === null){
                 $control->ingreso =  auth()->user()->name.' a las '.$hora;
                 $control->save(); 
            }else{
                $control->salida = NULL;
                 $control->save(); 
            }
        }
        
    }
    
    public function verificaringresoF(Request $request, $id){
        
        //dd($id);
        
        $id = intval($id);
        $array = array();
        
         $solicitudeUsuario = null;
        $results = array();
        $regIngreso = false;
        
         $fechaA = Carbon::now()->toDateString();
         $numdia = Carbon::now();
         
         //hora actual menos 30 min
         $hora = Carbon::now()->totimeString();
         $horaA = Carbon::now()->subMinutes(10); 
         $horaMenos30 = $horaA->totimeString();

         //hora actual mas 10 mmin
         $horaM = Carbon::now()->totimeString();
         $horaM = Carbon::now()->addMinutes(10); 
         $horaM10 = $horaM->totimeString();
         
         
         //consulta de contrato activo
         $empleado = ContratoActivo::where('cedula',$id)
         //->select('cedula')
         ->first();
         
         $visitante = ControlIngreso::where('identificacion',$id)
            ->where('fecha_ingreso',$fechaA)
            ->get();
            
            //dd($visitante,$empleado);
            
         $restriccion = RestriccionLaboral::where('cedula',$id)
         ->where('orientacion_para_seccional','TRABAJO EN CASA')
         ->select('orientacion_para_seccional','cedula','nombre')
         ->first();
         
         //dd($restriccion,$empleado,$visitante);
         
         if(!empty($restriccion)){
             //dd('hola');
             $restric []= array("Restriccion" => $restriccion->orientacion_para_seccional,
                                    "cedula"=>$restriccion->cedula,
                                    "nombre"=>$restriccion->nombre,
                                    "impedimento"=>"rest");
            
            
            //dd($restric);
            
                if($request->ajax())
                    {                    
                    return response()->json($restric);
                    }
                 exit();   
                
         }else{
            
         
         //dd($visitante,$empleado );
         
         
         //salir si no se encuentra resultado
            if(empty($visitante->all())  && empty($empleado)){
                $ingreso = null;
                //dd('entro');
                if($request->ajax())
                    {                    
                    return response()->json($ingreso);
                    }
            }
           // dd(!empty($empleado));
            
            //dd($visitante->identificacion);
            
            if(!empty($visitante) ){
                $ingresoV = true;
            }else{
               $ingresoV = false; 
            }
            
             if(!empty($empleado)){
                $ingresoE = true;
            }else{
               $ingresoE = false; 
            }
            
           // dd($visitante,$empleado,$ingresoE, $ingresoV);
            
            
            
            if($ingresoV == true && $ingresoE == true){
                
                //dd('hola');
                
               $despacho = User::where('cedula',$empleado->despacho_id)
                ->select('name','id')
                ->first();
                
                if($despacho == null){
                    $despaNull="Sin definir";
                }else{
                    $despaNull=$despacho->name;
                }
                
            // dd($empleado->despacho_id);
                   $array []= array("identificacion" => $empleado->cedula,
                                 "nombre"=>$empleado->nombre.' '.$empleado->apellidos,
                                 "despacho"=>$despaNull);
                    
                    //registrar ingreso
                    $ingreso = ControlIngreso::updateOrCreate(
                    ['identificacion'=>$empleado->cedula,'fecha_ingreso'=>$fechaA],
                    [//'fullname'=>$empleado->nombre.' '.$empleado->apellidos,
                    //'fecha_ingreso'=>$fechaA,
                    'hora_ingreso'=>Carbon::now(),
                    'ingreso'=> auth()->user()->name.' a las '.$hora,
                    //'despacho'=>$despacho->name,
                    //"quien_solicito"=>$despaNull,
                    //"tipo_solicitud"=>"EMPLEADO",
                    "hora_salida"=>null,
                    "salida"=>null,
                    ]);
                
                if($request->ajax())
                    {                    
                    return response()->json($array);
                    } 
            }
            
            
            
            
            if($ingresoV == true && $ingresoE == false ){
                
                //dd('ingreso vis');
                
                if(count($visitante)>1){
                   //dd(count($visitante));
                   if($visitante[0]->hora_ingreso > $visitante[1]->hora_ingreso){
                       //hora actual menos 30 min
                         $hora = Carbon::now()->totimeString();
                         $horaA = Carbon::parse($visitante[0]->hora_ingreso)->subMinutes(20); 
                         $horaMenos20 = $horaA->totimeString();
                         
                         //dd($horaMenos30);
                
                         //hora actual mas 10 mmin
                         //$horaM = Carbon::now()->totimeString();
                         $horaM = Carbon::parse($visitante[0]->hora_ingreso)->addMinutes(10); 
                         $horaM10 = $horaM->totimeString();
                        
                        if($visitante[0]->tipo_solicitud == 'VISITANTE'){
                                //dd($solicitudeUsuario);
                                dd('ingreso vis1',$hora);
                                if($hora >= $horaMenos20
                                &&  $hora<= $horaM10){
                                    dd($visitante);
                                    $array []= array("identificacion" => $visitante[0]->identificacion,
                                         "nombre"=>$visitante[0]->fullname,
                                         "despacho"=>$visitante[0]->despacho,
                                         "tipo_solicitud"=>$visitante[0]->tipo_solicitud,
                                         "hora_ingreso"=>$visitante[0]->hora_ingreso);
                                         
                                         //ALMACENA EL INGRESO
                                          $ingreso = ControlIngreso::updateOrCreate(
                                            ['identificacion'=>$empleado->cedula,'fecha_ingreso'=>$fechaA],
                                            [//'fullname'=>$empleado->nombre.' '.$empleado->apellidos,
                                            //'fecha_ingreso'=>$fechaA,
                                            'hora_ingreso'=>Carbon::now(),
                                            'ingreso'=> auth()->user()->name.' a las '.$hora,
                                            //'despacho'=>$despacho->name,
                                            //"quien_solicito"=>$despaNull,
                                            //"tipo_solicitud"=>"EMPLEADO",
                                            "hora_salida"=>null,
                                            "salida"=>null,
                                            ]);
                                }else{
                                    //dd('ingreso vis2');
                                     $array []= array("identificacion" => $visitante[0]->identificacion,
                                         "nombre"=>$visitante[0]->fullname,
                                         "despacho"=>$visitante[0]->despacho,
                                         "tipo_solicitud"=>$visitante[0]->tipo_solicitud,
                                         "hora"=>$visitante[0]->hora_ingreso,
                                         "hora_ingreso"=>0);
                                         
                                         //ALMACENA EL INGRESO
                                         /* $ingreso = ControlIngreso::updateOrCreate(
                                            ['identificacion'=>$visitante[0]->identificacion,'fecha_ingreso'=>$fechaA],
                                            [//'fullname'=>$empleado->nombre.' '.$empleado->apellidos,
                                            //'fecha_ingreso'=>$fechaA,
                                            'hora_ingreso'=>Carbon::now(),
                                            'ingreso'=> auth()->user()->name.' a las '.$hora,
                                            //'despacho'=>$despacho->name,
                                            //"quien_solicito"=>$despaNull,
                                            //"tipo_solicitud"=>"EMPLEADO",
                                            "hora_salida"=>null,
                                            "salida"=>null,
                                            ]);*/
                                }
                                
                        }else{
                            //dd('noes visitante');
                            $array []= array("identificacion" => $visitante[0]->identificacion,
                                         "nombre"=>$visitante[0]->fullname,
                                         "despacho"=>$visitante[0]->despacho,
                                         "tipo_solicitud"=>$visitante[0]->tipo_solicitud,
                                         "hora"=>$visitante[0]->hora_ingreso,
                                         "hora_ingreso"=>0);
                                         
                                         //ALMACENA EL INGRESO
                                          $ingreso = ControlIngreso::updateOrCreate(
                                            ['identificacion'=>$visitante[0]->identificacion,'fecha_ingreso'=>$fechaA],
                                            [//'fullname'=>$empleado->nombre.' '.$empleado->apellidos,
                                            //'fecha_ingreso'=>$fechaA,
                                            'hora_ingreso'=>Carbon::now(),
                                            'ingreso'=> auth()->user()->name.' a las '.$hora,
                                            //'despacho'=>$despacho->name,
                                            //"quien_solicito"=>$despaNull,
                                            //"tipo_solicitud"=>"EMPLEADO",
                                            "hora_salida"=>null,
                                            "salida"=>null,
                                            ]);
                            
                        }
                        
                        
                        
                         
                        
                        if($request->ajax())
                            {                    
                            return response()->json($array);
                            }
                   }else{
                       //hora actual menos 30 min
                         $hora = Carbon::now()->totimeString();
                         $horaA = Carbon::parse($visitante[0]->hora_ingreso)->subMinutes(20); 
                         $horaMenos20 = $horaA->totimeString();
                         
                         //dd($horaMenos30);
                
                         //hora actual mas 10 mmin
                         //$horaM = Carbon::now()->totimeString();
                         $horaM = Carbon::parse($visitante[0]->hora_ingreso)->addMinutes(10); 
                         $horaM10 = $horaM->totimeString();
                        
                        if($visitante[0]->tipo_solicitud == 'VISITANTE'){
                                //dd($solicitudeUsuario);
                                dd('ingreso vis1',$hora);
                                if($hora >= $horaMenos20
                                &&  $hora<= $horaM10){
                                    dd($visitante);
                                    $array []= array("identificacion" => $visitante[0]->identificacion,
                                         "nombre"=>$visitante[0]->fullname,
                                         "despacho"=>$visitante[0]->despacho,
                                         "tipo_solicitud"=>$visitante[0]->tipo_solicitud,
                                         "hora_ingreso"=>$visitante[0]->hora_ingreso);
                                         
                                         //ALMACENA EL INGRESO
                                          $ingreso = ControlIngreso::updateOrCreate(
                                            ['identificacion'=>$empleado->cedula,'fecha_ingreso'=>$fechaA],
                                            [//'fullname'=>$empleado->nombre.' '.$empleado->apellidos,
                                            //'fecha_ingreso'=>$fechaA,
                                            'hora_ingreso'=>Carbon::now(),
                                            'ingreso'=> auth()->user()->name.' a las '.$hora,
                                            //'despacho'=>$despacho->name,
                                            //"quien_solicito"=>$despaNull,
                                            //"tipo_solicitud"=>"EMPLEADO",
                                            "hora_salida"=>null,
                                            "salida"=>null,
                                            ]);
                                }else{
                                    //dd('ingreso vis2');
                                     $array []= array("identificacion" => $visitante[0]->identificacion,
                                         "nombre"=>$visitante[0]->fullname,
                                         "despacho"=>$visitante[0]->despacho,
                                         "tipo_solicitud"=>$visitante[0]->tipo_solicitud,
                                         "hora"=>$visitante[0]->hora_ingreso,
                                         "hora_ingreso"=>0);
                                         
                                         //ALMACENA EL INGRESO
                                         /* $ingreso = ControlIngreso::updateOrCreate(
                                            ['identificacion'=>$visitante[0]->identificacion,'fecha_ingreso'=>$fechaA],
                                            [//'fullname'=>$empleado->nombre.' '.$empleado->apellidos,
                                            //'fecha_ingreso'=>$fechaA,
                                            'hora_ingreso'=>Carbon::now(),
                                            'ingreso'=> auth()->user()->name.' a las '.$hora,
                                            //'despacho'=>$despacho->name,
                                            //"quien_solicito"=>$despaNull,
                                            //"tipo_solicitud"=>"EMPLEADO",
                                            "hora_salida"=>null,
                                            "salida"=>null,
                                            ]);*/
                                }
                                
                        }else{
                            //dd('noes visitante');
                            $array []= array("identificacion" => $visitante[0]->identificacion,
                                         "nombre"=>$visitante[0]->fullname,
                                         "despacho"=>$visitante[0]->despacho,
                                         "tipo_solicitud"=>$visitante[0]->tipo_solicitud,
                                         "hora"=>$visitante[0]->hora_ingreso,
                                         "hora_ingreso"=>0);
                                         
                                         //ALMACENA EL INGRESO
                                          $ingreso = ControlIngreso::updateOrCreate(
                                            ['identificacion'=>$visitante[0]->identificacion,'fecha_ingreso'=>$fechaA],
                                            [//'fullname'=>$empleado->nombre.' '.$empleado->apellidos,
                                            //'fecha_ingreso'=>$fechaA,
                                            'hora_ingreso'=>Carbon::now(),
                                            'ingreso'=> auth()->user()->name.' a las '.$hora,
                                            //'despacho'=>$despacho->name,
                                            //"quien_solicito"=>$despaNull,
                                            //"tipo_solicitud"=>"EMPLEADO",
                                            "hora_salida"=>null,
                                            "salida"=>null,
                                            ]);
                            
                        }
                        
                        
                        
                         
                        
                        if($request->ajax())
                            {                    
                            return response()->json($array);
                            }
                   }
                }else{
                
                        //hora actual menos 30 min
                         $hora = Carbon::now()->totimeString();
                         $horaA = Carbon::parse($visitante[0]->hora_ingreso)->subMinutes(20); 
                         $horaMenos20 = $horaA->totimeString();
                         
                         //dd($horaMenos30);
                
                         //hora actual mas 10 mmin
                         //$horaM = Carbon::now()->totimeString();
                         $horaM = Carbon::parse($visitante[0]->hora_ingreso)->addMinutes(10); 
                         $horaM10 = $horaM->totimeString();
                        
                        if($visitante[0]->tipo_solicitud == 'VISITANTE'){
                                //dd($solicitudeUsuario);
                                dd('ingreso vis1',$hora);
                                if($hora >= $horaMenos20
                                &&  $hora<= $horaM10){
                                    dd($visitante);
                                    $array []= array("identificacion" => $visitante[0]->identificacion,
                                         "nombre"=>$visitante[0]->fullname,
                                         "despacho"=>$visitante[0]->despacho,
                                         "tipo_solicitud"=>$visitante[0]->tipo_solicitud,
                                         "hora_ingreso"=>$visitante[0]->hora_ingreso);
                                         
                                         //ALMACENA EL INGRESO
                                          $ingreso = ControlIngreso::updateOrCreate(
                                            ['identificacion'=>$empleado->cedula,'fecha_ingreso'=>$fechaA],
                                            [//'fullname'=>$empleado->nombre.' '.$empleado->apellidos,
                                            //'fecha_ingreso'=>$fechaA,
                                            'hora_ingreso'=>Carbon::now(),
                                            'ingreso'=> auth()->user()->name.' a las '.$hora,
                                            //'despacho'=>$despacho->name,
                                            //"quien_solicito"=>$despaNull,
                                            //"tipo_solicitud"=>"EMPLEADO",
                                            "hora_salida"=>null,
                                            "salida"=>null,
                                            ]);
                                }else{
                                    //dd('ingreso vis2');
                                     $array []= array("identificacion" => $visitante[0]->identificacion,
                                         "nombre"=>$visitante[0]->fullname,
                                         "despacho"=>$visitante[0]->despacho,
                                         "tipo_solicitud"=>$visitante[0]->tipo_solicitud,
                                         "hora"=>$visitante[0]->hora_ingreso,
                                         "hora_ingreso"=>0);
                                         
                                         //ALMACENA EL INGRESO
                                         /* $ingreso = ControlIngreso::updateOrCreate(
                                            ['identificacion'=>$visitante[0]->identificacion,'fecha_ingreso'=>$fechaA],
                                            [//'fullname'=>$empleado->nombre.' '.$empleado->apellidos,
                                            //'fecha_ingreso'=>$fechaA,
                                            'hora_ingreso'=>Carbon::now(),
                                            'ingreso'=> auth()->user()->name.' a las '.$hora,
                                            //'despacho'=>$despacho->name,
                                            //"quien_solicito"=>$despaNull,
                                            //"tipo_solicitud"=>"EMPLEADO",
                                            "hora_salida"=>null,
                                            "salida"=>null,
                                            ]);*/
                                }
                                
                        }else{
                            //dd('noes visitante');
                            $array []= array("identificacion" => $visitante[0]->identificacion,
                                         "nombre"=>$visitante[0]->fullname,
                                         "despacho"=>$visitante[0]->despacho,
                                         "tipo_solicitud"=>$visitante[0]->tipo_solicitud,
                                         "hora"=>$visitante[0]->hora_ingreso,
                                         "hora_ingreso"=>0);
                                         
                                         //ALMACENA EL INGRESO
                                          $ingreso = ControlIngreso::updateOrCreate(
                                            ['identificacion'=>$visitante[0]->identificacion,'fecha_ingreso'=>$fechaA],
                                            [//'fullname'=>$empleado->nombre.' '.$empleado->apellidos,
                                            //'fecha_ingreso'=>$fechaA,
                                            'hora_ingreso'=>Carbon::now(),
                                            'ingreso'=> auth()->user()->name.' a las '.$hora,
                                            //'despacho'=>$despacho->name,
                                            //"quien_solicito"=>$despaNull,
                                            //"tipo_solicitud"=>"EMPLEADO",
                                            "hora_salida"=>null,
                                            "salida"=>null,
                                            ]);
                            
                        }
                        
                        
                        
                         
                        
                        if($request->ajax())
                            {                    
                            return response()->json($array);
                            }
                }
                
                //cierre de if
                }
                
                
            
            if($ingresoV == false && $ingresoE == true ){
                //dd('hola');
                $despacho = User::where('cedula',$empleado->despacho_id)
                ->select('name','id')
                ->first();
                
                if($numdia->dayOfWeek != 0 && $numdia->dayOfWeek != 6){
                   $array []= array("identificacion" => $empleado->cedula,
                                 "nombre"=>$empleado->nombre.' '.$empleado->apellidos,
                                 "despacho"=>$despacho->name);
                    
                    //registrar ingreso
                    $ingreso = ControlIngreso::updateOrCreate(
                    ['identificacion'=>$empleado->cedula,'fecha_ingreso'=>$fechaA],
                    ['fullname'=>$empleado->nombre.' '.$empleado->apellidos,
                    'fecha_ingreso'=>$fechaA,
                    'hora_ingreso'=>$hora,
                    'ingreso'=>$hora,
                    'despacho'=>$despacho->name,
                    "quien_solicito"=>$despacho->id,
                    "tipo_solicitud"=>"EMPLEADO"
                    ]);
                    
                }else{
                    $array []= array("identificacion" => $empleado->cedula,
                                 "nombre"=>$empleado->nombre.' '.$empleado->apellidos,
                                 "despacho"=>$despacho->name,
                                 "ingreso_actual"=>0);  
                    
                }
                
                 
                
                if($request->ajax())
                    {                    
                    return response()->json($array);
                    } 
            }
      }    
    }

    public function verificaringreso(Request $request, $id){ 
            //dd($id);
        $solicitudeUsuario = null;
        $results = array();
        
         $fechaA = Carbon::now()->toDateString();
         //hora actual menos 30 min
         $hora = Carbon::now()->totimeString();
         $horaA = Carbon::now()->subMinutes(20); 
         $horaMenos30 = $horaA->totimeString();

         //hora actual mas 10 mmin
         $horaM = Carbon::now()->totimeString();
         $horaM = Carbon::now()->addMinutes(10); 
         $horaM10 = $horaM->totimeString();
         
         //dd($hora);
         $UsuarioHoras = ControlIngreso::where('identificacion',$id)
            ->where('fecha_ingreso',$fechaA)
            ->get(); 
//dd($UsuarioHoras);
         //salir si no se encuentra resultado
            if($UsuarioHoras == null){
                $solicitudeUsuario = null;
                if($request->ajax())
                    {                    
                    return response()->json($solicitudeUsuario);
                    }
            }
            

            foreach ($UsuarioHoras as $solicitudeUsuario1) {
                
                        if($solicitudeUsuario1->tipo_solicitud == 'EMPLEADO'){
                            $control = ControlIngreso::find($solicitudeUsuario1->id);
            
                             if($control->ingreso != null){
                                    $control->salida = NULL;
                                     $control->hora_salida = NULL;
                                    $control->save(); 
                              }
                            //dd($solicitudeUsuario1->vehiculo_autorizado);
                            if($solicitudeUsuario1->vehiculo_autorizado === "AUTORIZADO"){
                                        
                                    $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo); 
                                    //dd($vehiculoIng );
                                    }else{
                                    $vehiculoIng = null; 
                                    }
                                    
                                            
                                    array_push($results,$solicitudeUsuario1);
                                    array_push($results, $vehiculoIng);
                                    
                                    
                                
                                    $solicitudeUsuario =$results;
                                //dd($solicitudeUsuario,'entro');
                                    if($request->ajax())
                                        { 
                                        
                                        return response()->json($solicitudeUsuario);
                                        } 
                                                    
                            

                        }
                        

                    }
                    //PROVEEDOR
                    foreach ($UsuarioHoras as $solicitudeUsuario) {
                        if($solicitudeUsuario->tipo_solicitud == 'PROVEEDOR'){
                            //dd($solicitudeUsuario);
                            if($solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/$horaMenos30/*$horaMenos30*/
                            && $solicitudeUsuario->hora_ingreso <= $horaM10){
                                
                                 $control = ControlIngreso::find($solicitudeUsuario->id);
            
                                            if($control->ingreso === null){
                                                 $control->ingreso =  auth()->user()->name.' a las '.$hora;
                                                 $control->save(); 
                                            }

                                //dd($solicitudeUsuario);
                                if($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO"){
                                    $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                                    //dd($vehiculoIng);  
                                    }else{
                                        $vehiculoIng = null; 
                                        }
                                        array_push($results,$solicitudeUsuario);
                                        array_push($results, $vehiculoIng);
                                        
                                        $solicitudeUsuario =$results;
                                //dd($solicitudeUsuario);
                                        if($request->ajax())
                                            {
                                                
                                            
                                            return response()->json($solicitudeUsuario);
                                            }
                            }

                                    }
            
               }

                            //visitante
                    foreach ($UsuarioHoras as $solicitudeUsuario) {
                        
                        
                                if($solicitudeUsuario->tipo_solicitud == 'VISITANTE'){
                        //dd($solicitudeUsuario);
                        if($solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/$horaMenos30/*$horaMenos30*/
                        && $solicitudeUsuario->hora_ingreso <= $horaM10){
                            
                            //dd('hola');
                            
                             $control = ControlIngreso::find($solicitudeUsuario->id);
            
                                            if($control->ingreso === null){
                                                 $control->ingreso =  auth()->user()->name.' a las '.$hora;
                                                 $control->salida = NULL;
                                                 $control->save(); 
                                            }
                                            
                                            if($control->ingreso != null){
                                                 $control->salida = NULL;
                                                 $control->hora_salida = NULL;
                                                 $control->save(); 
                                            }

                            //dd($solicitudeUsuario);
                            if($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO"){
                                $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                                //dd($vehiculoIng);  
                                }else{
                                    $vehiculoIng = null; 
                                    }
                                    
                                    array_push($results,$solicitudeUsuario);
                                    array_push($results, $vehiculoIng);
                                    
                                    $solicitudeUsuario =$results;
                            //dd($solicitudeUsuario);
                                    if($request->ajax())
                                        {
                                           
                                        
                                        return response()->json($solicitudeUsuario);
                                        }
                        }

                                }
                    
                       }
     
      

    }

    

    //CoordVerificarIngreso
    public function CoordVerificarIngreso(Request $request, $id){ 
        //dd($id);
        $solicitudeUsuario = null;
        $results = array();
        
         $fechaA = Carbon::now()->toDateString();
         //hora actual menos 30 min
         $hora = Carbon::now()->totimeString();
         $horaA = Carbon::now()->subMinutes(10); 
         $horaMenos30 = $horaA->totimeString();

         //hora actual mas 10 mmin
         $horaM = Carbon::now()->totimeString();
         $horaM = Carbon::now()->addMinutes(10); 
         $horaM10 = $horaM->totimeString();
         
         //dd($hora);
         $UsuarioHoras = ControlIngreso::where('identificacion',$id)
            ->where('fecha_ingreso',$fechaA)
            ->get(); 
//dd($UsuarioHoras);
         //salir si no se encuentra resultado
            if($UsuarioHoras == null){
                $solicitudeUsuario = null;
                if($request->ajax())
                    {                    
                    return response()->json($solicitudeUsuario);
                    }
            }
            

            foreach ($UsuarioHoras as $solicitudeUsuario1) {
                
                        if($solicitudeUsuario1->tipo_solicitud == 'EMPLEADO'){

                            //dd($solicitudeUsuario1->vehiculo_autorizado);
                            if($solicitudeUsuario1->vehiculo_autorizado === "AUTORIZADO"){
                                        
                                    $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo); 
                                    //dd($vehiculoIng );
                                    }else{
                                    $vehiculoIng = null; 
                                    }
                                    $control = ControlIngreso::find($solicitudeUsuario1->id);
                                    
                                            
                                    array_push($results,$solicitudeUsuario1);
                                    array_push($results, $vehiculoIng);
                                
                                    $solicitudeUsuario =$results;
                                //dd($solicitudeUsuario,'entro');
                                    if($request->ajax())
                                        {                                        
                                        return response()->json($solicitudeUsuario);
                                        } 
                                                    
                            

                        }
                        

                    }
                    //PROVEEDOR
                    foreach ($UsuarioHoras as $solicitudeUsuario) {
                        if($solicitudeUsuario->tipo_solicitud == 'PROVEEDOR'){
                            //dd($solicitudeUsuario);
                            if($solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/$horaMenos30/*$horaMenos30*/
                            && $solicitudeUsuario->hora_ingreso <= $horaM10){

                                //dd($solicitudeUsuario);
                                if($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO"){
                                    $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                                    //dd($vehiculoIng);  
                                    }else{
                                        $vehiculoIng = null; 
                                        }
                                        array_push($results,$solicitudeUsuario);
                                        array_push($results, $vehiculoIng);
                                        
                                        $solicitudeUsuario =$results;
                                //dd($solicitudeUsuario);
                                        if($request->ajax())
                                            {
                                            
                                            return response()->json($solicitudeUsuario);
                                            }
                            }

                                    }
            
               }

                            //visitante
                    foreach ($UsuarioHoras as $solicitudeUsuario) {
                                if($solicitudeUsuario->tipo_solicitud == 'VISTANTE'){
                        //dd($solicitudeUsuario);
                        if($solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/$horaMenos30/*$horaMenos30*/
                        && $solicitudeUsuario->hora_ingreso <= $horaM10){

                            //dd($solicitudeUsuario);
                            if($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO"){
                                $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                                //dd($vehiculoIng);  
                                }else{
                                    $vehiculoIng = null; 
                                    }
                                    array_push($results,$solicitudeUsuario);
                                    array_push($results, $vehiculoIng);
                                    
                                    $solicitudeUsuario =$results;
                            //dd($solicitudeUsuario);
                                    if($request->ajax())
                                        {
                                        
                                        return response()->json($solicitudeUsuario);
                                        }
                        }

                                }
                    
                       }

                       
    }
   

    public function contarUsuarios(Request $request){
        $fechaA = Carbon::now()->toDateString();
        $contarUsuario = ControlIngreso::where('hora_salida',null)
        ->where('ingreso','!=',null)
        ->where('fecha_ingreso',$fechaA)
        ->count();
        //dd($contarUsuario);
        if($request->ajax())
        {
         
          return response()->json($contarUsuario);
        }

        
    }
    
     public function verificarVehiculo(Request $request,$id)
    {
        //dd($id);
        $vehiculo = ControlIngreso::find($id);
        //dd($vehiculo);
        
        
        
        if($request->ajax())
        {
            if( $vehiculo != null){
                if( $vehiculo->vehiculo != null){
               $vehiculoIng = Vehiculo::find($vehiculo->vehiculo);
               //dd($vehiculoIng);
                return response()->json($vehiculoIng);
           }else{
               $vehiculoIng = null;
                return response()->json($vehiculoIng);
           }
        }
         
          
        }
    }
    
     public function autorizarVehiculo(Request $request,$id)
    {
        //dd($id);
        $ControlIngreso = ControlIngreso::find($id);
        //dd($ControlIngreso);
        
        
        $mensaje = ['mensaje' => 'No se puede autorizar Vehiculo <br> Feliz día!!'];
        $fechaA = Carbon::now()->toDateString();
        
        if( $ControlIngreso != null){
        $ingresos = ControlIngreso::where('identificacion',$ControlIngreso->identificacion)
        ->where('quien_solicito',$ControlIngreso->quien_solicito)
        ->where('vehiculo',$ControlIngreso->vehiculo)
        ->get();
        //dd($ingresos);
        
        foreach ($ingresos as  $value) {
            //dd($value->id);
            if($value->vehiculo_autorizado == "PENDIENTE" || $value->vehiculo_autorizado == "NEGADO") {
                if($fechaA <= $value->fecha_ingreso   ){
                   $value->vehiculo_autorizado = "AUTORIZADO";
                   $value->save();  
                }
               
               }   
                
            }
               
               $mensaje = ['mensaje' => 'Vehículo Autorizado <br> Feliz día!!'];
           
        }else{
            $mensaje = ['mensaje' => 'No se puede autorizar Vehiculo <br> Feliz día!!']; 
        }
        
       
        
        
        if($request->ajax())
        {
         
          return response()->json($mensaje);
        }
    }
    
     public function denegarVehiculo(Request $request,$id)
    {
        //dd($id);
        $ControlIngreso = ControlIngreso::find($id);
        //dd($ControlIngreso);
        
        
        $mensaje = ['mensaje' => 'Error al Negar Ingreso de Vehículo <br> Feliz día!!'];
        $fechaA = Carbon::now()->toDateString();
        
        if( $ControlIngreso != null){
        $ingresos = ControlIngreso::where('identificacion',$ControlIngreso->identificacion)
        ->where('quien_solicito',$ControlIngreso->quien_solicito)
        ->where('vehiculo',$ControlIngreso->vehiculo)
        ->get();
        //dd($ingresos);
        
        foreach ($ingresos as  $value) {
            //dd($value->id);
            if($value->vehiculo_autorizado == "PENDIENTE") {
                if($fechaA <= $value->fecha_ingreso   ){
                   $value->vehiculo_autorizado = "NEGADO";
                   $value->save();  
                }
               
               }   
                
            }
               
               $mensaje = ['mensaje' => 'Se Negó El ingreso de este Vehiculo <br> Feliz día!!'];
           
        }else{
            $mensaje = ['mensaje' => 'Error al Negar Ingreso de Vehículo <br> Feliz día!!']; 
        }
        
       
        
        
        if($request->ajax())
        {
         
          return response()->json($mensaje);
        }
    }
    
    
    public function reportarSalida(Request $request, $id){

        dd($request->all());
        
        $fechaA = Carbon::now()->toDateString();
         $hora = Carbon::now()->totimeString();
        
        $UsuarioHora = ControlIngreso::where('identificacion',$id)
        ->where('fecha_ingreso',$fechaA)
        ->where('ingreso','!=', null)
        ->where('hora_ingreso','<', $hora)
        ->where('salida', null)
        ->get();
        
        //dd($UsuarioHora->count());
        
        if($UsuarioHora->count() != 0 ){
            
           foreach ($UsuarioHora as  $value) {
            //dd($value,$value->id ,'hola');
           $control = ControlIngreso::find($value->id); 
           $control->salida =  auth()->user()->name.' a las '.$hora;
           $control->hora_salida = $hora;
           $control->save(); 
          }
          
          $mensaje = ['mensaje' => 'Registro de salida exitoso... <br> Feliz día!!'];
          
        
        
        }else{
            //dd($UsuarioHora);
            $mensaje = ['mensaje' => 'No ha reportado ingreso o ya lo realizó <br>Feliz día!'];
            
        }
        
        if($request->ajax())
        {
         
          return response()->json($mensaje);
        }
        
        
        
        //dd($UsuarioHora);
    }


    
    public function registroIngreso(Request $request)
    {
        if($request['cedula'] == null){
            $fecha = Carbon::now()->toDateString();
        }else{
           $fecha = $request['fecha'];
        }
        
        
        //dd($request['cedula']);
        $ingresos = ControlIngreso::where('quien_solicito', auth()->user()->id)
        ->cedulai($request['cedula'])
        ->fechai($fecha)
        ->radicadoi($request['radicado'])
        ->orderBy('fecha_ingreso', 'ASC')
        ->orderBy('hora_ingreso', 'ASC')
        ->get();
        
        return view('monitoreo.reg_ingreso.index',compact('ingresos'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agendamiento()
    {
        $despacho = Despacho::select('nombreDespacho')->where('correoD','=', auth()->user()->email)->first();
        //dd($despacho);
        if($despacho){
            $nombreDespacho = $despacho->nombreDespacho;
        }else{
            $nombreDespacho =  auth()->user()->name;
        }
        //dd($nombreDespacho);
       return view('monitoreo.reg_ingreso.agendamiento',compact('nombreDespacho'));
    }

    public function agendamientoStore(Request $request)
    {
        $visita = new ControlIngreso();

            $visita->identificacion = $request['identificacion'];
            $visita->nombre = $request['nombre'];
            $visita->apellidos = $request['apellidos'];
            $visita->fecha_ingreso = $request['fecha_ingreso'];
            $visita->hora_ingreso = $request['hora_ingreso'];
            $visita->radicado = $request['radicado'];
            $visita->despacho = $request['nombre_despacho'];
            $visita->save();
            return redirect()->back();
    }
    
  

   
    
    

}
