<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\EstadoExpediente;
use App\Models\EstadoExpedientePrestamo;
use App\Models\Despacho;

use App\Imports\BestdocImports;
use Excel;


class EstadoExpedienteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('checarsesion');
        //$this->middleware('cambiopass');
        //$this->middleware('administrador');

    }

    public function prestamos(Request $request)
    {
        //dd($request->all());
        
         if(!empty($request->radicado)){
           // dd($request->radicado);
            $expedientes = EstadoExpediente::where('radicado',$request->radicado)
            ->where('estado','EN PRESTAMO')
            ->select('id')
            ->get();
            
            //dd($expedientes->toArray());
           
          /* dd($expedientes->toArray(),EstadoExpedientePrestamo::whereIn('id_expediente',$expedientes->toArray())
           ->where('estado',"EN PRESTAMO")
            ->orderby('fecha_devolucion','DESC')
            ->get());*/
            
            $prestamos = EstadoExpedientePrestamo::whereIn('id_expediente',$expedientes->toArray())
           ->where('estado',"EN PRESTAMO")
           ->where('quien_devuelve',NULL)
            ->orderby('fecha_devolucion','DESC')
            ->get();
            
        }else{
          $prestamos = EstadoExpedientePrestamo::where('quien_devuelve',NULL)
          ->where('estado',"EN PRESTAMO")
            ->orderby('fecha_devolucion','DESC')
            ->paginate(1000);
        }
        
        
        $despachos = Despacho::orderby('nombreDespacho','ASC')->pluck('nombreDespacho','codigoDespacho');
        return view('Expedientes.prestamos',compact('prestamos','despachos'));
    }


    public function consulta(Request $request,$id)
    {
        //dd($id);
        $expediente = EstadoExpedientePrestamo::where('estado','EN PRESTAMO')
        ->where('quien_devuelve',NULL)
        ->orderby('prestado_a_fecha','DESC')
        ->where('id',$id)->with('Expediente')->get();
        //dd($expediente);
        if($request->ajax())
        {
          return response()->json($expediente);
        }
    }
    
    public function consultaExpediente(Request $request,$id)
    {
        //dd($id);
        $expediente = EstadoExpediente::where('estado','DISPONIBLE')
        ->where('id',$id)->get();
        //dd($expediente);
        if($request->ajax())
        {
          return response()->json($expediente);
        }
    }


    public function finalizarPrestamo(Request $request)
    {
        $devolver = EstadoExpedientePrestamo::findOrFail($request->id);
        $devolver->estado= "DEVUELTO";
        $devolver->quien_devuelve =  auth()->user()->name." ". auth()->user()->lastname;
        $devolver->observaciones = $request->observaciones;
        $devolver->fecha_devolucion = Carbon::now();
        $devolver->save();

        $expediente = EstadoExpediente::findOrFail($devolver->id_expediente);
        $expediente->estado= "DISPONIBLE";
        $expediente->save();

        Session::flash('success','SE REGISTRO LA DEVOLUCION DEL EXPEDIENTE DE FORMA EXITOSA');
        return redirect()->back();
    }


    public function registro_prestamos(Request $request)
    {
        //dd($request->all());
        $expediente = EstadoExpediente::where('radicado',$request->radicado)
        ->where('estado','DISPONIBLE')
        ->first();
        if(empty($expediente)){
            Session::flash('success','ESTE EXPEDIENTE YA SE ENCUENTRA EN PRESTAMO Y NO HAN HECHO DEVOLUCION, CONSULTE EN EXPEDIENTES PARA VERIFICAR RADICACION');
            return redirect()->back();
        }
        
        $expediente = EstadoExpediente::findOrFail($expediente->id);
        $id_expe= $expediente->id;
        $expediente->estado = "EN PRESTAMO";
        $expediente->save();

        //dd($expediente);

        $despacho = Despacho::where('codigoDespacho',$request->prestado_a_despacho)->first();

        $prestar = new EstadoExpedientePrestamo ();
        $prestar->id_expediente =$id_expe;
        //dd($prestar);
        $prestar->prestado_a_cedula =$request->prestado_a_cedula;
        $prestar->prestado_a_nombre =$request->prestado_a_nombre;
        $prestar->id_despacho =$request->prestado_a_despacho;
        $prestar->prestado_a_despacho =$despacho->nombreDespacho;
        $prestar->observaciones =$request->observaciones;
        $prestar->estado= "EN PRESTAMO";
        $prestar->prestado_a_fecha = Carbon::now();
        $prestar->user_id =  auth()->user()->id;
        $prestar->quien_presta =  auth()->user()->name." ". auth()->user()->lastname;
        $prestar->save();

        Session::flash('success','SE REGISTRO EL PRESTAMO DEL EXPEDIENTE DE FORMA EXITOSA');
        return redirect()->back();
    }


    public function historial_prestamos(Request $request)
    {
       
         $prestamos = EstadoExpedientePrestamo::where('quien_devuelve','!=',NULL)
            ->orderby('fecha_devolucion','DESC')
            ->paginate(1000);
        
        //dd($prestamos);
        return view('Expedientes.HistoricoPrestamo',compact('prestamos'));
    }

    public function registro_expedientes(Request $request)
    {
        $nume_expe=EstadoExpediente::count();
        //dd($nume_expe);
        if(!empty($request->all())){
           // dd($request->radicado);
            $expedientes = EstadoExpediente::radicado($request->radicado)
            ->procesado($request->cedula_procesado)
            ->nombre($request->nombre_procesado)
            ->ni($request->ni)
            ->caja($request->almacenado_en)
            ->get();
            
        }else{
            $expedientes = EstadoExpediente::paginate(500);
        }
        $sedes=EstadoExpediente::Sedes();
        $empaque=EstadoExpediente::TipoEmpaque();
        $tproceso=EstadoExpediente::TipoProceso();
        $asuntarchivo=EstadoExpediente::AsuntoArchivo();
        
        $despachos = Despacho::orderby('nombreDespacho','ASC')->pluck('nombreDespacho','codigoDespacho');

        return view('Expedientes.Expedientes',compact('expedientes','empaque','tproceso','asuntarchivo','sedes','despachos','nume_expe'));
    }


    public function save_registro_expedientes(Request $request)
    {
        
        $expediente = EstadoExpediente::where('radicado',$request->radicado)
        ->where('sede',$request->sede)
        ->first();
        
        //dd($expediente,!empty($expediente));
        
        $this->validate($request, [
            'radicado'=> 'required|numeric|digits:23',
            'ni' => 'required|max:30',
            'cedula_procesado' => 'required|max:20',
            'nombre_procesado' => 'required',
            'delito' => 'required|max:200',
            'sede' => 'required|string|max:50',
            'almacenado_en' => 'required|max:50',
            'cuadernos' => 'required|numeric',
            'folios' => 'required',
            'tipo_expediente' => 'required|max:100',
            'no_caja'=> 'required',
            //'fecha_digitalizado' => 'required|date',
            'asunto_archivo' => 'required|max:100',
            'fecha_archivo' => 'required',
            'observaciones'=>'required'
        ]);
        
        if(!empty($expediente)){
           Session::flash('success','EL EXPEDIENTE YA EXISTE EN LA SEDE QUE DESEA REGISTRAR !');
           return redirect()->back();
        }else{
            //dd($request->all());
        $expediente = new EstadoExpediente();
        $expediente->radicado= $request->radicado;
        $expediente->ni= $request->ni;
        $expediente->cedula_procesado= $request->cedula_procesado;
        $expediente->nombre_procesado= $request->nombre_procesado;
        $expediente->delito= $request->delito;
        $expediente->sede= $request->sede;
        $expediente->almacenado_en= $request->almacenado_en;
        $expediente->no_caja= $request->no_caja;
        $expediente->cuadernos= $request->cuadernos;
        $expediente->folios= $request->folios;
        $expediente->tipo_expediente= $request->tipo_expediente;
        $expediente->fecha_digitalizado= $request->fecha_digitalizado;
        $expediente->asunto_archivo= $request->asunto_archivo;
        $expediente->fecha_archivo= $request->fecha_archivo;
        $expediente->observaciones= $request->observaciones;
        $expediente->creado_por=  auth()->user()->name." ". auth()->user()->lastname;
        $expediente->save();

        Session::flash('success','SE REGISTRO EXPEDIENTE CORRECTAMENTE!');
        return redirect()->back();
        }
        
        return redirect()->back();
        
    }

    public function editar_registro_expedientes(Request $request,$id){

        $expediente = EstadoExpediente::FindOrFail($id);

        $sedes=EstadoExpediente::Sedes();
        $empaque=EstadoExpediente::TipoEmpaque();
        $tproceso=EstadoExpediente::TipoProceso();
        $asuntarchivo=EstadoExpediente::AsuntoArchivo();

        return view('Expedientes.EditarExpediente',compact('expediente','empaque','tproceso','asuntarchivo','sedes'));

    }


    public function update_registro_expedientes(Request $request,$id)
    {
        $this->validate($request, [
            'radicado'=> 'required|numeric|digits:23',
            'ni' => 'required|max:30',
            'cedula_procesado' => 'required|max:20',
            'nombre_procesado' => 'required',
            'delito' => 'required|max:200',
            'sede' => 'required|string|max:50',
            'almacenado_en' => 'required|max:50',
            'cuadernos' => 'required|numeric',
            'folios' => 'required',
            'tipo_expediente' => 'required|max:100',
            'no_caja'=> 'required',
            //'fecha_digitalizado' => 'required|date',
            'asunto_archivo' => 'required|max:100',
            'observaciones'=>'required'
        ]);
        //dd($request->all());
        $expediente = EstadoExpediente::FindOrFail($id);
        $expediente->radicado= $request->radicado;
        $expediente->ni= $request->ni;
        $expediente->cedula_procesado= $request->cedula_procesado;
        $expediente->nombre_procesado= $request->nombre_procesado;
        $expediente->delito= $request->delito;
        $expediente->sede= $request->sede;
        $expediente->almacenado_en= $request->almacenado_en;
        $expediente->no_caja= $request->no_caja;
        $expediente->cuadernos= $request->cuadernos;
        $expediente->folios= $request->folios;
        $expediente->tipo_expediente= $request->tipo_expediente;
        $expediente->fecha_digitalizado= $request->fecha_digitalizado;
        $expediente->asunto_archivo= $request->asunto_archivo;
        $expediente->observaciones= $request->observaciones;
        $expediente->save();

        Session::flash('success','SE ACTUALIZO EXPEDIENTE CORRECTAMENTE!');
        return redirect()->route('expediente.registrar.expediente');
    }
    
    public function destroy(Request $request)
    {
        $registro = EstadoExpediente::findOrFail($request->id);
        //dd($registro);
        Session::flash('error','ENTRO A ELIMINAR Y AUN NO ESTA HABILITADO!');
        return redirect()->back();
        $registro->destroy();
        Session::flash('message','Registro de Expediente Eliminado Correctamente');
        return redirect()->route('expediente.registrar.expediente');
    }
}
