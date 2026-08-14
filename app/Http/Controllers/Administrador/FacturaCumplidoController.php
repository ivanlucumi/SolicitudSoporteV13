<?php
namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\FacturaCumplido;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


class FacturaCumplidoController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

     public function index()
    {
    	$registro = null;
        return view('administrador.excel.facturasCumplido',compact('registro'));
    } //
    
        public function store(Request $request){
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

        $mensaje=   $this->llenarBaseDeDatos( $file_destination );

        }

        return $mensaje;
    }
    
        //Llena toda las BD según el archivo de programación académica (excepto la tabla usuarios y registros)
    private function llenarBaseDeDatos( $nombreDelArchivo ){

        set_time_limit (120);
        ini_set('memory_limit','512M');
       // dd($nombreDelArchivo);

        Excel::load( $nombreDelArchivo, function($reader) {
//dd($reader->toArray());
            $datos = $reader->toArray();
            //dd($datos);
             
             $this->FacturasCumplido($datos);
        });

	
       return Redirect::to('/administrador/cargar/excel/factura/cumplido');


    }
    
    private function FacturasCumplido($datos)
    {
        //dd($datos);
       
        foreach ($datos as $key => $registro) 
       {   
           
                if( $registro['num_cumplido'] != null && $registro['seccional'] != null  && $registro['mes_facturado'] != null && $registro['sede']!= null
                 && $registro['caso']!= null  && $registro['cambio']!= null  && $registro['usuario'] != null && $registro['repuesto'] != null
                  && $registro['ubicacion']!= null  && $registro['codigo_csj']!= null  && $registro['fecha_entrega_repuesto']!= null  && $registro['serial'] != null
                   && $registro['marca']!= null  && $registro['modelo']!= null  && $registro['cantidad']!= null  && $registro['valor_unitario']!= null 
                    && $registro['valor_total_iva']!= null   )
                {
                
               //dd($registro['sede'],$registro);
                
                $consulta = FacturaCumplido::where('caso',$registro['caso'])
                ->where('cambio',$registro['cambio'])
                ->first();
                
                if(empty($consulta)){
                    $repetido= "N/A";
                }else{
                   // dd($consulta);
                    $repetido = $consulta->num_cumplido;
                     if($consulta->num_cumplido == $registro['num_cumplido']){
                         $repetido= "N/A";
                     }
                }
                
              
                  
                   $factura = FacturaCumplido::updateOrCreate(
                     ['num_cumplido' => $registro['num_cumplido'],'caso' => $registro['caso'],'cambio' => $registro['cambio']],
                    [
                    'num_cumplido'=> $registro['num_cumplido'],
                    'seccional'=> $registro['seccional'],
                    'mes_facturado'=> $registro['mes_facturado'],
                	'sede'=> $registro['sede'], 
                	'caso'=> $registro['caso'],
                	'repetido'=> $repetido,
                	'cambio'=> $registro['cambio'],
                	'usuario'=> $registro['usuario'],
                	'repuesto'=> $registro['repuesto'],
                	'ubicacion'=> $registro['ubicacion'],
                	'codigo_csj'=> $registro['codigo_csj'],
                	'fecha_entrega_repuesto'=> $registro['fecha_entrega_repuesto'],
                	'serial'=> $registro['serial'],
                	'marca'=> $registro['marca'],
                	'modelo'=> $registro['modelo'],
                	'cantidad'=> $registro['cantidad'],
                	'valor_unitario'=> $registro['valor_unitario'],
                	'valor_total_iva'=> $registro['valor_total_iva']]);;
                    
                
                // dd($factura);
                    
                   
                }else{
                   
                if(!empty($registro)){
                   Session::flash('message', 'El caso  '.$registro['caso'].' algunos de los campos esta en blanco. No se ha almacenado de ese en adelante');
                   
                    }else{
                        
        Session::flash('message', 'Descargar para verificar documento');
                    }
                    
                 //return view('administrador.excel.facturasCumplido');
                }
                
        }
       // Session::flash('message', 'Descargar para verificar documento');
        return Redirect::back();
    }
    
    
     //DESCARGAR FACTURA DE CUMPLIMIENTO
    public function FacturaCumplimiento(Request $request){
        //dd($request);
        $cumplido=$request->numero;
        
        $consult= FacturaCumplido::where('num_cumplido',$cumplido)->first();
        
        if(!empty($consult)){
            Excel::create('Factura Cumplimiento', function($excel)use($cumplido) {
                    $excel->sheet('Factura Cumplimiento', function($sheet)use($cumplido) {
                        $products = DB::select('select  `num_cumplido`, `seccional`, `mes_facturado`, `sede`, `caso`, `repetido`, `cambio`, `usuario`,
 	 `repuesto`, `ubicacion`, `codigo_csj`, `fecha_entrega_repuesto`,
 	 `serial`, `marca`, `modelo`, `cantidad`, `valor_unitario`, `valor_total_iva` FROM `factura_cumplidos` WHERE num_cumplido = "'.$cumplido.'" ');
                        
                        $data= json_decode( json_encode($products), true);                
                        $sheet->fromArray($data);
                        $sheet->setOrientation('landscape');
                    });
                })->export('xlsx');
        }else{
        Session::flash('message', 'No hay nada registrado con ese cumplido');
        return Redirect::back();
        }
          

    }
}
