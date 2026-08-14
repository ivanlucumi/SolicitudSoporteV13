<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\SolicitudAudiencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Models\User;
use App\Models\ReservaSalas;
use App\Models\Despacho;

use Illuminate\Support\Facades\DB;

use Excel;


class ExcelSolicitudVirtualController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }

     public function index()
    {
    	
        return view('administrador.excel.excelsolicitud');
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
            $this->crearHorario($datos);
        });

	
       return Redirect::to('/administrador/store/solcitud/audiencia');


    }


    private function crearHorario($datos)
    {
        
        foreach ($datos as $registro) 
        {
           //dd($registro);

            //dd($registro['email']);
           /*$user = DB::select("select id FROM users WHERE cedula = "."'$registro[cedula]'"."
           OR email = "."'$registro[email]'"."");*/
           
          // dd(Carbon::parse($registro['completion_time'])->toDateTimeString());
           //dd(Carbon::parse($registro['hora_inicio'])->toTimeString());

           
         // if($user == null) {
           //dd($registro['email']);
               if( $registro['email'] != null 
                && $registro['nombre_entidad'] != null 
                && $registro['fecha_programada'] != null 
                && $registro['hora_inicio'] != null 
                && $registro['hora_fin'] != null 
                /*&& $registro['ciudad_destino'] != null */  
                /*&& $registro['entidad_destino'] != null   */
                && $registro['radicado'] != null   
                /*&& $registro['declarante_indiciado'] != null */  
               /* && $registro['direccion'] != null */   ){
                   //dd('entre2');
                   //
                           if($registro['telefono'] == null){
                            $telefono = 000000000;
                           }else{
                            $telefono = $registro['telefono'];
                           }
        
                            if($registro['audiencia_privada'] == null){
                            $audienciaP = 1;
                           }else{
                                if(strtoupper($registro['audiencia_privada']) == 'SI'){
                            $audienciaP = 1;
                           }else{
                            $audienciaP = 0;
                           }
                           }
                           
                           $radicadoI = $registro['radicado'];
                           
                           //quitar espacios
                           $radicado1 =str_replace(' ', '', $radicadoI);
                           $radicado2 =str_replace('-', '', $radicado1);
                           $radicado3 =str_replace('+', '', $radicado2);
        
                           //dd($registro,$telefono,$audienciaP);
                           
                           $idDespacho = User::where('email','LIKE','%'.$registro['email'].'%')->select('cedula')->first();
                           
                           $ciudad = Despacho::where('codigoDespacho',$idDespacho->cedula)->select('codCiudad')->first();
                           
                           //dd($idDespacho,$ciudad,$registro['email'],$registro['nombre_entidad']);
                           
                            $solicitudAudiencia = SolicitudAudiencia::create([ 
                                 'email' => $registro['email'],
                                 'codigo_despacho' => $idDespacho->cedula,
                                 'nombre_entidad' => $registro['nombre_entidad'],
                                 'fecha_prgramada'=> Carbon::parse($registro['fecha_programada'])->toDateString(),
                                 'hora_inicio' => Carbon::parse($registro['hora_inicio'])->toTimeString(),
                                 'hora_fin' => Carbon::parse($registro['hora_fin'])->toTimeString(),
                                 'ciudad_destino' =>$registro['ciudad_destino'],
                                 'entidad_destino' =>$registro['entidad_destino'],
                                 'numero_radicado_proceso' => $radicado3,
                                 'declarante_indiciado' =>$registro['declarante_indiciado'],
                                 'direccion' =>$registro['direccion'],
                                 'telefono' =>$telefono,
                                 'audiencia_privada' =>$audienciaP,
                                 'detenido' =>0,
                                 'id_conexion' =>$registro['id_conexion'],
                                 'editar' => 0,
                                 'codigo' => null,
                                 'num_agendamiento' => $registro['num_agendamiento'],
                                 'sala' => null,
                                 'enlace' => $registro['url'],
                                 //'quien_asigno' =>  auth()->user()->id,
                                 'fecha_solicitud' => Carbon::parse($registro['completion_time'])->toDateTimeString(),
                                 'editar' => 1,
                                 'created_at' => Carbon::now()->toDateTimeString()
                                  ]);
                                  
                                 //$idDespacho = User::where('email',$registro['email'])->select('cedula')->first();
                                  
                                //CORTAR NOMBRE DE DEMANDADO
                            $indiciado = explode(" ", $registro['declarante_indiciado']);
                            
                            
                           
                            
                            if($ciudad->codCiudad == 76001){
                                    //almacenar datos en la reserva de salas con el formulario de solicitud de audiencias virtuales
                                    $evento = ReservaSalas::create([
                                        'rs_sala'              =>null,
                                        'rs_numero_radicado'   => $radicado3,
                                        'rs_nombre_fiscal'     => 'FISCAL',
                                        'rs_nombre_indiciado'  => strtoupper($indiciado[0].' @@@@@'),
                                        'rs_fecha'             => Carbon::parse($registro['fecha_programada'])->toDateString(),
                                        'rs_hora_inicio'       => Carbon::parse($registro['hora_inicio'])->toTimeString(),
                                        'rs_fecha_fin'         => Carbon::parse($registro['fecha_programada'])->toDateString(),
                                        'rs_hora_fin'          =>  Carbon::parse($registro['hora_fin'])->toTimeString(),
                                        'rs_estado'            => 'SIN PUBLICAR',
                                        'rs_codigo_juzgado'    => $solicitudAudiencia->codigo_despacho,
                                        'color'                => null,
                                        'textcolor'            => null,
                                        'rs_creador'           => 'Creado desde excel', 
                                        'solicitud_audiencia_id'=> $solicitudAudiencia->id,
                                    ]);
                               }
                   }
         // }
        }

        

    }
}
