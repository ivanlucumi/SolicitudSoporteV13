<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use \Illuminate\Support\Facades\URL;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Mail;
use Validator;

use App\Models\EventoIntegracion;
use App\Models\FamiliarEvento;
use App\Models\MesaTrabajoCorte;

use App\Models\ListadoEvento;

use Illuminate\Support\Carbon;


class EventoIntegracionLController extends Controller
{
    
     public function __construct(){
        $this->middleware('auth');
        
    }
    //
    public function store(Request $request){
        
        $this->validate($request, [
                'cedula' => 'required|digits_between:6,10|unique:evento_integracions',
                'nombre'=>'required|max:120',
                'apellido'=>'required|max:120',
                'cargo'=>'required|max:120',
                'despacho'=>'required|max:120'
                ]);
                
      //dd($request,$request->acompanhante=="con_acompanhante");  
      $funcionario = new EventoIntegracion();
      $funcionario->cedula=$request->cedula;
      $funcionario->nombre=$request->nombre;
      $funcionario->apellido=$request->apellido;
      $funcionario->cargo=$request->cargo;
      $funcionario->despacho=$request->despacho;
      $funcionario->save();
      
      if($request->acompanhante=="con_acompanhante"){
          if(count($request->tipo_identificacion) <1){
              Session::flash('success', 'No ha diligenciado datos del acompaante!');
                          return Redirect::back();
          }
          
          /*$this->validate($request, [
                'tipo_identificacion.*' => 'required|max:30',
                'identificacion.*'=>'required|digits_between:6,10|unique:familiar_funcionarios',
                'parentesco.*'=>'required|max:50',
                'nombre_acompanhante.*'=>'required|max:120',
                'apellido_acompanhant.*e'=>'required|max:120'
                ]);*/
          
        for($i=0;$i<count($request->tipo_identificacion);$i++ ){
          $familiar = new FamiliarEvento(); 
          $familiar->evento_integracions_id=$funcionario->id;
          $familiar->tipo_identificacion=$request->tipo_identificacion[$i];
          $familiar->identificacion=$request->identificacion[$i];
          $familiar->parentesco=$request->parentesco[$i];
          $familiar->nombre_acompanhante=$request->nombre_acompanhante[$i];
          $familiar->apellido_acompanhante=$request->apellido_acompanhante[$i];
          $familiar->save();
       }  
      }
      Session::flash('success', 'Registro Exitoso!');
                          return Redirect::back();
      
    }
    
    
    
    //CONSULTA DE FUNCIONARIOS DE LA CORTE
    
    public function index(){
        
        $mesa = MesaTrabajoCorte::mesaTrabajo();
        $registros= MesaTrabajoCorte::TotalRegistros();
        $participantes =MesaTrabajoCorte::where('mesa_trabajo',"!=",NULL)
        ->orderBy('mesa_trabajo')
        ->get();
        //dd($registros);
        return view('externo.mesaTrabajoCorte',compact('mesa','registros','participantes'));
    }
    
    
    public function consultaCedula(Request $request,$id){
        
        $persona = MesaTrabajoCorte::where('cedula',$id)->first();
        
       // dd($persona);
        
        //dd($id, $vehiculo);
        
        if($request->ajax())
        {
         
          return response()->json($persona);
        }
        
        
    }
    
     public function storeMesaTrabajo(Request $request)
    {
        //dd($request->all());
        
        if($request->mesa=="SOLO ASISTENTE"){
          $Consulta=10;  
        }else{
          $Consulta=MesaTrabajoCorte::where('mesa_trabajo',$request->mesa)
        ->count();  
        }


        
        if($Consulta >= 60){
            $mensaje='Mesa de trabajo no disponible, alcanz車 el numero m芍ximo';
            Session::flash('error',$mensaje);
           return Redirect::back();
        }else{
            //dd($Consulta);
           $Consulta=MesaTrabajoCorte::where('cedula',$request->cedula)
           ->first();
            if($Consulta){
               $lista =MesaTrabajoCorte::where('cedula',$request->cedula) ->first();
            }else{
               $lista = new MesaTrabajoCorte() ; 
            }
            //dd($lista);
           $lista->cedula = $request->cedula;
           $lista->nombre = $request->nombre;
           $lista->correo = $request->correo;
           $lista->cargo = $request->cargo;
           $lista->ciudad = $request->ciudad;
           $lista->mesa_trabajo = $request->mesa;
           $lista->entidad = $request->entidad;
           $lista->numero_contacto = $request->numero_contacto;
           $lista->save();
        }
        Session::flash('success', 'Registro Exitoso!');
        return Redirect::back();

        
    }
    
    public function listadoEvento(Request $request){
        
        $asistentes=ListadoEvento::all()->count();
        $j26= ListadoEvento::where('asistencia_ingreso_26','!=',null)->count();
        $j27= ListadoEvento::where('asistencia_ingreso_27','!=',null)->count();
        $j28= ListadoEvento::where('asistencia_ingreso_28','!=',null)->count();
        //dd($asistentes,$j26,$j27,$j28);
        
        $registros= ListadoEvento::all();
        return view('externo.listadoAsistencia',compact('registros','asistentes','j26','j27','j28'));
        
    }
    public function RegsitrarAsistencia(Request $request){
        $listado = ListadoEvento::where('identificacion',$request->cedula)
        ->first();
        $fecha =Carbon::now()->toDateString();
        
        if($fecha < '2023-07-18' || $fecha > '2023-07-28' ){
          
        Session::flash('message', 'EL EVENTO AUN NO ESTA PROGRAMADO EN ESTA FECHA PARA AISTENCIA!');
        return redirect()->route("index.asistencia.evento");  
        }
        
        if(!empty($listado)){
        
        
        
            
        if($fecha == '2023-07-26'){
            //dd($fecha);
            $listado->asistencia_ingreso_26 ="ASISTIÓ ->".Carbon::now();
            $listado->save();
        }
        if($fecha == '2023-07-27'){
            $listado->asistencia_ingreso_27 ="ASISTIÓ ->".Carbon::now();
            $listado->save();
        }
        if($fecha == '2023-07-28'){
            $listado->asistencia_ingreso_28 ="ASISTIÓ ->".Carbon::now();
            $listado->save();
        }
        
        
        
        Session::flash('message', 'ASISTENCIA REGISTRADA CON EXITO!');
        return redirect()->route("index.asistencia.evento");
        }else{
          
        Session::flash('message', 'ASISTENTE NO INSCRITO!');
        return redirect()->route("index.asistencia.evento");  
        }
        
        //
        
        
    }
    
    public function consultaCedulaAsistencia(Request $request,$id){
        
        $persona = ListadoEvento::where('identificacion',$id)->first();
        $persona->asistencia = "SE REGISTRA INGRESO : ".Carbon::now();
        $persona->save();
        
       // dd($persona);
        
        //dd($id, $vehiculo);
        
        if($request->ajax())
        {
         
          return response()->json($persona);
        }
        
        
    }
}
