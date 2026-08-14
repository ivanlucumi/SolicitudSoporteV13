<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SoporteUsuario;
use App\Models\Despacho;
use App\Models\Ciudad;
use App\Models\Inventario;
use App\Models\Siniestro;

use App\Models\User;

use App\Models\Empleado;

class SoporteUsuarioController extends Controller
{
    //
    public function __construct(){
         $this->middleware('auth');
         $this->middleware('Mesa.Ayuda');
        // $this->middleware('Reparto');    

     }

    public function index(){
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        //$despachos= Despacho::all();
        $soporte = new SoporteUsuario;
        $tipo_servicio = SoporteUsuario::tipoServicio();
        $tipo_gestion = SoporteUsuario::estadoServicio();

        $ciudades = Ciudad::pluck('nombreCiudad','nombreCiudad');
        return view('externo.Formulario.formularioSoporte',compact('despachos','ciudades','soporte','tipo_servicio','tipo_gestion'));
    }

    public function almacenarDatos(Request $request){
         //dd($request['gestion']);
         $request->validate([
            'fecha_solicitud' => 'required|date',
            'fecha_atencion' => 'required|date',
            ]);
         
         $request->validate([
            'fecha_solicitud' => 'required|date',
            'fecha_atencion' => 'required|date',
            'fecha_atencion' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request['fecha_solicitud']) {
                        $fail($attribute.' no es válido. La fecha final, debe ser posterior a la fecha inicial.');
                    }
                }
                ]]);
         $despacho= Despacho::where('codigoDespacho',$request['despacho'])->first();
         
         if($request['tipo_servicio'] == "Remoto"){
             $EstadoSoporte = "PENDIENTE_FIRMA";
         }else{
            $EstadoSoporte = "PENDIENTE"; 
         }
         
        $soporte= SoporteUsuario::updateOrCreate([
            "num_caso"=> "ON-".strtoupper($request['num_caso']),
            "gestion"=> $request['gestion'],
            "tecnico_id"=>  auth()->user()->id,
            "despacho_id"=>$request['despacho'],
            "estado_soporte"=> $EstadoSoporte,
            'correo_despacho'=>$despacho->correoD,
            "fecha_solicitud"=> $request['fecha_solicitud'],
            "hora_solicitud" => $request['hora_solicitud'],
            "medio_solicitud" => $request['medio_solicitud'],
            "seccional"=> $request['seccional'],
            "despacho" => $despacho->nombreDespacho,
            "direccion"=> $request['direccion'],
            "cedula"=> $request['cedula'],
            "nombre" => $request['nombre'],
            "apellido"=> $request['apellido'],
            "correo_empleado"=> $request['correo_empleado'],
            "ciudad" => $request['ciudad'],
            "cargo"=> $request['cargo'],
            "telefono" => $request['telefono'],
            "falla_reportada" => $request['falla_reportada'],
            "fecha_atencion" => $request['fecha_atencion'],
            "hora_atencion"=> $request['hora_atencion'],
            "nombre_tecnico"=>  auth()->user()->name.' '.  auth()->user()->lastname,
            "tipo_servicio"=> $request['tipo_servicio'],
            "placa"=> $request['placa'],
            "serial_equipo"=> $request['serial_equipo'],
            "marca_equipo"=> $request['marca_equipo'],
            "modelo_equipo"=> $request['modelo_equipo'],
            "sistema_operativo" => $request['sistema_operativo'],
            "antivirus"=> $request['antivirus'],
            "ver_antivirus"=> $request['ver_antivirus'],
            "agente_ivanti"=> $request['agente_ivanti'],
            "office"=> $request['office'],
            "equipo_dominio"=> $request['equipo_dominio'],
            "requiere_repuesto"=> $request['requiere_repuesto'],
            "elementos_de_soporte"=> $request['elementos_de_soporte'],
            "tipo_elemento_de_soporte" => $request['tipo_elemento_de_soporte'],
            "elemeto_soporte"=> $request['elemeto_soporte'],
            "placa_soporte"=> $request['placa_soporte'],
            "serial_equipo_soporte"=> $request['serial_equipo_soporte'],
            "marca_equipo_soporte" => $request['marca_equipo_soporte'],
            "modelo_equipo_soporte"=> $request['modelo_equipo_soporte'],
            "sistema_operativo_soporte"=> $request['sistema_operativo_soporte'],
            "memoria_soporte"=> $request['memoria_soporte'],
            "disco_soporte"=> $request['disco_soporte'],
            "procesador_soporte"=> $request['procesador_soporte'],
            "tipo_equipo_soporte" => $request['tipo_equipo_soporte'],
            "nombre_equipo_soporte"=> $request['nombre_equipo_soporte'],
            "diagnostico" => $request['diagnostico'],
            "solucion"=> $request['solucion'],
            "observacion_tecnico"=> $request['observacion_tecnico'],
           // "observacion_cliente"=> $request['observacion_cliente'],
            //"disposicion"=> $request['disposicion'],
            //"conocimiento_tec"=> $request['conocimiento_tec'],
            //"tiempo_aten"=> $request['tiempo_aten'],
           // "avance_caso"=> $request['avance_caso'],
            //"firma"=> $request['firma'],
            //"firma_tecnico"=>  auth()->user()->firma,
         ]);
         
         //$soporte = SoporteUsuario::find(8);
         
         if($soporte->tipo_servicio == "Remoto"){
            
            Session::flash('success', 'En espera de Firma de Funcionario !');
            return Redirect::to('/tecnico/soporte');
            
         }
         
         $id=$soporte->id;
         
         return redirect()->route('tramitar.soporte.servicio', $id);
    }
    
    public function PendienteFirma(){
        
        if( auth()->user()->tipo_rol == 'COORDINADOR'){
         $soportes = SoporteUsuario::where('estado_soporte','PENDIENTE_FIRMA')->get();   
        }else{
         $soportes = SoporteUsuario::where('estado_soporte','PENDIENTE_FIRMA')->where("tecnico_id",  auth()->user()->id)->get();  
         //dd($soportes, auth()->user()->id);
        }
        return view('soporte.PendienteFirma',compact('soportes'));
        
    }
    
     public function formularioSinCaso(){
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        //$despachos= Despacho::all();
        $soporte = new SoporteUsuario;

        $ciudades = Ciudad::pluck('nombreCiudad','nombreCiudad');
        return view('externo.Formulario.FirmaFormularioSinCaso',compact('despachos','ciudades','soporte'));
    }
    
     public function almacenarDatosSinCaso(Request $request){
         //dd($request->all());
          $this->validate($request, [
                    'disposicion'=>'required',
                    'conocimiento_tec'=>'required',
                    'tiempo_aten'=>'required',
                    'avance_caso'=>'required',
                    'firma'=>'required',
                    'correo_empleado'=>'required',
                    
                    ]);
         $despacho= Despacho::where('codigoDespacho',$request['despacho'])->first();
         
         //$fileName = $identificacion ."_".$verificacion->p_apellido .'_' . time() . '.jpg';
         //$this->guardarImagenBase64EnPublic($request->imagen_base64, $fileName);
         
         
        $soporte= SoporteUsuario::Create([
            //"num_caso"=> $request['num_caso'],
            "gestion"=> $request['gestion'],
            "tecnico_id"=>  auth()->user()->id,
            "despacho_id"=>$request['despacho'],
            "estado_soporte"=> "PENDIENTE",
            "fecha_solicitud"=> $request['fecha_solicitud'],
            "hora_solicitud" => $request['hora_solicitud'],
            "medio_solicitud" => $request['medio_solicitud'],
            "seccional"=> $request['seccional'],
            "despacho" => $despacho->nombreDespacho,
            "direccion"=> $request['direccion'],
            "cedula"=> $request['cedula'],
            "nombre" => $request['nombre'],
            "apellido"=> $request['apellido'],
            "correo_empleado"=> $request['correo_empleado'],
            "ciudad" => $request['ciudad'],
            "cargo"=> $request['cargo'],
            "telefono" => $request['telefono'],
            "falla_reportada" => $request['falla_reportada'],
            "fecha_atencion" => $request['fecha_atencion'],
            "hora_atencion"=> $request['hora_atencion'],
            "nombre_tecnico"=>  auth()->user()->name.' '.  auth()->user()->lastname,
            "tipo_servicio"=> $request['tipo_servicio'],
            "placa"=> $request['placa'],
            "serial_equipo"=> $request['serial_equipo'],
            "marca_equipo"=> $request['marca_equipo'],
            "modelo_equipo"=> $request['modelo_equipo'],
            "sistema_operativo" => $request['sistema_operativo'],
            "antivirus"=> $request['antivirus'],
            "ver_antivirus"=> $request['ver_antivirus'],
            "agente_ivanti"=> $request['agente_ivanti'],
            "office"=> $request['office'],
            "equipo_dominio"=> $request['equipo_dominio'],
            "requiere_repuesto"=> $request['requiere_repuesto'],
            "elementos_de_soporte"=> $request['elementos_de_soporte'],
            "tipo_elemento_de_soporte" => $request['tipo_elemento_de_soporte'],
            "elemeto_soporte"=> $request['elemeto_soporte'],
            "placa_soporte"=> $request['placa_soporte'],
            "serial_equipo_soporte"=> $request['serial_equipo_soporte'],
            "marca_equipo_soporte" => $request['marca_equipo_soporte'],
            "modelo_equipo_soporte"=> $request['modelo_equipo_soporte'],
            "sistema_operativo_soporte"=> $request['sistema_operativo_soporte'],
            "memoria_soporte"=> $request['memoria_soporte'],
            "disco_soporte"=> $request['disco_soporte'],
            "procesador_soporte"=> $request['procesador_soporte'],
            "tipo_equipo_soporte" => $request['tipo_equipo_soporte'],
            "nombre_equipo_soporte"=> $request['nombre_equipo_soporte'],
            "diagnostico" => $request['diagnostico'],
            "solucion"=> $request['solucion'],
            "observacion_cliente"=> $request['observacion_cliente'],
            "disposicion"=> $request['disposicion'],
            "conocimiento_tec"=> $request['conocimiento_tec'],
            "tiempo_aten"=> $request['tiempo_aten'],
            "avance_caso"=> $request['avance_caso'],
            "firma"=> $request['firma'],
            "firma_tecnico"=>  auth()->user()->firma,
         ]);
         
         //$soporte = SoporteUsuario::find(8);
         
         $id=$soporte->id;
         
         return redirect()->route('tramitar.soporte.servicio', $id);
    }
    
    
    private function guardarImagenBase64EnPublic($base64, $fileName)
    {
        try {
            // Eliminar encabezado data:image/jpeg;base64, si existe
            $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $base64);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            //$path = public_path('Biometria');
            $path = base_path('../public_html/SoportePdf');
            if (!file_exists($path)) {
               // mkdir($path, 0755, true);
            }

            file_put_contents($path . '/' . $fileName, $image);
        } catch (\Throwable $e) {
            throw new \Exception("No se pudo guardar la imagen: " . $e->getMessage());
        }
    }
    

    public function listadoServicios(){
        $tecnicos = User::where('rol',17)->pluck('name','id');
        $soportes = SoporteUsuario::where('estado_soporte','PENDIENTE')->get();
        
        //dd($soportes);
        if( auth()->user()->tipo_rol == 'COORDINADOR'){
         $soportes = SoporteUsuario::where('estado_soporte','PENDIENTE')->get();   
        }else{
         $soportes = SoporteUsuario::where('estado_soporte','PENDIENTE')->where("tecnico_id",  auth()->user()->id)->get();  
         //dd($soportes, auth()->user()->id);
        }
        return view('soporte.listadoSoportes',compact('soportes','tecnicos'));
    }
    public function ServiciosAtendidos(){
        $soportes = SoporteUsuario::orderBy('created_at','ASC')
        ->get();   
        return view('soporte.ListadoSoportesCoordinador',compact('soportes'));

    }
    public function ServiciosAbiertos(){

    }
    public function AtenderServicios(Request $request,$id){
        $soporte = SoporteUsuario::findOrFail($id);
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        $ciudades = Ciudad::pluck('nombreCiudad','nombreCiudad');
        
        $tipo_gestion = SoporteUsuario::estadoServicio();
        //return view('externo.Formulario.formularioSoporte',compact('despachos','ciudades','soporte'));
        $tipo_servicio = SoporteUsuario::tipoServicio();
        
        //dd($soporte->gestion);
        
       return view('externo.Formulario.FirmaFuncionario',compact('despachos','ciudades','soporte','tipo_servicio','tipo_gestion'));
    }
    public function CerrarServicio(Request $request,$id){
        
        
        $request->validate([
            'fecha_solicitud' => 'required|date',
            'fecha_atencion' => 'required|date',
            'disposicion'=>'required',
            'conocimiento_tec'=>'required',
            'tiempo_aten'=>'required',
            'avance_caso'=>'required',
            ]);
         
         $request->validate([
            'fecha_solicitud' => 'required|date',
            'fecha_atencion' => 'required|date',
            'fecha_atencion' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request['fecha_solicitud']) {
                        $fail($attribute.' no es válido. La fecha final, debe ser posterior a la fecha inicial.');
                    }
                }
                ]]);
        
       // dd($request->all());
        
        if($request->tipo_servicio == 'Remoto'){
            $estado='CERRADO';
            /*
            $estado='PENDIENTE_FIRMA';
            */
        }else{
            $this->validate($request, [
                    'firma'=>'required',
                    ]);
            if($request->firma){
                $estado='CERRADO';
            }else{
                $estado='PENDIENTE';
            }
        }


        if($request->tipo_servicio != 'Remoto'){
             $this->validate($request, [
                    'firma'=>'required',
                    ]);
            if($request->firma){
                $estado='CERRADO';
               
            }
        }
        
        $despacho= Despacho::where('codigoDespacho',$request['despacho'])->first();
        
        
        
        

        $soporte = SoporteUsuario::findOrFail($id);
        $soporte->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $soporte->estado_soporte=$estado;
        $soporte->despacho = $despacho->nombreDespacho;
        $soporte->firma_tecnico =  auth()->user()->firma;
        $soporte->save();
        
        //enviar reporte en caso de siniestro
        
        if($soporte->gestion == 'SINIESTRO'){
          $siniestro= Siniestro::Create([
            "num_caso"=> $soporte->num_caso,
            "despacho_id"=>$despacho->codigoDespacho,
            "despacho" => $despacho->nombreDespacho,
            "correo_despacho" => $despacho->correoD,
            "direccion"=> $soporte->direccion,
            "diagnostico"=> $soporte->diagnostico,
            "cedula"=> $soporte->cedula,
            "nombre_usuario" => $soporte->nombre." ".$soporte->apellido,
            "ciudad" => $soporte->ciudad,
            "cargo"=> $soporte->cargo,
            "telefono" => $soporte->telefono,
            "placa"=> $soporte->placa,
            "serial_equipo"=> $soporte->serial_equipo,
            "marca_equipo"=> $soporte->marca_equipo,
            "modelo_equipo"=> $soporte->modelo_equipo,
            "fecha_reporte" => Carbon::now()->toDateTimeString(),
            "falla_reportada" =>$soporte->falla_reportada,
            "tecnico_id"=>  auth()->user()->id,
            "nombre_tecnico"=>  auth()->user()->name.' '.  auth()->user()->lastname,
            
              ]); 
              
              
            //dd($siniestro);
            
        }
        //_________________________________________
        
        //ENVIAR CASO CERRADO Y DESCARGAR PDF
           //dd($soporte);
         //$soporte = SoporteUsuario::find(8);

         $data              =  json_decode(json_encode($soporte), true);

         //return view('emails/soporte/pdf',compact('soporte'));
         
         $nombrePdf =$soporte->num_caso."-".$soporte->fecha_solicitud."-".$soporte->ciudad.".pdf";  //
         
         $asunto= $soporte->ciudad."-".$soporte->num_caso."-".$soporte->gestion;

       // dd(view()->share('soporte', $soporte),'hola');
         view()->share('soporte', $soporte);
         
        $cedula_tec = User::select('cedula')->where('id',$soporte->tecnico_id)->first();
        $soporte->cedula_tec = $cedula_tec->cedula;
         
         $pdf = Pdf::loadView('emails/soporte/PdfOnsiteV3',compact('soporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'650']);
         
        $despacho= Despacho::where('codigoDespacho',$soporte->despacho_id)->first();
        //dd($despacho,$soporte);
        
        //return $pdf->download('comprobante.pdf'); teccoorseccali@cendoj.ramajudicial.gov.co
        
        $correoDes =$despacho->correoD;
        $correoTec =  auth()->user()->email;
        $Estado =$soporte->gestion;
        $caso =$soporte->num_caso;
        
        if( auth()->user()->email =='tecnicosiris@disajcali.gov.co'){
            $pdf = Pdf::loadView('emails/soporte/PdfOnsiteV3',compact('soporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'650']);
          Mail::send('emails/soporte/comprobantePdf', $data, function ($mail) use ($pdf,$correoDes,$nombrePdf,$Estado,$caso,$asunto) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to('soportemesayudadeaj@deaj.ramajudicial.gov.co');
               // $mail->cc('teccoorseccali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                //$mail->cc($correoDes);
                $mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                $mail->attachData($pdf->output(), $nombrePdf);  
            });  
        };
        
        if( auth()->user()->email =='cfrasicap@disajcali.gov.co' ||  auth()->user()->email =='aesquivelm@disajcali.gov.co' ||  auth()->user()->email =='jcabrerar@disajcali.gov.co' ||  auth()->user()->email =='jrodriguezf@disajcali.gov.co' ){
               Mail::send('emails/soporte/comprobantePdf', $data, function ($mail) use ($pdf,$correoDes,$nombrePdf,$Estado,$caso,$asunto) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to('soportemesayudadeaj@deaj.ramajudicial.gov.co');
               // $mail->cc('teccoorseccali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                //$mail->cc($correoDes);
                $mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                $mail->attachData($pdf->output(), $nombrePdf);
            });  
        }else{
                 Mail::send('emails/soporte/comprobantePdf', $data, function ($mail) use ($pdf,$correoDes,$nombrePdf,$correoTec,$Estado,$caso,$asunto) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to($correoTec);
                $mail->cc('teccoorseccali@cendoj.ramajudicial.gov.co');
                //$mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                //$mail->cc($correoDes);
                //$mail->cc('gmstdesajvalle3@cendoj.ramajudicial.gov.co');
                $mail->attachData($pdf->output(), $nombrePdf);
            });
        }
    
    
      /* Mail::send('emails/soporte/comprobantePdf', $data, function ($mail) use ($pdf,$correoDes,$nombrePdf) {
            $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
            $mail->to('jbolivarrestrepo@gmail.com');
            $mail->subject('Remision de Formato Firmado por Funcionario Despacho');
            //$mail->cc($correoDes);
            $mail->cc('gmstdesajvalle3@cendoj.ramajudicial.gov.co');
            $mail->attachData($pdf->output(), $nombrePdf);
        });*/
    
        //return $pdf->download($nombrePdf); 
       //return $pdf->download('comprobante.pdf');
       Session::flash('success', 'Se remite Pdf Firmado !');
       return Redirect::to('/tecnico/soporte');
    }
    
    public function ReenviarPdf(){
        
    }
    
    public function ReenviarCorreo(Request $request){
        
        $numCaso = $request->num_caso;
        
        $soporte = SoporteUsuario::where('num_caso',$numCaso)
        ->where('estado_soporte','CERRADO')
        ->first();
        
        if(empty($soporte)){
         Session::flash('success', 'Verifique numero de caso, ese no esta relacionado!');
         return Redirect::back(); 
        }
        
         $data              =  json_decode(json_encode($soporte), true);

         //return view('emails/soporte/pdf',compact('soporte'));
         
         $nombrePdf =$soporte->num_caso."-".$soporte->fecha_solicitud."-".$soporte->ciudad.".pdf";  //
         
         $asunto= $soporte->ciudad."-".$soporte->num_caso."-".$soporte->gestion;
         
        $cedula_tec = User::select('cedula')->where('id',$soporte->tecnico_id)->first();
        $soporte->cedula_tec = $cedula_tec->cedula;
        //dd($soporte);
         view()->share('soporte', $soporte);
         $pdf = Pdf::loadView('emails/soporte/PdfOnsiteV3',compact('soporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'650']);
         //return $pdf->download($nombrePdf);
        $despacho= Despacho::where('codigoDespacho',$soporte->despacho_id)->first();
        //dd($despacho,$soporte);
        //dd('hola');
        //return $pdf->download('comprobante.pdf'); teccoorseccali@cendoj.ramajudicial.gov.co
        $usuario = User::findOrFail($soporte->tecnico_id)->first();
        
        
        
        
        $correoDes =$soporte->correo_despacho;
        $correoTec =  auth()->user()->email;
        $Estado =$soporte->gestion;
        $caso =$soporte->num_caso;
        
        
        if( auth()->user()->email =='tecnicosiris@disajcali.gov.co'){
            $pdf = Pdf::loadView('emails/soporte/PdfOnsiteV3',compact('soporte'))->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'650']);
          Mail::send('emails/soporte/comprobantePdf', $data, function ($mail) use ($pdf,$correoDes,$nombrePdf,$correoTec,$Estado,$caso,$asunto) {
                
               // $mail->cc('teccoorseccali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                //$mail->cc($correoDes);
                $mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                $mail->attachData($pdf->output(), $nombrePdf);  
            });  
            
             return $pdf->download($nombrePdf); 
           //return $pdf->download('comprobante.pdf');
           Session::flash('success', 'Se remite Pdf Firmado al correo !');
        };
        
        
        
                Mail::send('emails/soporte/comprobantePdf', $data, function ($mail) use ($pdf,$correoDes,$nombrePdf,$correoTec,$Estado,$caso,$asunto) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to($correoTec);
                $mail->cc('teccoorseccali@cendoj.ramajudicial.gov.co');
                //$mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                //$mail->cc($correoDes);
                //$mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                $mail->attachData($pdf->output(), $nombrePdf);
            });
        
    
    return $pdf->download($nombrePdf); 
       //return $pdf->download('comprobante.pdf');
       Session::flash('success', 'Se remite Pdf Firmado al correo !');
                       
        //return Redirect::to('/tecnico/soporte/listado/soportes');
    }
    
    
    
      public function consultaCedulaE(Request $request,$id){
         
         //dd($request->all(),$id);
              
        $usuarioSoporte = SoporteUsuario::where('cedula', $id)
            ->orderBy('id', 'desc')
            ->first();
            
        $Emple = Empleado::where('cedulaE',$id)->first(); 
        
        //dd($usuarioSoporte,$Emple);
        
        if (is_null($Emple) && is_null($usuarioSoporte)) {
                return response()->json([], 204);
            }

            if($usuarioSoporte) {
                
               $despacho = Despacho::findOrFail($usuarioSoporte->despacho_id); 
                // Formatear resultado con campos esperados
                $persona = [[
                        'id' => $usuarioSoporte->id,
                        'cedulaE' => $usuarioSoporte->cedula,
                        'nameE' => $usuarioSoporte->nombre,
                        'lastnameE' => $usuarioSoporte->apellido,
                        'cargo_titular' => $usuarioSoporte->cargo,
                        'circuito' => $usuarioSoporte->seccional,
                        'ciudad_ubicacion_laboral' => $usuarioSoporte->ciudad,
                        'clase_nombramiento' => 'PROVISIONALIDAD',
                        'codCiudad' => $usuarioSoporte->despacho_id ?? null,
                        'cod_cargo' => null,
                        'cod_dependencia' => $usuarioSoporte->despacho_id ?? null,
                        'cod_despacho' => $usuarioSoporte->despacho_id ?? null,
                        'codigoCiudad' => $usuarioSoporte->despacho_id ?? null,
                        'codigoDespacho' => $usuarioSoporte->despacho_id ?? null,
                        'correoD' => $usuarioSoporte->correo_despacho,
                        'correo_demanda' => null,
                        'correo_memoriales' => null,
                        'creador' => '',
                        'created_at' => $usuarioSoporte->created_at,
                        'dependencia_titular' => $usuarioSoporte->despacho,
                        'direccion' => $usuarioSoporte->direccion,
                        'districto' => $usuarioSoporte->seccional,
                        'especialidad' => 'DISAJ',
                        'estado' => null,
                        'extension' => null,
                        'fecha_posesion' => null,
                        'fecha_retiro' => null,
                        'ficha_remision' => null,
                        'modificador' => 'root',
                        'nombreCiudad' => $usuarioSoporte->ciudad,
                        'nombreDespacho' => $usuarioSoporte->despacho,
                        'notificacion_ficha_remision' => '0',
                        'telefono' => $usuarioSoporte->telefono,
                        'tipo' => '',
                        'updated_at' => $usuarioSoporte->updated_at,
                        'actualizacion' => '0',
                    ]];
                
                
        
                if($request->ajax())
                {
                  return response()->json($persona);
                }
                
                
            }
         
        
        $empleado = Empleado::where('cedulaE',$id)->get();
        
       // dd($empleado);
        
       // dd($empleado,$empleado->count() );
        
        if($empleado->count() >= 2){
            
            
         //$persona = Empleado::where('cedulaE',$id)->where('clase_nombramiento','PROVISIONALIDAD')->first(); 
         $persona = DB::table('empleados')
            ->where('cedulaE', $id)
            ->where('clase_nombramiento','PROVISIONALIDAD')
            ->join('despachos', 'empleados.cod_despacho', '=', 'despachos.codigoDespacho')
            ->join('ciudades', 'despachos.codCiudad', '=', 'ciudades.codigoCiudad')
            ->select('empleados.*', 'despachos.*', 'ciudades.*')
            ->get();
          //dd('entros a 0');
        }else{
            
         $Emple = Empleado::where('cedulaE',$id)->first(); 
         $despac = Despacho::where('codigoDespacho',$Emple->cod_despacho)->first();
        // dd($persona);
        if(!empty($despac)){
         $persona = DB::table('empleados')
            ->where('cedulaE', $id)
            //->where('clase_nombramiento','PROVISIONALIDAD')
            ->join('despachos', 'empleados.cod_despacho', '=', 'despachos.codigoDespacho')
            ->join('ciudades', 'despachos.codCiudad', '=', 'ciudades.codigoCiudad')
            ->select('empleados.*', 'despachos.*', 'ciudades.*')
            ->get();
           //dd($persona); 
        }else{
           $persona = DB::table('empleados')
            ->where('cedulaE', $id)
            //->where('clase_nombramiento','PROVISIONALIDAD')
            //->join('despachos', 'empleados.cod_despacho', '=', 'despachos.codigoDespacho')
            //->join('ciudades', 'despachos.codCiudad', '=', 'ciudades.codigoCiudad')
            ->select('empleados.*')
            ->get();
        }
        
        }
        
        
    
       //dd($persona);
        
        
        //dd($id, $vehiculo);
        
        if($request->ajax())
        {
         
          return response()->json($persona);
        }
        
        
    }
    
    public function consultaPlacaE(Request $request,$id){
        //dd($request->all(),$id);
        
        $inventario = Inventario::where('placaInventario',$id)->first();
       
        //dd($persona);
        
        //dd($id, $vehiculo);
        
        if($request->ajax())
        {
         
          return response()->json($inventario);
        }
        
    }
    
    public function asignarTecnico(Request $request,$id){
         $soporte = SoporteUsuario::findOrFail($id);
         
         $user= User::findOrFail($request->tecnico);
         
         //dd($soporte,$request->all());
         $soporte->tecnico_id =$request->tecnico;
         $soporte->nombre_tecnico =$user->name ." ". $user->lastname;
         $soporte->save();
         
         Session::flash('success', 'Tecnico Asignado!');
         return Redirect::back();
         
    }
    
    public function indexInventario(Request $request){
        
        $soporte = New Inventario();
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        $ciudades = Ciudad::pluck('nombreCiudad','nombreCiudad');
        
        return view('soporte.Inventario.FormularioInventario',compact('soporte','despachos','ciudades'));
        
    }
    
     public function saveInventario(Request $request){
        
        dd('guardo');
        
    }
    
}
