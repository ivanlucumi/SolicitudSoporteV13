<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Parqueadero;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;

class ExcelParqueaderoController extends Controller
{
      public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

     public function index()
    {
    	
        return view('administrador.excel.parqueadero');
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

        set_time_limit ( 600 );
        ini_set('memory_limit','512M');
       // dd($nombreDelArchivo);

        Excel::load( $nombreDelArchivo, function($reader) {

            $datos = $reader->toArray();
            //dd($datos);
             
             $this->crearHorario($datos);
        });

	
       return Redirect::to('/administrador/cargar/excel/parqueadero');


    }


    private function crearHorario($datos)
    {
        //$borrar = DB::table('personas')->delete();
        
        //dd($asignatura[0]->id);
        //Por cada registro del archivo excel...
        foreach ($datos as $registro) 
        {
            
           
               if( $registro['no_parqueadero']  )
                {
                    
                   //dd('entre2');
                   //dd($registro['despacho_id']);
                   Parqueadero::create([
                      "no_parqueadero" => $registro['no_parqueadero'],
                      "calidad" => $registro['calidad'],
                      "tipo_vehiculo" => $registro['tipo_vehiculo'],
                      "placa" => $registro['placa'],
                      "descripcion_vehiculo" => $registro['descr_vehiculo'],
                      "cedula" => $registro['cedula'],
                      "nombre" => $registro['nombre'],
                      "cargo" => $registro['cargo'],
                      "juzgado" => $registro['no_juzgado'],
                      "especialidad" => $registro['especialidad'],
                       ]);
                  
                   
                }
                
         
        }

    }
}
