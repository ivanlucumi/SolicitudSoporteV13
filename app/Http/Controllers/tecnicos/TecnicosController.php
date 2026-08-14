<?php

namespace App\Http\Controllers\tecnicos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Models\SolicitudUsuario;
use App\Models\Administrador;
use App\Models\Elemento;
use App\Models\Inventario;
use App\Models\Seccional;
use Illuminate\Support\Facades\Session;
use App\Models\Seguimiento;

use App\Http\Requests\TecnicoCreateRequest;
use App\Models\User;
use App\Models\Despacho;
use App\Models\TipoRequerimiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

use App\Models\SolicitudAudiencia;
use App\Models\Detenido;

class TecnicosController extends Controller
{
    //
	public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        
        $this->middleware('tecnico');
    }

    public function index(Request $request)
    { 
        $fechaCon = $request->fecha;   
        $radicado = $request->radicado;
        $email = $request->email;
            
        if(empty($request->all()) ){

        $fecha = Carbon::now()->toDateString();
        //dd($fecha);
        $fechademas = Carbon::now();
        $fechademas->addDays(1)->toDateString(); 
           

        $solicitudes = SolicitudAudiencia::where('enlace','!=',null)
        //->where('quien_asigno','!=', auth()->user()->id)
        //->where('quien_asigno','=', auth()->user()->id)
        ->where('id_conexion','!=',null)
        //->orWhere('quien_asigno','=', null)
        ->whereBetween('fecha_prgramada', [$fecha, $fechademas])
        //->fecha($fechaCon)
        //->ubicacion('CALI')
        //->paginate(1);
        ->orderBy('fecha_prgramada','ASC')
        ->get();
 
        }else{

        $solicitudes = SolicitudAudiencia::where('enlace','!=',null)
        ->where('id_conexion','!=',null)
        ->fecha($fechaCon)
        ->radicado($radicado)
        ->email($email)
        ->orderBy('fecha_prgramada','ASC')
        ->get();
        }
            
           // dd($solicitudes);
            $solicitudAudiencia = new SolicitudAudiencia();
        return view('audiencias.tecnico.porfecha',compact('solicitudes','solicitudAudiencia'));
    }

    public function solicitudes()
    {
        //
        //$solicitudes = Administrador::getSolicitud();
        $solicitudes = SolicitudUsuario::with('empleadoSoli','requerimientoSoli','categoriaSoli'/*,'elementosSoli'*/)->get();
        $contsolicitudes = SolicitudUsuario::where('tecnico','!=',null)->get();
        //dd($contsolicitudes);
        $todascont  = count($solicitudes);
        $solitcont  = count($contsolicitudes);
        if($todascont == $solitcont){
            $solitcont = 0;
        }
        //dd($solicitudes);
        //$inventarios =  Administrador::Inventario(); 
        $inventarios = Elemento::pluck('nombreElemento', 'id');
        //dd($inventario);
        return view('administrador.solicitudes.tecnico',compact('solicitudes','inventarios','solitcont'));
    }

    public function store(Request $request)
    {
        //dd($request);   

        if(isset($request->idPlaca))
        {
        $idPlaca = (implode(' ',$request->idPlaca));
         }else{
         $idPlaca = "";} 

        Seguimiento::create([
            'idReporte'        => $request['idSolicitud'],
            'seccional'        => $request['seccional'],
            'presentacion'          => $request['presentacion'],
            'solucion'          => $request['solucion'],
            'cargo_tecnico'        => $request['cargo_tecnico'],
            'estado'        => $request['estado'],
            'id_placa'       => $idPlaca,
            'observaciones'   => $request['observaciones'],
        ]);

        $asigAdmin = SolicitudUsuario::findOrFail($request['idSolicitud']);
        //dd($asigAdmin);
        $asigAdmin->fill(['estado_solicitud' => $request['estado'],
                      ]);/*metodo fill sirve para actualizar informacion en la bd */
        
        $asigAdmin->save(); 

        Session::flash('message', 'creado correctamente');
        return Redirect::to('tecnicos/');
    }

    public function update(request $request, $id)
    {
      //dd($request);
        $asigTecnico = SolicitudUsuario::findOrFail($id);
        //dd($asigTecnico);
        $asigTecnico->fill(['tecnico'  => $request['tecnico'],
                            'fecha_visita' => Carbon::parse($request['fechavisita']),
                            ]);/*metodo fill sirve para actualizar informacion en la bd */
        
        $asigTecnico->save(); 

        $a = @get_headers('http://www.google.com');
        if (is_array($a)) {
           TecnicosController::solicitudSend($id);
        }

        Session::flash('message', 'Caso asignado correctamente');
        return Redirect::to('/tecnicos/missolicitudes');

    }

    public function missolicitudes(){
       //$solicitudes = Administrador::getSolicitudAsignada( auth()->user()->id);
       $solicitudes = SolicitudUsuario::where('tecnico', auth()->user()->id)->with('empleadoSoli','requerimientoSoli','categoriaSoli','elementosSoli')->get();
       //dd( auth()->user()->id);
        $contsolicitudes = SolicitudUsuario::where('tecnico','=', auth()->user()->id)->where('estado_solicitud','=',null)->get();
        //dd($contsolicitudes);
        $todascont  = count($solicitudes);
        $solitcont  = count($contsolicitudes);
        //dd($solitcont);
        //$inventarios =  Administrador::Inventario(); 
        $inventarios = Elemento::pluck('nombreElemento', 'id');
        //dd($inventario);
        return view('administrador.solicitudes.asigTecnico',compact('solicitudes','inventarios','solitcont')); 
    }

    public function atender($id){

        
        $fecha = Carbon::now()->format('d/m/Y');
        $solicitud = Administrador::getSolicitudId($id);
        //dd($solicitud);
        $inventario =  Administrador::getinventario($id);
        //dd($solicitud);
        $elementosInve =  explode(" ", $inventario[0]->elementos);
        //dd($elementosInve);
        $SelectInventarios = Inventario::invetarioJuzgado($solicitud[0]->IdUser);
        //dd($SelectInventarios); 
        //$placas = Inventario::pluck('placaInventario','id');
        //$placas = Inventario::where('codigoJuzgado',$solicitud[0]->codigoDespacho)->pluck('placaInventario','id');
        $placas = Inventario::select(
            DB::raw("CONCAT(placaInventario,' ',marca) AS placaInventario"),'id')
            ->where('codigoJuzgado', $solicitud[0]->IdUser)
            ->pluck('placaInventario', 'id');
        //dd($placas);
        $seccionales = Seccional::All();
        $tipoSolicitudes = $tipoSolicitud = array('WEB');
        $estados = $estado = array('ARCHIVADA','RESUELTA');

        return view('administrador.solicitudes.formularioTecnico',compact('solicitud','elementosInve','SelectInventarios','seccionales','tipoSolicitudes','estados','placas','fecha'));
    

    }

    public static function solicitudSend($dato){
       
      $eventos           =  SolicitudUsuario::where('id',$dato)->first();
      $usuario           =  User::where('id',$eventos->tecnico)->first(); 
      $nombreD           =  Despacho::where('codigoDespacho',$eventos->codigoDespacho)->first();
      $requetD           =  TipoRequerimiento::where('id',$eventos->idrequerimiento)->first();
      //dd($eventos);
      $eventos->nameD    =  $nombreD->nombreDespacho;
      $eventos->distD    =  $nombreD->districto;
      $eventos->name     =  $usuario->name;
      $eventos->lastname =  $usuario->lastname;
      $eventos->requerim =  $requetD->nombreRequerimiento;
      $correo            =  $usuario->email;
      $asunto            =  "Solicitud Asignada  - SIRIS CALI";       
      $data              =  json_decode(json_encode($eventos), true);
      Mail::send('emails.asignarSolicitud',$data, function($msj) use ($correo,$asunto){
        $msj->to($correo);
        $msj->subject($asunto);
      });  
    }
}
