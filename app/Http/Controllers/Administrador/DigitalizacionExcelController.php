<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\RegistroIncidentesMercurioController;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Excel;
use App\Models\ControlDigitalizacion;
use App\Models\ControlDigitalizacionProtoDos;
use App\Models\ControlDigitalizacionSinRevisar;
use App\Models\ControlDigitalizacionPdf;
use Illuminate\Support\Facades\Route;
use App\Models\Administrador;

use App\Models\RegistroIncidentesMercurio;

class DigitalizacionExcelController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

    public function index()
    {
        $dia0=null;
        $dia1=null;
        $dia2=null;
        $dia3=null;
        $dia4=null;
        
        $fecha0=null;
        $fecha1=null;
        $fecha2=null;
        $fecha3=null;
        $fecha4=null;
        
        $consulta0 = Carbon::now()->toDateString();
        $fecha0=$consulta0;
        $dia0=Administrador::estadisticaDigitalizacionPDosDia($consulta0);
        
        
        $consulta1 = Carbon::now()->subDays(1)->toDateString();
        $fecha1=$consulta1;
        $dia1=Administrador::estadisticaDigitalizacionPDosDia($consulta1);
        
        
        $consulta2 = Carbon::now()->subDays(2)->toDateString();
        $fecha2=$consulta2;
        $dia2=Administrador::estadisticaDigitalizacionPDosDia($consulta2);
        
        $consulta3 = Carbon::now()->subDays(3)->toDateString();
        $fecha3=$consulta3;
        $dia3=Administrador::estadisticaDigitalizacionPDosDia($consulta3);
        
        $consulta4 = Carbon::now()->subDays(4)->toDateString();
        $fecha4=$consulta4;
        $dia4=Administrador::estadisticaDigitalizacionPDosDia($consulta4);
        

       /* for($dia=1; $dia<=5; $dia++){
           $diaS = Carbon::now()->subDays($dia)->dayOfWeek;
              //PROTOCOLO 2 fechas
            $consultaD = Carbon::now()->subDays($dia)->toDateString();
            
            ${"dia" . $dia} = Administrador::estadisticaDigitalizacionPDosDia($consultaD);
            ${"fecha" . $dia} = Carbon::now()->subDays($dia)->toDateString();
           
        }*/
        
        //dd($dia0,$dia1);
      
        $cantidadRevidadaPDos = ControlDigitalizacionProtoDos::where('correccion','!=',null)->count();

        //PROTOCOLO 1
        $estadisticaDigitalizacion = Administrador::estadisticaDigitalizacionMes();
        
        //PROTOCOLO 2 2021
        $estadisticaDigitalizacionPDos = Administrador::estadisticaDigitalizacionMesPDos2021();
         //PROTOCOLO 2 2022
        $estadisticaDigitalizacionPDos2022 = Administrador::estadisticaDigitalizacionMesPDos2022();
        
        $proto2Folios = Administrador::totalidadFolios();
        $proto2FoliosRevi = Administrador::totalidadFoliosRevisados();

       
        //conteo de revision de servisoft
        $revisionServisoft = Administrador::estadisticaRevisionServisof();
        //conteo de revision de servisoft PROTOCOLO2
        $revisionServisoftPDos = Administrador::estadisticaRevisionServisofPDos();
        
        //total almacenado en la db
        $conteoExpedientes = Administrador::TotalDigitalizacion();
        //total almacenado en la db PROTOCOLO2
        $conteoExpedientesPDos = Administrador::TotalDigitalizacionPDos();
        //dd($conteoExpedientes);
        
        $digitalizado = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	->where('segunda_revision', NULL)
    	->orWhere('observaciones','!=', NULL)
    	->paginate(300);
    	
    	    	//CONTAR REVISIONES PROTOCOLO 1
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
    	
    	   	//CONTAR REVISIONES PROTOCOLO 2
    	$digiCantidadPDos = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	//->where('segunda_revision', NULL)
    	//->where('correccion','!=', NULL)
    	->where('fecha_revision','>', 2022-04-17)
    	->select('estado')
    	->get();
    	
    	$digiCantidad1PDos = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado','!=',"SIN REGISTRO")
    	->where('correccion', NULL)
    	//->where('segunda_revision', NULL)
    	->where('observaciones','!=', NULL)
    	->where('fecha_revision','>', 2022-04-17)
    	->select('estado')
    	->get();
    	
    	$digiCantidad1PDosOk = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('fecha_revision','LIKE', "%2022%")
    	->where('observaciones', NULL)
    	->where('estado', "REGISTRO")
    	->select('estado')
    	->get();
    	
    	$cantidadOk=count($digiCantidad1PDosOk);
    	
    	$SinRPDos = count($digiCantidadPDos);
    	$observaPDos = count($digiCantidad1PDos);
    	$cantidadPDos = $SinRPDos+$observaPDos;

        $incidentesTotal= RegistroIncidentesMercurio::where('solucion', null)->count();
        $resueltosTotal= RegistroIncidentesMercurio::where('solucion','!=', null)->count();
     // dd($incidentesTotal,$resueltosTotal);
    	
    	//dd($cantidad,$digitalizado);
    	//dd($dia1,$fecha1);
    	
    	return view('administrador.excel.digitalizacion', compact('digitalizado','cantidad','estadisticaDigitalizacion', 'conteoExpedientes','SinR','observa','revisionServisoft',
    	'SinRPDos','observaPDos','cantidadPDos','estadisticaDigitalizacionPDos','revisionServisoftPDos','conteoExpedientesPDos',
    'dia0','dia1','dia2','dia3','dia4','fecha0','fecha1','fecha2','fecha3','fecha4','estadisticaDigitalizacionPDos2022',
    'cantidadOk','proto2Folios','proto2FoliosRevi','cantidadRevidadaPDos','incidentesTotal','resueltosTotal'));
  
    	
       // return view('administrador.excel.digitalizacion');
    } 



    public function store(Request $request){

       //dd($request);

     /* $tmp_name = $_FILES['file']['tmp_name'];
        if( move_uploaded_file($tmp_name, $tmp_name) ){
        $mensaje=   $this->llenarBaseDeDatos( $tmp_name );
        }
        return $mensaje;*/
        
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


    //Llena toda las BD según el archivo de programación académica (excepto la tabla usuarios y registros)
    private function llenarBaseDeDatos( $nombreDelArchivo ){

        set_time_limit (1000 );
        ini_set('memory_limit','512M');
        //dd($nombreDelArchivo);

        Excel::load( $nombreDelArchivo, function($reader) {

            $datos = $reader->toArray();
            //dd($datos);
            //dd(array_chunk($datos, 1000));
             
             $this->actualizarDirectorio($datos);
        });

	
       return Redirect::to('/administrador/store/almacenar/registro/digitalizacion');


    }
    
    
    private function actualizarDirectorio($datos)
    {
        $no_subio = array();
        
        $contar = 0;
        
        $variables = array_chunk($datos, 1200);
       
      foreach ($datos as $registro) 
        {
            //dd($registro['radicacion']);
            
            $consulta = ControlDigitalizacion::where('radicacion',$registro['radicacion'])
            //->where('despacho','LIKE','%' .$registro['despacho'].'%' )
            ->where('municipio','LIKE','%' .$registro['municipio'].'%')
           // ->where('especialidad','LIKE','%' .$registro['especialidad'].'%')
            //->where('cantidad',$registro['cantidad'])
           // ->where('reviso','!=',null)
           ->first();
           
          // dd(empty($consulta));
            
            if(empty($consulta)){
                
                if( $registro['radicacion'] != null && $registro['despacho'] != null && $registro['municipio'] != null  && $registro['especialidad'] != null && $registro['cantidad'] != null )
                {
                    //dd(strlen($registro['radicacion']));
                    
                   /* if(strlen($registro['radicacion'])>23){
                        
                       // $no_subio = array();
                        array_push($mayor_23, $registro['radicacion']);
                        
                    }else{*/
                        
                     //dd($registro['radicacion']);   
                        
                         ControlDigitalizacion::create(
                    ['radicacion' => $registro['radicacion'],
                    'despacho' => strtoupper($registro['despacho']),
                     'municipio' => strtoupper($registro['municipio']),
                     'especialidad' => strtoupper($registro['especialidad']),
                     'cantidad' => $registro['cantidad'], 	
                     /*'fecha_digitalizacion' => $registro['fecha'],
                     'llave_digitos_23' => $registro['llave_digitos_23'],
                     'no_pdf' => $registro['no_pdf'],
                     'visor' => $registro['visor'],
                     'cd' => $registro['cd'],
                     'ver_video' => $registro['ver_video'],
                    'indice' => $registro['indice'],
                     'ver_exp_completo' => $registro['ver_exp_completo'],
                     'observaciones' => $registro['observaciones'],
                     'demandante' => $registro['demandante'],
                     'demandado' => $registro['demandado'],
                     'tipificacion' => $registro['tipificacion'],
                     'reviso' => $registro['reviso'],
                     'fecha_revision' => $registro['fecha_revision']*/]);
                     $contar++;
                        
                  //  }
                    

                     }
                     
            }else{
                
                array_push($no_subio, $registro['radicacion']);
            }
            
               
                
            
          
        }//cierre de foreach
       
        
        //dd($asignatura[0]->id);
        //Por cada registro del archivo excel...
        
        dd($contar,$no_subio);
       // dd('termino',$registro['radicacion'],$registro['despacho'],$registro['municipio'],$registro['especialidad'],$registro['cantidad']);
                return Redirect::to('/administrador/store/almacenar/registro/digitalizacion');
        
        //dd($mayor_23);

    }
    
   //verificar observaciones protocoloo dos
   
   public function ObservacionesProtoDos(){
       
        
        //PROTOCOLO 2 2021
        $estadisticaDigitalizacionPDos = Administrador::estadisticaDigitalizacionMesPDos2021();
         //PROTOCOLO 2 2022
        $estadisticaDigitalizacionPDos2022 = Administrador::estadisticaDigitalizacionMesPDos2022();
        
        $proto2Folios = Administrador::totalidadFolios();
        $proto2FoliosRevi = Administrador::totalidadFoliosRevisados();

       
        //conteo de revision de servisoft
        $revisionServisoft = Administrador::estadisticaRevisionServisof();
        //conteo de revision de servisoft PROTOCOLO2
        $revisionServisoftPDos = Administrador::estadisticaRevisionServisofPDos();
        
        //total almacenado en la db
        $conteoExpedientes = Administrador::TotalDigitalizacion();
        //total almacenado en la db PROTOCOLO2
        $conteoExpedientesPDos = Administrador::TotalDigitalizacionPDos();
        //dd($conteoExpedientes);
        
        $digitalizado = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	->where('segunda_revision', NULL)
    	->orWhere('observaciones','!=', NULL)
    	->paginate(100);
    	
    	    	//CONTAR REVISIONES PROTOCOLO 1
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
    	
    	   	//CONTAR REVISIONES PROTOCOLO 2
    	$digiCantidadPDos = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	//->where('segunda_revision', NULL)
    	//->where('correccion','!=', NULL)
    	->select('estado')
    	->get();
    	
    	$digiCantidad1PDos = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado','!=',"SIN REGISTRO")
    	->where('correccion', NULL)
    	//->where('segunda_revision', NULL)
    	->where('observaciones','!=', NULL)
    	->select('estado')
    	->get();
    	
    	$digiCantidad1PDosOk = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('fecha_revision','LIKE', "%2022%")
    	->where('observaciones', NULL)
    	->where('estado', "REGISTRO")
    	->select('estado')
    	->get();
    	
    	$cantidadOk=count($digiCantidad1PDosOk);
    	
    	$SinRPDos = count($digiCantidadPDos);
    	$observaPDos = count($digiCantidad1PDos);
    	$cantidadPDos = $SinRPDos+$observaPDos;
    	
       	$digitalizado = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	->orWhere('observaciones','!=', NULL)
    	->where('correccion', NULL)
    	->orderBy('fecha_revision', 'DESC')
    	->paginate(300);
    
    	return view('administrador.protocoloDos.observaciones', compact('digitalizado','cantidad', 'conteoExpedientes','SinR','observa','revisionServisoft',
    	'SinRPDos','observaPDos','cantidadPDos','estadisticaDigitalizacionPDos','revisionServisoftPDos','conteoExpedientesPDos','estadisticaDigitalizacionPDos2022','cantidadOk','proto2Folios','proto2FoliosRevi'));
   }
   
    public function RevisadosProtoDos(){
       
       //dd('hola');
        
        //PROTOCOLO 2 2021
        $estadisticaDigitalizacionPDos = Administrador::estadisticaDigitalizacionMesPDos2021();
         //PROTOCOLO 2 2022
        $estadisticaDigitalizacionPDos2022 = Administrador::estadisticaDigitalizacionMesPDos2022();
        
        $proto2Folios = Administrador::totalidadFolios();
        $proto2FoliosRevi = Administrador::totalidadFoliosRevisados();

       
        //conteo de revision de servisoft
        $revisionServisoft = Administrador::estadisticaRevisionServisof();
        //conteo de revision de servisoft PROTOCOLO2
        $revisionServisoftPDos = Administrador::estadisticaRevisionServisofPDos();
        
        //total almacenado en la db
        $conteoExpedientes = Administrador::TotalDigitalizacion();
        //total almacenado en la db PROTOCOLO2
        $conteoExpedientesPDos = Administrador::TotalDigitalizacionPDos();
        //dd($conteoExpedientes);
        
        $digitalizado = ControlDigitalizacionProtoDos::where('correccion','!=', NULL)
        //->OrWhere('observaciones',null)
    	->paginate(100);
    	//dd($digitalizado);
    	
    	    	//CONTAR REVISIONES PROTOCOLO 1
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
    	
    	   	//CONTAR REVISIONES PROTOCOLO 2
    	$digiCantidadPDos = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado',"SIN REGISTRO")
    	->where('correccion', NULL)
    	//->where('segunda_revision', NULL)
    	//->where('correccion','!=', NULL)
    	->select('estado')
    	->get();
    	
    	$digiCantidad1PDos = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('estado','!=',"SIN REGISTRO")
    	->where('correccion', NULL)
    	//->where('segunda_revision', NULL)
    	->where('observaciones','!=', NULL)
    	->select('estado')
    	->get();
    	
    	$digiCantidad1PDosOk = ControlDigitalizacionProtoDos::where('reviso','!=',null)
    	->where('fecha_revision','LIKE', "%2022%")
    	->where('observaciones', NULL)
    	->where('estado', "REGISTRO")
    	->select('estado')
    	->get();
    	
    	$cantidadOk=count($digiCantidad1PDosOk);
    	
    	$SinRPDos = count($digiCantidadPDos);
    	$observaPDos = count($digiCantidad1PDos);
    	$cantidadPDos = $SinRPDos+$observaPDos;
    	
       	
    	
    	return view('administrador.protocoloDos.observacionesRevisadas', compact('digitalizado','cantidad', 'conteoExpedientes','SinR','observa','revisionServisoft',
    	'SinRPDos','observaPDos','cantidadPDos','estadisticaDigitalizacionPDos','revisionServisoftPDos','conteoExpedientesPDos','estadisticaDigitalizacionPDos2022','cantidadOk','proto2Folios','proto2FoliosRevi'));
   }


   /* private function actualizarDirectorio($datos)
    {
        $no_subio = array();
        
        $contar = 0;
        
        $variables = array_chunk($datos, 1200);
        
        foreach($variables as $variable){
           // dd($variable);
            foreach ($datos as $registro) 
        {
            //dd($registro['radicacion']);
            
            $consulta = ControlDigitalizacion::where('radicacion',$registro['radicacion'])
            //->where('despacho','LIKE','%' .$registro['despacho'].'%' )
            ->where('municipio','LIKE','%' .$registro['municipio'].'%')
           // ->where('especialidad','LIKE','%' .$registro['especialidad'].'%')
            //->where('cantidad',$registro['cantidad'])
           // ->where('reviso','!=',null)
           ->first();
           
          // dd(empty($consulta));
            
            if(empty($consulta)){
                
                if( $registro['radicacion'] != null && $registro['despacho'] != null && $registro['municipio'] != null  && $registro['especialidad'] != null && $registro['cantidad'] != null )
                {
                    //dd(strlen($registro['radicacion']));
                    
                   /* if(strlen($registro['radicacion'])>23){
                        
                       // $no_subio = array();
                        array_push($mayor_23, $registro['radicacion']);
                        
                    }else{*/
                        
                     //dd($registro['radicacion']);   
                        
                        /* ControlDigitalizacion::create(
                    ['radicacion' => $registro['radicacion'],
                    'despacho' => strtoupper($registro['despacho']),
                     'municipio' => strtoupper($registro['municipio']),
                     'especialidad' => strtoupper($registro['especialidad']),
                     'cantidad' => $registro['cantidad'], 	
                     'fecha_digitalizacion' => $registro['fecha'],
                     'llave_digitos_23' => $registro['llave_digitos_23'],
                     'no_pdf' => $registro['no_pdf'],
                     'visor' => $registro['visor'],
                     'cd' => $registro['cd'],
                     'ver_video' => $registro['ver_video'],
                    'indice' => $registro['indice'],
                     'ver_exp_completo' => $registro['ver_exp_completo'],
                     'observaciones' => $registro['observaciones'],
                     'demandante' => $registro['demandante'],
                     'demandado' => $registro['demandado'],
                     'tipificacion' => $registro['tipificacion'],
                     'reviso' => $registro['reviso'],
                     'fecha_revision' => $registro['fecha_revision']]);
                     $contar++;
                        
                  //  }
                    

                     }
                     
            }else{
                
                array_push($no_subio, $registro['radicacion']);
            }
            
               
                
            
          
        }//cierre de foreach
        }
        
        //dd($asignatura[0]->id);
        //Por cada registro del archivo excel...
        
        dd($contar,$no_subio);
       // dd('termino',$registro['radicacion'],$registro['despacho'],$registro['municipio'],$registro['especialidad'],$registro['cantidad']);
                return Redirect::to('/administrador/store/almacenar/registro/digitalizacion');
        
        //dd($mayor_23);

    }
    
*/
    
    
    

}
