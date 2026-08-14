<?php

namespace App\Http\Controllers\Administrador;


use Illuminate\Http\Request;
use \Illuminate\Support\Facades\URL;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\EventoIntegracion;
use App\Models\FamiliarEvento;

use App\Models\DiaFamilia;


class EventoIntegracionController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        //$this->middleware('cambiopass');
        $this->middleware('administrador');
        
    }
    
    
    
    public function index(){
       $eventos= EventoIntegracion::all();
       return view('administrador.eventos.index',compact('eventos'));
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
    
    
    public function diaFamilia(Request $request){
        
        $listado = DiaFamilia::where('confirma',"!=", null)
        //
        ->orderby('confirma','DESC')
        ->get();
        
        return view('administrador.eventos.DiaFamilia',compact('listado'));
        
    }
    
    //
    
    public function diaFamiliaActualizar(Request $request,$usuario){
        
       $evento = DiaFamilia::findOrFail($usuario);
       
      // dd($usuario,$evento);
    $evento->update($request->all());
    Session::flash('message', 'Actualizacion Realizada a '.$evento->nombre_servidor);
    return Redirect::back();
        
    }
    
}
