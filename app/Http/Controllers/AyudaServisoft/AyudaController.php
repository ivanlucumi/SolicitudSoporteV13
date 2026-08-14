<?php

namespace App\Http\Controllers\AyudaServisoft;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AyudaServisoft;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB; 

//Paginate

use Illuminate\Pagination\Paginator;

use App\SolicitudAudiencia;
use App\Detenido;
use Illuminate\Support\Carbon;

class AyudaController extends Controller
{
    

    public function index(Request $request){

       return view('ayudaServisoft.index');
    }
    
    
     public function DescargarSolicitudAudiencia(){
       /* Excel::create('Directorio Siris', function($excel) {
                $excel->sheet('Directorio Siris', function($sheet) {
                    $directorio = DB::select("select codigo_despacho,email, nombre_entidad as Despacho,
                   fecha_prgramada,hora_inicio,hora_fin,ciudad_destino as Ciudad,entidad_destino,numero_radicado_proceso,
                   id_conexion, enlace, created_at as Solicitada, updated_at as asignada FROM solicitud_audiencias WHERE 1");
                    //dd(json_encode($directorio));
                    $data= json_decode( json_encode($directorio), true);    
                    //dd($data);
                    $sheet->fromArray($data);
                    $sheet->setOrientation('landscape');
                });
            })->export('xlsx');*/

            Excel::create('Directorio Siris', function($excel) {
                $excel->sheet('Directorio Siris', function($sheet) {
                    $directorio = DB::select("select codigo_despacho,email, nombre_entidad as Despacho,
                   fecha_prgramada,hora_inicio,hora_fin,ciudad_destino as Ciudad,entidad_destino,numero_radicado_proceso,
                   id_conexion, enlace, created_at as Solicitada, updated_at as asignada FROM solicitud_audiencias WHERE created_at LIKE '%2021-10%'");
                    
                    $data= json_decode( json_encode($directorio), true);                
                    $sheet->fromArray($data);
                    $sheet->setOrientation('landscape');
                });
            })->export('xlsx');
       
           Session::flash('message', 'No se encontraron datos para generar el excel');
           
            $revisar=   $this->IndexSolicitudAudiencia();
            return $revisar;
         
       

   }
}
