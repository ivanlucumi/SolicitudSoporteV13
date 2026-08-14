<?php

namespace App\Http\Controllers\Teletrabajo;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Imports\TeletrabajoImport;
use App\Imports\DiaFamiliaImport;
use App\Imports\TeletrabajoPastoImport;

use App\Models\MigracionBestdoc;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Excel;


class Teletrabajo2024Controller extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('checarsesion');
        //$this->middleware('cambiopass');
        //$this->middleware('administrador');
        
    }
    //
     public function index(){

        return view('administrador.excel.Teletrabajo');
    }
    
     public function store(Request $request){
         
         //DD('HOLA');

        $tmp_name = $_FILES['file']['tmp_name'];
        
        $file_tmp = $_FILES['file']['tmp_name'];
        //dd($file_tmp);
        $file_name = $_FILES['file']['name'];
        //dd($file_name);
        $file_destination = '..' . $file_name;
       //dd( move_uploaded_file($file_tmp, $file_destination));


        if( move_uploaded_file($file_tmp, $file_destination) ){
            //dd('entro');

        //$mensaje=   $this->llenarBaseDeDatosTeletrabajoPasto( $file_destination );
        $mensaje=   $this->llenarBaseDeDatos( $file_destination );
        //$mensaje=   $this->llenarBaseDeDatosEventosRh( $file_destination );
        

        }

        return $mensaje;
    }
    
    public function llenarBaseDeDatos($nombreDelArchivo){
        
        set_time_limit (920);
        ini_set('memory_limit','512M');
       // dd($nombreDelArchivo);
       
       
        //$import = new ProtocoloDosImportar();
        $import = new TeletrabajoImport();
        $data = Excel::import($import, $nombreDelArchivo);
        
        dd($data);
        
	
       return Redirect::to('/administrador/carga/excel/migracion/bestdoc');

    }
    
    public function llenarBaseDeDatosEventosRh($nombreDelArchivo){
        
        set_time_limit (920);
        ini_set('memory_limit','512M');
       // dd($nombreDelArchivo);
       
       
        //$import = new ProtocoloDosImportar();
        $import = new DiaFamiliaImport();
        $data = Excel::import($import, $nombreDelArchivo);
        
        //dd($data);
        
	
       return Redirect::to('/administrador/carga/excel/migracion/bestdoc');

    }
    
     public function llenarBaseDeDatosTeletrabajoPasto($nombreDelArchivo){
        
        set_time_limit (920);
        ini_set('memory_limit','512M');
       // dd($nombreDelArchivo);
       
       
        //$import = new ProtocoloDosImportar();
        $import = new TeletrabajoPastoImport();
        $data = Excel::import($import, $nombreDelArchivo);
        
        //dd($data);
        
	
       return Redirect::to('/administrador/carga/excel/migracion/bestdoc');

    }
    
    
    
    
}
