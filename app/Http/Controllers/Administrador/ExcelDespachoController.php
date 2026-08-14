<?php

namespace App\Http\Controllers\Administrador;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\EstadisticaDigitalizacion;
use App\Models\ControlDigitalizacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;




class ExcelDespachoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

     public function index()
    {
        //dd('hola');
    	
        return view('administrador.excel.despacho');
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
             
             //$this->crearHorario($datos);
            //$this->crearDespachoEstadistica($datos);
               //$this->actualizarDespachoEstadistica($datos);
               $this->actualizarFecha($datos);
        });

	
       return Redirect::to('/administrador/store/despachos');


    }


    private function crearHorario($datos)
    {
        
        
        //dd($asignatura[0]->id);
        //Por cada registro del archivo excel...
        foreach ($datos as $registro) 
        {
           $user = DB::select("select id FROM users WHERE cedula = "."'$registro[cedula]'"."
           OR email = "."'$registro[email]'"."");
           
           //dd($user);
          if($user == null) {
           //dd('entre');
               if( $registro['cedula'] != null && $registro['name'] != null /*&& $registro['lastname'] != null*/ && $registro['email'] != null && $registro['password'] != null && $registro['rol'] != null   )
                {
                   //dd('entre2');
                    User::create([ 'cedula' => $registro['cedula'],
                        'name' => $registro['name'],
                         'lastname'=> $registro['lastname'],
                         'email' => $registro['email'],
                         'password' => $registro['password'],
                         'rol' => $registro['rol'] ]);

                    //User::insert([ 'cedula' => $registro['cedula'] , 'name' => $registro['name'], 'lastname' => $registro['lastname'], 'email' => $registro['email'], 'password'=> $registro['password'] ,'rol' => $registro['rol']   ]);
                }
                
            
          }
        }

    }
    
    //CREAR DESPACHOS EN ESTADISTICA
     private function crearDespachoEstadistica($datos)
    {
        
        
        //dd($asignatura[0]->id);
        //Por cada registro del archivo excel...
        foreach ($datos as $registro) 
        {
               if( $registro['id_despacho'] != null && $registro['despacho'] != null && $registro['distrito'] != null )
                {
                   //dd('entre2');
                    EstadisticaDigitalizacion::create([ 'id_despacho' => $registro['id_despacho'],
                        'despacho' => $registro['despacho'],
                         'distrito'=> $registro['distrito'],
                         'email' => $registro['email'],
                         'ciudad' => $registro['punto_digitalizacion'],
                         'digitalizacion_fisico' => $registro['encuesta'],
                         'folios' => $registro['folios'],
                         'procesos_digitalizados' => $registro['procesos_fisicos'],
                         'especialidad' => $registro['especialidad'] ]);

                }
                
          
        }

    }
    
    //CREAR DESPACHOS EN ESTADISTICA
     private function actualizarDespachoEstadistica($datos)
    {
      $contador = 0;
        foreach ($datos as $registro) 
        {
            $idDespacho = str_replace(' ', '', $registro['id_despacho']);
           
               if( $registro['id_despacho'] )
                {
                  
                    DB::table('estadistica_digitalizacion')
                         ->where('id_despacho', $idDespacho)
                         ->update(['digitalizacion_fisico' => $registro['encuesta'],
                                    'procesos_digitalizados'=> $registro['procesos_digitalizados'],
                                    'folios'=> $registro['folios']]);
                     $contador ++;

                }
                
          
        }
        //dd( $contador );

    }
    
    //CREAR ACTUALIZAR FECHA DE EDICION
     private function actualizarFecha($datos)
    {
      
        foreach ($datos as $registro) 
        {
            //dd($registro['codigo']);
            
            $usuario = ControlDigitalizacion::findOrFail($registro['codigo']);
            $usuario->updated_at = $registro['updated_at'];
            //dd($usuario);
            $usuario->save();
                
          
        }
        //dd( $contador );

    }


   }
