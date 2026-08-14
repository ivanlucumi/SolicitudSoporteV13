<?php

namespace App\Http\Controllers;

use App\Models\RegistroIncidentesMercurio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\ControlDigitalizacion;
use App\Models\ControlDigitalizacionProtoDos;
use App\Models\ControlDigitalizacionSinRevisar;
use App\Models\ControlDigitalizacionPdf;

class RegistroIncidentesMercurioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $incidentesTotal= RegistroIncidentesMercurio::where('solucion', null)->where('revision_mercurio',null)->count();
      $resueltosTotal= RegistroIncidentesMercurio::where('solucion','!=', null)->where('revision_mercurio',null)->count();
     // dd($incidentesTotal,$resueltosTotal);
     $estados = RegistroIncidentesMercurio::estado();
     //dd($estados);
     
     $Corregido = ControlDigitalizacionProtoDos::where('correccion','!=',null)->count();
      
      $incidentes= RegistroIncidentesMercurio::where('revision_mercurio',null)->get();
      //dd($incidentes);
      
      return view('administrador.registroIncidentesMercurio.index',compact('incidentes','incidentesTotal','resueltosTotal','estados','Corregido'));
    }
    //ControlDigitalizacionProtoDos
     public function RevisadoPDos(){
        // dd('hola');
         
    	/*$digitalizado = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	->orWhere('observaciones','!=', NULL)
    	->where('correccion', NULL)
    	->paginate(100);*/
    	
    	$digitalizado = ControlDigitalizacionProtoDos::where('reviso_servisoft',null)
    	->where('correccion', NULL)
    	->where('reviso',"!=", NULL)
    	//->where('quien_tomo', NULL)
    	->where('reprocesar','!=', 'SIN NOVEDAD')
    	//->orWhere('observaciones','!=', NULL)
    	->get();
    	
    	//dd($digitalizado);
    
    	
    	   	//CONTAR REVISIONES
    	$digiCantidad = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	//->where('segunda_revision', NULL)
    	//->where('correccion','!=', NULL)
    	->select('estado')
    	->get();
    	
    	$digiCantidad1 = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado','!=',"SIN REGISTRO")
    	->where('correccion', NULL)
    	->orWhere('reprocesar','!=','SIN NOVEDAD')
    	//->where('observaciones','!=', NULL)
    	->select('estado')
    	->get();
    	
    	
    	$CorregidoUser =  ControlDigitalizacionProtoDos::where('reviso_servisoft','!=',null)
    	->where('reviso_servisoft','LIKE','%' . auth()->user()->name.' '. auth()->user()->lastname. '%' )
    	->get();
    	
    	$CorregidoUser= count($CorregidoUser);
    	//dd($CorregidoUser);
    	
    	$SinR = count($digiCantidad);
    	$observa = count($digitalizado);
    	$cantidad = $SinR+$observa;
    	$Corregido = ControlDigitalizacionProtoDos::where('correccion','!=',null)->count();
    	$TotalRevisadosPDos = ControlDigitalizacionProtoDos::where('reviso','!=',null)->count();
    	$totalProtocolo = ControlDigitalizacion::where('correccion','!=',null)->where('estado', '!=', "SIN REGISTRO")->count();  ///correccion is not null and estado != "SIN REGISTRO";
    	$Total = $TotalRevisadosPDos+$totalProtocolo;
    	
    	//dd($TotalRevisados,$totalProtocolo,$Total);
    	
    //	$cantidad = count($digiCantidad);
    	
    	//dd($cantidad,$digitalizado);
    	
    	$sin_novedad = ControlDigitalizacionProtoDos::where('observaciones_archivos_multimedia_m','LIKE', '%n/a%' )
    	->where('observaciones_generales_m','LIKE', '%n/a%' )
    	->where('carpetas_comprimidas_m','LIKE', '%n/a%' )
    	->where('carpetas_protocolodos_m','LIKE', '%n/a%' )
    	->count();
    	//dd($sin_novedad);
    	
    	
    	return view('administrador.registroIncidentesMercurio.IndexProtocoloDos', compact('digitalizado','cantidad','SinR','observa','CorregidoUser','Corregido','Total','TotalRevisadosPDos'));
  
    }
    
    public function RevisadoPDosCorregido(){
        
    	   	//CONTAR REVISIONES
    	$digitalizado = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('correccion', '!=',null)
    	->get();
    	
    	
    	return view('administrador.registroIncidentesMercurio.IndexProtocoloDosCorregido', compact('digitalizado'));
  
    }
    
     public function indexServisoft()
    {
      $incidentes= RegistroIncidentesMercurio::where('solucion', null)->where('revision_mercurio',null)->get();
      $resueltos= RegistroIncidentesMercurio::where('solucion','!=', null)->where('revision_mercurio',null)->get();
      return view('administrador.registroIncidentesMercurio.indexServisoft',compact('incidentes','resueltos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $lista = new RegistroIncidentesMercurio() ;
           $lista->usuario =  auth()->user()->name.' '.  auth()->user()->lastname;
           if($request->estado =='CARGADO_COMPLETO'){
            $lista->solucion = 'CARGADO_COMPLETO';
            $lista->fecha_solucion =  date("Y-m-d");
            $lista->quien_soluciono =  auth()->user()->name.' '.  auth()->user()->lastname;
           }
           //
           $lista->radicacion = $request->radicacion;
           $lista->estado = $request->estado;
           $lista->solicitud = $request->solicitud;
           $lista->fecha_solicitud =  date("Y-m-d");
           $lista->despacho_que_solicita = $request->despacho_que_solicita;
           $lista->save();
           
           Session::flash('message', 'Novedad registrada con exito!');
           return Redirect::to('administrador/registro/incidentes/bestdoc'); 
        
    }
    
      public function storeServisoft(Request $request,$id) {
          
          //dd($request->all());
          $lista = RegistroIncidentesMercurio::findOrFail($id);
           $lista->quien_soluciono =  auth()->user()->name.' '.  auth()->user()->lastname;
           $lista->solucion = $request->solucion;
           $lista->fecha_solucion =  date("Y-m-d");
           $lista->save();
           
           Session::flash('message', 'Registro de solucion almacenando con exito!');
           return Redirect::to('servisoft/registro/incidentes/bestdoc'); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegistroIncidentesMercurio  $registroIncidentesMercurio
     * @return \Illuminate\Http\Response
     */
    public function show(RegistroIncidentesMercurio $registroIncidentesMercurio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegistroIncidentesMercurio  $registroIncidentesMercurio
     * @return \Illuminate\Http\Response
     */
    public function edit(RegistroIncidentesMercurio $registroIncidentesMercurio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegistroIncidentesMercurio  $registroIncidentesMercurio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistroIncidentesMercurio $registroIncidentesMercurio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegistroIncidentesMercurio  $registroIncidentesMercurio
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistroIncidentesMercurio $registroIncidentesMercurio)
    {
        //
    }
}
