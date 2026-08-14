<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\ControlDigitalizacionProtoDos;
use App\Models\ControlDigitalizacionSinRevisar;
use App\Models\ControlDigitalizacionPDosPdf;
use Illuminate\Support\Facades\Route;
use App\Models\Administrador;
use App\Models\RegistroDigitalizacion;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;


class ControlDigitalizacionPDosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('Digitalizacion');
        
    }

    public function index(Request $requets){
        
        dd('hola');
        
        $estadisticaDigitalizacion = ControlDigitalizacionProtoDos::estadisticaDigitalizacionMes( auth()->user()->id);
        
        $cantidad= ControlDigitalizacionProtoDos::where('reviso_id', auth()->user()->id)->count();
        
    	
    	//dd($estadisticaDigitalizacion, auth()->user()->name. " ". auth()->user()->lastname);
    	
    	if(count($requets->all())== 0){
    	  $digitalizado = ControlDigitalizacionProtoDos::where('reviso',null)
    	  //->where('calidad','LIKE', '%' ."ok".'%')
    	  ->inRandomOrder('id')
    	  ->paginate(2000);
    	//dd($digitalizado[0]);  
    	}else{
    	    $digitalizado = ControlDigitalizacionProtoDos::where('reviso',null)
    	//->where('calidad','!=', "REPETIDO")
    	//->where('calidad','!=', "REPETIDO2")
        ->municipio($requets->municipio)
        ->radicado($requets->radicado)
        ->despacho($requets->despacho)
        ->especialidad($requets->especialidad)
        //->estado($requets->estado)
        ->cantidad($requets->cantidad)
        //->orderBy('fecha_prgramada','ASC')
        ->inRandomOrder('id')
        ->paginate(2000);
    	}
    	
    	//dd($digitalizado);
    	
    	
        $meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO','04'=>'ABRIL','05'=>'MAYO','06' => 'JUNIO', '07' => 'JULIO',
   '08' => 'AGOSTO','09'=>'SEPTIEMBRE','10'=>'OCTUBRE','11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
    	
    	$nombreRuta = request()->fullUrl();
    	
    	$url=substr($nombreRuta, 0, 29);
        
        $nombreRuta = str_replace($url,'', $nombreRuta);
    	
    	//dd($nombreRuta);
    	
    	if( auth()->user()->email != "servisoft@disajcali.gov.co" ){
    	    dd('hola');
    	   return view('digitalizacionPDos.index',compact('digitalizado','nombreRuta','estadisticaDigitalizacion','meses')); 
    	}else{
    	    
    	     $revisar=   $this->Revisado();
    	     return $revisar;
    	    
    	}
    	
    	
  
    }
    
    

    public function porRevisar(){
        
    	$digitalizado = ControlDigitalizacionProtoDos::where('reviso',null)->paginate(150);
    	$estadisticaDigitalizacion = ControlDigitalizacionProtoDos::estadisticaDigitalizacionMes( auth()->user()->name);
        //dd($estadisticaDigitalizacion);
    	
    	//return view('digitalizacion.index', compact('reservas'));
    	
    	if( auth()->user()->email != "servisoft@disajcali.gov.co" ){
    	   	return view('digitalizacionPDos.sinRevisar', compact('digitalizado','estadisticaDigitalizacion'));
    	}else{
    	    
    	     $revisar=   $this->Revisado();
    	     return $revisar;
    	    
    	}
  
    }
    
    public function revisar(Request $requets,$radicado){
        
        $digitalizado = ControlDigitalizacionProtoDos::findOrFail($radicado);
        
        if($digitalizado->quien_tomo == null || $digitalizado->quien_tomo == auth()->user()->id){
          $digitalizado->quien_tomo = auth()->user()->id;
        $digitalizado->save();  
        }else{
            Session::flash('message', 'Expediente ya esta en revision!');
            return redirect()->back();
        }
        
       // dd($requets->all());
        $total =0;
        //dd($radicado);
       // $estado=['SIN REGISTRO'=>'SIN REGISTRO'];
        $estadoRadicado = array('REGISTRO'=>'REGISTRO','SIN_REGISTRO'=>'SIN_REGISTRO');
        $llave23 = array('CUMPLE'=>'CUMPLE','NO_CUMPLE'=>'NO_CUMPLE');
        $visor = array('FUNCIONA'=>'FUNCIONA','NO_FUNCIONA'=>'NO_FUNCIONA');
        $cd = array('CONTIENE'=>'CONTIENE','NO_CONTIENE'=>'NO_CONTIENE');
        $digitales = array('NO_CONTIENE'=>'NO_CONTIENE','REPRODUCE'=>'REPRODUCE','NO_REPRODUCE'=>'NO_REPRODUCE');
        $expedientes = array('VISUALIZA'=>'VISUALIZA','NO_VISUALIZA'=>'NO_VISUALIZA');
        $indices = array('VISUALIZA'=>'VISUALIZA','NO_VISUALIZA'=>'NO_VISUALIZA');
        $demte = array('CUMPLE'=>'CUMPLE','NO_CUMPLE'=>'NO_CUMPLE');
        $demdo = array('CUMPLE'=>'CUMPLE','NO_CUMPLE'=>'NO_CUMPLE');
        $tipific = array('CUMPLE'=>'CUMPLE','NO_CUMPLE'=>'NO_CUMPLE');
        
    	$digitalizado = ControlDigitalizacionProtoDos::findOrFail($radicado);
    	
    	$nombreRuta = $requets->nombreRuta;
    	
    	//dd($nombreRuta);
    	
    	
    	$PRODUCTOS  = ControlDigitalizacionPDosPdf::where('control_digitalizacion_id',$radicado)->get();
            
            foreach($PRODUCTOS as $PROD){
                $total += (int)$PROD->cantidad_paginas;
            }
        //array para guardar la informacion de la consulta de pdfs
        
    	//dd($digitalizado->id);
    	
    	if( auth()->user()->email != "servisoft@disajcali.gov.co" ){
    	   	return view('digitalizacionPDos.Revisar', compact('digitalizado','estadoRadicado','llave23','visor','cd','digitales','expedientes','indices','demte','demdo','tipific','total','nombreRuta','PRODUCTOS','nombreRuta'));
    	}else{
    	    
    	     $revisar=   $this->Revisado();
    	     return $revisar;
    	    
    	}
    	
    
    }

    public function Revisado(){
    	$digitalizado = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	->orWhere('observaciones','!=', NULL)
    	->where('correccion', NULL)
    	->paginate(100);
    	
    	/*
    	    SELECT first_name, last_name, subsidiary_id, employee_id
  FROM employees
 WHERE( subsidiary_id    = NULL     OR NULL IS NULL )
   AND( employee_id      = NULL     OR NULL IS NULL )
   AND( UPPER(last_name) = 'WINAND' OR 'WINAND' IS NULL )
    	*/
    	
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
    	//->where('segunda_revision', NULL)
    	->where('observaciones','!=', NULL)
    	->select('estado')
    	->get();
    	
    	$SinR = count($digiCantidad);
    	$observa = count($digiCantidad1);
    	$cantidad = $SinR+$observa;
    	//dd($cantidad,$SinR,$observa);
    	
    //	$cantidad = count($digiCantidad);
    	
    	//dd($cantidad,$digitalizado);
    	
    	//dd('hola');
    	return view('digitalizacionPDos.digitalizacion', compact('digitalizado','cantidad','SinR','observa'));
  
    }
    
    public function update(Request $request,$id){
        
        //dd($request->all());
        
        
        $url=substr($request->nombreRuta, 0, 29);
        
        $resultado = str_replace($url,'', $request->nombreRuta);
        
        
    	
    	$digitalizado = ControlDigitalizacionProtoDos::findOrFail($id);
    	
        $digitalizado->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        //dd($digitalizado->fill($request->All()),$request->all());
        $digitalizado->reviso_id = auth()->user()->id;
        $digitalizado->reviso = auth()->user()->name. " ". auth()->user()->lastname;
        if($request->reporcesar == "SIN NOVEDAD"){
          $digitalizado->reviso_servisoft ="SIN NOVEDAD";  
        }
        
        $digitalizado->save();
        
       
        Session::flash('message', 'Informe actualizado correctamente');
        return redirect()->back();
    }
    
    //REVISION SERVISOFT
    public function RevisionSevisoft(Request $request,$id){
        //dd($request->all());
        $control = ControlDigitalizacionProtoDos::find($id); 
           $control->correccion =  $request['correccion'];
           $control->save(); 
           Session::flash('message', 'Se informa correcci&oacute;n, el proceso ser&aacute; revisado nuevamente');
           return redirect()->back();
        
    }
    
    
    //REGISTRO INVENTARIO
    
    public function registroInventario(Request $request){
        //dd('hola');
        $despachosRegistrados = RegistroDigitalizacion::distinct()->pluck('despacho','id_despacho');
        
        if(count($request->all())== 0){
    	  $inventarios = RegistroDigitalizacion::paginate(200);
    	//dd($digitalizado[0]);  
    	}else{
    	    $inventarios = RegistroDigitalizacion::where('id_despacho',$request->id_despacho)
        ->paginate(500);
    	}
        
         //$inventarios = Administrador::InventarioDigitalizacion()->paginate(200);
         
        //dd($inventarios);
        return view('digitalizacionPDos.InventarioDigitalizacion',compact('inventarios','despachosRegistrados'));
        
    }
    
    //DESCARGAR INVENTARIO DIGITALIZACION
    public function DescargarInvetarioD(Request $request){
        
        $despacho =$request->id_despacho;
        
        
        if(count($request->all())== 0){
        	 $verificar = RegistroDigitalizacion::all();
    
            if($verificar != null){
                
                Excel::create('Inventario Digitalizacion', function($excel) {
                    $excel->sheet('Inventario Digitalizacion', function($sheet) {
                        //otra opci贸n -> $products = Product::select('name')->get();
                        //$products = HistoricoComprobanteEntrega::excelcomprobante();
                        $products = DB::select("select radicado,demandante, demandado, id_despacho, despacho,folios,cuadernos,tipo_expediente,created_at , ciudad FROM `registro_digitalizacion` WHERE 1 ORDER BY id_despacho");
                        //dd($products);
                        $data= json_decode( json_encode($products), true);                
                        $sheet->fromArray($data);
                        $sheet->setOrientation('landscape');
                    });
                })->export('xlsx');
            }else{
                Session::flash('message', 'No se encontraron datos para generar el excel');
                
        	     $revisar=   $this->registroInventario();
        	     return $revisar;
        	  
            }
    	//dd($digitalizado[0]);  
    	}else{
    	     $verificar = RegistroDigitalizacion::where('id_despacho',$request->id_despacho)->first();
             $despacho =$request->id_despacho;
            if($verificar != null){
                Excel::create('Inventario Digitalizacion', function($excel)use($despacho) {
                    
                    $excel->sheet('Inventario Digitalizacion', function($sheet)use($despacho) {
                        //dd($despacho);
                        //otra opci贸n -> $products = Product::select('name')->get();
                        //$products = HistoricoComprobanteEntrega::excelcomprobante();
                        $products = DB::select('select radicado,demandante, demandado, id_despacho, despacho,folios,cuadernos,tipo_expediente,created_at , ciudad FROM `registro_digitalizacion` WHERE id_despacho = "'.$despacho.'" ORDER BY id_despacho');
                        //dd($products);
                        $data= json_decode( json_encode($products), true);                
                        $sheet->fromArray($data);
                        $sheet->setOrientation('landscape');
                    });
                })->export('xlsx');
            }else{
                Session::flash('message', 'No se encontraron datos para generar el excel');
                
        	     $revisar=   $this->registroInventario();
        	     return $revisar;
        	  
            }
    	    
    	}
        
         

    }
    
    //actualizar sin registro
    public function sinRegistro(Request $request,$id){
        //dd($request,$id);
        
        $control = ControlDigitalizacionProtoDos::find($id); 
           $control->estado = "SIN REGISTRO";
           $control->reviso =  auth()->user()->name.' '. auth()->user()->lastname;
           $control->fecha_revision =  date("Y-m-d");
           $control->save(); 
           Session::flash('message', 'Actualizado a Sin Registro');
           return redirect()->back();
    }
    
     //actualizar Corregido
    public function Corregido(Request $request,$id){
        //dd($request,$id);
        
        $control = ControlDigitalizacionProtoDos::find($id); 
           $control->estado = "CORREGIDO POR CSJ";
           $control->reviso =  auth()->user()->name.' '. auth()->user()->lastname;
           $control->reviso_servisoft = "se correge directamente en bestdoc por : ". auth()->user()->name.' '. auth()->user()->lastname;
           $control->fecha_revision =  date("Y-m-d");
           $control->correccion = "SE ACTUALIZA INFORMACION EN BESTDOC";
           $control->reviso_id =  auth()->user()->id;
           $control->save(); 
           Session::flash('message', 'Corregido');
           return redirect()->back();
    }
    
    public function saveReporte(Request $requets,$radicado){
        $total =0;
        //dd($requets->all(),$radicado);
        
        $proceso = new ControlDigitalizacionPDosPdf();

            $proceso->control_digitalizacion_id = $requets['radicado'];
            $proceso->nombre_pdf =  $requets['nombre_pdf'];
            $proceso->cantidad_paginas = $requets['cantidad_paginas'];
            $proceso->save();
            
            //$products = DB::select("SELECT SUM(cantidad_paginas) FROM `control_digitalizacion_pdf` WHERE control_digitalizacion_id ="+$requets['radicado']);
            
            $PRODUCTOS  = ControlDigitalizacionPDosPdf::where('control_digitalizacion_id',$requets['radicado'])->get();
            
            foreach($PRODUCTOS as $PROD){
                $total += (int)$PROD->cantidad_paginas;
            }
            
            $array = array();
        	array_push($array,$proceso);
            array_push($array, $total);
            
            
            
            
        if($requets->ajax())
        {
         
          return response()->json($array);
        }
            
        
    }
    
    
    //metodo para revisar las observaciones del contratista con respecto a las observaciones
     public function segundaRevision(){
         
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
    	//->where('segunda_revision', NULL)
    	->where('observaciones','!=', NULL)
    	->select('estado')
    	->get();
    	
    	$SinR = count($digiCantidad);
    	$observa = count($digiCantidad1);
    	$cantidad = $SinR+$observa;
    //	dd($cantidad,$SinR,$observa);
        
    	$digitalizado = ControlDigitalizacionProtoDos::where('correccion','!=',null)->paginate(100);
    	
    	//dd($digitalizado);
    	
    	//metodo para contar lo hecho por cada usuario
    	$estadisticaDigitalizacion = ControlDigitalizacionProtoDos::estadisticaDigitalizacionMes( auth()->user()->name.  auth()->user()->lastname);
    	
    	
    	if( auth()->user()->email != "servisoft@disajcali.gov.co"){
    	    //dd($digitalizado);
    	   	return view('digitalizacionPDos.segundaRevision', compact('digitalizado','estadisticaDigitalizacion'));
    	}else{
    	    
    	     $revisar=   $this->Revisado();
    	     return $revisar;
    	    
    	}
  
    }
    
    public function deletepdf(Request $requets,$id){
        
        $total= 0;
        
        $pdfid = ControlDigitalizacionPDosPdf::find($id);
         //dd($pdfid);
        
        $pdf = ControlDigitalizacionPDosPdf::destroy($id);
        
        
        
        $idCOntar=$pdfid->control_digitalizacion_id;
        //dd($idCOntar);
        
        
        $PRODUCTOS  = ControlDigitalizacionPDosPdf::where('control_digitalizacion_id',$idCOntar)->get();
        //dd($idCOntar,$PRODUCTOS);   
            foreach($PRODUCTOS as $PROD){
                $total += (int)$PROD->cantidad_paginas;
            }
            //dd($total);
        if($requets->ajax())
        {
         
          return response()->json($total);
        }
    }
    
        //DESCARGAR INVENTARIO DIGITALIZACION
        
   
    
    public function descarga(Request $request){
        
        $mes= $request->mes;
        
                $USER = auth()->user()->id;     
                
                 $data = DB::select('select  * FROM `control_digitalizacion_proto_dos` WHERE reviso_id = "'.$USER.'" AND fecha_revision LIKE "%2023-'.$mes.'%"');
                 //$data = ControlDigitalizacionProtoDos::where('reviso_id',$USER)->get();
                $collection = collect($data); 
               // dd($collection);
               
               /* return \Pdf::loadView('digitalizacionPDos.pdf.Reporte', $revisiones)
                    ->setPaper('a4', 'landscape')
                    ->download('Mis Revisiones.pdf');*/
                
                return view('digitalizacionPDos.pdf.Reporte',compact('collection'));
        

                  // share data to view
                  view()->share('revisiones',$data);
                  $pdf = Pdf::loadView('digitalizacionPDos.pdf.Reporte', $data);
            
                  // download PDF file with download method
                  return $pdf->setPaper('a4', 'landscape')
                  ->download('Mis Revisiones.pdf');
                        
                
               
    
                /*Excel::create('Inventario Digitalizacion', function($excel) use($USER) {
                    $excel->sheet('Inventario Digitalizacion', function($sheet)use($USER) {
                        //otra opci贸n -> $products = Product::select('name')->get();
                        //$products = HistoricoComprobanteEntrega::excelcomprobante();
                        $products = DB::select('select  * FROM `control_digitalizacion_proto_dos` WHERE reviso = "'.$USER.'" AND fecha_revision LIKE "%2022%"');
                        //dd($products);
                        $data= json_decode( json_encode($products), true);                
                        $sheet->fromArray($data);
                        $sheet->setOrientation('landscape');
                    });
                })->export('csv');*/
            
        
         

    }
    
    //ControlDigitalizacionProtoDos novedades
    public function novedades(){
         
    	
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
    	->where('observaciones','!=', NULL)
    	->select('estado')
    	->get();
    	
    	
    	$CorregidoUser =  ControlDigitalizacionProtoDos::where('reviso_servisoft','!=',null)
    	->where('reviso_servisoft','LIKE','%' . auth()->user()->name.' '. auth()->user()->lastname. '%' )
    	->get();
    	
    	$CorregidoUser= count($CorregidoUser);
    	//dd($CorregidoUser);
    	
    	$SinR = count($digiCantidad);
    	//$observa = count($digiCantidad1);
    	$observa = count($digitalizado);
    	$cantidad = $SinR+$observa;
    	//dd($cantidad,$SinR,$observa);
    	
    //	$cantidad = count($digiCantidad);
    	
    	//dd($cantidad,$digitalizado);
    	
    	
    	return view('digitalizacionPDos.novedadesProtoDos', compact('digitalizado','cantidad','SinR','observa','CorregidoUser'));
  
    }
    
    
     public function revisionServisoft(){
       
    	
    	$digitalizado = ControlDigitalizacionProtoDos::where('reviso_servisoft',"!=", NULL)
    	->where('correccion',"!=", NULL)
    	->where('reviso',"!=", NULL)
    	//->orWhere('observaciones','!=', NULL)
    	->get();
    	
    	
    	
    	$CorregidoUser =  ControlDigitalizacionProtoDos::where('reviso_servisoft',"!=", NULL)
    	->where('correccion',"!=", NULL)
    	->where('reviso',"!=", NULL)
    	->get()
    	->COUNT();
    	//dd($CorregidoUser);
    	
    	
    	
    	return view('digitalizacionPDos.corregidoPDos', compact('digitalizado','CorregidoUser'));
  
    }


}
