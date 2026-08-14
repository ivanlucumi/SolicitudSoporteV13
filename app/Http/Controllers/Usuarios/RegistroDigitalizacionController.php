<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Digitalizacion;
use App\Models\RegistroDigitalizacion;
use App\Models\Despacho;
use App\Models\Ciudad;
use Illuminate\Support\Facades\DB;
use PDF;

use Maatwebsite\Excel\Facades\Excel;



class RegistroDigitalizacionController extends Controller
{
    
    
      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        
        $this->middleware('usuario');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $radicados= RegistroDigitalizacion::where('id_despacho', auth()->user()->cedula)->get();
        // dd( $radicados);
        
        $options = ['FISICO' => 'FISICO', 'DIGITAL' => 'DIGITAL', 'HIBRIDO' => 'H&Iacute;BRIDO (ESTÁ COMPUESTO POR EXPEDIENTES FÍSICOS Y DIGITALES)'];
        
        return view('Formularios.reporte.index',compact('radicados','options'));
        
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
         //dd($request->all());
         
         $this->validate($request, [
            'radicado'=> 'required|numeric|digits:23',
            'demandante' => 'required|string',
            'demandado' => 'required|string',
           // 'folios' => 'required|numeric',
            //'cuadernos' => 'required|numeric',
            'tipo_expediente'=> 'required'
        ]);
         
         
         $despacho = Despacho::where('codigoDespacho', auth()->user()->cedula)->first();
         //dd($despacho);
         $ciudad = Ciudad::where('codigoCiudad', $despacho->codCiudad);
         
         $ciudad = Ciudad::where('codigoCiudad', $despacho->codCiudad)->first();
         $ciudad = $ciudad->nombreCiudad;
         
         if($despacho != null){
         
         $registroDigitalizacion = new RegistroDigitalizacion();

           $registroDigitalizacion->radicado = $request->radicado;
           $registroDigitalizacion->demandante = $request->demandante;
           $registroDigitalizacion->demandado = $request->demandado;
           $registroDigitalizacion->folios = $request->folios;
           $registroDigitalizacion->cuadernos = $request->cuadernos;
           $registroDigitalizacion->tipo_expediente = $request->tipo_expediente;
           $registroDigitalizacion->id_despacho =  auth()->user()->cedula;
           $registroDigitalizacion->despacho = $despacho->nombreDespacho;
           $registroDigitalizacion->ciudad = $ciudad;
           $registroDigitalizacion->observacion = $request->observacion;
           $registroDigitalizacion->save();
           
           return Redirect::back();
         if($request->ajax())
            {
             
              return response()->json($registroDigitalizacion);
            }

           
         }else{
             $registroDigitalizacion = "No tiene despacho asignado";
             
               if($request->ajax())
            {
             
              return response()->json($registroDigitalizacion);
            }
             
         }
         
         
        
    }
    
      //DESCARGAR INVENTARIO DIGITALIZACION
    public function DescargarMiInvetario(){
        
         $verificar = RegistroDigitalizacion::all();
         $user =  auth()->user()->cedula; 

        if($verificar != null){
            Excel::create('Inventario Digitalizacion', function($excel)use($user) {
               
                $excel->sheet('Inventario Digitalizacion', function($sheet)use($user) {
                    //otra opci贸n -> $products = Product::select('name')->get();
                    //$products = HistoricoComprobanteEntrega::excelcomprobante();
                    $products = DB::select('select * FROM `registro_digitalizacion` WHERE id_despacho = "'.$user.'" ORDER BY id_despacho');
                    //dd($products);
                     
                    $data= json_decode( json_encode($products), true);  
                    
                    $sheet->fromArray($data);
                    
                    $sheet->setOrientation('landscape');
                });
                
            })->export('csv');//xlsx
            
            
         //dd(DB::select('select * FROM `registro_digitalizacion` WHERE id_despacho = "'.$user.'" ORDER BY id_despacho'));
        }else{
            Session::flash('message', 'No se encontraron datos para generar el excel');
            
    	     $revisar=   $this->registroInventario();
    	     return $revisar;
    	  
        }

    }
    
    //DESCARGAR INVENTARIO DIGITALIZACION PDF
    public function DescargarMiInvetarioPdf(){
        
         $user =  auth()->user()->cedula; 
            
                
         $data = DB::select('select * FROM `registro_digitalizacion` WHERE id_despacho = "'.$user.'" ORDER BY id_despacho');
                 

                  // share data to view
                  view()->share('inventario',$data);
                  $pdf = Pdf::loadView('usuario.pdfInventarioDigitalizacion', $data);
            
                  // download PDF file with download method
                  return $pdf->setPaper('legal', 'landscape')
                  ->download('Inventario Digitalizacion.pdf');
                        
  

    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
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
    public function destroy(Request $request,$id)
    {
        $mensaje = "Eliminado!";
           if($request->ajax())
            {
                $registro = RegistroDigitalizacion::findOrFail($id);
                //dd($detenido);
                $registro = RegistroDigitalizacion::destroy($id);
                     
                return response()->json($mensaje);
            }
    }
}
