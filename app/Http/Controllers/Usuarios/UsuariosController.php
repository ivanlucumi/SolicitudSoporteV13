<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SolicitudUsuario;
use App\Models\Administrador;
use App\Models\Inventario;
use Illuminate\Support\Facades\Auth;
use App\Models\SolicitudAudiencia;
use App\Models\Despacho;
use App\Models\ReservaSalas;
use App\Models\FichaGrReparto;
use App\Models\OficinaJudicialReparto;
use App\Models\FichaRemision;

use App\Models\LicenciaOffice;
use App\Models\DistribucionE2024;
use App\Models\User;
use App\Models\usuarioSgde;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class UsuariosController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('checarsesion');
        
        $this->middleware('usuario');
    }
    
    public function index(Request $request){
        
        $distribucioncantidad = DistribucionE2024::select('numero')->where('codigo_despacho', auth()->user()->cedula)->first();
        //dd($distribucioncantidad);
        
        $registros= LicenciaOffice::where('codigo_despacho', auth()->user()->cedula)->count();
        $respuestas = LicenciaOffice::where('codigo_despacho', auth()->user()->cedula)->get();
        
        return view('usuario.noticias');
        
    }

    public function show($id)
    {
        // Fallback para evitar BadMethodCallException si alguna ruta tipo /usuarios/{id} es llamada
        return redirect('usuarios/soporte');
    }

    public function audiencias(Request $request)
    {
        
        //dd($request);
        $date = \Carbon\Carbon::now();

        $fechaA = \Carbon\Carbon::parse($date)->format('Y-m-d');
        
        if(empty($request->all())){
            $solicitudesAudiencia = SolicitudAudiencia::where('email',  auth()->user()->email)
            ->fecha($fechaA)
            ->radicado($request->radicado)
            ->get();
        }else{
            $solicitudesAudiencia = SolicitudAudiencia::where('email',  auth()->user()->email)
            ->fecha($request->fecha)
            ->radicado($request->radicado)
            ->get();
        }

        
        

        return view('usuario.audiencias',compact('solicitudesAudiencia','fechaA'));
    }

     public function soporte()
    {
       // $solicitudes = SolicitudUsuario::solicituesEnviadas();
        $solicitudes = SolicitudUsuario::solicitudesEnviadas( auth()->user()->id);
        //dd($solicitudes);
        $codigoJ = Inventario::codigoJuzgado( auth()->user()->id);
        //dd($codigoJ);
        $SelectInventarios = Inventario::invetarioJuzgado($codigoJ[0]->cedula); 
        //dd($SelectInventarios );
        if($solicitudes != ''){
            $elementosInve =  explode(" ", $solicitudes[0]->elementos);
        }else{
            $elementosInve = 0;  
        }
        //dd($elementosInve);
        return view('usuario.index',compact('solicitudes','SelectInventarios','elementosInve'));
    }


    public function misSolicitudes()
    {
        return view('usuario.missolicitudes');
    }
    
    
    public function destroy($id)
    {
        $reservaSala= ReservaSalas::where('solicitud_audiencia_id',$id)
        ->select('id')
        ->first();
        
        $audiencia = SolicitudAudiencia::findOrFail($id);
        $detenido = Detenido::where('solicitud_audiencias_id',$id)->get();
        
        //dd($detenido);
        
        if($audiencia->enlace === null){
            
            if($detenido !=null){
                
                foreach($detenido as $deteni){
                    $eliminar = Detenido::findOrFail($deteni->id);
                //dd($eliminar);
                $eliminar->delete();
                }
            }
            
            
        $audiencia = SolicitudAudiencia::destroy($id);
            if($reservaSala != null){
             $reserva = ReservaSalas::destroy($reservaSala->id);   
            }
        
        
        
        Session::flash('success','Audiencia Eliminada correctamente');
        return redirect()->back(); 
        
        }else{
            Session::flash('success','La Audiencia no se puede eliminar, ya ha sido reservada');
        return redirect()->back(); 
            
        }
       
        
        
    }
    
    public function Noticias(){
        //DD('HOLA');
        
        $servicios = ServicioJudicial::serviciosPredefinidos();
        $despachos = ServicioJudicial::despachosDisponibles();
        dd('hola');
        return view('usuario.noticias',compact('servicios'));
        
    }
    
    public function Formatos(){
       return view('usuario.formatos'); 
    }
    
    public function Salas(){
        
        $salon = '10a';
        $reserva= true;
       return view('usuario.reservaSalas.Index',compact('salon','reserva')); 
    }
    
      
    public function Ficha_Remision(Request $request){
        $especialidad = FichaGrReparto::distinct('especialidad')
        ->select('especialidad')
        ->orderby('especialidad', 'ASC')
        ->pluck('especialidad','especialidad');
        //dd($especialidad);
        $gr_reparto = OficinaJudicialReparto::Gr_Reparto();
        
        return view('usuario.reparto.Ficha_Remision',compact('especialidad','gr_reparto'));
        
    }
    
    
     public function Conocimiento(Request $request){
         //dd($request->subcategoria_id);
         $ciudad = Despacho::where('codigoDespacho', auth()->user()->cedula)
         ->select('codCiudad')
         ->first();
         
         //dd($ciudad);
         
         $despachos = Despacho::where('ficha_remision',$request->subcategoria_id)
         ->select('nombreDespacho')
         ->where('codCiudad',$ciudad->codCiudad)->get();
         
         //dd($ciudad,$despachos,$request->subcategoria_id);
         
         
         if($request->ajax()){
            return response()->json($despachos);
        }
        
    }
    public function grupo_reparto(Request $request){
         //dd($request->gr_reparto);
         $grupo_reparto = FichaGrReparto::where('especialidad',$request->gr_reparto)
         ->get();
         
         if($request->ajax()){
            return response()->json($grupo_reparto);
        }
        
    }
    
     public function Ficha_Remision_store(Request $request){
          
        
           $this->validate($request, [
                'm_remision'=>'required',
                'especialidad'=>'required|max:80',
                'despacho_remite'=>'required|max:120',
                'numero_radicado_proceso'=>'required|numeric|digits:23',
                'gr_reparto'=>'required|max:120',
                'demandante'=>'required',
                'demandado'=>'required',
                'concocimiento_pre'=>'required|max:80',
                'url_expediente'=>'required|max:200',
                
            ]);
        
           $despacho = Despacho::where('codigoDespacho', auth()->user()->cedula)->first();
                
           $reporte = new FichaRemision();
           $reporte->despacho_id =   auth()->user()->id;
           $reporte->despacho_remite = strtoupper($request->despacho_remite);
           $reporte->codigo_despacho =  auth()->user()->cedula;
           $reporte->circuito = $despacho->circuito;
           $reporte->email_despacho =  auth()->user()->email;
           $reporte->m_remision = $request->m_remision;
           $reporte->especialidad = $request->especialidad;
           $reporte->numero_radicado_proceso = $request->numero_radicado_proceso;
           $reporte->gr_reparto =strtoupper($request->gr_reparto) ;
           $reporte->demandante = strtoupper($request->demandante);
           $reporte->demandado = strtoupper($request->demandado);
           $reporte->concocimiento_pre = $request->concocimiento_pre;
           $reporte->url_expediente = $request->url_expediente;
           $reporte->hora_remision = Carbon::now();
           $reporte ->save();
           
            $data              =  json_decode(json_encode($reporte), true);

         //return view('emails/soporte/pdf',compact('soporte'));
         
         $nombrePdf ="FICHA REMISION-".$reporte->numero_radicado_proceso."-".$reporte->despacho_remite.Carbon::now()->toDateTimeString().".pdf";  //
         
         $asunto= "FICHA DE REMISION";

         view()->share('reporte', $reporte);
         
         //$pdf = \Pdf::loadView('emails.soporte.fichaRemisionPdf', $data);
         //return $pdf->download('archivo.pdf');
         //dd($pdf);
         $pdf = Pdf::loadView('emails/soporte/fichaRemisionPdf',$data)->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'300']);
         
         //return $pdf->download($nombrePdf);
        
        $correoDes = auth()->user()->email;
        $correoTec =  auth()->user()->email;
        
        Mail::send('emails/soporte/correoFichaRemision', $data, function ($mail) use ($pdf,$correoDes,$nombrePdf,$asunto) {
                $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                $mail->to($correoDes);
                //$mail->cc('siriscali@cendoj.ramajudicial.gov.co');
                $mail->subject($asunto);
                $mail->attachData($pdf->output(), $nombrePdf);
            });  
            
        Session::flash('success','Solicitud Realizada Con Exito!!');
        return redirect()->back(); 
            
        
        
    }
    public function historicoFicha(Request $request){
         $fichas = FichaRemision::where('despacho_id', auth()->user()->id)
         ->orderBy('created_at','DESC')
         ->get();
         //dd($reporte);
         return view('usuario.reparto.HistoricoFichaRemision',compact('fichas'));
         
        
    }
    
    public function generarFicha(Request $request,$id){
         $reporte = FichaRemision::findOrFail($id);
         view()->share('reporte', $reporte);
         
         $pdf = Pdf::loadView('emails/soporte/fichaRemisionPdf',$data)->setPaper('legal', 'portrait')->setOptions(['isRemoteEnabled' => true, 'dpi'=>'300']);
         return $pdf->download('archivo.pdf');
        
    }
    
    public function SaveRespuesta(Request $request){
        $this->validate($request, [
                'identificacion'=>'required|unique:licencias_office_ltsc_instaladas|max:15',
                'funcionario'=>'required|max:180',
                'email_funcionario'=>'required|max:180',
                //'ip'=>'required|max:15',
                
            ]);
        DB::beginTransaction();
         try{ 
        $distribucioncantidad = DistribucionE2024::select('numero')->where('codigo_despacho', auth()->user()->cedula)->first();
        
        $cantidad =intval($distribucioncantidad->numero);
        
        $registros= LicenciaOffice::where('codigo_despacho', auth()->user()->cedula)->count();
        
        if($registros >= $cantidad){
            Session::flash('success','Ya no tiene mas equipos asignados!!');
        return redirect()->back(); 
        }
         
                $reporte = new LicenciaOffice();
                   $reporte->seccional = "CALI";
                   $reporte->codigo_despacho =   auth()->user()->cedula;
                   $reporte->despacho = strtoupper( auth()->user()->name." ". auth()->user()->lastname);
                   $reporte->identificacion = $request->identificacion;
                   $reporte->funcionario =strtoupper($request->funcionario) ;
                   $reporte->email_funcionario = $request->email_funcionario;
                   $reporte->ip = $request->ip;
                   
                   $reporte ->save();
                   
           DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
        
        Session::flash('success','REGISTRO REALIZADO!!');
        return redirect()->back(); 
       
        
    }
    
    public function ActualizacionDespacho(Request $request){
        
         $request->validate([
            'telefono' => 'required|numeric',
            'correo_demanda' => 'required|max:180',
            'correo_memoriales' => 'required|max:180',
        ]);
        
        if(!empty($request->extension)){
           $request->validate([
            'extension'=> 'required|numeric',
        ]); 
        }
        
        
        
        DB::beginTransaction();
         try{
        $despacho = Despacho::findOrFail( auth()->user()->cedula);
        $despacho->telefono = $request->telefono;
        $despacho->extension = $request->extension;
        $despacho->correo_demanda=$request->correo_demanda;
        $despacho->correo_memoriales=$request->correo_memoriales;
        $despacho->actualizacion = 1;
        $despacho->save();
        
        //dd($request->all(),$despacho);
        
        
        User::where('id',  auth()->user()->id)->update([
            'actualizacion' => 1, // Cambiar el estado a actualizado
        ]);
        
        DB::commit();
        
        Session::flash('success','Datos Actualizados!!');
        return redirect()->back(); 
    
       
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
    }
    
    
    public function sgde(Request $request){
        
         // Lista fija de cargos
        $cargos = [
            'JUEZ', 'SECRETARIO', 'OFICIAL MAYOR 1', 'OFICIAL MAYOR 2', 
            'ASISTENTE JUDICIAL', 'ESCRIBIENTE 1', 'ESCRIBIENTE 2','MAGISTRADO','ABOGADO ASESOR','AUXILIAR JUDICIAL','ASISTENTE SOCIAL','CITADOR','ASISTENTE ADMINISTRATIVO'
        ];
         
         
        $empleados= usuarioSgde::where('codigo_despacho', auth()->user()->cedula)->get();

        
        return view('usuario.sgde.index',compact('cargos','empleados'));
    }
    
    // Obtener empleados filtrados por cargo
    public function getEmpleados(Request $request)
    {
        
        $empleados= usuarioSgde::where('codigo_despacho', auth()->user()->cedula)->
        where('cargo', $request->cargo)
        ->get();
        return response()->json($empleados);
    }
    
    
    
    
    
    
    
    public function sgdeStore(Request $request){
        
         $request->validate([
            'cedula' => 'required|numeric',
            'nombre' => 'required',
            //'cargo' => 'required',
            'usuario' => 'required',
            'email' => 'required',
        ]);
        
        
        //dd($request->all());
        
        
        $solicitud = new usuarioSgde();
        $solicitud->cedula = $request->cedula;
        $solicitud->nombre = $request->nombre;
        //$solicitud->cargo=$request->cargo;
        $solicitud->usuario = $request->usuario;
        $solicitud->email=$request->email;
        $solicitud->codigo_despacho= auth()->user()->cedula;
        $solicitud->correo_despaho =  auth()->user()->email;
        $solicitud->despacho =  auth()->user()->name. " ". auth()->user()->lastname;
        $solicitud->save();
        
        //dd($request->all(),$despacho);
        
        
       
    }
    
    
    public function Escalafon(Request $request){
        
        return view('usuario.Escalafon.form');
        
    }
    
     public function ConsultaEscalafon(Request $request)
    {
        $request->validate([
            'cedula' => 'required',
            'fecha_expedicion' => 'nullable|date'
        ]);

        $persona = Persona::with([
            'escalafon.despacho',
            'escalafon.cargo',
            'calificaciones.despacho',
            'calificaciones.cargo'
        ])
        ->where('cedula', $request->cedula)
        ->first();

        if (!$persona) {
            return response()->json(['error' => 'No se encontraron registros']);
        }

        $escalafon = $persona->escalafon;

        if ($request->fecha_expedicion) {
            $escalafon = $escalafon->where(
                'fecha_expedicion',
                Carbon::parse($request->fecha_expedicion)->format('Y-m-d')
            );
        }

        return response()->json([
            'persona' => $persona,
            'escalafon' => $escalafon->values(),
            'calificaciones' => $persona->calificaciones,
            'pdf' => file_exists(public_path("pdf/{$persona->cedula}.pdf"))
        ]);
    }
    

   
}
