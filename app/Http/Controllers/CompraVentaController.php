<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompraVenta;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class CompraVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if( auth()->user() == null){
          Session::flash('success','Usuario no Autenticado!!');
          return redirect()->route('index');  
        }
        $clasificados= CompraVenta::where('id_despacho', auth()->user()->id)->get();
        $categorias = CompraVenta::Categoria();
        return view('usuario.CompraVenta.index',compact('categorias','clasificados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        
        if(count($_FILES["photos"]["name"])<3){
          Session::flash('error','Error al guardar, debe subir al menos 3 imagenes del Producto!!');
        return redirect()->back();   
        }
        
        if( auth()->user() == null){
          Session::flash('success','Solicitud Realizada Con Exito!!');
          return redirect()->route('index');  
        }
        //dd($_FILES["photos"]['type']);
        
        DB::beginTransaction();
         $this->validate($request, [
                
                'categoria'=>'required|max:30',
                'producto'=>'required|max:120',
                'especificaciones'=>'required',
                'caracteristicas'=>'required',
                'photos'=>'required',
                'contacto_telefono'=>'required|max:30',
                'contacto_correo'=>'required|max:120',
                
            ]);
            
        if($request->categoria == 'VEHICULO'){
            $this->validate($request, [
                'modelo'=>'required|max:50',
                'kilometraje'=>'required',
                
            ]);
        }
         
        $fecha = Carbon::now();

        try{
            
            $nombresFoto = $_FILES["photos"]["name"];
            $nombresType = $_FILES["photos"]["type"];
            //dd($_FILES["photos"]["tmp_name"][0]);
        
            $separador = "/";
            //dd($nombresFoto,$nombresFoto[0],$nombresFoto[1],$nombresFoto[2]);
            
             $separada0 = explode($separador, $nombresType[0]);
             $foto_1= $nombresFoto[0]." ".strtoupper($request->categoria).Carbon::now()->toDateTimeString().".$separada0[1]"; 
             
             \Storage::disk('clasificados')->put($foto_1, \File::get($_FILES["photos"]["tmp_name"][0]));
            //dd($foto_1,$nombresFoto[0]);
            
            $separada1 = explode($separador, $nombresType[1]);
             $foto_2= $nombresFoto[1]." ".strtoupper($request->categoria).Carbon::now()->toDateTimeString().".$separada1[1]"; 
             \Storage::disk('clasificados')->put($foto_2, \File::get($_FILES["photos"]["tmp_name"][1]));
         
             $separada2 = explode($separador, $nombresType[2]);
             $foto_3= $nombresFoto[2]." ".strtoupper($request->categoria).Carbon::now()->toDateTimeString().".$separada2[1]"; 
             \Storage::disk('clasificados')->put($foto_3, \File::get($_FILES["photos"]["tmp_name"][2]));
        
            //dd($foto_1,$foto_2,$foto_3);

                
           $reporte = new CompraVenta();
                        $reporte->id_despacho =   auth()->user()->id;
             			$reporte->despacho =   auth()->user()->name." ". auth()->user()->lastname;
				    	$reporte->correo_despacho =   auth()->user()->email;
             			$reporte->categoria =  $request->categoria;
				    	$reporte->producto =  $request->producto;
             			$reporte->modelo =  $request->modelo;
				    	$reporte->kilometraje =  $request->kilometraje;
             			$reporte->especificaciones =  $request->especificaciones;
				    	$reporte->caracteristicas =  $request->caracteristicas;
             			$reporte->foto_1 =  $foto_1;
				    	$reporte->foto_2 =  $foto_2;
             			$reporte->foto_3 =  $foto_3;
				    	$reporte->contacto_telefono =  $request->contacto_telefono;
             			$reporte->contacto_correo =  $request->contacto_correo;
				    	$reporte->ip_publicacion =  $request->ip();
				    	$reporte->fecha_eliminacion = $fecha->addDays(8)->toDateString(); 
				    	//dd($reporte);
           $reporte ->save();
          
           
            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }

           
         
            
        Session::flash('success','Solicitud Realizada Con Exito!!');
        //return redirect()->back(); 
        return redirect()->route('usuario.clasificados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompraVenta  $compraVenta
     * @return \Illuminate\Http\Response
     */
    public function clasificados(Request $request)
    {
       
        
        if($request->ip() =="190.217.19.164"){
        $categorias = CompraVenta::Categoria();
        $clasificados= CompraVenta::All();
        return view('clasificados',compact('clasificados','categorias'));
        
        }else{
          return Redirect::to('/');    
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompraVenta  $compraVenta
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $fecha = Carbon::now();
        $fecha = Carbon::now()->subDays(8)->toDateString();
        $clasificados = CompraVenta::where('fecha_eliminacion', '<', $fecha)->get();
        //dd($clasificados);
        foreach($clasificados as $clasificado){
        \Storage::disk('clasificados')->delete($clasificado->foto_1);
        \Storage::disk('clasificados')->delete($clasificado->foto_2);
        \Storage::disk('clasificados')->delete($clasificado->foto_3);
        $clasificado->delete();
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompraVenta  $compraVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompraVenta $compraVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompraVenta  $compraVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompraVenta $compraVenta,$id)
    {
        DB::beginTransaction();
        try{
        $clasificado = CompraVenta::findOrFail($id);
        //dd($clasificado);
        \Storage::disk('clasificados')->delete($clasificado->foto_1);
        \Storage::disk('clasificados')->delete($clasificado->foto_2);
        \Storage::disk('clasificados')->delete($clasificado->foto_3);
        $clasificado::destroy($id);
        
             DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
        Session::flash('message','Clasificado Eliminado Correctamente!');
        return redirect()->back(); 
        
    }
}
