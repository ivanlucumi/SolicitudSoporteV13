<?php

namespace App\Http\Controllers\modificacion;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Excel;

class UpdateDespachosController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }
    
    public function index()
    {
    	/*function obtenerIP () {
           if ( filter_var( $_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP ) ) {
              return $_SERVER['HTTP_CLIENTE_IP'];
           }
           elseif ( filter_var ( $_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP ) ) {
              return $_SERVER['HTTP_X_FORWARDED_FOR'];
           }
           elseif ( filter_var ( $_SERVER['HTTP_VIA'], FILTER_VALIDATE_IP ) ) {
              return $_SERVER['HTTP_VIA'];
           }
           else {
              return $_SERVER['REMOTE_ADDR'];
           }
        }*/
        
        return view('administrador.modificacion.despacho');
    } 



    public function store(Request $request){

       //dd($request);

      $tmp_name = $_FILES['file']['tmp_name'];


        if( move_uploaded_file($tmp_name, $tmp_name) ){

        $mensaje=   $this->llenarBaseDeDatos( $tmp_name );

        }

        return $mensaje;
    }


    //Llena toda las BD según el archivo de programación académica (excepto la tabla usuarios y registros)
    private function llenarBaseDeDatos( $nombreDelArchivo ){

        set_time_limit ( 120 );
        ini_set('memory_limit','512M');
        //dd($nombreDelArchivo);

        Excel::load( $nombreDelArchivo, function($reader) {

            $datos = $reader->toArray();
           // dd($datos);
             
             $this->crearHorario($datos);
        });

	
       return Redirect::to('/administrador/update/despachos');


    }


    private function crearHorario($datos)
    {
        
        foreach ($datos as $registro) 
        {
        
        DB::table('despachos')
            ->where('codigoDespacho', $registro['cedula'])
            ->update(['correoD' => $registro['email']]);
            
        }

    }


}
