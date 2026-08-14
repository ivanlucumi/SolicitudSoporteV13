<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use Carbon\Carbon;
use App\Models\Seguimiento;
use App\Models\SolicitudUsuario;
use App\Models\Seccional;
use App\Models\Empleado;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Elemento;

use App\Models\PersonalActivo;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Auth;

class HistorialSolicitudesController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $seguimiento       =   Seguimiento::verHistorial();
        $solicitudusuario  =   SolicitudUsuario::All();
        $seccional         =   Seccional::All();
        $empleado          =   Empleado::All();
        $categoria         =   Categoria::All();
        $user              =   User::All();
        $elementos          =   Elemento::All();
        //dd($seguimiento);
        return view('administrador.historial.index',compact('seguimiento','solicitudusuario','seccional','empleado','categoria','user','elementos'));
    }

    

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       // $seguimiento    = Seguimiento::find($id);
        $seguimiento    =   Seguimiento::verHistorialId($id);
        $solicitudusuario  =   SolicitudUsuario::All();
        $seccional         =   Seccional::All();
        $empleado          =   Empleado::All();
        $categoria         =   Categoria::All();
        $user              =   User::All();
        $elementos          =   Elemento::All();
        //dd($seguimiento);
        return view('administrador/historial.show',['seguimiento'=>$seguimiento],compact('solicitudusuario','seccional','empleado','categoria','user','elementos'));
    }
    
    public function store(Request  $request){

        $fechai =  $request['fechaInicio'];
        $fechaf =  $request['fechaFin'];

        //dd($fechaf);
        $seguimiento       =   Seguimiento::buscarHistorialBD($fechai,$fechaf);
        $solicitudusuario  =   SolicitudUsuario::All();
        $seccional         =   Seccional::All();
        $empleado          =   Empleado::All();
        $categoria         =   Categoria::All();
        $user              =   User::All();
        $elementos          =   Elemento::All();

        if($seguimiento != null){
            $fecha = Carbon::now();
            $fecha = $fecha->format('Y-m-d');
            $pdf   = Pdf::loadView('administrador/pdf.pdfHistorialTodo',['seguimiento'=> $seguimiento],compact('seguimiento','solicitudusuario','seccional','empleado','categoria','user','elementos'))->setPaper('tabloid', 'landscape');
            //$dompdf->load_html(utf8_encode($salida_html));
            return $pdf->download('pdfHistorialTodo"'.$fecha.'".pdf');
        }else{
            Session::flash('message', 'No se encontraron datos para generar el pdf');
        return Redirect::to('/administrador/historial');
        }

    }

    public function excel(){

        return view('administrador.excel.index');
    }

    public function excelconsolidado(){
        
        $verificar = solicitudusuario::all();

        if($verificar != null){
           //dd('hola');
            Excel::create('Consolidado General', function($excel) {
                 //dd('hola3');
                $excel->sheet('Consolidado General', function($sheet) {
                    //otra opción -> $products = Product::select('name')->get();
                    //$products = HistoricoComprobanteEntrega::excelcomprobante();
                    $products = DB::select("
                        select solicitud_usuarios.codigoDespacho,
                                concat(users.name,' ',users.lastname) as despacho,
                                users.email as email_despacho,
                                empleados.cedulaE as cedula_empleado, concat(empleados.nameE,' ',empleados.lastnameE) as empleado,
                                solicitud_usuarios.edificio,
                                tipo_requerimientos.nombreRequerimiento,
                                categorias.descripcioncategoria,
                                categorias.prioridad,
                                solicitud_usuarios.elementos,
                                solicitud_usuarios.descripcion,
                                (select concat(us.name,' ',us.lastname) from users as us where us.id = solicitud_usuarios.tecnico) as tecnico,
                                (select usr.email from users usr where usr.id = solicitud_usuarios.tecnico) as email_tecnico,
                                solicitud_usuarios.fecha_visita,
                                solicitud_usuarios.estado_solicitud,
                                solicitud_usuarios.tiempo
                        from solicitud_usuarios, users, empleados, tipo_requerimientos, categorias
                        where solicitud_usuarios.idUser = users.id
                        and solicitud_usuarios.idEmpleado = empleados.id
                        and solicitud_usuarios.idrequerimiento = tipo_requerimientos.id
                        and solicitud_usuarios.idcategorias = categorias.id");
                    //dd($products);
                    $data= json_decode( json_encode($products), true);                
                    $sheet->fromArray($data);
                    $sheet->setOrientation('landscape');
                });
            })->export('csv');//xlsx
        }else{
            Session::flash('message', 'No se encontraron datos para generar el excel');
            return Redirect::to('administrador/excel');
        }
        
    }

    public function excelfiltro(){
        Session::flash('message', 'No se encontraron datos para generar el excel');
            return Redirect::to('administrador/excel');
    }

    public function excelrequerimientos(){


        $verificar = solicitudusuario::all();

        if($verificar != null){
            Excel::create('Atencion Requerimientos', function($excel) {
                $excel->sheet('Atencion Requerimientos', function($sheet) {
                    //otra opción -> $products = Product::select('name')->get();
                    //$products = HistoricoComprobanteEntrega::excelcomprobante();
                    $products = DB::select("
                        select  tipo_requerimientos.nombreRequerimiento as requerimiento,
                                        solicitud_usuarios.codigoDespacho,
                                        concat(users.name,' ',users.lastname) as despacho,
                                solicitud_usuarios.edificio,
                                solicitud_usuarios.descripcion,
                                (select concat(us.name,' ',us.lastname) from users as us where us.id = solicitud_usuarios.tecnico) as tecnico,
                                solicitud_usuarios.fecha_visita,
                                solicitud_usuarios.estado_solicitud
                        from solicitud_usuarios, users, empleados, tipo_requerimientos
                        where solicitud_usuarios.idUser = users.id
                        and solicitud_usuarios.idEmpleado = empleados.id
                        and solicitud_usuarios.idrequerimiento = tipo_requerimientos.id
                        order by solicitud_usuarios.codigoDespacho");
                    //dd($products);
                    $data= json_decode( json_encode($products), true);                
                    $sheet->fromArray($data);
                    $sheet->setOrientation('landscape');
                });
            })->export('xls');
        }else{
            Session::flash('message', 'No se encontraron datos para generar el excel');
            return Redirect::to('administrador/excel');
        }
    }

    public function excelsolicitados(){
        $verificar = solicitudusuario::all();

        if($verificar != null){
            Excel::create('Solicitados', function($excel) {
                $excel->sheet('Solicitados', function($sheet) {
                    //otra opción -> $products = Product::select('name')->get();
                    //$products = HistoricoComprobanteEntrega::excelcomprobante();
                    $products = DB::select("
                        select tipo_requerimientos.nombreRequerimiento,
                               COUNT(solicitud_usuarios.idrequerimiento) as total 
                        from solicitud_usuarios, tipo_requerimientos
                        where solicitud_usuarios.idrequerimiento = tipo_requerimientos.id
                        GROUP by solicitud_usuarios.idrequerimiento");
                    //dd($products);
                    $data= json_decode( json_encode($products), true);                
                    $sheet->fromArray($data);
                    $sheet->setOrientation('landscape');
                });
            })->export('xlsx');
        }else{
            Session::flash('message', 'No se encontraron datos para generar el excel');
            return Redirect::to('administrador/excel');
        }
    }
    
     public function excelDirectorio(){
         
         $data = DB::select("
                        SELECT despachos.nombreDespacho,despachos.codigoDespacho,despachos.direccion,despachos.telefono,despachos.correoD,despachos.extension,despachos.circuito,despachos.districto, ciudades.nombreCiudad as ciudad from despachos, ciudades where despachos.codCiudad = ciudades.codigoCiudad");
                    
         
           /** Creamos nuestro archivo Excel */
      return  Excel::create('Directorio Siris', function ($excel) use ($data) {
            /** Creamos una hoja */
            $excel->sheet('Directorio', function ($sheet) use ($data) {
                $data= json_decode( json_encode($data), true);                
                    $sheet->fromArray($data);
                    $sheet->setOrientation('landscape');
                $sheet->with($data, null, 'A1', false, false);
                //dd($sheet);
            });
            /** Descargamos nuestro archivo pasandole la extensi��n deseada (xls, xlsx) */
        })->download('xlsx');
    


         /*  return Excel::create('Directorio Siris', function($excel) {
                $excel->sheet('Directorio Siris', function($sheet) {
                    $directorio = DB::select("
                        SELECT despachos.nombreDespacho,despachos.codigoDespacho,despachos.direccion,despachos.telefono,despachos.correoD,despachos.extension,despachos.circuito,despachos.districto, ciudades.nombreCiudad as ciudad from despachos, ciudades where despachos.codCiudad = ciudades.codigoCiudad");
                    
                    $data= json_decode( json_encode($directorio), true);                
                    $sheet->fromArray($data);
                    $sheet->setOrientation('landscape');
                });
            })->export('xlsx');//xlsx*/
        
    }
    
      //descargar el consolidado de personal activo
        public function certificadoempleados(){
    
           $PersonalActivos = PersonalActivo::All();
             //dd($PersonalActivos);
           return view('administrador.excel.consolidadoPesronalActivo',compact('PersonalActivos'));
            
        }
    
}
