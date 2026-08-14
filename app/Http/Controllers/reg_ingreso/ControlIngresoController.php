<?php

namespace App\Http\Controllers\reg_ingreso;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;



use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\Despacho;
use App\Models\ControlIngreso;
use App\Models\Persona;
use App\Models\Vehiculo;
use App\Models\ContratoActivo;
use App\Models\Parqueadero;

class ControlIngresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');  
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request['cedula'] == null){
            $fecha = Carbon::now()->toDateString();
        }else{
           $fecha = $request['fecha'];
        }
        
        
        $contarUsuario = ControlIngreso::where('salida',null)
        ->where('ingreso','!=',null)
        ->where('fecha_ingreso',$fecha)
        ->count();
        
        //dd($request['cedula']);
        $ingresos = ControlIngreso::where('quien_solicito', auth()->user()->id)
        ->cedulai($request['cedula'])
        ->fechai($fecha)
        ->radicadoi($request['radicado'])
        ->orderBy('fecha_ingreso', 'ASC')
        ->orderBy('hora_ingreso', 'ASC')
        ->get();
        
        return view('reg_ingreso.index',compact('ingresos','contarUsuario'));
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
       return view('reg_ingreso.agendamiento',compact('nombreDespacho'));
    }

    public function agendamientoStore(Request $request)
    {
            $visita = new ControlIngreso();

            $visita->identificacion = $request['identificacion'];
            $visita->fullname = $request['nombre'] . $request['apellidos'];
            $visita->fecha_ingreso = $request['fecha_ingreso'];
            $visita->hora_ingreso = $request['hora_ingreso'];
            $visita->radicado = $request['radicado'];
            $visita->despacho = $request['nombre_despacho'];
            $visita->save();
            return redirect()->back();
    }

    public function agendamientoEmpleado(Request $request){
        //dd($request->all()); 
        //dd(Carbon::parse($request['fecha_ingreso'])->dayOfWeek); 
        $dia = 0;      
        $dia1 = 0;      
        $despacho = Despacho::select('nombreDespacho')->where('correoD','=', auth()->user()->email)->first();
        //dd($despacho);
        if($despacho){
            $nombreDespacho = $despacho->nombreDespacho;
        }else{
            $nombreDespacho =  auth()->user()->name;
        }
        
        if(isset($request['vehiculoEmpleado'])){
            $conVehiculo = true;
            $this->validate($request, [
            'identificacion'=> 'required|numeric',
            'fecha_ingreso' => 'required',
            'fecha_hasta' => 'required',
            'hora_ingreso' => 'required',
            'placa' => 'required',
            'tipo' => 'required',
            'marca' => 'required',
            'color' => 'required',
            
        ]);
            
        }else{
            $conVehiculo = false;
            $this->validate($request, [
            'identificacion'=> 'required|numeric',
            'fecha_ingreso' => 'required',
            'hora_ingreso' => 'required',
            'fecha_hasta' => 'required',
            
        ]);
        }
        
        $fechaA = Carbon::now()->toDateString();
        $horaA = Carbon::now()->toTimeString();
        
        if($request['fecha_ingreso'] < $fechaA){
            Session::flash('success', 'Fecha de ingreso no puede ser menor a la actual!');
             return redirect()->back();
        }else{
            if($request['fecha_hasta'] < $fechaA){
                Session::flash('success', 'Fecha de Final no puede ser menor a la actual!');
                 return redirect()->back();
            }else{
                if($request['hora_ingreso']< $horaA && $request['fecha_ingreso'] < $fechaA){
                    Session::flash('success', 'La hora no puede ser menor a la actual!');
                     return redirect()->back();
                }else{
                    
                    if($request['fecha_ingreso'] == $request['fecha_hasta']){
                       //dd($conVehiculo);
                       $persona = Persona::updateOrCreate(['cedula'=>$request['identificacion']],['nombre'=>$request['nombre'],'apellidos'=>$request['apellidos']]);
        
                            $visita = new ControlIngreso();
                
                            $visita->identificacion = $request['identificacion'];
                            $visita->fullname = $request['nombre'] . $request['apellidos'];
                            $visita->fecha_ingreso = $request['fecha_ingreso'];
                            $visita->hora_ingreso = $request['hora_ingreso'];
                            $visita->despacho = strtoupper($nombreDespacho);
                            $visita->quien_solicito =  auth()->user()->id;
                            $visita->tipo_solicitud = strtoupper($request['uEmpleado']);
                            $visita->vehiculo_autorizado = strtoupper('PENDIENTE');
                            $visita->save();
                
                            if($conVehiculo){
                                $vehiculo = Vehiculo::updateOrCreate(
                                    ['placa'=>strtoupper($request['placa'])],
                                    ['tipo'=> strtoupper($request['tipo']),
                                'marca'=> strtoupper($request['marca']),
                                'color'=> strtoupper($request['color'])]
                                );
                
                                $visitaVehiculo = Vehiculo::where('placa',strtoupper($request['placa']))
                                    ->select('id')
                                    ->first();
                                //dd($visitaVehiculo);
                
                                $vehiculoV = ControlIngreso::find($visita->id);
                                //dd($vehiculoV);
                                $vehiculoV->vehiculo = $visitaVehiculo->id;
                                $vehiculoV->save();
                            }
                            
                            Session::flash('success', 'Registro de Ingreso Exitoso!');
                            return redirect()->back();
 
                    }else{
                        $fechaI = Carbon::parse($request['fecha_ingreso']);
                        $fechaH = Carbon::parse($request['fecha_hasta']);
                        
                        

                        for ($fechaI; $fechaI < $fechaH; $fechaI){ 
                            if($dia > 0){
                                $fechaI = Carbon::parse($request['fecha_ingreso'])->addDays($dia);
                            }else{
                                $fechaI = Carbon::parse($request['fecha_ingreso']);
                            }



                            if($fechaI->dayOfWeek != 0 && $fechaI->dayOfWeek != 6){
                                //dd('entro');
                                $dia1++;
                                $persona = Persona::updateOrCreate(['cedula'=>$request['identificacion']],['nombre'=>$request['nombre'],'apellidos'=>$request['apellidos']]);
        
                                    $visita = new ControlIngreso();
                        
                                    $visita->identificacion = $request['identificacion'];
                                    $visita->fullname = $request['nombre'] . $request['apellidos'];
                                    $visita->fecha_ingreso = $fechaI;
                                    $visita->hora_ingreso = $request['hora_ingreso'];
                                    $visita->despacho = strtoupper($nombreDespacho);
                                    $visita->quien_solicito =  auth()->user()->id;
                                    $visita->tipo_solicitud = strtoupper($request['uEmpleado']);
                                    $visita->vehiculo_autorizado = strtoupper('PENDIENTE');
                                    $visita->save();
                        
                                    if($conVehiculo){
                                        $vehiculo = Vehiculo::updateOrCreate(
                                            ['placa'=>strtoupper($request['placa'])],
                                            ['tipo'=> strtoupper($request['tipo']),
                                        'marca'=> strtoupper($request['marca']),
                                        'color'=> strtoupper($request['color'])]
                                        );
                        
                                        $visitaVehiculo = Vehiculo::where('placa',strtoupper($request['placa']))
                                            ->select('id')
                                            ->first();
                                        //dd($visitaVehiculo);
                        
                                        $vehiculoV = ControlIngreso::find($visita->id);
                                        //dd($vehiculoV);
                                        $vehiculoV->vehiculo = $visitaVehiculo->id;
                                        $vehiculoV->vehiculo_autorizado = strtoupper('PENDIENTE');
                                        $vehiculoV->save();
                                    }
                            
                                    
                            }
                            //dd('salio');
                            $dia++;
                            
                            
                        }
                        //dd($dia,$fechaI);
                        //dd($dia,$dia1);
                        Session::flash('success', 'Registro de Ingreso Exitoso!');
                            return redirect()->back();
                        
                        
                    }
                }
            }
            
        }
        
       // dd($request->all()); 

        
    }

    public function agendamientoVisitante(Request $request){
        //dd($request->all());
        
        $despacho = Despacho::select('nombreDespacho')->where('correoD','=', auth()->user()->email)->first();
        //dd($despacho);
        if($despacho){
            $nombreDespacho = $despacho->nombreDespacho;
        }else{
            $nombreDespacho =  auth()->user()->name;
        }
        
        
        $this->validate($request, [
            'identificacion'=> 'required|numeric',
            'fecha_ingreso' => 'required',
            'hora_ingreso' => 'required',
            'radicado' => 'required|min:23',
            
        ]);
        
        //verificar empleado si esta creado y lo ingresa
        $persona = Persona::updateOrCreate(['cedula'=>$request['identificacion']],['nombre'=>$request['nombre'],'apellidos'=>$request['apellidos']]);
        
        
        
         $visita = new ControlIngreso();

            $visita->identificacion = $request['identificacion'];
            $visita->fullname = $request['nombre'] . $request['apellidos'];
            $visita->fecha_ingreso = $request['fecha_ingreso'];
            $visita->hora_ingreso = $request['hora_ingreso'];
            $visita->despacho = strtoupper($nombreDespacho);
            $visita->radicado = $request['radicado'];
            $visita->quien_solicito =  auth()->user()->id;
            $visita->tipo_solicitud = strtoupper($request['uVisitante']);
            $visita->vehiculo_autorizado = strtoupper('PENDIENTE');
            $visita->save();
            
            Session::flash('success', 'Registro de Ingreso Exitoso!');
            return redirect()->back();
     
    }
    
    public function agendamientoProveedor(Request $request){
        
        //dd($request->all());
       
       $despacho = Despacho::select('nombreDespacho')->where('correoD','=', auth()->user()->email)->first();
        //dd($despacho);
        if($despacho){
            $nombreDespacho = $despacho->nombreDespacho;
        }else{
            $nombreDespacho =  auth()->user()->name;
        }
       // dd($nombreDespacho);
        
        if(isset($request['vehiculoProveedor'])){
            $conVehiculo = true;
            $this->validate($request, [
            'identificacion'=> 'required|numeric',
            'fecha_ingreso' => 'required',
            'hora_ingreso' => 'required',
            'placa' => 'required',
            'tipo' => 'required',
            'marca' => 'required',
            'color' => 'required',
            'parqueadero'=>'required',
            
        ]);
            
        }else{
            $conVehiculo = false;
            $this->validate($request, [
            'identificacion'=> 'required|numeric',
            'fecha_ingreso' => 'required',
            'hora_ingreso' => 'required',
            
        ]);
        }
        
       //dd($request->all()); 

       // $persona = Persona::updateOrCreate(['cedula'=>$request['identificacion']],['nombre'=>$request['nombre'],'apellidos'=>$request['apellidos']]);
        
        
        
         $visita = new ControlIngreso();

            $visita->identificacion = $request['identificacion'];
            $visita->fullname = $request['nombre'] . $request['apellidos'];
            $visita->fecha_ingreso = $request['fecha_ingreso'];
            $visita->hora_ingreso = $request['hora_ingreso'];
            $visita->despacho = strtoupper($nombreDespacho);
            $visita->quien_solicito =  auth()->user()->id;
            $visita->tipo_solicitud = strtoupper($request['uProveedor']);
            $visita->parqueadero = $request['parqueadero'];
            $visita->vehiculo_autorizado = strtoupper('PENDIENTE');
            $visita->save();

            if($conVehiculo){
                
                
                $vehiculo = Vehiculo::updateOrCreate(
                    ['placa'=>strtoupper($request['placa'])],
                    ['tipo'=> strtoupper($request['tipo']),
                'marca'=> strtoupper($request['marca']),
                'color'=> strtoupper($request['color'])]
                );

                $visitaVehiculo = Vehiculo::where('placa',strtoupper($request['placa']))
                    ->select('id')
                    ->first();
                //dd($visitaVehiculo);
        

                $vehiculoV = ControlIngreso::find($visita->id);
                //dd($vehiculoV);
                $vehiculoV->vehiculo = $visitaVehiculo->id;
                $vehiculoV->vehiculo_autorizado = "PENDIENTE";
                $vehiculoV->save();


            }
            
            Session::flash('success', 'Registro de Ingreso Exitoso!');
            return redirect()->back();
        
    }
    
    public function agendamientoParqueadero(Request $request){
       
       $despacho = Despacho::select('nombreDespacho')->where('correoD','=', auth()->user()->email)->first();
        //dd($despacho);
        if($despacho){
            $nombreDespacho = $despacho->nombreDespacho;
        }else{
            $nombreDespacho =  auth()->user()->name;
        }
        
        if(isset($request['vehiculoProveedor'])){
            $conVehiculo = true;
            $this->validate($request, [
            'identificacion'=> 'required|numeric',
            'fecha_ingreso' => 'required',
            'hora_ingreso' => 'required',
            'placa' => 'required',
            'tipo' => 'required',
            'marca' => 'required',
            'color' => 'required',
            
        ]);
            
        }else{
            $conVehiculo = false;
            $this->validate($request, [
            'identificacion'=> 'required|numeric',
            'fecha_ingreso' => 'required',
            'hora_ingreso' => 'required',
            
        ]);
        }
        
       // dd($request->all()); 

       // $persona = Persona::updateOrCreate(['cedula'=>$request['identificacion']],['nombre'=>$request['nombre'],'apellidos'=>$request['apellidos']]);
        
        
        
         $visita = new ControlIngreso();

            $visita->identificacion = $request['identificacion'];
            $visita->fullname = $request['nombre'] . $request['apellidos'];
            $visita->fecha_ingreso = $request['fecha_ingreso'];
            $visita->hora_ingreso = $request['hora_ingreso'];
            $visita->despacho = strtoupper($nombreDespacho);
            $visita->quien_solicito =  auth()->user()->id;
            $visita->tipo_solicitud = strtoupper($request['uProveedor']);
            $visita->vehiculo_autorizado = strtoupper('PENDIENTE');
            $visita->save();

            if($conVehiculo){
                
                
                $vehiculo = Vehiculo::updateOrCreate(
                    ['placa'=>strtoupper($request['placa'])],
                    ['tipo'=> strtoupper($request['tipo']),
                'marca'=> strtoupper($request['marca']),
                'color'=> strtoupper($request['color'])]
                );

                $visitaVehiculo = Vehiculo::where('placa',strtoupper($request['placa']))
                    ->select('id')
                    ->first();
                //dd($visitaVehiculo);
        

                $vehiculoV = ControlIngreso::find($visita->id);
                //dd($vehiculoV);
                $vehiculoV->vehiculo = $visitaVehiculo->id;
                $vehiculoV->vehiculo_autorizado = "PENDIENTE";
                $vehiculoV->save();


            }
            
            Session::flash('success', 'Registro de Ingreso Exitoso!');
            return redirect()->back();
        
    }
    
    public function consultaPlaca(Request $request,$id){
        
        $vehiculo = Vehiculo::where('placa',$id)->first();
        
        //dd($id, $vehiculo);
        
        if($request->ajax())
        {
         
          return response()->json($vehiculo);
        }
        
        
    }
    
     public function consultaCedula(Request $request,$id){
        
        $persona = Persona::where('cedula',$id)->first();
        
        //dd($persona);
        
        //dd($id, $vehiculo);
        
        if($request->ajax())
        {
         
          return response()->json($persona);
        }
        
        
    }
    
     public function consultaCedulaContrato(Request $request,$id){
        // dd($id);
        
        $results = array();
        
        $funcionario = ContratoActivo::where('cedula',$id)->first();
        $parqueadero = Parqueadero::where('cedula',$id)->first();
        
        array_push($results,$funcionario);
        array_push($results, $parqueadero);
        
        //dd($persona);
        
        if($request->ajax())
        {
         
          return response()->json($results);
        }
        
        
    }
    
    public function agendamientoTemporalParqueadero(Request $request){
        
        $dia = 0;
        
        //dd($request->all());
        
        $parqueadero = Parqueadero::where('cedula',$request['identificacion'])->first();
        if($parqueadero == null){
          Session::flash('success', 'Verifique los datos, el funcionario no tiene asignado parqueadero');
            return redirect()->back();  
        }
        
        //valicacion de datos del usuario
        $this->validate($request, [
            'identificacionF'=> 'required|numeric',
            'fecha_ingresoF' => 'required',
            'fecha_finalizacionF' => 'required',
            'placaJ' => 'required',
            'tipoJ' => 'required',
            'marcaJ' => 'required',
            'placaF' => 'required',
            'tipoF' => 'required',
            'marcaF' => 'required'
            
        ]);
        
        $juez = ContratoActivo::where('cedula',$request['identificacion'])->first();
        //dd($juez);
        
        $funcionario = ContratoActivo::where('cedula',$request['identificacionF'])->first();
        
        // No realiza proceso si no encuentra alguna d elas cedulas
        
        if($juez == null && $funcionario == null){
            Session::flash('success', 'Verifique los datos, uno de los funcionario no esta activo como empleado en KACTUS!');
            return redirect()->back();
        }
        
        $despacho = Despacho::select('nombreDespacho')->where('codigoDespacho','=', auth()->user()->cedula)->first();
        //dd($despacho);
        if($despacho){
            $nombreDespacho = $despacho->nombreDespacho;
        }else{
            $nombreDespacho =  auth()->user()->name;
        }
        
            $fechaI = Carbon::parse($request['fecha_ingresoF']);
            $fechaH = Carbon::parse($request['fecha_finalizacionF']);
            
            if($fechaI == $fechaH){
                
                $visita = new ControlIngreso();
                                    $visita->identificacion = $request['identificacionF'];
                                    $visita->fullname = $request['nombreF'] . $request['apellidosF'];
                                    $visita->fecha_ingreso = $request['fecha_ingresoF'];
                                    $visita->despacho = strtoupper($nombreDespacho);
                                    $visita->quien_solicito =  auth()->user()->id;
                                    $visita->tipo_solicitud = 'EMPLEADO';
                                    $visita->vehiculo_autorizado = strtoupper('PENDIENTE');
                                    $visita->save();
                                    
                        
                                    $vehiculo = Vehiculo::updateOrCreate(
                                            ['placa'=>strtoupper($request['placaF'])],
                                            ['tipo'=> strtoupper($request['tipoF']),
                                        'marca'=> strtoupper($request['marcaF'])]
                                        );
                                        
                                        //dd($vehiculo);
                        
                                        
                        
                                        $vehiculoV = ControlIngreso::find($visita->id);
                                        //dd($vehiculoV);
                                        $vehiculoV->vehiculo = $vehiculo->id;
                                        $vehiculoV->parqueadero = $parqueadero->id;
                                        $vehiculoV->vehiculo_autorizado = strtoupper('PENDIENTE');
                                        $vehiculoV->save();
                
            }else{
               for ($fechaI; $fechaI < $fechaH; $fechaI){ 
                            if($dia > 0){
                                $fechaI = Carbon::parse($request['fecha_ingreso'])->addDays($dia);
                            }else{
                                $fechaI = Carbon::parse($request['fecha_ingreso']);
                            }



                            if($fechaI->dayOfWeek != 0 && $fechaI->dayOfWeek != 6){
                                //dd('entro');
                                $dia1++;
                                //$persona = Persona::updateOrCreate(['cedula'=>$request['identificacion']],['nombre'=>$request['nombre'],'apellidos'=>$request['apellidos']]);
        
                                    $visita = new ControlIngreso();
                                    $visita->identificacion = $request['identificacionF'];
                                    $visita->fullname = $request['nombreF'] . $request['apellidosF'];
                                    $visita->fecha_ingreso = $request['fecha_ingresoF'];
                                    $visita->despacho = strtoupper($nombreDespacho);
                                    $visita->quien_solicito =  auth()->user()->id;
                                    $visita->tipo_solicitud = 'EMPLEADO';
                                    $visita->vehiculo_autorizado = strtoupper('PENDIENTE');
                                    $visita->save();
                                    
                        
                                    
                                        $vehiculo = Vehiculo::updateOrCreate(
                                            ['placa'=>strtoupper($request['placaF'])],
                                            ['tipo'=> strtoupper($request['tipoF']),
                                        'caracteristica'=> strtoupper($request['marcaF'])]
                                        );
                        
                                        $vehiculoV = ControlIngreso::find($visita->id);
                                        //dd($vehiculoV);
                                        $vehiculoV->vehiculo = $vehiculo->id;
                                        $vehiculoV->vehiculo_autorizado = strtoupper('PENDIENTE');
                                        $vehiculoV->save();
                                    
                            
                                    
                            }
                            //dd('salio');
                            $dia++;
                            
                            
                        } 
            }
            
        
            
            Session::flash('success', 'Registro de Ingreso Exitoso!');
            return redirect()->back();
        
    }
   
  
}

