<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\ControlDigitalizacion;
use App\Models\ControlDigitalizacionSinRevisar;
use App\Models\ControlDigitalizacionPdf;
use Illuminate\Support\Facades\Route;
use App\Models\Administrador;

use App\Models\NormalizacionAsignados;
use App\RegistroDigitalizacion;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Auth;


class ControlDigitalizacionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('Digitalizacion');
        
    }

    public function index(Request $requets){
        
        $estadisticaDigitalizacion = ControlDigitalizacion::estadisticaDigitalizacionMes( auth()->user()->lastname);
        
    	
    	//dd($estadisticaDigitalizacion);
    	
    	if(count($requets->all())== 0){
    	  $digitalizado = ControlDigitalizacion::where('reviso',null)->paginate(150);
    	//dd($digitalizado[0]);  
    	}else{
    	    $digitalizado = ControlDigitalizacion::where('reviso',null)
        ->municipio($requets->municipio)
        ->radicado($requets->radicado)
        ->despacho($requets->despacho)
        ->especialidad($requets->especialidad)
        ->cantidad($requets->cantidad)
        //->orderBy('fecha_prgramada','ASC')
        ->paginate(100);
    	}
    	
    	
    	
    	$nombreRuta = request()->fullUrl();
    	
    	$url=substr($nombreRuta, 0, 29);
        
        $nombreRuta = str_replace($url,'', $nombreRuta);
    	
    	//dd($nombreRuta);
    	
    	if( auth()->user()->email != "servisoft@disajcali.gov.co" ){
    	    $expedientes =NormalizacionAsignados::where('registrado','nada')->GET();
    	    //dd($expedientes);
    	    $expedientesTomados =NormalizacionAsignados::where('user', auth()->user()->id)
    	    ->where('registrado',NULL)
    	    ->GET();
    	    return view('Normalizacion.normalizacion', compact('expedientes','expedientesTomados'));
    	    
    	  // return view('digitalizacion.index',compact('digitalizado','nombreRuta','estadisticaDigitalizacion')); 
    	}else{
    	    
    	    
    	    
    	     $revisar=   $this->Revisado();
    	     return $revisar;
    	    
    	}
    	
    	
  
    }
    
    

    public function porRevisar(){
        
    	$digitalizado = ControlDigitalizacion::where('reviso',null)->paginate(150);
    	$estadisticaDigitalizacion = ControlDigitalizacion::estadisticaDigitalizacionMes( auth()->user()->name);
        //dd($estadisticaDigitalizacion);
    	
    	//return view('digitalizacion.index', compact('reservas'));
    	
    	if( auth()->user()->email != "servisoft@disajcali.gov.co" ){
    	   	return view('digitalizacion.sinRevisar', compact('digitalizado','estadisticaDigitalizacion'));
    	}else{
    	    
    	     $revisar=   $this->Revisado();
    	     return $revisar;
    	    
    	}
  
    }
    
    public function revisar(Request $requets,$radicado){
        
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
        
    	$digitalizado = ControlDigitalizacion::findOrFail($radicado);
    	
    	$nombreRuta = $requets->nombreRuta;
    	
    	//dd($nombreRuta);
    	
    	
    	$PRODUCTOS  = ControlDigitalizacionPdf::where('control_digitalizacion_id',$radicado)->get();
            
            foreach($PRODUCTOS as $PROD){
                $total += (int)$PROD->cantidad_paginas;
            }
        //array para guardar la informacion de la consulta de pdfs
        
    	//dd($digitalizado->id);
    	
    	if( auth()->user()->email != "servisoft@disajcali.gov.co" ){
    	   	return view('digitalizacion.Revisar', compact('digitalizado','estadoRadicado','llave23','visor','cd','digitales','expedientes','indices','demte','demdo','tipific','total','nombreRuta','PRODUCTOS','nombreRuta'));
    	}else{
    	    
    	    
    	    // $revisar=   $this->Revisado();
    	    // return $revisar;
    	    
    	}
    	
    
    }
    
    public function TomarRadicados(Request $request,$id){
        
        $expediente =NormalizacionAsignados::where('radicado',$id)->GET();
        
         if(empty($expediente->user) ||  $expediente->user ==  auth()->user()->id){
               $ficha = NormalizacionAsignados::findOrFail($expediente->id); 
               $ficha->user =  auth()->user()->id;
               $ficha->save();
            }else{
                Session::flash('message', 'OTRO USUARIO YA TOMO EL RADICADO!');
                return Redirect::back();
            }
    }
    
    

    public function Revisado(){
    	$digitalizado = ControlDigitalizacion::where('reviso','!=',null)
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
    	$digiCantidad = ControlDigitalizacion::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	//->where('segunda_revision', NULL)
    	//->where('correccion','!=', NULL)
    	->select('estado')
    	->get();
    	
    	$digiCantidad1 = ControlDigitalizacion::where('reviso','!=',null)
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
    	
    	
    	return view('digitalizacion.digitalizacion', compact('digitalizado','cantidad','SinR','observa'));
  
    }
    
    public function update(Request $request,$id){
        
       // dd($request->all());
        
        $url=substr($request->nombreRuta, 0, 29);
        
        $resultado = str_replace($url,'', $request->nombreRuta);
        
        
    	
    	$digitalizado = ControlDigitalizacion::findOrFail($id);
        $digitalizado->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $digitalizado->save();
       
        Session::flash('message', 'Usuario actualizado correctamente');
        return redirect()->back();
    }
    
    //REVISION SERVISOFT
    public function RevisionSevisoft(Request $request,$id){
        //dd($request->all());
        $control = ControlDigitalizacion::find($id); 
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
        return view('digitalizacion.InventarioDigitalizacion',compact('inventarios','despachosRegistrados'));
        
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
        
        $control = ControlDigitalizacion::find($id); 
           $control->estado = "SIN REGISTRO";
           $control->reviso =  auth()->user()->name.' '. auth()->user()->lastname;
           $control->save(); 
           Session::flash('message', 'Actualizado a Sin Registro');
           return redirect()->back();
    }
    
    public function saveReporte(Request $requets,$radicado){
        $total =0;
        //dd($requets->all(),$radicado);
        
        $proceso = new ControlDigitalizacionPdf();

            $proceso->control_digitalizacion_id = $requets['radicado'];
            $proceso->nombre_pdf =  $requets['nombre_pdf'];
            $proceso->cantidad_paginas = $requets['cantidad_paginas'];
            $proceso->save();
            
            //$products = DB::select("SELECT SUM(cantidad_paginas) FROM `control_digitalizacion_pdf` WHERE control_digitalizacion_id ="+$requets['radicado']);
            
            $PRODUCTOS  = ControlDigitalizacionPdf::where('control_digitalizacion_id',$requets['radicado'])->get();
            
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
    	$digiCantidad = ControlDigitalizacion::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	//->where('segunda_revision', NULL)
    	//->where('correccion','!=', NULL)
    	->select('estado')
    	->get();
    	
    	$digiCantidad1 = ControlDigitalizacion::where('reviso','!=',null)
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
        
    	$digitalizado = ControlDigitalizacion::where('correccion','!=',null)->paginate(100);
    	
    	//dd($digitalizado);
    	
    	//metodo para contar lo hecho por cada usuario
    	$estadisticaDigitalizacion = ControlDigitalizacion::estadisticaDigitalizacionMes( auth()->user()->name);
    	
    	
    	if( auth()->user()->email != "servisoft@disajcali.gov.co"){
    	    //dd($digitalizado);
    	   	return view('digitalizacion.segundaRevision', compact('digitalizado','estadisticaDigitalizacion'));
    	}else{
    	    
    	     $revisar=   $this->Revisado();
    	     return $revisar;
    	    
    	}
  
    }
    
    public function deletepdf(Request $requets,$id){
        
        $total= 0;
        
        $pdfid = ControlDigitalizacionPdf::find($id);
         //dd($pdfid);
        
        $pdf = ControlDigitalizacionPdf::destroy($id);
        
        
        
        $idCOntar=$pdfid->control_digitalizacion_id;
        //dd($idCOntar);
        
        
        $PRODUCTOS  = ControlDigitalizacionPdf::where('control_digitalizacion_id',$idCOntar)->get();
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


}
