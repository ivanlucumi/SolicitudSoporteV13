<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use App\Models\Empleado;

use App\Imports\EmpleadosImports;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;


class ExcelEmpleadosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

     public function index()
    {
    	//dd('hola');
        return view('administrador.excel.empleado');
    } 



    public function store(Request $request){

      // dd($request->all());

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

        // INACTIVA a todos aquellos que NO sean Contratistas
        // Valida que la palabra CONTRATISTA no esté ni en el cargo ni en la columna despacho
        Empleado::whereRaw("IFNULL(UPPER(cargo_titular), '') NOT LIKE '%CONTRATISTA%'")
                ->whereRaw("IFNULL(UPPER(cod_despacho), '') != 'CONTRATISTA'")
                ->update(['estado' => 'I']);

        $import = new EmpleadosImports();
        Excel::import($import, $nombreDelArchivo);
        
        $cantidad = $import->rowsImported;
        Session::flash('message', "Importación finalizada correctamente. Se actualizaron/insertaron $cantidad empleados.");
        return Redirect::to('/administrador/empleados');
    }


}
