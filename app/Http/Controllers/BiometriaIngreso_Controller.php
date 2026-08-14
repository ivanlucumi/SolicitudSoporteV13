<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiometriaIngreso;

use App\Models\BiometriaIngresoRegistro;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


use Telegram\Bot\Laravel\Facades\Telegram;

use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class BiometriaIngresoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('ingresoporteria');
        //$this->middleware('cambiopass');
        //$this->middleware('administrador');
        
    }
    public function index(Request $request)
    {
        return view('Biometria.Index');
    }

   

    public function save(Request $request)
    {
       // dd($request->all());
        
        $this->validate($request, [
                
                'identificacion'=>'required|max:13',
                'p_apellido'=>'required',
                'p_nombre'=>'required|max:50',
            ]);
        //dd($request->all());
       // dd(Carbon::now()->toTimeString(),Carbon::now()->toDateString());
         
                
             $identificacion = (int) $request->identificacion;
             
             $verificacion =BiometriaIngreso::where('identificacion',$identificacion)->first();
             //dd($verificacion,$identificacion);
             
             if(empty($verificacion))                 {
                     
                     $this->validate($request, [
                            'identificacion'=>'required|max:13|unique:biometria_ingresos,identificacion',
                
                        ]);
                     
                    
                    $BiometriaIngreso = New BiometriaIngreso();
             
                    $BiometriaIngreso->identificacion = $identificacion;
                    $BiometriaIngreso->p_apellido = strtoupper($request->p_apellido);
                    $BiometriaIngreso->s_apellido = strtoupper($request->s_apellido);
                    $BiometriaIngreso->p_nombre = strtoupper($request->p_nombre);
                    $BiometriaIngreso->s_nombre = strtoupper($request->s_nombre);
                    //$BiometriaIngreso->foto = $request->imagen_base64;
                    //$BiometriaIngreso->observaciones = strtoupper($request->observaciones);
                    $BiometriaIngreso->id_porteria = auth()->user()->id;
                    $BiometriaIngreso->save();
                    
                    // DB::commit();
                    
                    $verificacion =$BiometriaIngreso;
                    //DD($BiometriaIngreso,"NO ESTA");
                    
                    return view('Biometria.CargarFoto',compact('verificacion'));
                     
                 }else{
                     
                     //DD($verificacion,"ESTA");
                     
                     if(empty($verificacion->foto)){
                         //DD($verificacion,"FOTO");
                       $BiometriaIngreso =  BiometriaIngreso::where('identificacion',$identificacion)->first();
                       
                       $verificacion =$BiometriaIngreso;
                       
                       return view('Biometria.CargarFoto',compact('verificacion'));
                     }else{
                        // DD($verificacion,"SIN FOTO");
                        return view('Biometria.MostrarFoto',compact('verificacion')); 
                     }
                     
                     //DD($verificacion,"SIN FOTO");
                     
                     return view('Biometria.MostrarFoto',compact('verificacion'));
                     
                    
                 }
              
             
                
                Session::flash('error','No se ha podido realizar la Solicitud!!');
            return redirect()->back(); 
            DB::beginTransaction();
            try{     
            }catch (\Exception $e) {
                DB::rollback();
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            } catch (\Throwable $e) {
                DB::rollback();
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            }
    
               
             
                
            
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
                
                'identificacion'=>'required',
                'p_apellido'=>'required',
                'p_nombre'=>'required|max:50',
            ]);
        
       $identificacion= (int) $request->identificacion;
        
        $verificacion =BiometriaIngreso::where('identificacion',$identificacion)->first();
        
        if(empty($verificacion) || empty($verificacion->foto))
                 {
                    $this->validate($request, [
                                    'imagen_base64'=>'required',
                                ]);
                 }
        
            
            DB::beginTransaction();
            try{ 
                
                $verificacion =BiometriaIngreso::where('identificacion',$identificacion)->first();
                
                if(empty($verificacion))
                 {
                     
                     // Guardar la foto en almacenamiento local
                       /* if ($request->hasFile('camera_imagen_base64')) {
                            $fotoPath = $request->file('foto')->store('fotos', 'public');
                            
                            
                            // Lee el contenido de la imagen y conviértelo a Base64
                            $base64 = base64_encode(file_get_contents($imagen->getRealPath()));
                
                            // Devuelve el Base64 en formato 'data:image/png;base64,...' (ajusta según el tipo)
                            $mimeType = $imagen->getMimeType();
                            $imagen_base64 = 'data:' . $mimeType . ';base64,' . $base64;
                        }*/
                     
                     
                     
                     $this->validate($request, [
                
                        'identificacion'=>'required|max:13|unique:biometria_ingresos,identificacion',
                        'p_apellido'=>'required',
                        'p_nombre'=>'required|max:50',
                        'imagen_base64'=>'required',
                    ]);
                     
                    $BiometriaIngreso = New BiometriaIngreso();
             
                    $BiometriaIngreso->identificacion = $identificacion;
                    $BiometriaIngreso->p_apellido = strtoupper($request->p_apellido);
                    $BiometriaIngreso->s_apellido = strtoupper($request->s_apellido);
                    $BiometriaIngreso->p_nombre = strtoupper($request->p_nombre);
                    $BiometriaIngreso->s_nombre = strtoupper($request->s_nombre);
                    $BiometriaIngreso->foto = $request->imagen_base64;
                    $BiometriaIngreso->observaciones = strtoupper($request->observaciones);
                    $BiometriaIngreso->id_porteria =  auth()->user()->id;
                    $BiometriaIngreso->save();
                    
                    
                    $BiometriaIngresoRegistro = New BiometriaIngresoRegistro();
                 
                    $BiometriaIngresoRegistro->biometria_ingresos_id = $BiometriaIngreso->id;
                    $BiometriaIngresoRegistro->fecha_ingreso = Carbon::now()->toDateString();
                    
                    $BiometriaIngresoRegistro->fecha = Carbon::now()->toDateString();
                    $BiometriaIngresoRegistro->accion = "INGRESO";
                    
                    $BiometriaIngresoRegistro->hora_ingreso = Carbon::now()->toTimeString();
                    $BiometriaIngresoRegistro->id_porteria =  auth()->user()->id;
                    $BiometriaIngresoRegistro->direccion_ingreso =  auth()->user()->direccion_porteria;
                    $BiometriaIngresoRegistro->save();  
                 }else{
                     
                     $identificacion= (int) $request->identificacion;
                
                    $verificacion =BiometriaIngreso::where('identificacion',$identificacion)->first();
                     
                     if(empty($verificacion->foto)){
                       $BiometriaIngreso =  BiometriaIngreso::where('identificacion',$identificacion)->first();
                       $BiometriaIngreso->foto = $request->imagen_base64;
                       $BiometriaIngreso->id_porteria =  auth()->user()->id;
                       $BiometriaIngreso->observaciones = strtoupper($request->observaciones);
                       $BiometriaIngreso->save();
                     }
                     
                     
                     $BiometriaIngresoRegistro = New BiometriaIngresoRegistro();
                     
             
                    $BiometriaIngresoRegistro->biometria_ingresos_id = $verificacion->id;
                    $BiometriaIngresoRegistro->fecha = Carbon::now()->toDateString();
                    $BiometriaIngresoRegistro->accion = "INGRESO";
                    $BiometriaIngresoRegistro->fecha_ingreso = Carbon::now()->toDateString();
                    $BiometriaIngresoRegistro->hora_ingreso = Carbon::now()->toTimeString();
                    $BiometriaIngresoRegistro->id_porteria =  auth()->user()->id;
                    $BiometriaIngresoRegistro->direccion_ingreso =  auth()->user()->direccion_porteria;
                    $BiometriaIngresoRegistro->save();
                 }
              
            
                DB::commit();
                
                Session::flash('success', 'El resgistro de ingreso ha sido exitoso!');
             return redirect()->route('biometria.index');
                
            }catch (\Exception $e) {
                DB::rollback();
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            } catch (\Throwable $e) {
                DB::rollback();
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            }
            
             
            
    }

     public function cargarFoto(Request $request)
    {
        if(empty($request->imagen_base64)){
            Session::flash('error','Debe Tomar La Foto Para Almacenar!!');
            return redirect()->back(); 
        }
        
            $this->validate($request, [
                
                /*'identificacion'=>'required|max:13|unique:biometria_ingresos,identificacion',
                'p_apellido'=>'required',
                'p_nombre'=>'required|max:50',*/
                'imagen_base64'=>'required',
                
            ]);
            DB::beginTransaction();
            try{ 
                
                $identificacion= (int) $request->identificacion;
                
                $verificacion =BiometriaIngreso::where('identificacion',$identificacion)->first();
                     
                     if(empty($verificacion->foto)){
                       $BiometriaIngreso =  BiometriaIngreso::where('identificacion',$identificacion)->first();
                       $BiometriaIngreso->foto = $request->imagen_base64;
                       $BiometriaIngreso->id_porteria =  auth()->user()->id;
                       $BiometriaIngreso->observaciones = strtoupper($request->observaciones);
                       $BiometriaIngreso->save();
                     }
                     
                    $BiometriaIngresoRegistro = New BiometriaIngresoRegistro();
             
                    $BiometriaIngresoRegistro->biometria_ingresos_id = $verificacion->id;
                    $BiometriaIngresoRegistro->fecha = Carbon::now()->toDateString();
                    $BiometriaIngresoRegistro->accion = "INGRESO";
                    $BiometriaIngresoRegistro->fecha_ingreso = Carbon::now()->toDateString();
                    $BiometriaIngresoRegistro->hora_ingreso = Carbon::now()->toTimeString();
                    $BiometriaIngresoRegistro->id_porteria =  auth()->user()->id;
                    $BiometriaIngresoRegistro->direccion_ingreso =  auth()->user()->direccion_porteria;
                    $BiometriaIngresoRegistro->save();
                 
              
            
                DB::commit();
                
                Session::flash('success', 'El resgistro de ingreso ha sido exitoso!');
             return redirect()->route('biometria.index');
                
            }catch (\Exception $e) {
                DB::rollback();
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            } catch (\Throwable $e) {
                DB::rollback();
                return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
            }
            
             
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BiometriaIngreso  $biometriaIngreso
     * @return \Illuminate\Http\Response
     */
    public function Consulta(Request $request,$cedula)
    {
        //dd($cedula);
        $identificacion = (int) $cedula;
        $consulta = BiometriaIngreso::where('identificacion',$identificacion)->first();
        //dd($consulta);
        if($request->ajax())
        {
         
          return response()->json($consulta);
        }
        
    }

     public function registrarSalidaPorteria(Request $request, $id){
       $id = intval($id);
        $fechaA = Carbon::now()->toDateString();
         $hora = Carbon::now()->totimeString();
        
        $verificacion = BiometriaIngreso::where('identificacion',$id)
        ->first();
        
       // dd($verificacion->count());
        
        if(!empty($verificacion)){
            
           
            $BiometriaIngresoRegistro = New BiometriaIngresoRegistro();
             
                    $BiometriaIngresoRegistro->biometria_ingresos_id = $verificacion->id;
                    $BiometriaIngresoRegistro->fecha = Carbon::now()->toDateString();
                    $BiometriaIngresoRegistro->accion = "SALIDA";
                    $BiometriaIngresoRegistro->fecha_salida = Carbon::now()->toDateString();
                    $BiometriaIngresoRegistro->hora_salida = Carbon::now()->toTimeString();
                    $BiometriaIngresoRegistro->id_porteria =  auth()->user()->id;
                    $BiometriaIngresoRegistro->porteria_salida =  auth()->user()->direccion_porteria;
                    $BiometriaIngresoRegistro->save();
          //DD($BiometriaIngresoRegistro);
          
          $mensaje = ['mensaje' => 'Registro de salida exitoso... <br> Feliz día!!','codigo'=>'1'];
          
        
        
        }else{
            //dd($UsuarioHora);
            $mensaje = ['mensaje' => 'Error al Registra la salida, cedula ' . $id .' no esta registrada <br>Feliz día!','codigo'=>'1'];
            
        }
        
        if($request->ajax())
        {
         
          return response()->json($mensaje);
        }
        
        
        
        //dd($UsuarioHora); 
    }
}
