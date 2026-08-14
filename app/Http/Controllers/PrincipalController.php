<?php

namespace App\Http\Controllers;

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Institucional;
use App\Models\Banner;
use App\Models\Noticias;
use App\Models\Especial;
use App\Models\Despacho;
use App\Models\ComiteGenero;
use App\Models\ComiteGeneroEnlaces;
use App\Models\ComiteGeneroGaleria;
use App\Models\ReservaSalas;
use App\Models\RegionCali;
use App\Models\Sst;
use App\Models\Ciudad;
use App\Models\Edificio;


use App\Models\VigilanciaJudicial;

use App\Models\FichaPreliminar;


use App\Models\ReservaSalaAudiencia;


use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Mail;

use App\Models\ControlIngreso;
use App\Models\Contador;
use Carbon\Carbon;


use Illuminate\Support\Facades\Http;
use GuzzleHttp\Cookie\CookieJar;

class PrincipalController extends Controller
{
   
   public function autenticar()
{
   /* $loginUrl = "https://siugj.ramajudicial.gov.co/principalPortal/index.php";

    // Crear un contenedor de cookies
    $cookieJar = new CookieJar();

    $response = Http::withOptions([
        'cookies' => $cookieJar // Pasamos el contenedor de cookies
    ])->asForm()->post($loginUrl, [
        'usuario' => 'radicador01',
        'password' => '123456'
    ]);
    

    if ($response->successful()) {
        // Extraer cookies como array
        $cookies = [];
        foreach ($cookieJar->toArray() as $cookie) {
            $cookies[$cookie['Name']] = $cookie['Value'];
        }*/
$cookies="sldkfjlksjflsdkjflsdkfjlsdkf";
       // 
    //}

    return $cookies;
}
   
 
 public function consultarCedula(/*$cedula*/)
{
    $url = "https://api.chucknorris.io/jokes/random";
    
    $response = Http::get($url);
    
    //dd($response->body());

    if ($response->successful()) {
        return response()->json($response->json());
    } else {
        return response()->json(['error' => 'No se pudo obtener la información'], $response->status());
    }
}
   



    
    //
    public function index(Request $request)
    {
        
        $ip = $request->ip();
        
        $fecha = Carbon::now();
        $fecha = $fecha->format('Y-m-d');
        
        
        
        
        //dd(empty($visitas_d));
        
        if ( isset( $_COOKIE[ 'visitas' ] ) ) {

            setcookie( 'visitas', $_COOKIE[ 'visitas' ] + 1, time() + 10800 * 1 );
            
        }
        else {
            
         
            //insertar contador global
        $visitas_d = Contador::where('fecha_visita',$fecha)
        ->where('user_visita','!=','GLOBAL')
           ->first();
            
            //insertar contador diario
        $visita_g = Contador::where('user_visita','GLOBAL')->first();
        $No =intval($visita_g->visitas);
        $visita_g->visitas= $No+1;
        $visita_g->save();
        
        
            setcookie( 'visitas',  1, time() + 10800 * 1);
            if(empty($visitas_d)){
               $visitas_d = new Contador();
               $visitas_d->user_visita= 'DIARIA';
               $visitas_d->fecha_visita= $fecha;
               $visitas_d->visitas= 1;
               $visitas_d->save(); 
            }else{
               $visitas_d = Contador::where('fecha_visita',$fecha)
               ->where('user_visita','DIARIA')
               ->first();
               $NoD =intval($visitas_d->visitas);
               $visitas_d->visitas= $NoD+1;
               $visitas_d->save(); 
            }
            
           
        }
        
        
        $visitas = array();
        
        $fechaA = Carbon::now()->toDateString();
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        
        $banner = Banner::where('bEstado', 1)
        ->where('bCreador', '!=', 'BIENESTAR')
        ->where('bCreador', '!=', 'COE')
        ->orderBy('created_at', 'desc')
        ->get();
        
        //$banner       =  Banner::bannerIndex();
        $noticia      =  Noticias::noticiasIndex();
        $especial     =  Especial::especilIndex();
        $actualizarN  =  Noticias::actualizarEstadoN();
        $actualizarB  =  Banner::actualizarEstadoB();
        $actualizarE  =  Especial::actualizarEstadoE();
        //dd($banner);
        return view('principal', compact('banner','noticia','especial','global','diaria','ip'));
    }
    
    
    
     //
    public function indexBienestar(Request $request)
    {
        
        $ip = $request->ip();
        
        $fecha = Carbon::now();
        $fecha = $fecha->format('Y-m-d');
        
        
        
        
        //dd(empty($visitas_d));
        
        if ( isset( $_COOKIE[ 'visitas' ] ) ) {

            setcookie( 'visitas', $_COOKIE[ 'visitas' ] + 1, time() + 10800 * 1 );
            
        }
        else {
            
         
            //insertar contador global
        $visitas_d = Contador::where('fecha_visita',$fecha)
        ->where('user_visita','!=','GLOBAL')
           ->first();
            
            //insertar contador diario
        $visita_g = Contador::where('user_visita','GLOBAL')->first();
        $No =intval($visita_g->visitas);
        $visita_g->visitas= $No+1;
        $visita_g->save();
        
        
            setcookie( 'visitas',  1, time() + 10800 * 1);
            if(empty($visitas_d)){
               $visitas_d = new Contador();
               $visitas_d->user_visita= 'DIARIA';
               $visitas_d->fecha_visita= $fecha;
               $visitas_d->visitas= 1;
               $visitas_d->save(); 
            }else{
               $visitas_d = Contador::where('fecha_visita',$fecha)
               ->where('user_visita','DIARIA')
               ->first();
               $NoD =intval($visitas_d->visitas);
               $visitas_d->visitas= $NoD+1;
               $visitas_d->save(); 
            }
            
           
        }
        
        
        $visitas = array();
        
        $fechaA = Carbon::now()->toDateString();
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        
        $banner = Banner::where('bEstado', 1)
        ->where('bCreador','BIENESTAR')
        ->orderBy('created_at', 'desc')
        ->get();
        
       // dd($banner);
        
       // $banner       =  Banner::bannerIndexBienestar();
        $noticia      =  Noticias::noticiasIndex();
        $especial     =  Especial::especilIndex();
        $actualizarN  =  Noticias::actualizarEstadoN();
        $actualizarB  =  Banner::actualizarEstadoB();
        $actualizarE  =  Especial::actualizarEstadoE();
        //dd($banner);
        
        //$lastUpdated = optional($banner->max('updated_at'))->toDateTimeString();
        $lastUpdated = optional($banner->max('updated_at'))->toDateTimeString() ?? '';
        
        return view('Bienestar.Banner', compact('banner','noticia','especial','global','diaria','ip', 'lastUpdated'));
    }
    
    public function checkUpdate()
    {
        try {
            $query = Banner::where('bCreador', 'BIENESTAR')
                            ->where('bEstado', 1);
    
            $count = $query->count();
            $lastUpdated = $query->max('updated_at');
    
            return response()->json([
                'success' => true,
                'count' => $count,
                'last_updated' => $lastUpdated ?? '',
            ]);
        } catch (\Throwable $e) {
            \Log::error('Error en checkUpdate: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Error interno en el servidor.',
            ], 500);
        }
    }
    
    public function ruleta1(Request $request)
    {
        
        $ip = $request->ip();
        $fecha = Carbon::now();
        $fecha = $fecha->format('Y-m-d');
        //dd(empty($visitas_d));
        
        if ( isset( $_COOKIE[ 'visitas' ] ) ) {

            setcookie( 'visitas', $_COOKIE[ 'visitas' ] + 1, time() + 10800 * 1 );
            
        }
        else {
            
         
            //insertar contador global
        $visitas_d = Contador::where('fecha_visita',$fecha)
        ->where('user_visita','!=','GLOBAL')
           ->first();
            
            //insertar contador diario
        $visita_g = Contador::where('user_visita','GLOBAL')->first();
        $No =intval($visita_g->visitas);
        $visita_g->visitas= $No+1;
        $visita_g->save();
        
        
            setcookie( 'visitas',  1, time() + 10800 * 1);
            if(empty($visitas_d)){
               $visitas_d = new Contador();
               $visitas_d->user_visita= 'DIARIA';
               $visitas_d->fecha_visita= $fecha;
               $visitas_d->visitas= 1;
               $visitas_d->save(); 
            }else{
               $visitas_d = Contador::where('fecha_visita',$fecha)
               ->where('user_visita','DIARIA')
               ->first();
               $NoD =intval($visitas_d->visitas);
               $visitas_d->visitas= $NoD+1;
               $visitas_d->save(); 
            }
            
           
        }
        
        $visitas = array();
        
        $fechaA = Carbon::now()->toDateString();
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        
        
        $banner       =  Banner::bannerIndex();
        $noticia      =  Noticias::noticiasIndex();
        $especial     =  Especial::especilIndex();
        $actualizarN  =  Noticias::actualizarEstadoN();
        $actualizarB  =  Banner::actualizarEstadoB();
        $actualizarE  =  Especial::actualizarEstadoE();
        //dd($banner);
        return view('layouts.index', compact('banner','noticia','especial','global','diaria','ip'));
    }

    public function mision(){
    	$institucional = Institucional::verInstitucioonalM();
    	//dd($institucional);
    	$fechaA = Carbon::now()->toDateString();
    	$global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
    	return view('mision',compact('institucional','global','diaria'));
    }

    public function vision(){
    	$institucional = Institucional::verInstitucioonal();
    	
    	$fechaA = Carbon::now()->toDateString();
    	$global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
    	return view('vision',compact('institucional','global','diaria'));
    }

    public function directorio(){
        
        $despacho  =  Despacho::despachoIndex();
        //dd($despacho);
        
        $fechaA = Carbon::now()->toDateString();
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        return view('directorio',compact('despacho','global','diaria'));

    }
    
    public function comite_genero(){
        $ver            =  ComiteGeneroGaleria::all(); 
        $total          =  count($ver);

        $informe        =  ComiteGenero::comiteGeneroIndex();
        $comitegaleria  =  ComiteGeneroGaleria::comiteGeneroGaleriaIndexVer();
        $comieenlaces   =  ComiteGeneroEnlaces::comiteGeneroEnlacesIndex();
        //dd($informe);
        
        $fechaA = Carbon::now()->toDateString();
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        return view('comite_genero',compact('informe','comitegaleria','comieenlaces', 'total','global','diaria'));

    }
    public function seguridad_st(){
        $seguridad_st            =  Sst::where('ubicacion',"SST")
        ->get(); 

        $fechaA = Carbon::now()->toDateString();
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        
        return view('sst',compact('seguridad_st','global','diaria'));

    }

    public function comite_genero_galeria(){

        $comitegaleria  =  ComiteGeneroGaleria::comiteGeneroGaleriaIndex();
        
        $fechaA = Carbon::now()->toDateString();
        
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();

        return view('comitegenerogaleria', compact('comitegaleria','global','diaria'));
    }

    public function contactenos(){
        $fechaA = Carbon::now()->toDateString();
        
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        
    	return view('contactenos',compact('global','diaria'));
    }

    public  function programacion_audiencias(Request $request){
        //dd($request->all());

        $verTorrea = ReservaSalas::salasTorrePluck('TORRE A');
        $verTorreb = ReservaSalas::salasTorrePluck('TORRE B');

        //$reservas =  ReservaSalas::verReservasBuscar($request['fecha']);
        
        $fechaA = Carbon::now()->toDateString();
        
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();

        return view('programacion_audiencias', compact('verTorrea','verTorreb','global','diaria'));
        
    }

    public function programacion_torre_a(Request $request){
        $fecha = Carbon::now();
        $fecha = $fecha->format('Y-m-d');
        //dd($request->all() );
        $buscar = "";
        if($request->all() != null){
            $buscar = $request['fecha'];
        }else{
            $buscar = $fecha;
        }

        $reservas  = ReservaSalas::verReservasBuscar($buscar,'TORRE A');
        $fechaA = Carbon::now()->toDateString();
        
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        
        return view('programacion_torre_a', compact('reservas','global','diaria'));
    }

    public function programacion_torre_b(Request $request){
        $fecha = Carbon::now();
        $fecha = $fecha->format('Y-m-d');
        //dd($request->all() );
        $buscar = "";
        if($request->all() != null){
            $buscar = $request['fecha'];
        }else{
            $buscar = $fecha;
        }
        //dd($buscar);
        $reservas  = ReservaSalas::verReservasBuscar($buscar,'TORRE B');
        
        $fechaA = Carbon::now()->toDateString();
        
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        
        
        return view('programacion_torre_b', compact('reservas','global','diaria'));
    }


    public function legal(){
        $fechaA = Carbon::now()->toDateString();
        
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        return view('legal',compact('global','diaria'));
    }
    
      public function CiereVisitasAutomaticamente()
    {
        $fechaA = Carbon::now()->toDateString();
        $hora = Carbon::now()->totimeString();
        $ingresos = ControlIngreso::where('fecha_ingreso','<',$fechaA)
        ->where('ingreso',null)
        ->get();
        
        $salidas = ControlIngreso::where('fecha_ingreso','<',$fechaA)
        ->where('salida',null)
        ->get();
        
        foreach ($ingresos as  $control) {
            //dd($value,$value->id ,'hola');
           if($control->fecha_ingreso < $fechaA ){
               $control->ingreso = 'Ingreso automatico automatico a las '.$hora;
               $control->salida = 'Salida automatica por sistema a las '.Carbon::now();
               $control->hora_salida = $hora;
               $control->save(); 
           }
          
           
          }
          
        foreach ($salidas as  $control) {
            //dd($value,$value->id ,'hola');
           if($control->fecha_ingreso < $fechaA ){
               $control->salida = 'Salida automatica  a las '.$hora;
               $control->salida = 'Salida automatica por sistema a las '.Carbon::now();
               $control->hora_salida = $hora;
               $control->save(); 
           }
          
           
          }
         
    }
    
    public function contarVisitas(Request $request){
        
        $visitas = array();
        
        $fechaA = Carbon::now()->toDateString();
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        
        //dd($global,$diaria);
        array_push($visitas,$global);
        array_push($visitas, $diaria);
        
        if($request->ajax())
        {
         
          return response()->json($visitas);
        }

        
    }
    
   
    
     public function publico()
    {
        $eventos = ReservaSalaAudiencia::ReservasHoyCali();
        //dd($eventos);
        //dd(intval($sala),$nombre);
       return view('reservaSalas.ReservasPublico',compact('eventos')); 
       if($request->ajax())
			{
			  return response()->json($eventos);  
			};
    }
    public function publicoAjax(Request $request)
    {
        $eventos = ReservaSalaAudiencia::ReservasHoyCali();
       if($request->ajax())
			{
			  return response()->json($eventos);  
			};
    }
    
     public function publicoPalmira(Request $request)
    {
        $eventos = ReservaSalaAudiencia::ReservasHoyPalmira();
        
        return view('reservaSalas.ReservasPublicoPalmira',compact('eventos')); 
       if($request->ajax())
			{
			    //dd($eventos);
			  return response()->json($eventos);  
			};
    }
    public function publicoAjaxPalmira(Request $request)
    {
        $eventos = ReservaSalaAudiencia::ReservasHoyPalmira();
       if($request->ajax())
			{
			   // dd($eventos);
			  return response()->json($eventos);  
			};
    }
    
     public function regionCali(Request $request)
    {
        $total = RegionCali::all()->count();
        $transporte =RegionCali::viaje();
       return view('externo.region_cali',compact('transporte','total'));  
    }
    
    public function regionCaliSave(Request $request){
        $this->validate($request , [
						 'nombre_completo' => 'required',
                         'ciudad_trabajo' => 'required',
                         'cargo' => 'required',
                         'cedula' => 'required',
                         'telefono' => 'required',
                         'correo' => 'required',
                         'ya_adjunto_cedula' => 'required',
                         'fecha_de_viaje' => 'required',
                         'de_ciudad' => 'required',
                         'a_ciudad' => 'required',
                         'hora_salida' => 'required',
                         'tipo_viajes' => 'required',
                         'valor_estimado' => 'required',
                         'a_ciudad_regreso' => 'required',
                         'de_ciudad_regreso' => 'required',
                         'fecha_regreso' => 'required',
                         'hora_regreso' => 'required',
                         'valor_estimado_regreso' => 'required',
                         'requiere_hotel' => 'required',
                         'valor_total_viajes'=> 'required',
        ]);
        
        $region = new RegionCali($request->input());
        $region->save();
        Session::flash('message', 'Registro Almacenado con Exito!');
        return Redirect::back();
    }
    
    //URL PARA VISUALIZAR RESERVA DE SALAS
    public function publicoReservaSalas(Request $request,$edificio,$ciudad)
    {
        //dd($request,$edificio,$ciudad);
        $eventos = ReservaSalaAudiencia::ReservasSalasAudienciaHoy($edificio);
        //dd($eventos);
        
        $ciudad = Ciudad::findOrFail($ciudad);
        $edificio= Edificio::findOrFail($edificio);
        //dd($request,$edificio,$ciudad,$eventos);
        
        return view('reservaSalas.ReservasSalasAudiencia',compact('eventos','ciudad','edificio')); 
        
       if($request->ajax())
			{
			    //dd($eventos);
			  return response()->json($eventos);  
			};
    }
     public function publicoReservaSalasAjax(Request $request,$edificio,$ciudad)
    {
        $eventos = ReservaSalaAudiencia::ReservasSalasAudienciaHoy($edificio);
       if($request->ajax())
			{
			   // dd($eventos);
			  return response()->json($eventos);  
			};
    }
    

 public function BkDatabases(){
        $nombre= "BkFull_disajcali.sql.gz";
        //$nombre="2022-04-04_9AM_disajcali.sql.gz";
        $reporte=['re'=>'re'];
        $data              =  json_decode(json_encode($reporte), true);
        Mail::send('emails.BackupDatabases', $data, function ($message) use ($nombre) {
                             
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                                        $message->to('siriscali@cendoj.ramajudicial.gov.co');
                                        $message->cc('disajcali@gmail.com');
                                        $message->subject('Backup db');
                                        $message->attach("/home/disajcal/backups/" . $nombre,[  'mime' => "application/octet-stream", ]);
                         });
        Storage::disk('backups')->delete($nombre);
        
        return Redirect::to('/');
                         
    }
     public function BkDatabasesFicha(){
        $nombre= "BkFull_Ficha_Preliminar.sql.gz";
        //$nombre="2022-04-04_9AM_disajcali.sql.gz";
        $reporte=['re'=>'re'];
        $data              =  json_decode(json_encode($reporte), true);
        Mail::send('emails.BackupDatabases', $data, function ($message) use ($nombre) {
                             
                                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                                        $message->to('siriscali@cendoj.ramajudicial.gov.co');
                                        $message->cc('disajcali@gmail.com');
                                        $message->subject('Backup Ficha Preliminar');
                                        $message->attach("/home/disajcal/backups/" . $nombre,[  'mime' => "application/octet-stream", ]);
                         });
        Storage::disk('backups')->delete($nombre);
        
        return Redirect::to('/');
                         
    }



    public function sendEmail()
    {
        $SesClient = new SesClient([
            'version' => 'latest',
            'region'  => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $recipient_emails = ['siriscali@cendoj.ramajudicial.gov.co']; // Reemplaza con una dirección válida

        try {
            $result = $SesClient->sendEmail([
                'Destination' => [
                    'ToAddresses' => $recipient_emails,
                ],
                'ReplyToAddresses' => ['siriscali@disajcali.gov.co'],
                'Source' => 'siriscali@disajcali.gov.co',
                'Message' => [
                    'Body' => [
                        'Html' => [
                            'Charset' => 'UTF-8',
                            'Data' => 'This email was sent with Amazon SES using the AWS SDK for PHP.',
                        ],
                        'Text' => [
                            'Charset' => 'UTF-8',
                            'Data' => 'This email was sent with Amazon SES using the AWS SDK for PHP.',
                        ],
                    ],
                    'Subject' => [
                        'Charset' => 'UTF-8',
                        'Data' => 'Amazon SES Test Email',
                    ],
                ],
            ]);
            return response()->json(['message' => 'Email sent successfully', 'result' => $result]);
        } catch (AwsException $e) {
            return response()->json(['message' => 'Failed to send email', 'error' => $e->getAwsErrorMessage()]);
        }
    }
    
    public function numeroAleatorios()
    {
        return view('NumerosAleatorios');
    }
    
     public function generateNumeroAleatorios(Request $request)
    {
        $request->validate([
            'min' => 'required|integer',
            'max' => 'required|integer|gte:min',
            'count' => 'required|integer|min:1|max:1000',
            'unique' => 'required|boolean'
        ]);

        $min = $request->input('min');
        $max = $request->input('max');
        $count = $request->input('count');
        $unique = $request->input('unique');

        if ($unique && ($max - $min + 1) < $count) {
            return response()->json([
                'error' => 'El rango no tiene suficientes números únicos para la cantidad solicitada'
            ], 422);
        }

        $numbers = [];
        
        if ($unique) {
            $range = range($min, $max);
            shuffle($range);
            $numbers = array_slice($range, 0, $count);
        } else {
            for ($i = 0; $i < $count; $i++) {
                $numbers[] = rand($min, $max);
            }
        }

        return response()->json([
            'numbers' => $numbers,
            'timestamp' => now()->toDateTimeString()
        ]);
    }
    
    public function descargarFichaPreliminar($filename)
    {
        // Decodifica la URL
        $filename = urldecode($filename);
    
        // Reemplaza + por espacio
        $filename = str_replace('+', ' ', $filename);
        //DD($filename);
        $disk = \Storage::disk('fichapreliminar');
    
        if (!$disk->exists($filename)) {
            abort(404, 'Archivo no encontrado.');
        }
    
        return response()->download($disk->path($filename));
    }
    
    public function descargarFichaPreAnexo($filename)
    {
         //dd($filename);
         
        // Decodifica la URL
        $filename = urldecode($filename);
        
        $DocFicha = FichaPreliminar::where('anexos',$filename)->first();
       // dd($DocFicha);
        // Decodifica la URL
        $filename = $DocFicha->anexos;
    
        //DD($filename,$DocFicha);
        $disk = \Storage::disk('fichapreliminar');
    
        if (!$disk->exists($filename)) {
            abort(404, 'Archivo no encontrado.');
        }
    
        return response()->download($disk->path($filename));
    }
    
     public function descargarFichaPreActa($filename)
    {
        // Decodifica la URL
        $filename = urldecode($filename);
        
        $DocFicha = FichaPreliminar::where('acta_reparto',$filename)->first();
        // Decodifica la URL
        
        if(empty($DocFicha)){
          $DocFicha = FichaPreliminar::where('anexos',$filename)->first();  
        }
        
        //DD($DocFicha,$filename);
        $filename = $DocFicha->acta_reparto;
        
        
        $disk = \Storage::disk('fichapreliminar');
    
        if (!$disk->exists($filename)) {
            abort(404, 'Archivo no encontrado.');
        }
    
        return response()->download($disk->path($filename));
    }
    
    public function actualizarSas(Request $request)
    {
        //dd($request->all());
        // 1️⃣ Validar datos recibidos
        
        $validator = $this->validate($request, [
                'filename' => 'required|string',
            'sas' => 'required|string'
            ]);
    
        
    
        // 2️⃣ Obtener datos del request
        $filename = urldecode($request->input('filename'));
        $sas = $request->input('sas');
    
        // 3️⃣ Buscar en la base de datos
        $docFicha = FichaPreliminar::where('acta_reparto', $filename)->first();
    
        if (!$docFicha) {
            return response()->json([
                'status' => 'error',
                'message' => "No se encontró el registro con acta_reparto: {$filename}"
            ], 404);
        }
    
        // 4️⃣ Actualizar el campo SAS
        if($docFicha->acta_reparto_sas == "documento subido"){
            $docFicha->acta_reparto_sas = $sas;
            $docFicha->save();
        }
    
        // 5️⃣ Responder OK
        return response()->json([
            'status' => 'success',
            'message' => 'SAS actualizado correctamente',
            'data' => [
                'id' => $docFicha->id,
                'acta_reparto' => $docFicha->acta_reparto,
                'acta_reparto_sas' => $docFicha->acta_reparto_sas
            ]
        ]);
    }
    
    public function actualizarAnexosSas(Request $request)
    {
        //dd($request->all());
        // 1️⃣ Validar datos recibidos
        
        $validator = $this->validate($request, [
                'filename' => 'required|string',
            'sas' => 'required|string'
            ]);
    
        
    
        // 2️⃣ Obtener datos del request
        $filename = urldecode($request->input('filename'));
        $sas = $request->input('sas');
    
        // 3️⃣ Buscar en la base de datos
        $docFicha = FichaPreliminar::where('anexos', $filename)->first();
    
        if (!$docFicha) {
            return response()->json([
                'status' => 'error',
                'message' => "No se encontró el registro con acta_reparto: {$filename}"
            ], 404);
        }
    
        // 4️⃣ Actualizar el campo SAS
        if($docFicha->anexo_sas == "documento subido"){
            $docFicha->anexo_sas = $sas;
            $docFicha->save();
        }
    
        // 5️⃣ Responder OK
        return response()->json([
            'status' => 'success',
            'message' => 'SAS actualizado correctamente',
            'data' => [
                'id' => $docFicha->id,
                'acta_reparto' => $docFicha->anexos,
                'acta_reparto_sas' => $docFicha->anexo_sas
            ]
        ]);
    }
    
    //DESCARGAR DE DOCUEMTNOS SOLICITUD VIGILANCIA
    public function descargarDocumentoVigilancia($filename)
    {
         //dd($filename);
         
         // Decodifica la URL
        $filename = urldecode($filename);
         
        $documento = VigilanciaJudicial::where('formato', $filename)
        ->orWhere('anexos', $filename)
        ->orWhere('acta_reparto', $filename)
        ->first();
         
        
        if (is_null($documento)) {
            abort(404, 'El archivo solicitado no existe.');
        }
        
        
        // Determinar archivo REAL de forma segura
        $archivo = null;
        
        if ($documento->formato === $filename) {
            $archivo = $documento->formato;
        } elseif ($documento->anexos === $filename) {
            $archivo = $documento->anexos;
        } elseif ($documento->acta_reparto === $filename) {
            $archivo = $documento->acta_reparto;
        }
        
        //dd($documento,$archivo,!$archivo);
        
        if (!$archivo) {
            return response()->json([
                'message' => 'Archivo encontrado pero no coincide con ningún campo.'
            ], 404);
        }
    
        
        
        $filename = $archivo;
    
        //DD($filename,$DocFicha);
        $disk = \Storage::disk('VigilanciaJudicial');
    
        if (!$disk->exists($filename)) {
            abort(404, 'Archivo no encontrado.');
        }
    
        return response()->download($disk->path($filename));
    }
    

}
