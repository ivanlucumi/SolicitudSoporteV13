<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\SolicitudAudiencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Excel;
use App\Models\RestriccionLaboral;
use App\Models\ControlDigitalizacionProtoDos;
use App\Models\Hora;

class ExcelRestriccionSaludController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

     public function index()
    {
    	
        return view('administrador.excel.restriccionSalud');
    } 



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
            dd($datos);
             
             //$this->crearRestriccion($datos);
             //$this->crearRevision($datos);
             //$this->ActualizarSolicitudAu($datos);
             $this->LlenarBaseProtocoloDos($datos);
             //$this->LlenarJoradaVacunacion($datos);
             //crearRevision
        });

	
       return Redirect::to('/administrador/cargar/excel/restriccion/salud');


    }


    private function crearRestriccion($datos)
    {
        //$borrar = DB::table('contratos_activos')->delete();
        
        //dd($asignatura[0]->id);
        //Por cada registro del archivo excel...
        foreach ($datos as $registro) 
        {
           
           
               if( $registro['cedula'] != null && $registro['nombre'] != null  && $registro['edad'] != null && $registro['genero']  )
                {
                    
                    
                   //dd('entre2');
                   //dd($registro['despacho_id']);
                   RestriccionLaboral::create(
                    ['cedula' => $registro['cedula'],
                    'nombre' => $registro['nombre'],
                     'correo' => $registro['correo'],
                     'cargo' => $registro['cargo'],
                     'seccional' => $registro['seccional'],
                     'edad' => $registro['edad'],
                     'genero' => $registro['genero'],
                     'orientacion_para_seccional' => $registro['orientacion_para_seccional'],
                     'recomendaciones' => $registro['recomendaciones']]);;
                   
                }
                
                /*
                'cedula',
    	'nombre',
    	'correo', 
    	'cargo',
    	'seccional',
    	'edad',
    	'genero',
    	'orientacion_para_seccional',
    	'recomendaciones'
                */
                
         
        }

    }
    
    //lenar base de datos con revisiones
     private function crearRevision($datos)
    {
       
        foreach ($datos as $registro) 
        {
            
           // dd($registro['expediente']);
            
            if( $registro['radicacion'] != null )
                {
                    
                    DB::table('control_digitalizacion')
                         ->where('radicacion', $registro['radicacion'])
                         ->update(['estado' => strtoupper($registro['estado']),
                     'llave_digitos_23' => $registro['llave_digitos_23'],
                     'visor' => $registro['visor'],
                     'cd' => $registro['cd'],
                     'ver_video' => $registro['ver_video'],
                    'indice' => $registro['indice'],
                     'ver_exp_completo' => $registro['ver_exp_completo'],
                     'demandante' => $registro['demandante'],
                     'demandado' => $registro['demandado'],
                     'tipificacion' => $registro['tipificacion'],
                     'reviso' => "IVAN CAMILO LUCUMI GARCIA",
                     'fecha_revision' => $registro['fecha_revision'] ]);
                     //dd("entro");
                        
                         /*ControlDigitalizacion::create(
                    ['radicacion' => $registro['radicacion'],
                    'estado' => strtoupper($registro['estado']),
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
                     'reviso' => "IVAN CAMILO LUCUMI GARCIA",
                     'fecha_revision' => $registro['fecha_revision']]);*/
                     
                        
                  //  }
                    

                     }
                
         
        }

    }
    
    
    //actualizar solicitu audiencia
     private function ActualizarSolicitudAu($datos)
    {
        $num =0;
       
        foreach ($datos as $registro) 
        {
            
           // dd($registro['expediente']);
           
            if( $registro['id'] != null )
                {
                   
           $user = SolicitudAudiencia::updateOrCreate(
                    ['id' => $registro['id'],'codigo_despacho' => $registro['codigo_despacho']],
                    [
                    'codigo_despacho' => $registro['codigo_despacho'],
                    'email' => $registro['email'],
                    'nombre_entidad' => $registro['nombre_entidad'],
                    'fecha_prgramada' => $registro['fecha_prgramada'],
                    'hora_inicio' => $registro['hora_inicio'],
                    'hora_fin' => $registro['hora_fin'],
                    'ciudad_destino' => $registro['ciudad_destino'],
                    'entidad_destino' => $registro['entidad_destino'],
                    'numero_radicado_proceso' => $registro['numero_radicado_proceso'],
                    'declarante_indiciado' => $registro['declarante_indiciado'],
                    'direccion' => $registro['direccion'],
                    'telefono' => $registro['telefono'],
                    'audiencia_privada' => $registro['audiencia_privada'],
                    'detenido' => $registro['detenido'],
                    'id_conexion' => $registro['id_conexion'],
                    'editar' => $registro['editar'],
                    'codigo' => $registro['codigo'],
                    'num_agendamient' => $registro['num_agendamient'],
                    'sala' => $registro['sala'],
                    'enlace' => $registro['enlace'],
                    'quien_asigno' => $registro['quien_asigno'],
                    'fecha_solicitud' => $registro['fecha_solicitud'],
                    'created_at' => $registro['created_at'],
                    'updated_at' => $registro['updated_at']
                    
                    ]
    
); 
 $num++; //dd($user);          
 }
           
//dd($registro['id']);
            
            /*if( $registro['id'] != null )
                {
                    if($registro['id_conexion'] != null && $registro['enlace'] != null && $registro['quien_asigno'] != null&& $registro['detenido'] != null){
                       DB::table('solicitud_audiencias')
                         ->where('id', $registro['id'])
                         ->update(['id_conexion' => $registro['id_conexion'],
                     'enlace' => $registro['enlace'],
                     'quien_asigno' => $registro['quien_asigno'],
                     'detenido' => $registro['detenido'] ]); 
                     $num++;
                    }
                    
                    

                     }*/
                
         
        }
        dd($num);

    }
    
    
    
    //llenar tabla de protocolo 2
    
    private function LlenarBaseProtocoloDos($datos)
    {
        
        //$k =sizeof($datos)-1;
        dd($datos);
        
        $num=0;
        foreach ($datos as $key => $registro) 
       { 
            //dd($registro);
          // dd('ola',$registro);
               // if( $registro['especialidad'] != null && $registro['despacho'] != null  && $registro['radicacion'] != null && $registro['codigo_despacho']  )
               // {
                    
                    
                    /* DB::table('control_digitalizacion_proto_dos')
                         ->where('radicacion', $registro['radicacion'])
                         ->where('codigo_despacho', $registro['codigo_despacho'])
                         ->update([
                            'especialidad' => $registro['especialidad'],
                            //'despacho' => $registro['despacho'],
                            'radicacion' => $registro['radicacion'],
                            'codigo_despacho' => $registro['codigo_despacho'],
                            'cantidad' => $registro['folios'],
                            'calidad' => $registro['calidad'],
                            'municipio' => $registro['municipio'] ]);*/
                            $num++;
                            
                            //para acualizar daos especificos
                            
                    /* DB::table('control_digitalizacion_proto_dos')
                         ->where('radicacion', $registro['radicacion'])
                         ->where('despacho', $registro['despacho'])
                         ->where('codigo_despacho', $registro['codigo_despacho'])
                         ->where('reviso',null)
                         ->where('fecha_revision',null)
                         ->update([
                            //'municipio' => $registro['municipio'],
                           // 'especialidad' => $registro['especialidad']
                            'calidad' => "repetido"
                            ]);     
                    */
                            
                   /* $verificar = ControlDigitalizacionProtoDos::where('codigo_despacho',$registro['codigo_despacho'])
                    ->where('radicacion',$registro['radicacion'])
                    ->where('reviso',null)
                    ->where('fecha_revision',null)
                    ->first();
                    $verificar->delete();*/
                      
                    /*$observaciones= ControlDigitalizacionProtoDos::where('reviso','!=', null)
                    ->where('fecha_revision','!=', null)
                    ->get();*/
                    
                    //dd($observaciones);
                    
                   // if(empty($verificar)){
                     /*  ControlDigitalizacionProtoDos::create(
                    ['especialidad' => $registro['especialidad'],
                    'despacho' => $registro['despacho'],
                     'radicacion' => $registro['radicacion'],
                     'codigo_despacho' => $registro['codigo_despacho'],
                     'cantidad' => $registro['folios'],
                     'calidad' => $registro['calidad'],
                     'municipio' => $registro['municipio']]);; */
                   // }
                     
                   ControlDigitalizacionProtoDos::create(
                    [//'especialidad' => $registro['especialidad'],
                    'despacho' => $registro['despacho'],
                     'radicacion' => $registro['radicacion'],
                     'codigo_despacho' => $registro['codigo_despacho'],
                     'cantidad' => $registro['folios'],
                     //'calidad' => $registro['calidad'],
                     'municipio' => $registro['municipio']]);;
                     
                     /* $user = ControlDigitalizacionProtoDos::updateOrCreate(
                    ['codigo_despacho' => $registro['codigo_despacho'],'radicacion' => $registro['radicacion']],
                    [
                    'especialidad' => $registro['especialidad'],
                    'despacho' => $registro['despacho'],
                     'radicacion' => $registro['radicacion'],
                     'codigo_despacho' => $registro['codigo_despacho'],
                     'cantidad' => $registro['folios'],
                     'calidad' => $registro['calidad'],
                     'municipio' => $registro['municipio']
                    
                    ]
    
                    );*/ 
                    
                    //ACTUALIZAR CODIGO DESPACO POR EXCEL
                   /* ControlDigitalizacionProtoDos::where("despacho", $registro['despacho'])
                     ->update(["codigo_despacho" => $registro['codigo_despacho']]);*/
                 
                    
                   
               // }
                
               

                
        }
        dd($num);
    }
    
     private function LlenarJoradaVacunacion($datos)
    {
        $num=0;
        foreach ($datos as $registro) 
        {
            $time = Carbon::now()->toTimeString();
            //dd(Carbon::parse($registro['hora'])->toTimeString(),$time);
               if( $registro['hora']  )
                {
                   Hora::create(
                    ['hora' => Carbon::parse($registro['hora'])->toTimeString()]);
                   
                }
                $num++;
        }
        
    }
}
