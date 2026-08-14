<?php

namespace App\Http\Controllers\Administrador;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;

class ExcelActualizarDirectorioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

    
    public function index()
    {
    	
        return view('administrador.excel.actualizaDespachos');
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

        set_time_limit ( 120 );
        ini_set('memory_limit','512M');
        //dd($nombreDelArchivo);

        Excel::load( $nombreDelArchivo, function($reader) {

            $datos = $reader->toArray();
            //dd($datos);
             
             $this->actualizarDirectorio($datos);
        });

	
       return Redirect::to('/administrador/store/actualizar/despachos');


    }


    private function actualizarDirectorio($datos)
    {
        
        
        //dd($asignatura[0]->id);
        //Por cada registro del archivo excel...
        foreach ($datos as $registro) 
        {
               if( $registro['codigodespacho'] != null && $registro['nombredespacho'] != null && $registro['direccion'] != null   )
                {
                    dd('entro');
                   /* User::update([ 'codigoDespacho' => $registro['codigoDespacho'],
                        'nombreDespacho' => $registro['nombreDespacho'],
                         'direccion'=> $registro['direccion'] ]);*/

                         DB::table('despachos')
                         ->where('codigoDespacho', $registro['codigodespacho'])
                         ->update(['nombreDespacho' => $registro['nombredespacho'],
                                    'direccion'=> $registro['direccion'] ]);

                     }
                
            
          
        }

    }


}
