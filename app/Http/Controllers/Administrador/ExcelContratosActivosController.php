<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\ContratoActivo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;

class ExcelContratosActivosController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

     public function index()
    {
    	
        return view('administrador.excel.contratoActivos');
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


    //Llena toda las BD según el archivo de programación académica (excepto la tabla usuarios y registros)
    private function llenarBaseDeDatos( $nombreDelArchivo ){

        set_time_limit (120);
        ini_set('memory_limit','512M');
       // dd($nombreDelArchivo);

        Excel::load( $nombreDelArchivo, function($reader) {
//dd($reader->toArray());
            $datos = $reader->toArray();
           // dd($datos);
             
             $this->crearHorario($datos);
        });

	
       return Redirect::to('/administrador/store/empleados');


    }


    private function crearHorario($datos)
    {
        $borrar = DB::table('contratos_activos')->delete();
        
        //dd($asignatura[0]->id);
        //Por cada registro del archivo excel...
        foreach ($datos as $registro) 
        {
            
           
               if( $registro['cedula'] != null && $registro['nombre'] != null && $registro['apellidos'] != null && $registro['fecha_contrato'] != null && $registro['fecha_inicio'] != null && $registro['despacho_id'] != null && $registro['cargo_id'] != null && $registro['estado_cargo'] != null && $registro['descripcion_cargo'] != null )
                {
                    
                    $rest = substr($registro['despacho_id'], 0, -3);  // devuelve "le resta los ultimos 3 ceros"
                    
                   //dd('entre2');
                   //dd($registro['despacho_id']);
                   ContratoActivo::create(
                    ['cedula' => $registro['cedula'],
                    'nombre' => $registro['nombre'],
                     'apellidos' => $registro['apellidos'],
                     'fecha_contrato' => $registro['fecha_contrato'],
                     'fecha_inicio' => $registro['fecha_inicio'],
                     'fecha_vencimiento' => $registro['fecha_vencimiento'],
                     'despacho_id' => $rest,
                     'cargo_id' => $registro['cargo_id'],
                     'estado_cargo' => $registro['estado_cargo'],
                     'descripcion_cargo' => $registro['descripcion_cargo']]);;
                   
                }
                
         
        }

    }
}
