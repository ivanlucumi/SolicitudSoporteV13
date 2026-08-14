<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\ControlDigitalizacion;
use App\Models\ControlDigitalizacionProtoDos;
use App\Models\ControlDigitalizacionSinRevisar;
use App\Models\ControlDigitalizacionPdf;
use Illuminate\Support\Facades\Route;
use App\Models\Administrador;
use App\Models\RegistroDigitalizacion;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Auth;


class ServisoftController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('Servisoft');
        
    }




    //REVISION SERVISOFT
    public function RevisionSevisoft(Request $request,$id){
        //dd($request->all());
        $control = ControlDigitalizacion::find($id); 
           $control->correccion =  $request['correccion'];
           $control->reviso_servisoft =  auth()->user()->name.' '. auth()->user()->lastname;
           $control->save(); 
           Session::flash('message', 'Se informa correcci&oacute;n, el proceso ser&aacute; revisado nuevamente');
           return redirect()->back();
        
    }
    
       //REVISION SERVISOFT PROTOCOLO DOS
    public function RevisionSevisoftPDos(Request $request,$id){
        //dd($request->all());
        $control = ControlDigitalizacionProtoDos::find($id); 
           $control->correccion =  $request['correccion'];
           $control->reviso_servisoft =  auth()->user()->name.' '. auth()->user()->lastname;
           $control->save(); 
           Session::flash('message', 'Se informa correccion, el proceso sera revisado nuevamente');
           return redirect()->back();
        
    }
    
    //ControlDigitalizacionProtoDos
     public function RevisadoPDos(){
         
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
    	
    	
    	return view('servisoft.revisadoPDos', compact('digitalizado','cantidad','SinR','observa','CorregidoUser'));
  
    }
    
    //PROTOCOLO 1
    
    public function Revisado(){
    	$digitalizado = ControlDigitalizacion::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	->orWhere('observaciones','!=', NULL)
    	->where('correccion', NULL)
    	->paginate(100);
    
    	
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
    	
    	
    	$CorregidoUser =  ControlDigitalizacion::where('reviso_servisoft','!=',null)
    	->where('reviso_servisoft','LIKE','%' . auth()->user()->name.' '. auth()->user()->lastname. '%' )
    	->get();
    	
    	$CorregidoUser= count($CorregidoUser);
    	//dd($CorregidoUser);
    	
    	$SinR = count($digiCantidad);
    	$observa = count($digiCantidad1);
    	$cantidad = $SinR+$observa;
    	//dd($cantidad,$SinR,$observa);
    	
    //	$cantidad = count($digiCantidad);
    	
    	//dd($cantidad,$digitalizado);
    	
    	
    	return view('servisoft.revisado', compact('digitalizado','cantidad','SinR','observa','CorregidoUser'));
  
    }
    
    
    //metodos para descargar de invetario de digitalizacion
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
       // dd('hola');
        
        $despacho =$request->id_despacho;
          
        
        if(count($request->all())== 0){
        	 $verificar = RegistroDigitalizacion::all();
        	 
    
            if($verificar != null){
               /* Excel::create('Inventario Digitalizacion', function($excel) {
                    $excel->sheet('Inventario Digitalizacion', function($sheet) {
                        //otra opci贸n -> $products = Product::select('name')->get();
                        //$products = HistoricoComprobanteEntrega::excelcomprobante();
                        $products = DB::select("select radicado,demandante, demandado, id_despacho, despacho,folios,cuadernos,tipo_expediente,created_at , ciudad FROM `registro_digitalizacion` WHERE 1 ORDER BY id_despacho");
                        //dd($products);
                        $data= json_decode( json_encode($products), true);                
                        $sheet->fromArray($data);
                        $sheet->setOrientation('landscape');
                    });
                })->export('csv');*/
                 $products = DB::select("select radicado,demandante, demandado, id_despacho, despacho,folios,cuadernos,tipo_expediente,created_at , ciudad FROM `registro_digitalizacion` WHERE 1 ORDER BY id_despacho");
                 $collection = collect($products); 
                  return view('servisoft.inventario',compact('collection'));
        
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
               /* Excel::create('Inventario Digitalizacion', function($excel)use($despacho) {
                    
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
                })->export('csv');*/
                $products = DB::select('select radicado,demandante, demandado, id_despacho, despacho,folios,cuadernos,tipo_expediente,created_at , ciudad FROM `registro_digitalizacion` WHERE id_despacho = "'.$despacho.'" ORDER BY id_despacho');
               $collection = collect($products); 
                  return view('servisoft.inventario',compact('collection'));      
            }else{
                Session::flash('message', 'No se encontraron datos para generar el excel');
                
        	     $revisar=   $this->registroInventario();
        	     return $revisar;
        	  
            }
    	    
    	}
        
         

    }
   
}
