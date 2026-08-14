<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\SolicitudEnviada;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Models\Empleado;
use App\Models\TipoRequerimiento;
use App\Models\Categoria;
use App\Models\SolicitudUsuario;
use App\Models\User;
//use App\Mail\Mail;
use App\Models\Inventario;
use App\Models\Elemento;
use App\Models\TiempoAtencion;
use App\Http\Requests\UsuarioSolicitudCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Digitalizacion;
use App\Models\RegistroDigitalizacion;
use Illuminate\Support\Facades\DB;
use App\Models\Vacunacion;
use App\Models\Hora;
use App\Models\EsquemaVacuna;


use App\Models\CategoriaIncidente;
use App\Models\CategoriaIncidenteItem;
use App\Models\ReporteIncidente;

use App\Models\RequerimientoDespacho;
use App\Models\RequerimientoElemento;
use App\Models\RequerimientoCategoria;


use Illuminate\Support\Carbon;

use DateTime;





class SolicitudUsuarioController extends Controller
{

      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        
        $this->middleware('usuario');
    }

     public function index()
    {
         
        return Redirect::to('/usuarios');
        //return view('usuario.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //dd( auth()->user()->id);
        $categorias = Categoria::Pluck('descripcioncategoria','id');
        $requerimientos = TipoRequerimiento::pluck('nombreRequerimiento','id');
        $empleados = Empleado::pluck('cedulaE','id'); 
        $inventarios = Inventario::invetarioJuzgado( auth()->user()->cedula);  
        //dd($inventarios);
        return view('usuario.crearsolicitud',compact('empleados','requerimientos','categorias','inventarios'));
    }

    public function selects(Request $request, $id)
    {
        $inventarios = Inventario::invetarioJuzgadoDinamico( auth()->user()->cedula,$id); 

        if($request->ajax())
        {
         
          return response()->json($inventarios);
        }

    }

     public function selectsempleado(Request $request, $id)
    {
        $empleados = Empleado::Selectemplados($id); 

        if($request->ajax())
        {
         
          return response()->json($empleados);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
       /*if(isset($request->elemento))
        {
        $elementos = (implode('  |  ',$request->elemento));
         }else{
         $elementos = "";}*/
        //dd($elementos);
        //

        
         
        $elementos = "";
        $key = '';
        $pattern = '1234567890-ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max     = strlen($pattern)-1;
        //$max = int($max);

        /*for($i   =0;$i < 10;$i++) {
        $key .= $pattern{mt_srand(0, $max)};
        }*/

        $chars = 'bcdfghjklmnprstvwxzaeiou';
   
        for ($p = 0; $p < 10; $p++)
        {
            $key .= ($p%2) ? $pattern[mt_rand(19, 23)] : $pattern[mt_rand(0, 18)];
        }
        

        $prioridad = TiempoAtencion::where('id',$request['idcategorias'])->pluck('id');
    //dd($prioridad[0]);
   // dd( auth()->user()->cedula);
   //dd($request['idUser']);

        $solicitud = SolicitudUsuario::create([
            
            'radicado'            =>$key,            
            'idUser'              =>$request['idUser'],
            'idEmpleado'          =>$request['idEmpleado'],
            'codigoDespacho'      => auth()->user()->cedula,
            'edificio'            =>$request['edificio'],
            'idrequerimiento'     =>$request['idrequerimiento'],
            'idcategorias'        =>$request['idcategorias'],
            'elementos'           =>$request['elementos'],
            'descripcion'         =>$request['descripcion'],   
            'tiempo'              =>$prioridad[0],        
        ]);

        //$solicitud->elementosSoli()->attach($request->elemento);


         $user = User::where('id','=',$request['idUser'])->get();
         $requerimiento = TipoRequerimiento::where('id','=',$request['idrequerimiento'])->first();
         $descripcion = $request['descripcion'];
         
        //
         $correo = 'Mfernandp@cendoj111.ramajudicial.gov.co';
         $asunto = 'Nueva Solicitud SIRIS CALI';
         //$eventos = '';
         //dd($user[0]->name);
         $requerimiento->name = $user[0]->name;
         $requerimiento->lastname = $user[0]->lastname;

         $requerimiento->descripcion = $descripcion; 
         //dd($requerimiento);
         //disparamos evento para enviar correo al administrador
         //SolicitudEnviada::dispatch($user, $requerimiento, $descripcion);
        $data              =  json_decode(json_encode($requerimiento), true);

       /* Mail::send('emails.informacion',$data, function($msj) use ($correo,$asunto){
            $msj->to($correo);
            $msj->subject($asunto);
        });*/

         Session::flash('message', 'solicitud radicada con exito!!');
         
         return Redirect::to('/usuarios');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       
        $misSolicitudes = SolicitudUsuario::solicitudesEnviadas( auth()->user()->id);
        //dd($misSolicitudes);
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
     //fomulario de digitalizacion de expedientes
    public function formularioDigitalizacion(Request $request){
        
        $solicitudAudiencia= null;
        
        return view('Formularios.Digitalizacion2020.index',compact('solicitudAudiencia'));
        
    }
    
    public function guardarFormulario(Request $request){
        
        
        if( auth()->user()->lleno_form_dig == 'SI'){
            Session::flash('message','El formulario ya ha sido diligenciado con anterioridad, no es necesario enviar la informacion nuevamente, si necesita corregir, comuniquese con el GRUPO DE SOPORTE!');
                return Redirect::to('/usuarios');
        }
        
       /* $total = $request['sinsentencia']+$request['consentencia'];
        $porProcesos =$request['porcesosdespacho']+$request['procesossecretaria'];
        $estadoProceso = $request['procesosactivos']+$request['procesosinactivos'];*/
        
          
                 $this->validate($request, [
                    'procesos_activos'=> 'required|numeric',
                    /*'consentencia' => 'required|numeric',
                    'porcesosdespacho' => 'required|numeric',
                    'procesossecretaria' => 'required|numeric',
                    'procesosactivos' => 'required|numeric',
                    'procesosinactivos' => 'required|numeric',  */          
                    'autorizadigitalizacion' => 'required'
                ]);
                
                $solicitud = Digitalizacion::create([
                    'despacho_id'            => auth()->user()->cedula,
                    'despacho'            => auth()->user()->name,
                    'email'            => auth()->user()->email,
                    /*'p_sin_sentencia'            =>$request['sinsentencia'],            
                    'p_con_sentencia'              =>$request['consentencia'],
                    'cant_proceso_despacho'          =>$request['porcesosdespacho'],
                    'cant_proceso_secretaria'      =>$request['procesossecretaria'],
                    'proceso_activos'            =>$request['procesosactivos'],*/
                    'procesos_activos'     =>$request['procesos_activos'],
                    'autoriza_digitalizacion'        =>$request['autorizadigitalizacion']
                ]);
                
                DB::table('users')
            ->where('cedula',  auth()->user()->cedula)
            ->update(['lleno_form_dig' => 'SI']);
        
                
                Session::flash('message','Encuesta Diligenciada con éxito!');
                return Redirect::to('/usuarios');
         
        
        
        
    }
    
    
    ///JORNADA VACUNACION
     public function ConsulJornadaVacunacion(){
         
         $time = Carbon::now()->toTimeString();
         //dd($time);
         
         $vacunas = ['PFIZER' => 'PFIZER', 'SINOVAC' => 'SINOVAC','JANSSEN'=>'JANSSEN'/*, 'MODERNA' => 'MODERNA','ASTRAZENECA'=>'ASTRAZENECA'*/];
        
        
        //verificAR HORARIO Y DESOCUPAR HORA
        $HoraReserva = Hora::where('confirmado',NULL)
        ->where('cedula','!=',null)
        ->orderBy('hora', 'ASC')->get();
        
        //dd($HoraReserva);
        if($HoraReserva->isEmpty()){
         
        }else{
             foreach($HoraReserva as $horar){
                 if(Carbon::now()->toTimeString() >= Carbon::parse($horar->updated_at)->addSeconds(120)->toTimeString()){
                    $HoraReserv = Hora::findOrfail($horar->id);
                    $HoraReserv->cedula = NULL;
                    $HoraReserv->confirmado = NULL;
                    $HoraReserv->save();
                 }
        } 
        }
        
        
        
        //CERRAR
        
        $vacunacion = new Vacunacion(); 
        $reserva = 0;
        $hora = Hora::where('cedula',null)->pluck('hora','hora');
        //dd($hora->isEmpty());
        return view('usuario.vacunacion.jornadaVacunacion',compact('vacunacion','hora','reserva','vacunas'));
        
    }
    
    public function jornadaVacunacion(Request $request){
        
        //dd($request);
        
        $reserva = 1;
        
        
        $usuario = Vacunacion::where('cedula',$request->cedula)->first();
        $horario = Hora::where('hora',$request->hora)
        ->where('cedula',null)
        ->first();
        //dd(empty($horario));
        $cedula=$request->cedula;
        
        $vacunas = ['PFIZER' => 'PFIZER', 'SINOVAC' => 'SINOVAC','JANSSEN'=>'JANSSEN'/*, 'MODERNA' => 'MODERNA','ASTRAZENECA'=>'ASTRAZENECA'*/];
        
        $vacunacion = new Vacunacion();
        
        if($usuario == null){
            
        $horarioUser = Hora::where('cedula',$request->cedula)->get();
        
        
        if($horarioUser->isEmpty()){
           
          if(empty($horario)){
             $hora=$request->hora;
              
             $horario = Hora::where('hora',$request->hora)
             ->where('cedula',$request->cedula)
             ->first(); 
             
             if($horario->cedula == $request->cedula){
              $horario->cedula=$cedula;
              $horario->save();
              //dd('holA');
            return view('usuario.vacunacion.confirmacion',compact('vacunacion','hora','cedula','reserva','vacunas'));
             }else{
              Session::flash('error','HORA NO DISPONIBLE!');
                return redirect()->back();    
             }
              
          }else{
             
              $horario->cedula=$cedula;
              $horario->save();
              $hora=$request->hora;
            return view('usuario.vacunacion.confirmacion',compact('vacunacion','hora','cedula','reserva','vacunas'));  
          }  
        }else{
            $hora = $horarioUser[0]->hora;
            Session::flash('error','YA TIENE UNA HORA ASIGNADA, CONTINUE DILIGENCIANDO EL FORMULARIO!');
            return view('usuario.vacunacion.confirmacion',compact('vacunacion','hora','cedula','reserva','vacunas'));
            
        }
           
          
        }else{
            Session::flash('error','USUARIO YA REGISTRADO!');
            return redirect()->back();  
        }
        
        
    }
    
     public function saveFormularioVacunacion(Request $request){
         
         //dd($request->all());
         
         $this->validate($request, [
                    'cedula'=> 'required|unique:vacunacion',
                    'hora_asistencia'=>'required'
                   /* 'nombres' => 'required',
                    'apellidos' => 'required',
                    'sexo' => 'required',
                    'fecha_nacimiento' => 'required'*/  
                ]);
                
       /* if($request->dosis == "SEGUNDA" || $request->dosis == "REFUERZO"){
            $this->validate($request, [
                    'dosis'=> 'required
                    
                ]);
            
        }*/
             
    
                
        $cumpleanos = new DateTime($request->fecha_nacimiento);
        $hoy = new DateTime();
        $annos = $hoy->diff($cumpleanos);
        $edad= $annos->y;
        
        $vacunacion = new Vacunacion();
        $vacunacion->cedula = $request->cedula;
        $vacunacion->hora_asistencia = $request->hora_asistencia;
        $vacunacion->nombres = $request->nombres;
        $vacunacion->apellidos = $request->apellidos;
        $vacunacion->sexo = $request->sexo;
        $vacunacion->fecha_nacimiento = $request->fecha_nacimiento;
        $vacunacion->edad = $edad;
        $vacunacion->dosis = $request->dosis;
        $vacunacion->empleado = $request->empleado;
        $vacunacion->familiar = $request->familiar;
        $vacunacion->vacuna = $request->vacuna;
        $vacunacion->despacho =  auth()->user()->email;
        $vacunacion->save();
        
        //dd($vacunacion->save());
        
        if($vacunacion->save()){
            //confirmar diligenciado
            $horarioCon = Hora::where('hora',$request->hora_asistencia)
             ->where('cedula',$request->cedula)
             ->first(); 
            $horarioCon->confirmado="CONFIRMADO";
            $horarioCon->save();
            
            //cerrar confiracion
            
            $horario = Hora::where('hora',$request->hora)
             ->where('cedula',$request->cedula)
             ->first(); 
            
            $data              =  json_decode(json_encode($vacunacion), true);
            
             Mail::send('emails.ConfirmacionReserva', $data, function ($message) use ($vacunacion) {
                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
                        $message->to( auth()->user()->email);
                        $message->subject('Cita para vacunación');
                        
                    });
            
             Session::flash('success', 'Reserva creada con éxito !');
                        return Redirect::to('usuarios/formulario/consultar/jornada/vacunacion');
        }
        
        
         
        
    }
    
    public function calcularEdad(Request $request,$edad){
        //dd($edad);
        $cumpleanos = new DateTime($edad);
        $hoy = new DateTime();
        $annos = $hoy->diff($cumpleanos);
        $edad = $annos->y;
        return $edad;
        
    }
    ///CIERRE DE JORNADA DE VACUNACION
    
    
    public function ReportePersonalVacunado(Request $request){
        
    $vacunas = ['PFIZER' => 'PFIZER', 'SINOVAC' => 'SINOVAC','JANSSEN'=>'JANSSEN'/*, 'MODERNA' => 'MODERNA','ASTRAZENECA'=>'ASTRAZENECA'*/];
      $esquema = EsquemaVacuna::where('codigo_despacho', auth()->user()->cedula) ->get();

        return view('usuario.vacunacion.encuestaVacunacion',compact('vacunas','esquema'));
    }
    public function ReportePersonalVacunadoSave(Request $request){
        
        $this->validate($request, [
                    'cedula' => 'required|unique:esquema_vacunacion',
                    'nombre' => 'required',
                    'cargo' => 'required',
                    'dosis' => 'required'
                ]);

           $encuestaVacuna = new EsquemaVacuna();
            
           
           $encuestaVacuna->codigo_despacho =  auth()->user()->cedula;
           $encuestaVacuna->cedula = $request->cedula;
           $encuestaVacuna->nombre = strtoupper($request->nombre);
           $encuestaVacuna->cargo = strtoupper($request->cargo);
           $encuestaVacuna->dosis = $request->dosis;
           $encuestaVacuna->vacuna = $request->vacuna;
           $encuestaVacuna->save();
        
        Session::flash('message','Se registró Esquema de vacunación!!');
        return redirect()->back(); 
    }
    
    public function ReportePersonalVacunadoDel(Request $request,$id){
        $esquema = EsquemaVacuna::findOrFail($id);
        //dd($detenido);
        $esquema = EsquemaVacuna::destroy($id);
        Session::flash('message','USUARIO ELIMINADO !!');
            return redirect()->back(); 
    }
    
    
    
    //REPORTE DE INCIDENTES A MATENIMIENTO

    public function reporteIncidente(){

        $incidentes = ReporteIncidente::where('id_usuario', auth()->user()->cedula)
        ->select('id','consecutivo','categoria','item','descripcion','created_at','estado','observaciones')
        ->orderby('created_at','DESC')
        ->get();
        
        
        //$categorias = CategoriaIncidente::all();
        $categorias= RequerimientoCategoria::all();
        //$categorias= RequerimientoCategoria::all()->pluck('id','nombre');
        //dd($incidentes);
       return view('usuario.Mantenimiento.incidentes',compact('categorias','incidentes'));
    }
    
    public function ElementosMantenimietno(Request $request, $id){
        
        //dd($request->all(),$id);
        
        $items = RequerimientoElemento::where('category_id',$id)->get();
        
        return $items;
        
        //return response()->json($elements);
    }

    public function reporteIncidenteSelect(Request $request,$id){

        $items = CategoriaIncidenteItem::where('categoria_item_id',$id)->get();
        //dd($items);
        return $items;
    }

    public function reporteIncidenteSave(Request $request){
        
        $rules = [
            'categoria' => 'required|array',
            'item' => 'required|array',
            'identificacion' => 'required|max:15',
            'nombre_funcionario' => 'required|max:120',
            'descripcion' => 'required'
        ];
        
        $request->validate($rules);
        
        // Validar campos "otro_item" si alguno de los requerimientos es "otro"
        foreach ($request->item as $index => $val) {
            if ($val === 'otro' && empty($request->otro_item[$index])) {
                return back()->withErrors(['Debe especificar el requerimiento en la opción OTRO.'])->withInput();
            }
        }
        
        //genarar radicado 
        $date=Carbon::now();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $d=rand(1,30);
        $aleat = substr(md5(time()), 0, 3);

        
        
        
        
        //dd($request->all(),$categoria,$item);
        
        //lamacenar varios requermientos
        foreach ($request->categoria as $index => $categoria_id) {
            
            $consecutivo= $date->format('Y').$date->format('m')."-".rand(1,30).substr(md5(time()), 0, 10);

            $categoria = RequerimientoCategoria::findOrFail($categoria_id);
            
            if ($request->item[$index] === 'otro') {
                $item_nombre = $request->otro_item[$index];
            } else {
                $item = RequerimientoElemento::where('id', $request->item[$index])->first();
                $item_nombre = $item->elemento;
            }
        
            $Incidentes = new ReporteIncidente();
            $Incidentes->consecutivo = $consecutivo;
            $Incidentes->id_usuario =  auth()->user()->cedula;
            $Incidentes->nombre_despacho =  auth()->user()->name;
            $Incidentes->email_despacho =  auth()->user()->email;
            $Incidentes->identificacion = $request->identificacion;
            $Incidentes->nombre_funcionario = $request->nombre_funcionario;
            $Incidentes->categoria = $categoria->nombre;
            $Incidentes->item = $item_nombre;
            $Incidentes->descripcion = $request->descripcion;
            $Incidentes->estado = "RECIBIDO";
            $Incidentes->reportado_a = "PRINCIPAL";
            $Incidentes->save();
        }

        
        
        
        $data              =  json_decode(json_encode($Incidentes), true);

       /* Mail::send('emails.reporteIncidente', $data, function ($message) use ($Incidentes) {
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
            $message->to( auth()->user()->email);
            $message->subject('Registro de incidente ');
        });*/
        
        $mantenimiento= User::where('rol',13)
        ->where('estado_rol','PRINCIPAL')
        ->select('email')
        ->get();
        //dd($mantenimiento[0]->email);
        
        foreach($mantenimiento as $manteni){
            
         /* Mail::send('emails.reporteIncidente', $data, function ($message) use ($Incidentes,$manteni) {
              
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI');
           
            $message->to($manteni->email);
            $message->subject('Registro de incidente ');
        }); */ 
        }

        Session::flash('message','Se registro Incidente!!');
        //return redirect()->back(); 
        return Redirect::to('usuarios/reporte/incidente');


    }
    
     public function Revision(Request $request,$id){
        
        $incidente = ReporteIncidente::find($id);
        
        //dd($incidente);
        
        if($request->ajax())
        {
         
          return response()->json($incidente = ReporteIncidente::find($id));
        }

        //$solicitud = ReporteIncidente::findOrFail($id);
        //return view('mantenimiento.reporte',compact('solicitud','operario','mantenimiento'));

    }

    public function reporteIncidentedelete(Request $request,$id){

        $reporteE = ReporteIncidente::findOrFail($id);
        $reporteE = ReporteIncidente::destroy($id);
        Session::flash('message','REPORTE ELIMINADO!!');
            return redirect()->back(); 

    }

  /*  public function ReportePersonalVacunado(Request $request){

        return view('usuario.vacunacion.encuestaVacunacion');
    }
    public function ReportePersonalVacunadoSave(Request $request){


        
        Session::flash('message','Se registor Incidente!!');
        //return redirect()->back(); 
    }*/
    
    
    
    
}
