<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\SoportesExport;

use App\Models\SolicitudUsuarioSoporte;
use App\Models\Despacho;
use App\Models\RegionCali;
use App\Models\usuarioSgde;


class AdministradorSolicitudUsuarios extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        //$this->middleware('cambiopass');
        $this->middleware('administrador');
        
    }
    public function index(){
        
        $despachos = Despacho::pluck('nombreDespacho','codigoDespacho');
        $medio = SolicitudUsuarioSoporte::medio_solicitud();
        $reporte = New SolicitudUsuarioSoporte();
        $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud();
        $reportes= SolicitudUsuarioSoporte::where('respuesta',null)
        ->where('estado','!=',"CERRADO")
        ->orderBy('fecha_solicitud', 'asc')->get();

        return view('administrador.reporteUsuarios.index',compact('reportes','tipo_solicitud','reporte','despachos','medio'));

    }
    
    public function registrar(Request $request){
        
        $despacho = Despacho::where('codigoDespacho',$request->despacho)->first();
        
        //dd($request->despacho,$despacho);
        
        $reporte = New SolicitudUsuarioSoporte();
        $reporte->tipo_solicitud = $request->tipo_solicitud;
        $reporte->solicitud = $request->solicitud;
        $reporte->id_funcionario = $request->id_funcionario;
        $reporte->medio_solicitud = $request->medio_solicitud;
        $reporte->funcionario = $request->funcionario;
        $reporte->id_despacho = $request->despacho;
        $reporte->email_despacho = $despacho->correoD;
        $reporte->despacho = $despacho->nombreDespacho;
        $reporte->respuesta = $request->respuesta;
        $reporte->estado = "CERRADO";
        $reporte->fecha_solicitud = Carbon::now();
        $reporte->fecha_solucion = Carbon::now();
        $reporte->id_user =  auth()->user()->id;
        $reporte->quien_da_solucion =  auth()->user()->name." ". auth()->user()->lastname;
        $reporte->save();
        
        //dd($reporte);
        Session::flash('message', 'Soporte registrado con Exito');
        return redirect()->route('administrador.registro.solicitud');
        
    }
     public function consultaCedulaE(Request $request,$id){
         
         //dd($request->all(),$id);
        
        $empleado = Empleado::where('cedulaE',$id)->first();
        dd($empleado);
        
        if($request->ajax())
        {
         
          return response()->json($empleado);
        }
        
        
    }
    
    public function edit(Request $request,$id){
       //dd($request,$id);       
       
       $tipo_solicitud=SolicitudUsuarioSoporte::tipo_solicitud();
        $reporte=SolicitudUsuarioSoporte::findOrFail($id);
       // dd($reporte->id_user, auth()->user(),$reporte);
        
        
        if($reporte->id_user == null || $reporte->id_user== auth()->user()->id ){
            if( $reporte->estado == "CERRADO"){
                $reporte->estado = "CERRADO";
            }else{
                $reporte->estado = "EN GESTION";   
            }
            
            $reporte->id_user =  auth()->user()->id;
            $reporte->quien_da_solucion =  auth()->user()->name." ". auth()->user()->lastname;
            $reporte->save();
    
            
            return view('administrador.reporteUsuarios.edit',compact('reporte','tipo_solicitud'));
        }

        Session::flash('message', 'Ya esta siendo Resuelta');
        return Redirect::to('/administrador/registro/solicitud/usuarios');

        

    }

    public function resolver(Request $request,$id){
        //dd($id,$request);
        $reporte=SolicitudUsuarioSoporte::findOrFail($id);
        $reporte->respuesta = $request->respuesta;
        $reporte->estado = "CERRADO";
        $reporte->fecha_solucion = Carbon::now();
        $reporte->quien_da_solucion =  auth()->user()->name." ". auth()->user()->lastname;
        $reporte->save();

        $data              =  json_decode(json_encode($reporte), true);
                    
            Mail::send('emails.solucionSoporte', $data, function ($message) use ($reporte) {
              $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
              $message->to($reporte->email_despacho, $reporte->despacho);
              $message->subject('Respuesta Soporte Solicitado  por SIRIS');
                        
            });
            
        

        Session::flash('message', 'Caso Resuelto');
        return Redirect::to('/administrador/registro/solicitud/usuarios');

    }

    public function soltar(Request $request,$id){
        $reporte=SolicitudUsuarioSoporte::findOrFail($id);
        $reporte->estado = "ABIERTO";
        $reporte->id_user = NULL;
        $reporte->quien_da_solucion = NULL;
        $reporte->save();
        //dd($reporte);
        Session::flash('message', 'Se Suelta Solucion Requerimiento');
        return Redirect::to('/administrador/registro/solicitud/usuarios');
    }

    public function resueltas(){
        /*$reportes= SolicitudUsuarioSoporte::where('respuesta',"!=",null)
        ->where('estado',"CERRADO")
        ->where('id_user',"!=","NULL")
        ->orderBy('fecha_solucion', 'desc')->paginate(1000);*/
        
        $reportes = SolicitudUsuarioSoporte::query()
        ->whereNotNull('respuesta')
        ->where('estado', 'CERRADO')
        ->whereNotNull('id_user')
        ->orderByDesc('fecha_solucion')
        ->simplePaginate(1000);

        return view('administrador.reporteUsuarios.resueltas',compact('reportes'));
    }
    
   
    public function estadistica(Request $request){
        $fecha = Carbon::now();
        
        $agendadoI = $request->agendadorMesi;
        $agendadoF = $request->agendadorMesf;

        if (empty($agendadoI) && empty($agendadoF)) {
            // Traer todos los datos sin filtro
            $estadisticaFuncionarioM = SolicitudUsuarioSoporte::estadisticaFuncionario();
            $estadisticaTipoSolicitud = SolicitudUsuarioSoporte::estadisticaTipoSolicitud();
            $agendadoI = '';
            $agendadoF = '';
        } else {
           // dd($request->agendadorMesi,$request->agendadorMesf);
            // Filtrar usuarios que resolvieron en las fechas dadas
            $estadisticaFuncionarioM = SolicitudUsuarioSoporte::estadisticaFuncionarioFechas($agendadoI, $agendadoF);
            // Traer datos de tipo de solicitud por fecha
            $estadisticaTipoSolicitud = SolicitudUsuarioSoporte::estadisticaTipoSolicitudFechas($agendadoI, $agendadoF);
        }
       // dd($estadisticaFuncionarioM,$estadisticaTipoSolicitud,$request->agendadorMesi,$request->agendadorMesf);
        
        return view('administrador.estadistica.soportes',compact('fecha', 'agendadoI', 'agendadoF', 'estadisticaFuncionarioM', 'estadisticaTipoSolicitud'));
    }
    
    public function ListadoRegionCali(){
        
        $solicitudes = RegionCali::all();
        
        return view('administrador.estadistica.regional',compact('solicitudes'));
        
    }
    
    public function indexUsuariosSgde()
    {
        $usuarios = usuarioSgde::where('created_at','>','2025-05-01 00:00:00')->orderBy('id')->get();
        return view('administrador.UsuariosSgde.Listado', compact('usuarios'));
    }
    
}
