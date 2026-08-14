<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Mail;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\RequerimientoDespacho;
use App\Models\RequerimientoElemento;
use App\Models\RequerimientoCategoria;

use App\Models\Despacho;
use App\Http\Requests\RequerimientoDespachoRequest;

use App\Exports\RequerimientosExport;

class RequerimientoDespachosController extends Controller
{
    public function __construct(){
         $this->middleware('auth');
        // $this->middleware('Reparto');

     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
   
    
    public function index(Request $request)
    {
        $despachos = Despacho::orderby('nombreDespacho','ASC')->pluck('nombreDespacho','codigoDespacho');
        $categories= RequerimientoCategoria::all();
        
        dd($categories);
        
        
         if(  auth()->user()->rol == 1){
         $requerimientodespachos= RequerimientoDespacho::select('despacho_id','nombre_despacho','email_despacho')->distinct('despacho_id')->get();
          
        return view('requerimientodespachos.admin.index',compact('requerimientodespachos','despachos','categories'));
        }else{
        $requerimientodespachos= RequerimientoDespacho::where('usuario_id', auth()->user()->id)->select('despacho_id','nombre_despacho','email_despacho')->distinct('despacho_id')->get();
       
        return view('requerimientodespachos.index',compact('requerimientodespachos','despachos','categories'));    
        }
        
        
    }
    
    
    
    public function Elementos(Request $request){
        
        $elements = RequerimientoElemento::where('category_id', $request->category_id)->get();
        
        return response()->json($elements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        
        $categories= RequerimientoCategoria::all();
        
            $id_despacho = auth()->user()->cedula;
             //dd($id_despacho);
        
       //dd($request->all());
       $requerimientodespachos= RequerimientoDespacho::where('despacho_id',$id_despacho)->get();
       $despacho= Despacho::where('codigoDespacho',$id_despacho)->first();
      
      //dd($despacho,$id_despacho);
       $Solicitudes= RequerimientoDespacho::Solicitud();
       if(  auth()->user()->rol == 1){
       return view('requerimientodespachos.admin.create',compact('requerimientodespachos','despacho','Solicitudes','categories'));
       }else{
           
       return view('requerimientodespachos.create',compact('requerimientodespachos','despacho','Solicitudes','categories'));
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RequerimientoDespachoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        
        //dd($request->all());
        
        $Categoria=RequerimientoCategoria::findOrFail($request->tipo_solicitud);
        $elemento=RequerimientoElemento::findOrFail($request->elemento);
        
        //dd($request->all(),$Categoria,$elemento);
        
         DB::beginTransaction();
         
        $this->validate($request, [
                'despacho_id' => 'required',
                'observaciones'=>'required',
                'tipo_solicitud'=>'required|max:100',
                'images'=>'required',
                'cantidad_elementos'=>'required',
                'identificacion'=>'required|max:15',
                'nombre_funcionario'=>'required|max:150',
                'images' => 'required|image|mimes:jpeg,png,jpg,svg|max:4048',
                ]);
         try{
        
        $despacho= Despacho::where('codigoDespacho',$request->despacho_id)->first();
        
       
        if(!empty($request->file('images'))){
        $file = $request->file('images');
        //dd($file);
        $documento = $_FILES["images"]["name"];
        $extension= pathinfo($_FILES["images"]['name'], PATHINFO_EXTENSION);
        $fotografia =$request->despacho_id."_".$request->tipo_solicitud."_".Carbon::now()->toTimeString().".".$extension;
        \Storage::disk('solicitudes')->put($fotografia, \File::get($file));
        
        }else{
            Session::flash('error', 'Debe Adjuntar la evidencia del daño');
            return Redirect::back();
        }
        
        // dd($request->file('images'));
        
        if($request->tipo_solicitud =="OTRO"){
            $TIPO_SOLICI = $request->tipo_otro;
             $this->validate($request, [
                'tipo_otro' => 'required'
                ]);
        }else{
            $TIPO_SOLICI =$elemento->elemento;
        }
        
        $requerimientodespacho = new RequerimientoDespacho;
		$requerimientodespacho->despacho_id = $request->despacho_id;
		$requerimientodespacho->nombre_despacho = $despacho->nombreDespacho;
		$requerimientodespacho->email_despacho = $despacho->correoD;
		$requerimientodespacho->identificacion = $request->identificacion;
		$requerimientodespacho->nombre_funcionario = $request->nombre_funcionario;
		$requerimientodespacho->categoria = $Categoria->nombre;
		$requerimientodespacho->tipo_solicitud = $TIPO_SOLICI;
		$requerimientodespacho->cantidad_elementos = $request->cantidad_elementos;
		$requerimientodespacho->observaciones = $request->input('observaciones');
		$requerimientodespacho->fecha_solicitud = Carbon::now();
		$requerimientodespacho->usuario_id =  auth()->user()->id;
		$requerimientodespacho->usuario_registra =  auth()->user()->name." ". auth()->user()->lastname;
		$requerimientodespacho->evidencia_fotografica = $fotografia;
		$requerimientodespacho->estado = "PENDIENTE";
        $requerimientodespacho->save();
          DB::commit();
          
          Session::flash('message','REGISTRO CREADO CORRECTAMENTE!');
            return redirect()->back();
          
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        //dd('hola');
        $requerimientodespacho = RequerimientoDespacho::findOrFail($id);
        return view('requerimientodespachos.show',['requerimientodespacho'=>$requerimientodespacho]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $requerimientodespacho = RequerimientoDespacho::findOrFail($id);
        return view('requerimientodespachos.edit',['requerimientodespacho'=>$requerimientodespacho]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RequerimientoDespachoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RequerimientoDespachoRequest $request, $id)
    {
        
        DB::beginTransaction();
        try{
        
        $requerimientodespacho = RequerimientoDespacho::findOrFail($id);
		$requerimientodespacho->despacho_id = $request->input('despacho_id');
		$requerimientodespacho->nombre_despacho = $request->input('nombre_despacho');
		$requerimientodespacho->email_despacho = $request->input('email_despacho');
		$requerimientodespacho->tipo_solicitud = $request->input('tipo_solicitud');
		$requerimientodespacho->observaciones = $request->input('observaciones');
		$requerimientodespacho->fecha_solicitud = $request->input('fecha_solicitud');
		$requerimientodespacho->usuario_id = $request->input('usuario_id');
		$requerimientodespacho->evidencia_fotografica = $request->input('evidencia_fotografica');
        $requerimientodespacho->save();

        
        
         DB::commit();
          
          Session::flash('message','REGISTRO ACTUALIZADO CORRECTAMENTE!');
            return to_route('requerimientodespachos.index');
          
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $requerimientodespacho = RequerimientoDespacho::findOrFail($id);
       
       if($requerimientodespacho->estado != "PENDIENTE"){
           Session::flash('message','EL CASO ESTA TOMADO, NO SE PUEDE ELIMINAR!');
            return redirect()->back();
       }
       
       if(!empty( $requerimientodespacho)){
           
               \Storage::disk('solicitudes')->delete("/".$requerimientodespacho->despacho_id."/".$requerimientodespacho->evidencia_fotografica);
               $eliminar = RequerimientoDespacho::destroy($id);
               Session::flash('message','Eliminado Correctamente');
        
       /* $data              =  json_decode(json_encode($requerimientodespacho), true);        
        $correoFuncionario = $registro->email_funcionario;
        $correoDespacho = $registro->email_despacho;
        
        Mail::send('emails.remoto.novedadTeletrabajo',$data, function ($message) use ($registro,$correoFuncionario,$correoDespacho) {   
            $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS – DISAJ CALI');
            $message->to($correoDespacho);
            if(!empty($correoFuncionario)){
                $message->cc($correoFuncionario); 
            }
            $message->subject('Se Elimino Registro por Parte del Despacho');
                                        
        });*/
          
       }
       Session::flash('message','REGISTRO ELIMINADO CORRECTAMENTE!');
       return redirect()->back();
        
        
    }
    
    public function ListadoRequerimientos(Request $request){
        $requerimientodespachos= RequerimientoDespacho::All();
        return view('requerimientodespachos.admin.listado',compact('requerimientodespachos'));  
    }
      //DESCARGAR FACTURA DE CUMPLIMIENTO
    public function DescargaListadoRequerimientos(Request $request){
        //dd($request);
        
        $requerimientodespachos= RequerimientoDespacho::first();
        
        
        if(!empty($requerimientodespachos)){
            $requerimientodespachos= RequerimientoDespacho::select("despacho_id", "nombre_despacho", "email_despacho", "tipo_solicitud", "observaciones", "fecha_solicitud", "cantidad_elementos", "usuario_registra", "evidencia_fotografica")
            ->get();
            //dd($requerimientodespachos);
             return (new RequerimientosExport($requerimientodespachos))->download('REQUERIMIENTOS_DESPACHOS.xlsx', \Maatwebsite\Excel\Excel::XLSX);
   
        }else{
        Session::flash('message', 'No hay nada registrado con ese cumplido');
        return Redirect::back();
        }
    }
    
    /*
     "DESPACHO ID",
            "DESPACHO" ,
            "CORREO" ,
            "TIPO SOLICITUD" ,
            "OBSERVACIONES",
            "FECHA SOLICITUD",
            "CANTIDAD DE ELEMENTOS",
            "REGISTRA" ,
            "FOTOGRAFIA" 
    */
          

}
