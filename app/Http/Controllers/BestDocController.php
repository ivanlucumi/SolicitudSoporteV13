<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\BestdocImports;
use App\Imports\EstadoExpedienteImports;
use App\Models\MigracionBestdoc;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Excel;


class BestDocController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('checarsesion');
        //$this->middleware('cambiopass');
        //$this->middleware('administrador');
        
    }
    //
     public function index(){

        return view('administrador.excel.Bestdoc');
    }
    
     public function store(Request $request){

        $tmp_name = $_FILES['file']['tmp_name'];
        
        $file_tmp = $_FILES['file']['tmp_name'];
        //dd($file_tmp);
        $file_name = $_FILES['file']['name'];
        //dd($file_name);
        $file_destination = '..' . $file_name;
       //dd( move_uploaded_file($file_tmp, $file_destination));


        if( move_uploaded_file($file_tmp, $file_destination) ){
            //dd('entro');

        $mensaje=   $this->llenarBaseDeDatos( $file_destination );

        }

        return $mensaje;
    }
    
    public function llenarBaseDeDatos($nombreDelArchivo){
        
        set_time_limit (920);
        ini_set('memory_limit','512M');
       // dd($nombreDelArchivo);
       
       
        //$import = new ProtocoloDosImportar();
        $import = new BestdocImports();
        $data = Excel::import($import, $nombreDelArchivo);
        
        dd($data);
        
	
       return Redirect::to('/administrador/carga/excel/migracion/bestdoc');

    }
    
    
     public function index_archivo(){

        return view('administrador.excel.EstadoExpediente');
    }
    
     public function store_archivo(Request $request){
        //dd('hola');
        $tmp_name = $_FILES['file']['tmp_name'];
        
        $file_tmp = $_FILES['file']['tmp_name'];
        //dd($file_tmp);
        $file_name = $_FILES['file']['name'];
        //dd($file_name);
        $file_destination = '..' . $file_name;
       //dd( move_uploaded_file($file_tmp, $file_destination));


        if( move_uploaded_file($file_tmp, $file_destination) ){
            //dd('entro');

        $mensaje=   $this->llenarBaseDeDatosEstadoExpediente( $file_destination );

        }

        return $mensaje;
    }
    
    public function llenarBaseDeDatosEstadoExpediente($nombreDelArchivo){
        
        set_time_limit (920);
        ini_set('memory_limit','512M');
       //dd($nombreDelArchivo);
       
       
        //$import = new ProtocoloDosImportar();
        $import = new EstadoExpedienteImports();
        $data = Excel::import($import, $nombreDelArchivo);
        
        //dd($data);
        
	
       return Redirect::to('administrador/carga/excel/estado/archivo');

    }
    
    
    
    
    public function revision_index(Request $requets){
        
        $meses = ['01' => 'ENERO', '02' => 'FEBRERO', '03' => 'MARZO','04'=>'ABRIL','05'=>'MAYO','06' => 'JUNIO', '07' => 'JULIO',
       '08' => 'AGOSTO','09'=>'SEPTIEMBRE','10'=>'OCTUBRE','11' => 'NOVIEMBRE', '12' => 'DICIEMBRE'];
       
       $revisados= MigracionBestdoc::where('reviso', auth()->user()->id)
       ->count();
      // dd($revisados);
       
       
       $despachos=  MigracionBestdoc::distinct()->get(['despacho'])
       ->pluck('despacho','despacho');
       
       $TotalTransferencia =  null;
       
       	if(count($requets->all())== 0){
        	  $listado = MigracionBestdoc::where('repetido_en_excel',null)
        	  ->where('reviso',null)
        	  //->where('asignado_a',null)
              ->orderBy('despacho','ASC')
        	  ->paginate(1000);
        	//dd($digitalizado[0]);  
        	}else{
        	    $listado = MigracionBestdoc::where('reviso',null)
        	  ->where('repetido_en_excel',null)
        	  ->radicado($requets->radicado)
        	  ->despacho($requets->despacho)
            //->municipio($requets->municipio)
            //->radicado($requets->radicado)
             //->orderBy('despacho','asignado_a','ASC')
            ->paginate(1000);
            //->get();
        	}
        	//dd($listado);
        	//DIGITALIZACION
        	if( auth()->user()->rol == 11 ){
        	   return view('digitalizacionPDos.bestdoc.digitalizacion',compact('listado','despachos','meses','TotalTransferencia','revisados')); 
        	}
        	//SERVISOFT
        	if( auth()->user()->rol == 12 ){
        	   return view('digitalizacionPDos.bestdoc.servisoft',compact('listado','despachos','meses','TotalTransferencia','revisados')); 
        	}
        	//ADMINISTRADOR
        	if( auth()->user()->rol == 1 ){
        	   return view('digitalizacionPDos.bestdoc.admin',compact('listado','despachos','meses','TotalTransferencia','revisados')); 
        	}
        
    }
    
    public function Registro_revision(Request $request,$id){
        //dd($request,$id);
        
        $control = MigracionBestdoc::find($id); 
        if($control->asignado_a == null || $control->asignado_a == auth()->user()->id  ){
           $control->asignado_a =  auth()->user()->id;
           $control->reviso =  auth()->user()->name.' '. auth()->user()->lastname;
           $control->fecha_traslado =  date("Y-m-d");
           $control->estado =  "CARGADO A BESTDOC";
           $control->save(); 
           Session::flash('message', 'Se Registro como Cargado');
           return redirect()->back();
        }else{
        Session::flash('message', 'Radicado no se puede tomar, ya esta asignado');
        return redirect()->back(); 
        }
    }
    
    public function Asignar_revision(Request $request,$id){
        $control = MigracionBestdoc::find($id); 
        if($control->asignado_a == null || $control->asignado_a == auth()->user()->id  ){
          $control->asignado_a =  auth()->user()->id;
        $control->save(); 
        Session::flash('message', 'Radicacion Asignada');
        return redirect()->back();  
        }else{
        Session::flash('message', 'Radicado no se puede tomar, ya esta asignado');
        return redirect()->back(); 
        }
        
    }
    
     public function descarga(Request $request){
        
                $mes= $request->mes;
        
                $USER = auth()->user()->id;     
                
                 $data = DB::select('select  * FROM `control_migracion_bestdoc` WHERE asignado_a = "'.$USER.'"AND reviso is not null AND fecha_traslado LIKE "%2022-'.$mes.'%"');
                $listado = collect($data); 
               
               /* return \Pdf::loadView('digitalizacionPDos.pdf.Reporte', $revisiones)
                    ->setPaper('a4', 'landscape')
                    ->download('Mis Revisiones.pdf');*/
                
                return view('digitalizacionPDos.pdf.ReporteBestDoc',compact('listado'));
        

                  // share data to view
                  view()->share('revisiones',$data);
                  $pdf = Pdf::loadView('digitalizacionPDos.pdf.Reporte', $data);
            
                  // download PDF file with download method
                  return $pdf->setPaper('a4', 'landscape')
                  ->download('Cargas a Bestdoc.pdf');
                        
              

    }
    
    public function revision(Request $request){
        dd($request->all());
        
        
        
    }
    
}
