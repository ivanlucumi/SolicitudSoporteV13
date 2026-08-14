<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\URL;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Mail;
use Validator;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


use App\Models\OficinasReparto;
use App\Models\GrupoReparto;
use App\Models\OficinaJudicialReparto;
use App\Models\GrupoDespachoEspecialidad;

use Carbon\Carbon;

use App\Models\Reparto;

class RepartoController extends Controller
{
    
    public function __construct(){
       // $this->middleware('auth');
       // $this->middleware('Reparto');
        
    }
   
    public function index(){
        $oficinas = OficinasReparto::where('observaciones',"ACTIVO")->pluck('nombre','email');
        //dd($oficinas);
        return view('externo.validacion',compact('oficinas'));
    }
    
    public function robot(Request $request){
       $this->validate($request, [
                'g-recaptcha-response' => 'required|captcha',
                'email'=>'required|email',
                'oficinaReparto'=>'required',
                'tratamientoDeDatos'=>'required'
                ]);
        
       /* return URL::temporarySignedRoute(
            'externo.informacion.reparto', 
            now()->addMinutes(5), 
            ['oficinaReparto' =>$request->oficinaReparto,'email' =>$request->email]
        );*/
                
        //dd($request);
     //return response()->redirectToAction('RepartoController@formulario', $request->oficinaReparto,$request->email);
     return redirect()->route('externo.informacion.reparto', array('oficinaReparto' =>$request->oficinaReparto,'email' =>$request->email));	
      //return $this->formulario($request);
    }
    
    public function formulario(Request $request,$oficinaR,$correo){
      //dd($id,$value);
       //dd($request);
        $gruposRePartos = array();   
        
        $grupos=[];
        $grupo =null;
        
        $oficinaReparto =$oficinaR;
        $email =  $correo;
        
        if(empty($oficinaReparto) && empty($email)){
            
        Session::flash('error', 'Debe validar El Formulario !');
        return Redirect::to('/formulario/validacion');
        }
    
     //dd($oficinaReparto,$email);
        $oficinas = OficinasReparto::where('email',$oficinaReparto)->select('id')->first();
        
        
        $GrupoDespachoEspecialidad = GrupoDespachoEspecialidad::where('id_grupos_reparto',$oficinas->id)->get();
        //dd($oficinas->id,$oficinaReparto,$GrupoDespachoEspecialidad);
        
        //dd(GrupoReparto::where('id',7)->select('especialidad','id')->first(), DB::select('select especialidad, id from grupo_repartos where id = 7 ')); 
        
        foreach($GrupoDespachoEspecialidad as $GrupoDespacho ){
            array_push($gruposRePartos,GrupoReparto::where('id',$GrupoDespacho->id_oficina_reparto)->pluck('especialidad','id'));
            //$grupos[] = GrupoReparto::where('id',$GrupoDespacho->id_oficina_reparto)->select('especialidad','id')->get();
            //$grupo = $grupo.$GrupoDespacho->id_oficina_reparto.',';
        }
        
        
        //$gruposRe = GrupoReparto::pluck('especialidad','id');
        //dd($grupos,GrupoReparto::whereIn('id',$grupos)->pluck('especialidad','id'));
        //dd($gruposRePartos,$gruposRe,collect($gruposRePartos));
        
        $gruposRe = $gruposRePartos;
        
        return view('externo.index',compact('oficinaReparto','email','gruposRe'));
    }
    
    
    public function consultaGrupo(Request $request,$id){
        $grupo = Reparto::where('id_grupo',$id)->get();
        return $grupo;
        //dd($id);
    }
    //
    public function store(Request $request){
        //dd($request->ceduladado);
        //dd($request->all());
        
        //validacion de tamaño de Documentos
        $tamDemanda= intval($_FILES["demanda"]["size"]);
        //$tamDemanda2 = intval($_FILES["poder"]["size"]);
        $tamDemanda3 = intval($_FILES["anexos"]["size"]);
        //dd($tamDemanda,$tamDemanda3,$tamDemanda2);
        
        //validacion de tamaño
         $total= ($tamDemanda+$tamDemanda3)/1000000;
        
        if ($total > 20.9) {
            //dd('hola1',$total);
           Session::flash('message', "Documentos Superan el Tamaño Permitido, debe ser máximo 20 MB");
           return Redirect::back();
        }
        
        //validacion de tamaño de Documentos
        $tamDemanda= intval($_FILES["demanda"]["size"]);
        //$tamDemanda2 = intval($_FILES["poder"]["size"]);
        $tamDemanda3 = intval($_FILES["anexos"]["size"]);
        //dd($tamDemanda,$tamDemanda3,$tamDemanda2);
        
        $extension= pathinfo($_FILES["demanda"]['name'], PATHINFO_EXTENSION);
        
        $formatos_permitidos =  array('pdf','PDF');
        if(!in_array($extension, $formatos_permitidos) ) {
               
            //dd(pathinfo($_FILES["demanda"]['name'], PATHINFO_EXTENSION),'NO ES PDF');
            Session::flash('error', 'El Documento Cargado Debe Ser en Formato Pdf!');
            return Redirect::back();
            }
        
        if($extension != "pdf" || $extension != "PDF" ){
            
        }
        
        //dd(pathinfo($_FILES["demanda"]['name'], PATHINFO_EXTENSION));
        
        $correoDemandado="";
         if(!empty($request->correo_notif_ddo[0])){
            // dd('hola');
            for($i=0;$i<count($request->correo_notif_ddo);$i++ ){
             // dd($request->correo_notif_ddo[$i]);  
             $correoDemandado = $correoDemandado. $request->correo_notif_ddo[$i]."; ";
            // dd('entro al for');
                    }
            }else{
                //dd('entro else');
                    $correoDemandado=" ";
            }
       
      // dd($correoDemandado,'dsalio del for');
       
        
         $this->validate($request, [
                'email'=>'required|email',
                'oficinaReparto'=>'required',
                'especialidad'=>'required',
                'nombre_grupo'=>'required',
                'cuaderno'=>'required',
                'folios'=>'required',
                'contacto'=>'required',
                ]);
                
        if($request->especialidad == 10){
            $this->validate($request, [
                'comuna'=>'required',
                ]); 
        }
        $oficinaReparto = $request->oficinaReparto;
        $email = $request->email;
        //dd('hola');
        //dd($request->especialidad,$request->nombre_grupo);
        //generador de codigos aleatorios
        
         
        
        $total= ($tamDemanda+$tamDemanda3)/1000000;
        
        if ($total > 20.9) {
            //dd('hola1',$total);
           Session::flash('message', "Documentos Superan el Tamaño Permitido, debe ser máximo 20 MB");
           return Redirect::back();
        }
        
     
        $key = '';
        $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz+#&';
        $max     = strlen($pattern)-1;
        //$max = int($max);

        /*for($i   =0;$i < 10;$i++) {
        $key .= $pattern{mt_srand(0, $max)};
        }*/

   
        for ($p = 0; $p < 12; $p++)
        {
            $key .= ($p%2) ? $pattern[mt_rand(27, 49)] : $pattern[mt_rand(0, 28)];
        }
        //dd($key);
    
        $demandado = "";
        $demandante= "";
        $apoderado= "";
        $nombre3 = "";
        
        //EJECUTAR ACCION CUANDO CARGAN ANEXOS O NO
        
        if($tamDemanda3 > 0){
          $file3 = $request->file('anexos');  
          $nombreanexos =  $_FILES["anexos"]["name"];
          
          $separador = ".";
          $separada3 = explode($separador, $nombreanexos);
          
          $nombre3 = $key." "."Anexo.".$separada3[array_key_last($separada3)];
         
          //dd($nombre3);
            
        }
        
       
        
        //dd(json_encode($request->ceduladado));
        $file = $request->file('demanda');
        //$file2 = $request->file('poder');
       // $file3 = $request->file('anexos');
        
        
        
        $nombredemanda = $_FILES["demanda"]["name"];
        //$nombrepoder = $_FILES["poder"]["name"];
        //$nombreanexos =  $_FILES["anexos"]["name"];
        // dd($nombredemanda,$nombrepoder,$nombreanexos);
        
        $separador = ".";
        $separada1 = explode($separador, $nombredemanda);
        //$separada2 = explode($separador, $nombrepoder);
       // $separada3 = explode($separador, $nombreanexos);
        
        //$texto = preg_replace('([^A-Za-z0-9])', ' ', $separada1[0]);
        
        
        $nombre = $key." ".preg_replace('([^A-Za-z0-9])', ' ', $separada1[0]).".".$separada1[1];
        //$nombre2 = $key." ".preg_replace('([^A-Za-z0-9])', ' ', $separada2[0]).".".$separada2[1];
       // $nombre3 = $key." ".preg_replace('([^A-Za-z0-9])', ' ', $separada3[0]).".".$separada3[1];
        //dd($nombre,$nombre2,$nombre3);
        
         //$almac=\Storage::putFile('reparto',  \File::get($file));
        
       //$almac=\Storage::disk('reparto')->put($nombre, \File::get($file));
        //dd($almac);  correo_notif_ddo
        
       $nombreEspecialidad= GrupoReparto::findOrFail($request->especialidad);
        
        //dd($nombreEspecialidad->especialidad);
       for($i=0;$i<count($request->ceduladado);$i++ ){
           $demandado = $demandado. $request->ceduladado[$i]." ".$request->nombredado[$i]." ".$request->apellidodado[$i]."\n";
       }
       for($i=0;$i<count($request->ceduladte);$i++ ){
           $demandante = $demandante. $request->ceduladte[$i]." -".$request->nombredte[$i]."- ".$request->apellidodte[$i]."\n";
       }
       
       $apoderado = $request->cedulaA." -".$request->nombreA."- ".$request->tarjetaP;

      
          $reporte = new OficinaJudicialReparto();
           $reporte->seguimiento = $key;
           $reporte->especialidad = $request->especialidad;
           $reporte->nombre_especialidad = $nombreEspecialidad->especialidad;
           $reporte->nombre_grupo = $request->nombre_grupo;
           $reporte->comuna = $request->comuna;
           $reporte->demandante = $demandante;
           $reporte->demandado = $demandado;
           $reporte->correo_notif_ddo = $correoDemandado;
           $reporte->cedulaA = $request->cedulaA;
           $reporte->nombreA = $request->nombreA;
           $reporte->tarjetaP = $request->tarjetaP;
           $reporte->cuaderno = $request->cuaderno;
           $reporte->folios = $request->folios;
           $reporte->observaciones = $request->observaciones;
           $reporte->email = $request->email;
           $reporte->oficinaReparto = $request->oficinaReparto;
           $reporte->demanda = $nombre;
           $reporte->contacto = $request->contacto;
          // $reporte->poder = $nombre2;
           $reporte->anexos = $nombre3;
           $reporte->url_anexos = $request->url_anexos;
           $reporte->fecha_recibido = Carbon::now();
           $reporte ->save();
       
        //dd($reporte ->save());
        
        if($tamDemanda > 0){
            //dd('hola1');
           \Storage::disk('reparto')->put($nombre, \File::get($file));
           
        }
        /*if($tamDemanda2 > 0){
            //dd('hola2');
            \Storage::disk('reparto')->put($nombre2, \File::get($file2));
         
        }*/
        if($tamDemanda3 > 0){
           // dd('hola3');
          \Storage::disk('reparto')->put($nombre3, \File::get($file3));  
        }
        
        //dd($nombre,$nombre3);
        
        //demanda
        $demanda = $reporte->demanda;
        //anexos
        $anexos = $reporte->anexos;
        $data              =  json_decode(json_encode($reporte), true);
                       
                     
                            Mail::send('emails.RepartoAdespacho',$data, function ($message) use ($email,$oficinaReparto,$key,$reporte,$nombre,/*$nombre2,*/$nombre3,$tamDemanda,/*$tamDemanda2,*/$tamDemanda3,$anexos,$demanda) {
                             
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                                        $message->to($oficinaReparto);
                                        $message->cc($email);
                                        $message->subject('Notificacion Envio Documentos Reparto');
                                         if($demanda != null){
                                             //dd($nombre);
                                              $message->attach("/home/disajcal/public_html/Reparto/".$demanda,[  'mime' => "application/octet-stream", ]);
                                            }
                                           
                                            if($anexos != null){
                                                //dd($nombre3);
                                              $message->attach("/home/disajcal/public_html/Reparto/".$anexos,[  'mime' => "application/octet-stream", ]);
                                            }
                         });
                         
                          Mail::send('emails.RepartoAdespacho',$data, function ($message) use ($email,$oficinaReparto,$reporte,$nombre,/*$nombre2,*/$nombre3,$tamDemanda,/*$tamDemanda2,*/$tamDemanda3,$anexos,$demanda) {   
                                     $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                                      $message->to($email);
                                        //dd($email);
                                       $message->subject('Notificacion Envio Documentos');
                                        if($demanda != null){
                                             //dd($nombre);
                                              $message->attach("/home/disajcal/public_html/Reparto/".$demanda,[  'mime' => "application/octet-stream", ]);
                                            }
                                           
                                            if($anexos != null){
                                                //dd($nombre3);
                                              $message->attach("/home/disajcal/public_html/Reparto/".$anexos,[  'mime' => "application/octet-stream", ]);
                                            }
                         });
                         
                   
                          
        Session::flash('success', 'Documentos enviados con Exito !');
        return Redirect::to('/formulario/validacion');
                
 

    }

    public function consultar(Request $request){
        //dd( $request->all());
      
        $resultado = OficinaJudicialReparto::where('especialidad',$request->especialidad)
        ->where('nombre_grupo',$request->nombre_grupo)
        ->where('demandante',"LIKE",'%' .$request->ceddante.'%')
        ->where('demandado',"LIKE",'%' .$request->ceddado.'%')->first();
       //dd($resultado,"espe",$request->especialidad,"grupo",$request->nombre_grupo,"dte",$request->ceddante,"ddado",$request->ceddado);
        if($resultado != null){
            return "True";
        }else{
            return "False";
        }
        
        
    }
}
