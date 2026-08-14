<?php
namespace App\Http\Controllers\Monitoreo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\BiometriaIngreso;
use App\Models\BiometriaIngresoRegistro;
use Illuminate\Support\Collection;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\UsoParqueadero;


use App\Models\ControlIngreso;
use App\Models\Vehiculo;
use App\Models\User;
use App\Models\Despacho;
use App\Models\Persona;
use App\Models\Parqueadero;
use App\Models\BitacoraParqueadero;
use App\Models\Empleado;
use App\Models\PermisoEspecialParqueadero;
use App\Models\Conductor;



class CoordinadorIngresoController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('checarsesion');
        $this->middleware('CoordinadorIngreso');
    }


    public function index()
    {
        $fechaA = Carbon::now()->toDateString();

        // Leer seccional directo del campo en la BD (string: "CALI" o "CALI, PALMIRA")
        $seccionalRaw =  auth()->user()->seccional ?? '';
        $seccionales  = !empty($seccionalRaw)
            ? array_filter(array_map('trim', explode(',', strtoupper($seccionalRaw))))
            : [];

        $ingresos = ControlIngreso::where('fecha_ingreso', '>=', $fechaA)
            ->where('vehiculo_autorizado', '!=', "AUTORIZADO")
            ->whereHas('parqueado.puesto', function ($q) use ($seccionales) {
                if (!empty($seccionales)) {
                    $q->whereIn('edificio', $seccionales);
                }
            })
            ->get();

        $parqueadero = Parqueadero::where('placa', null)
            ->where('tipo_vehiculo', null)
            ->whereHas('puesto', function ($q) use ($seccionales) {
                if (!empty($seccionales)) {
                    $q->whereIn('edificio', $seccionales);
                }
            })
            ->pluck('no_parqueadero', 'no_parqueadero');

        $contarUsuario = ControlIngreso::whereNull('salida')
            ->whereNotNull('ingreso')
            ->whereHas('parqueado.puesto', function ($q) use ($seccionales) {
                if (!empty($seccionales)) {
                    $q->whereIn('edificio', $seccionales);
                }
            })
            ->count();

        return view('monitoreo.coordinador.index', compact('ingresos', 'contarUsuario', 'parqueadero'));
    }


    public function enviarsectionajax(Request $request)
    {
        $view = View::make('monitoreo.parqueadero', compact('comprobanteEntregas', 'estados', 'contador', 'consecutivo'));
        if ($request->ajax()) {

            $sections = $view->renderSections();
            return Response::json($sections['content']);
        } else return $view;
    }

    public function administrarParqueadero(Request $request)
    {
        $fechaA = Carbon::now()->toDateString();

        // Leer seccional directo del campo en la BD
        $seccionalRaw =  auth()->user()->seccional ?? '';
        $seccionales  = !empty($seccionalRaw)
            ? array_filter(array_map('trim', explode(',', strtoupper($seccionalRaw))))
            : [];

        $contarUsuario = ControlIngreso::whereNull('salida')
            ->whereNotNull('ingreso')
            ->when(!empty($seccionales), function ($q) use ($seccionales) {
                $q->whereHas('parqueado.puesto', function ($qp) use ($seccionales) {
                    $qp->whereIn('edificio', $seccionales);
                });
            })
            ->count();

        $parqueadero = Parqueadero::with('puesto')
            ->when(!empty($seccionales), function ($q) use ($seccionales) {
                $q->whereHas('puesto', function ($qp) use ($seccionales) {
                    $qp->whereIn('edificio', $seccionales);
                });
            })
            ->get();

        return view('monitoreo.coordinador.adminParqueadero', compact('contarUsuario', 'parqueadero'));
    }

    //metodos crear parqueadero

    public function form(Request $request)
    {




        return view('monitoreo.coordinador.create');
    }

    public function saveForm(Request $request)
    {

        //dd($request->all()); 
        $this->validate($request, [
            "no_parqueadero" => 'required|string|max:10',
            "calidad" => 'required|string|max:29',
            "cedula" => 'required|numeric',
            "tipo_vehiculo" => 'required|string|max:29',
            "placa" => 'required|string|max:10',
            "descripcion_vehiculo" => 'required|string|max:50',
            "nombre" => 'required|string|max:90',
            "cargo" => 'required|string|max:60',
            "juzgado" => 'required|string|max:90',
            "especialidad" => 'required|string|max:60',


        ]);

        $parqueadero = new Parqueadero();

        $parqueadero->fill($request->All());
        $parqueadero->save();

        return Redirect::to('coordinador/ingresos/parqueadero');

        //dd($parqueadero);

    }

    public function updateForm(Request $request, $id)
    {

        $parqueadero = Parqueadero::findOrFail($id);
        $parqueadero->fill($request->All());
        $parqueadero->save();


        return Redirect::to('coordinador/ingresos/parqueadero');
    }
    public function editForm(Request $request, $id)
    {
        //dd($id);
        $parqueadero = Parqueadero::findOrFail($id);
        //dd($parqueadero);

        return view('monitoreo.coordinador.edit', compact('parqueadero'));
    }

    public function registrarIngreso(Request $request, $id)
    {
        //dd($id);

        $hora = Carbon::now()->totimeString();

        if ($request->ajax()) {

            $control = ControlIngreso::find($id);

            if ($control->ingreso === null) {
                $control->ingreso =  auth()->user()->name . ' a las ' . $hora;
                $control->save();
            } else {
                $control->salida = NULL;
                $control->save();
            }
        }
    }


    public function verificaringreso(Request $request, $id)
    {
        //dd($id);
        $solicitudeUsuario = null;
        $results = array();

        $fechaA = Carbon::now()->toDateString();
        //hora actual menos 30 min
        $hora = Carbon::now()->totimeString();
        $horaA = Carbon::now()->subMinutes(20);
        $horaMenos30 = $horaA->totimeString();

        //hora actual mas 10 mmin
        $horaM = Carbon::now()->totimeString();
        $horaM = Carbon::now()->addMinutes(10);
        $horaM10 = $horaM->totimeString();

        //dd($hora);
        $UsuarioHoras = ControlIngreso::where('identificacion', $id)
            ->where('fecha_ingreso', $fechaA)
            ->get();
        //dd($UsuarioHoras);
        //salir si no se encuentra resultado
        if ($UsuarioHoras == null) {
            $solicitudeUsuario = null;
            if ($request->ajax()) {
                return response()->json($solicitudeUsuario);
            }
        }


        foreach ($UsuarioHoras as $solicitudeUsuario1) {

            if ($solicitudeUsuario1->tipo_solicitud == 'EMPLEADO') {
                $control = ControlIngreso::find($solicitudeUsuario1->id);

                /* if($control->ingreso != null){
                                    $control->salida = NULL;
                                     $control->hora_salida = NULL;
                                    $control->save(); 
                              }*/
                //dd($solicitudeUsuario1->vehiculo_autorizado);
                if ($solicitudeUsuario1->vehiculo_autorizado === "AUTORIZADO") {

                    $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                    //dd($vehiculoIng );
                } else {
                    $vehiculoIng = null;
                }


                array_push($results, $solicitudeUsuario1);
                array_push($results, $vehiculoIng);



                $solicitudeUsuario = $results;
                //dd($solicitudeUsuario,'entro');
                if ($request->ajax()) {

                    return response()->json($solicitudeUsuario);
                }
            }
        }
        //PROVEEDOR
        foreach ($UsuarioHoras as $solicitudeUsuario) {
            if ($solicitudeUsuario->tipo_solicitud == 'PROVEEDOR') {
                //dd($solicitudeUsuario);
                if (
                    $solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/ $horaMenos30/*$horaMenos30*/
                    && $solicitudeUsuario->hora_ingreso <= $horaM10
                ) {

                    $control = ControlIngreso::find($solicitudeUsuario->id);

                    /* if($control->ingreso === null){
                                                 $control->ingreso =  auth()->user()->name.' a las '.$hora;
                                                 $control->save(); 
                                            }*/

                    //dd($solicitudeUsuario);
                    if ($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO") {
                        $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                        //dd($vehiculoIng);  
                    } else {
                        $vehiculoIng = null;
                    }
                    array_push($results, $solicitudeUsuario);
                    array_push($results, $vehiculoIng);

                    $solicitudeUsuario = $results;
                    //dd($solicitudeUsuario);
                    if ($request->ajax()) {


                        return response()->json($solicitudeUsuario);
                    }
                }
            }
        }

        //visitante
        foreach ($UsuarioHoras as $solicitudeUsuario) {


            if ($solicitudeUsuario->tipo_solicitud == 'VISITANTE') {
                //dd($solicitudeUsuario);
                if (
                    $solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/ $horaMenos30/*$horaMenos30*/
                    && $solicitudeUsuario->hora_ingreso <= $horaM10
                ) {

                    //dd('hola');

                    $control = ControlIngreso::find($solicitudeUsuario->id);

                    /* if($control->ingreso === null){
                                                 $control->ingreso =  auth()->user()->name.' a las '.$hora;
                                                 $control->salida = NULL;
                                                 $control->save(); 
                                            }
                                            
                                            if($control->ingreso != null){
                                                 $control->salida = NULL;
                                                 $control->hora_salida = NULL;
                                                 $control->save(); 
                                            }*/

                    //dd($solicitudeUsuario);
                    if ($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO") {
                        $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                        //dd($vehiculoIng);  
                    } else {
                        $vehiculoIng = null;
                    }

                    array_push($results, $solicitudeUsuario);
                    array_push($results, $vehiculoIng);

                    $solicitudeUsuario = $results;
                    //dd($solicitudeUsuario);
                    if ($request->ajax()) {


                        return response()->json($solicitudeUsuario);
                    }
                }
            }
        }
    }



    //CoordVerificarIngreso
    public function CoordVerificarIngreso(Request $request, $id)
    {
        //dd($id);
        $solicitudeUsuario = null;
        $results = array();

        $fechaA = Carbon::now()->toDateString();
        //hora actual menos 30 min
        $hora = Carbon::now()->totimeString();
        $horaA = Carbon::now()->subMinutes(10);
        $horaMenos30 = $horaA->totimeString();

        //hora actual mas 10 mmin
        $horaM = Carbon::now()->totimeString();
        $horaM = Carbon::now()->addMinutes(10);
        $horaM10 = $horaM->totimeString();

        //dd($hora);
        // Leer seccional directo del campo en la BD
        $seccionalRaw =  auth()->user()->seccional ?? '';
        $seccionales  = !empty($seccionalRaw)
            ? array_filter(array_map('trim', explode(',', strtoupper($seccionalRaw))))
            : [];

        $UsuarioHoras = ControlIngreso::where('identificacion', $id)
            ->where('fecha_ingreso', $fechaA)
            ->whereHas('parqueado.puesto', function ($q) use ($seccionales) {
                if (!empty($seccionales)) {
                    $q->whereIn('ciudad', $seccionales);
                }
            })
            ->get();
        //dd($UsuarioHoras);
        //salir si no se encuentra resultado
        if ($UsuarioHoras == null) {
            $solicitudeUsuario = null;
            if ($request->ajax()) {
                return response()->json($solicitudeUsuario);
            }
        }


        foreach ($UsuarioHoras as $solicitudeUsuario1) {

            if ($solicitudeUsuario1->tipo_solicitud == 'EMPLEADO') {

                //dd($solicitudeUsuario1->vehiculo_autorizado);
                if ($solicitudeUsuario1->vehiculo_autorizado === "AUTORIZADO") {

                    $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                    //dd($vehiculoIng );
                } else {
                    $vehiculoIng = null;
                }
                $control = ControlIngreso::find($solicitudeUsuario1->id);


                array_push($results, $solicitudeUsuario1);
                array_push($results, $vehiculoIng);

                $solicitudeUsuario = $results;
                //dd($solicitudeUsuario,'entro');
                if ($request->ajax()) {
                    return response()->json($solicitudeUsuario);
                }
            }
        }
        //PROVEEDOR
        foreach ($UsuarioHoras as $solicitudeUsuario) {
            if ($solicitudeUsuario->tipo_solicitud == 'PROVEEDOR') {
                //dd($solicitudeUsuario);
                if (
                    $solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/ $horaMenos30/*$horaMenos30*/
                    && $solicitudeUsuario->hora_ingreso <= $horaM10
                ) {

                    //dd($solicitudeUsuario);
                    if ($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO") {
                        $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                        //dd($vehiculoIng);  
                    } else {
                        $vehiculoIng = null;
                    }
                    array_push($results, $solicitudeUsuario);
                    array_push($results, $vehiculoIng);

                    $solicitudeUsuario = $results;
                    //dd($solicitudeUsuario);
                    if ($request->ajax()) {

                        return response()->json($solicitudeUsuario);
                    }
                }
            }
        }

        //visitante
        foreach ($UsuarioHoras as $solicitudeUsuario) {
            if ($solicitudeUsuario->tipo_solicitud == 'VISTANTE') {
                //dd($solicitudeUsuario);
                if (
                    $solicitudeUsuario->hora_ingreso/*1:42*/ >=/*1:45*/ $horaMenos30/*$horaMenos30*/
                    && $solicitudeUsuario->hora_ingreso <= $horaM10
                ) {

                    //dd($solicitudeUsuario);
                    if ($solicitudeUsuario->vehiculo_autorizado === "AUTORIZADO") {
                        $vehiculoIng = Vehiculo::find($solicitudeUsuario1->vehiculo);
                        //dd($vehiculoIng);  
                    } else {
                        $vehiculoIng = null;
                    }
                    array_push($results, $solicitudeUsuario);
                    array_push($results, $vehiculoIng);

                    $solicitudeUsuario = $results;
                    //dd($solicitudeUsuario);
                    if ($request->ajax()) {

                        return response()->json($solicitudeUsuario);
                    }
                }
            }
        }
    }


    public function contarUsuarios(Request $request)
    {
        $fechaA = Carbon::now()->toDateString();
        $contarUsuario = ControlIngreso::where('hora_salida', null)
            ->where('ingreso', '!=', null)
            ->where('fecha_ingreso', $fechaA)
            ->count();
        //dd($contarUsuario);
        if ($request->ajax()) {

            return response()->json($contarUsuario);
        }
    }

    public function verificarVehiculo(Request $request, $id)
    {
        //dd($id);
        $vehiculo = ControlIngreso::find($id);
        //dd($vehiculo);



        if ($request->ajax()) {
            if ($vehiculo != null) {
                if ($vehiculo->vehiculo != null) {
                    $vehiculoIng = Vehiculo::find($vehiculo->vehiculo);
                    //dd($vehiculoIng);
                    return response()->json($vehiculoIng);
                } else {
                    $vehiculoIng = null;
                    return response()->json($vehiculoIng);
                }
            }
        }
    }

    public function autorizarVehiculo(Request $request, $id)
    {
        dd($request->all(), $id);
        //dd($id);
        $ControlIngreso = ControlIngreso::find($id);
        //dd($ControlIngreso);


        $mensaje = ['mensaje' => 'No se puede autorizar Vehiculo <br> Feliz día!!'];
        $fechaA = Carbon::now()->toDateString();

        if ($ControlIngreso != null) {
            $ingresos = ControlIngreso::where('identificacion', $ControlIngreso->identificacion)
                ->where('quien_solicito', $ControlIngreso->quien_solicito)
                ->where('vehiculo', $ControlIngreso->vehiculo)
                ->get();
            //dd($ingresos);

            foreach ($ingresos as  $value) {
                //dd($value->id);
                if ($value->vehiculo_autorizado == "PENDIENTE" || $value->vehiculo_autorizado == "NEGADO") {
                    if ($fechaA <= $value->fecha_ingreso) {
                        $value->vehiculo_autorizado = "AUTORIZADO";
                        $value->vehiculo_autorizado = "AUTORIZADO";
                        $value->vehiculo_autorizado = "AUTORIZADO";
                        $value->save();
                    }
                }
            }

            $mensaje = ['mensaje' => 'Vehículo Autorizado <br> Feliz día!!'];
        } else {
            $mensaje = ['mensaje' => 'No se puede autorizar Vehiculo <br> Feliz día!!'];
        }




        if ($request->ajax()) {

            return response()->json($mensaje);
        }
    }

    public function denegarVehiculo(Request $request, $id)
    {
        //dd($id);
        $ControlIngreso = ControlIngreso::find($id);
        //dd($ControlIngreso);


        $mensaje = ['mensaje' => 'Error al Negar Ingreso de Vehículo <br> Feliz día!!'];
        $fechaA = Carbon::now()->toDateString();

        if ($ControlIngreso != null) {
            $ingresos = ControlIngreso::where('identificacion', $ControlIngreso->identificacion)
                ->where('quien_solicito', $ControlIngreso->quien_solicito)
                ->where('vehiculo', $ControlIngreso->vehiculo)
                ->get();
            //dd($ingresos);

            foreach ($ingresos as  $value) {
                //dd($value->id);
                if ($value->vehiculo_autorizado == "PENDIENTE") {
                    if ($fechaA <= $value->fecha_ingreso) {
                        $value->vehiculo_autorizado = "NEGADO";
                        $value->save();
                    }
                }
            }

            $mensaje = ['mensaje' => 'Se Negó El ingreso de este Vehiculo <br> Feliz día!!'];
        } else {
            $mensaje = ['mensaje' => 'Error al Negar Ingreso de Vehículo <br> Feliz día!!'];
        }




        if ($request->ajax()) {

            return response()->json($mensaje);
        }
    }


    public function reportarSalida(Request $request, $id)
    {

        $fechaA = Carbon::now()->toDateString();
        $hora = Carbon::now()->totimeString();

        $UsuarioHora = ControlIngreso::where('identificacion', $id)
            ->where('fecha_ingreso', $fechaA)
            ->where('ingreso', '!=', null)
            ->where('hora_ingreso', '<', $hora)
            ->where('salida', null)
            ->get();

        //dd($UsuarioHora->count());

        if ($UsuarioHora->count() != 0) {

            foreach ($UsuarioHora as  $value) {
                //dd($value,$value->id ,'hola');
                $control = ControlIngreso::find($value->id);
                $control->salida =  auth()->user()->name . ' a las ' . $hora;
                $control->hora_salida = $hora;
                $control->save();
            }

            $mensaje = ['mensaje' => 'Registro de salida exitoso... <br> Feliz día!!'];
        } else {
            //dd($UsuarioHora);
            $mensaje = ['mensaje' => 'No ha reportado ingreso o ya lo realizó <br>Feliz día!'];
        }

        if ($request->ajax()) {

            return response()->json($mensaje);
        }



        //dd($UsuarioHora);
    }



    public function registroIngreso(Request $request)
    {
        if ($request['cedula'] == null) {
            $fecha = Carbon::now()->toDateString();
        } else {
            $fecha = $request['fecha'];
        }


        //dd($request['cedula']);
        $ingresos = ControlIngreso::where('quien_solicito',  auth()->user()->id)
            ->cedulai($request['cedula'])
            ->fechai($fecha)
            ->radicadoi($request['radicado'])
            ->orderBy('fecha_ingreso', 'ASC')
            ->orderBy('hora_ingreso', 'ASC')
            ->get();

        return view('monitoreo.reg_ingreso.index', compact('ingresos'));
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function agendamiento()
    {
        $despacho = Despacho::select('nombreDespacho')->where('correoD', '=',  auth()->user()->email)->first();
        $parqueadero = Parqueadero::where('placa', null)->where('tipo_vehiculo', null)->pluck('no_parqueadero', 'no_parqueadero');

        //dd($despacho);
        if ($despacho) {
            $nombreDespacho = $despacho->nombreDespacho;
        } else {
            $nombreDespacho =  auth()->user()->name;
        }
        //dd($nombreDespacho);
        return view('monitoreo.reg_ingreso.agendamiento', compact('nombreDespacho', 'parqueadero'));
    }

    public function agendamientoStore(Request $request)
    {
        $visita = new ControlIngreso();

        $visita->identificacion = $request['identificacion'];
        $visita->nombre = $request['nombre'];
        $visita->apellidos = $request['apellidos'];
        $visita->fecha_ingreso = $request['fecha_ingreso'];
        $visita->hora_ingreso = $request['hora_ingreso'];
        $visita->radicado = $request['radicado'];
        $visita->despacho = $request['nombre_despacho'];
        $visita->save();
        return redirect()->back();
    }

    public function registroIngresos()
    {
        $biometria = null;
        $Registros = null;
        $modoPerfil = false;
        $porteros = DB::table('users')->where('rol', 8)->select('id', 'name', 'lastname')->orderBy('name')->get();

        return view('monitoreo.coordinador.ConsultaRegistroIngresos', compact('biometria', 'Registros', 'modoPerfil', 'porteros'));
    }

    public function buscaRegistroIngresos(Request $request)
    {
        try {
            $identificacion = $request->get('identificacion');
            $id_porteria    = $request->get('id_porteria');
            $fecha_inicio   = $request->get('fecha_inicio');
            $fecha_fin      = $request->get('fecha_fin');
            $export_excel   = $request->has('export_excel');

            $modoPerfil = false;
            $biometria = null;

            // Modo perfil si solo se busca una cédula exacta
            if (!empty($identificacion) && empty($id_porteria) && empty($fecha_inicio) && empty($fecha_fin)) {
                $biometria = BiometriaIngreso::where('identificacion', $identificacion)->first();
                if ($biometria) {
                    $modoPerfil = true;
                }
            }

            $query = DB::table('biometria_ingresos_registro as r')
                ->join('biometria_ingresos as i', 'r.biometria_ingresos_id', '=', 'i.id')
                ->leftJoin('users as u', 'r.id_porteria', '=', 'u.id')
                ->select(
                    'r.*',
                    'i.identificacion',
                    'i.p_nombre',
                    'i.s_nombre',
                    'i.p_apellido',
                    'i.s_apellido',
                    'i.observaciones',
                    DB::raw("CONCAT(u.name,' ',u.lastname) as portero"),
                    'u.seccional as portero_seccional'
                );

            if (!empty($identificacion)) {
                $query->where(function($q) use ($identificacion) {
                    $q->where('i.identificacion', 'LIKE', "%{$identificacion}%")
                      ->orWhere(DB::raw("CONCAT(i.p_nombre, ' ', i.p_apellido)"), 'LIKE', "%{$identificacion}%")
                      ->orWhere(DB::raw("CONCAT(i.p_nombre, ' ', i.s_nombre, ' ', i.p_apellido, ' ', i.s_apellido)"), 'LIKE', "%{$identificacion}%");
                });
            }

            if (!empty($id_porteria)) {
                $query->where('r.id_porteria', $id_porteria);
            }

            if (!empty($fecha_inicio) && !empty($fecha_fin)) {
                $query->whereBetween('r.fecha_ingreso', [
                    $fecha_inicio . ' 00:00:00',
                    $fecha_fin . ' 23:59:59'
                ]);
            } elseif (!empty($fecha_inicio)) {
                $query->where('r.fecha_ingreso', '>=', $fecha_inicio . ' 00:00:00');
            } elseif (!empty($fecha_fin)) {
                $query->where('r.fecha_ingreso', '<=', $fecha_fin . ' 23:59:59');
            }

            if ($export_excel) {
                $resultados = $query->orderBy('r.fecha_ingreso', 'desc')->get();
                return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\BiometriaIngresosExport($resultados), 'ingresos_personas.xlsx');
            }

            if ($modoPerfil) {
                $Registros = $query->orderBy('r.fecha_ingreso', 'desc')->get();
            } else {
                $Registros = $query->orderBy('r.fecha_ingreso', 'desc')->paginate(50);
            }

            if ($modoPerfil === false && $Registros->isEmpty() && !empty($identificacion) && empty($id_porteria) && empty($fecha_inicio) && empty($fecha_fin)) {
                Session::flash('error', 'No se encontraron registros con: ' . $identificacion);
                return redirect()->back();
            }

            $porteros = DB::table('users')->where('rol', 8)->select('id', 'name', 'lastname')->orderBy('name')->get();

            return view('monitoreo.coordinador.ConsultaRegistroIngresos', compact('biometria', 'Registros', 'modoPerfil', 'porteros'));
        } catch (\Exception $e) {
            return back()->with('error', "Se presento un error, informe a soporte <br>" . $e->getMessage())->withInput();
        }
    }


    public function guardarNovedad(Request $request)
    {
        $request->validate([
            'id_biometria' => 'required|numeric',
            'novedades' => 'required|string',
        ]);

        $biometria = BiometriaIngreso::findOrFail($request->id_biometria);
        $biometria->novedades = mb_strtoupper(trim($request->novedades));
        $biometria->save();

        Session::flash('success', 'Novedad registrada y actualizada exitosamente.');
        return back();
    }

    public function eliminarNovedad(Request $request)
    {
        $request->validate([
            'id_biometria' => 'required|numeric'
        ]);

        $biometria = BiometriaIngreso::findOrFail($request->id_biometria);
        $biometria->novedades = null;
        $biometria->save();

        Session::flash('success', 'La novedad ha sido eliminada. El usuario ingresará sin alertas.');
        return back();
    }

    public function contarUsuariosPorteria(Request $request)
    {

        $fechaA = Carbon::now()->toDateString();
        //dd($fechaA);
        $contarUsuario = BiometriaIngresoRegistro::where('id_porteria',  auth()->user()->id)
            ->count();
        //dd($contarUsuario);
        if ($request->ajax()) {

            return response()->json($contarUsuario);
        }
    }

    public function ListadoRegistroIngresos(Request $request)
    {

        $query = DB::table('biometria_ingresos_registro as r')
            ->join('biometria_ingresos as i', 'r.biometria_ingresos_id', '=', 'i.id')
            ->join('users as u', 'r.id_porteria', '=', 'u.id')
            ->select(
                'r.fecha_ingreso',
                'r.hora_ingreso',
                'i.identificacion',
                'i.p_nombre',
                'i.s_nombre',
                'i.p_apellido',
                'i.s_apellido',
                'i.observaciones',
                DB::raw("CONCAT(u.name,' ',u.lastname) as portero")
            );

        // 🔎 Filtro por usuario portería
        if ($request->filled('portero')) {
            $query->where('r.id_porteria', $request->portero);
        }

        // 🔎 Filtro por cédula
        if ($request->filled('cedula')) {
            $query->where('i.identificacion', $request->cedula);
        }

        // 🔎 Filtro por rango de fechas
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('r.fecha_ingreso', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59'
            ]);
        }

        $registros = $query->orderBy('r.fecha_ingreso', 'desc')
            ->paginate(20);

        $porteros = DB::table('users')->where('rol', 8)
            ->select('id', 'name', 'lastname')
            ->orderBy('name')
            ->get();

        return view('monitoreo.coordinador.Listado', compact('registros', 'porteros'));
    }

    /* --- MEJORAS DE ADMINISTRACI&Oacute;N (USO PARQUEADERO) --- */

    public function adminPuestos(Request $request)
    {

        $seccionalRaw =  auth()->user()->seccional ?? '';
        $seccionales  = !empty($seccionalRaw)
            ? array_filter(array_map('trim', explode(',', strtoupper($seccionalRaw))))
            : [];

        $query = UsoParqueadero::with('asignaciones');

        // Filtro por seccional obligatoria (Seguridad por jurisdicción)
        if (!empty($seccionales)) {
            $query->where(function($q) use ($seccionales) {
                foreach($seccionales as $s) {
                    $q->orWhere('edificio', 'LIKE', "%$s%")
                      ->orWhere('ciudad', 'LIKE', "%$s%");
                }
            });
        }

        // Búsqueda por Ciudad
        if ($request->filled('ciudad')) {
            $query->where('ciudad', $request->ciudad);
        }

        // Búsqueda por Edificio/Torre
        if ($request->filled('edificio')) {
            $query->where('edificio', 'LIKE', '%' . strtoupper(trim($request->edificio)) . '%');
        }

        if ($request->filled('ubicacion')) {
            $query->where('ubicacion', 'LIKE', '%' . strtoupper(trim($request->ubicacion)) . '%');
        }

        if ($request->filled('zona')) {
            $query->where('zona', 'LIKE', '%' . strtoupper(trim($request->zona)) . '%');
        }

        // Búsqueda por Puesto / Edificio / Ubicación
        if ($request->filled('parqueadero')) {
            $val = strtoupper(trim($request->parqueadero));
            $query->where(function($q) use ($val) {
                $q->where('parqueadero', 'LIKE', "%$val%")
                  ->orWhere('edificio', 'LIKE', "%$val%")
                  ->orWhere('ubicacion', 'LIKE', "%$val%");
            });
        }

        // Búsqueda por Estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Búsqueda por Vehículo (Placa o Tipo)
        if ($request->filled('vehiculo')) {
            $vehiculo = strtoupper($request->vehiculo);
            $query->whereHas('asignaciones', function ($q) use ($vehiculo) {
                $q->where('placa', $vehiculo)
                    ->orWhere('tipo_vehiculo', 'LIKE', "%$vehiculo%");
            });
        }

        // Búsqueda por Funcionario (Nombre, Cédula o Placa)
        if ($request->filled('funcionario')) {
            $search = strtoupper(trim($request->funcionario));
            $query->whereHas('asignaciones', function ($q) use ($search) {
                $q->where(function($sq) use ($search) {
                    $sq->where('nombre', 'LIKE', "%$search%")
                      ->orWhere('cedula', 'LIKE', "%$search%")
                      ->orWhere('placa', 'LIKE', "%$search%");
                });
            });
        }

        $puestos = $query->orderBy('parqueadero')->paginate(20)->appends($request->input());
        $ciudades = UsoParqueadero::distinct()->orderBy('ciudad')->pluck('ciudad');

        return view('monitoreo.parqueadero.index', compact('puestos', 'ciudades'));
    }

    public function adminAsignaciones()
    {
        // Cargar asignaciones con su puesto físico para mostrar ubicación completa
        // Solo mostrar asignaciones activas (parqueadero_id no nulo)
        $asignaciones = Parqueadero::with('puesto')
                            ->whereNotNull('parqueadero_id')
                            ->orderBy('nombre')
                            ->get();
        return view('monitoreo.parqueadero.assignments', compact('asignaciones'));
    }

    public function crearPuesto()
    {
        return view('monitoreo.parqueadero.create');
    }

    public function guardarPuesto(Request $request)
    {
        $request->validate([
            'parqueadero' => 'required|unique:uso_parqueadero,parqueadero',
            'ciudad'      => 'required',
            'edificio'    => 'required',
            'ubicacion'   => 'required',
            'capacidad'   => 'required|numeric|min:1',
        ]);

        UsoParqueadero::create([
            'parqueadero' => strtoupper($request->parqueadero),
            'ciudad'      => strtoupper($request->ciudad),
            'edificio'    => strtoupper($request->edificio),
            'ubicacion'   => strtoupper($request->ubicacion),
            'zona'        => strtoupper($request->zona ?? ''),
            'capacidad'   => $request->capacidad,
            'estado'      => 'LIBRE'
        ]);

        Session::flash('message', 'Puesto de parqueo creado correctamente.');
        return redirect()->route('cooringreso.parqueadero.index');
    }

    public function editarPuesto($id)
    {
        $puesto = UsoParqueadero::with('asignaciones')->findOrFail($id);
        return view('monitoreo.parqueadero.edit', compact('puesto'));
    }

    public function actualizarPuesto(Request $request, $id)
    {
        $puesto = UsoParqueadero::findOrFail($id);
        $request->validate([
            'parqueadero' => 'required|unique:uso_parqueadero,parqueadero,' . $id,
            'ciudad'      => 'required',
            'edificio'    => 'required',
            'ubicacion'   => 'required',
            'capacidad'   => 'required|numeric|min:1',
        ]);

        $puesto->update([
            'parqueadero' => strtoupper($request->parqueadero),
            'ciudad'      => strtoupper($request->ciudad),
            'edificio'    => strtoupper($request->edificio),
            'ubicacion'   => strtoupper($request->ubicacion),
            'zona'        => strtoupper($request->zona ?? ''),
            'capacidad'   => $request->capacidad,
            'estado'      => $request->estado ?? $puesto->estado,
        ]);

        // Sincronizar cambios con los funcionarios que tienen este puesto asignado
        Parqueadero::where('parqueadero_id', $puesto->id)->update([
            'no_parqueadero' => $puesto->parqueadero,
            'ciudad'         => $puesto->ciudad,
            'edificio'       => $puesto->edificio,
            'sotano'         => $puesto->ubicacion,
        ]);

        Session::flash('message', 'Puesto actualizado correctamente.');
        return redirect()->route('cooringreso.parqueadero.index');
    }

    public function asignarPuestoForm($id)
    {
        $puesto = UsoParqueadero::findOrFail($id);
        $asignacion = $puesto->asignacionActiva;
        $despachos = Despacho::orderBy('nombreDespacho')->get();
        return view('monitoreo.parqueadero.assign', compact('puesto', 'asignacion', 'despachos'));
    }

    public function editarAsignacionPuesto($id)
    {
        $asignacion = Parqueadero::findOrFail($id);
        $puesto = UsoParqueadero::findOrFail($asignacion->parqueadero_id);
        $despachos = Despacho::orderBy('nombreDespacho')->get();
        return view('monitoreo.parqueadero.assign', compact('puesto', 'asignacion', 'despachos'));
    }

    public function guardarAsignacionPuesto(Request $request)
    {
        $request->validate([
            'puesto_id'    => 'required|exists:uso_parqueadero,id',
            'funcionarios' => 'required|array',
            'funcionarios.*' => 'exists:parqueadero,id'
        ]);

        $puesto = UsoParqueadero::findOrFail($request->puesto_id);

        if ($puesto->estado == 'INACTIVO') {
            return redirect()->back()->withErrors(['puesto_id' => 'No se puede asignar funcionarios a un puesto INACTIVO.'])->withInput();
        }

        foreach($request->funcionarios as $funcionario_id) {
            $funcionario = Parqueadero::findOrFail($funcionario_id);
            // Actualizamos TODOS los registros (vehículos) de esta persona
            Parqueadero::where('cedula', $funcionario->cedula)->update([
                'parqueadero_id' => $puesto->id,
                'no_parqueadero' => $puesto->parqueadero,
                'ciudad'         => $puesto->ciudad,
                'edificio'       => $puesto->edificio,
                'sotano'         => $puesto->ubicacion,
            ]);
        }

        if ($puesto->estado === 'LIBRE') {
            $puesto->update(['estado' => 'OCUPADO']);
        }

        Session::flash('message', 'Funcionario(s) asignados correctamente al puesto ' . $puesto->parqueadero);
        return redirect()->route('cooringreso.parqueadero.index');
    }

    public function liberarAsignacion($id)
    {
        $asignacion = Parqueadero::findOrFail($id);
        $puesto_id = $asignacion->parqueadero_id;
        // En lugar de borrar, solo desvinculamos el puesto
        $asignacion->update(['parqueadero_id' => null, 'no_parqueadero' => null]);
        UsoParqueadero::where('id', $puesto_id)->update(['estado' => 'LIBRE']);

        Session::flash('message', 'Asignación eliminada correctamente.');
        return redirect()->route('cooringreso.parqueadero.assignments');
    }

    public function liberarPuesto($id)
    {
        // Desvincular cualquier funcionario asignado a este puesto
        Parqueadero::where('parqueadero_id', $id)->update(['parqueadero_id' => null, 'no_parqueadero' => null]);
        
        $puesto = UsoParqueadero::findOrFail($id);
        $puesto->update(['estado' => 'LIBRE']);
        
        Session::flash('message', 'Puesto ' . $puesto->parqueadero . ' liberado correctamente.');
        return redirect()->route('cooringreso.parqueadero.index');
    }


    /* ---  M&Oacute;DULO FUNCIONARIOS  --- */

    public function adminFuncionarios(Request $request)
    {
        $seccionalRaw =  auth()->user()->seccional ?? '';
        $seccionales  = !empty($seccionalRaw)
            ? array_filter(array_map('trim', explode(',', strtoupper($seccionalRaw))))
            : [];

        $nombre    = trim($request->get('nombre'));
        $cedula    = trim($request->get('cedula'));
        $placa     = trim($request->get('placa'));
        $puesto    = trim($request->get('puesto'));
        $cargo     = trim($request->get('cargo'));

        $query = Parqueadero::with(['puesto']);

        // Filtro por seccional (Seguridad)
        if (!empty($seccionales)) {
            $query->where(function ($q) use ($seccionales) {
                // 1. Por el edificio o ciudad del puesto asignado
                $q->whereHas('puesto', function ($qp) use ($seccionales) {
                    $qp->where(function($sq) use ($seccionales) {
                        foreach($seccionales as $s) {
                            $sq->orWhere('edificio', 'LIKE', "%$s%")
                               ->orWhere('ciudad', 'LIKE', "%$s%");
                        }
                    });
                })
                // 2. O por la ciudad del despacho (Fallback para funcionarios sin puesto)
                ->orWhereIn('despacho', function ($qd) use ($seccionales) {
                    $qd->select('nombreDespacho')
                        ->from('despachos')
                        ->join('ciudades', 'despachos.codCiudad', '=', 'ciudades.codigoCiudad')
                        ->where(function($sq) use ($seccionales) {
                            foreach($seccionales as $s) {
                                $sq->orWhere('ciudades.nombreCiudad', 'LIKE', "%$s%");
                            }
                        });
                })
                // 3. O por coincidencia directa en campos de texto (Juzgado/Despacho)
                ->orWhere(function ($qf) use ($seccionales) {
                    foreach($seccionales as $s) {
                        $qf->orWhere('despacho', 'LIKE', "%$s%")
                           ->orWhere('juzgado', 'LIKE', "%$s%")
                           ->orWhere('nombre', 'LIKE', "%$s%"); // A veces el nombre tiene la seccional
                    }
                });
            });
        }

        // Filtros Manuales (Encabezados)
        if ($nombre) {
            $query->where('nombre', 'LIKE', '%' . strtoupper($nombre) . '%');
        }

        if ($cedula) {
            $query->where('cedula', 'LIKE', "%$cedula%");
        }

        if ($cargo) {
            $query->where('cargo', 'LIKE', '%' . strtoupper($cargo) . '%');
        }

        if ($placa) {
            $placaVal = strtoupper($placa);
            $query->where('placa', 'LIKE', "%$placaVal%");
        }

        if ($puesto) {
            $query->where(function ($q) use ($puesto) {
                $q->where('no_parqueadero', 'LIKE', "%$puesto%")
                    ->orWhereHas('puesto', function ($qp) use ($puesto) {
                        $qp->where('parqueadero', 'LIKE', "%$puesto%");
                    });
            });
        }

        $funcionarios = $query->orderBy('nombre')->paginate(25)->appends($request->input());
        return view('monitoreo.funcionarios.index', compact('funcionarios', 'nombre', 'cedula', 'placa', 'puesto', 'cargo'));
    }

    public function crearFuncionario()
    {
        $despachos = Despacho::orderBy('nombreDespacho')->get();
        return view('monitoreo.funcionarios.create', compact('despachos'));
    }

    public function guardarFuncionario(Request $request)
    {
        $request->validate([
            'cedula'        => 'required|unique:parqueadero,cedula',
            'nombre'        => 'required',
            'placa'         => 'required',
            'tipo_vehiculo' => 'required',
        ]);

        $commonData = [
            'cedula'               => $request->cedula,
            'nombre'               => strtoupper($request->nombre),
            'cargo'                => strtoupper($request->cargo ?? ''),
            'codigo_despacho'      => $request->codigo_despacho,
            'despacho'             => strtoupper($request->despacho),
            'email_despacho'       => $request->email_despacho,
            'juzgado'              => strtoupper($request->despacho ?? ''),
            'especialidad'         => strtoupper($request->especialidad ?? ''),
            'calidad'              => strtoupper($request->calidad ?? 'FUNCIONARIO'),
            'calidad_vehiculo'     => strtoupper($request->calidad_vehiculo ?? 'PARTICULAR'),
            'observaciones'        => $request->observaciones,
            'tipo_ingreso'         => $request->tipo_ingreso ?? 'RESTRINGIDO',
            'estado'               => 'ACTIVO',
            'parqueadero_id'       => null,
        ];

        // 1. Crear el registro principal
        Parqueadero::create(array_merge($commonData, [
            'placa'                => strtoupper($request->placa),
            'tipo_vehiculo'        => strtoupper($request->tipo_vehiculo),
            'descripcion_vehiculo' => strtoupper($request->descripcion_vehiculo ?? ''),
        ]));

        // 2. Gestionar vehículos adicionales (duplicando registros en 'parqueadero')
        if ($request->has('vehiculos_extra')) {
            foreach ($request->vehiculos_extra as $vData) {
                if (empty($vData['placa'])) continue;

                Parqueadero::create(array_merge($commonData, [
                    'placa'                => strtoupper($vData['placa']),
                    'tipo_vehiculo'        => strtoupper($vData['tipo_vehiculo']),
                    'calidad_vehiculo'     => strtoupper($vData['calidad_vehiculo'] ?? 'PARTICULAR'),
                    'descripcion_vehiculo' => strtoupper($vData['descripcion'] ?? ''),
                ]));
            }
        }

        Session::flash('message', 'Funcionario y vehículo(s) registrados correctamente.');
        return redirect()->route('cooringreso.funcionarios.index');
    }

    public function editarFuncionario($id)
    {
        $funcionario = Parqueadero::with('puesto')->findOrFail($id);
        $despachos   = Despacho::orderBy('nombreDespacho')->get();
        
        // Cargar los "hermanos" (otros vehículos de la misma persona)
        $vehiculosHermanos = Parqueadero::where('cedula', $funcionario->cedula)
                                        ->where('id', '!=', $id)
                                        ->get();
                                        
        return view('monitoreo.funcionarios.edit', compact('funcionario', 'despachos', 'vehiculosHermanos'));
    }

    public function actualizarFuncionario(Request $request, $id)
    {
        $master = Parqueadero::findOrFail($id);
        $request->validate([
            'cedula'        => 'required|unique:parqueadero,cedula,' . $id . ',id',
            'nombre'        => 'required',
            'placa'         => 'required',
            'tipo_vehiculo' => 'required',
        ]);

        $commonData = [
            'cedula'               => $request->cedula,
            'nombre'               => strtoupper($request->nombre),
            'cargo'                => strtoupper($request->cargo ?? ''),
            'codigo_despacho'      => $request->codigo_despacho,
            'despacho'             => strtoupper($request->despacho),
            'email_despacho'       => $request->email_despacho,
            'juzgado'              => strtoupper($request->despacho ?? ''),
            'especialidad'         => strtoupper($request->especialidad ?? ''),
            'calidad'              => strtoupper($request->calidad ?? 'FUNCIONARIO'),
            'calidad_vehiculo'     => strtoupper($request->calidad_vehiculo ?? 'PARTICULAR'),
            'observaciones'        => $request->observaciones,
            'tipo_ingreso'         => $request->tipo_ingreso ?? 'RESTRINGIDO',
            'estado'               => $request->estado ?? 'ACTIVO',
            'parqueadero_id'       => $master->parqueadero_id,
            'no_parqueadero'       => $master->no_parqueadero,
            'ciudad'               => $master->ciudad,
            'edificio'             => $master->edificio,
            'sotano'               => $master->sotano,
        ];

        // 1. Actualizar el registro principal
        $master->update(array_merge($commonData, [
            'placa'                => strtoupper($request->placa),
            'tipo_vehiculo'        => strtoupper($request->tipo_vehiculo),
            'descripcion_vehiculo' => strtoupper($request->descripcion_vehiculo ?? ''),
        ]));

        // 2. Gestionar vehículos adicionales (duplicando registros en 'parqueadero')
        $keepIds = [$master->id];
        if ($request->has('vehiculos_extra')) {
            foreach ($request->vehiculos_extra as $vData) {
                if (empty($vData['placa'])) continue;

                $extraData = array_merge($commonData, [
                    'placa'                => strtoupper($vData['placa']),
                    'tipo_vehiculo'        => strtoupper($vData['tipo_vehiculo']),
                    'calidad_vehiculo'     => strtoupper($vData['calidad_vehiculo'] ?? 'PARTICULAR'),
                    'descripcion_vehiculo' => strtoupper($vData['descripcion'] ?? ''),
                ]);

                if (isset($vData['id']) && !empty($vData['id'])) {
                    $brother = Parqueadero::find($vData['id']);
                    if ($brother) {
                        $brother->update($extraData);
                        $keepIds[] = $brother->id;
                    }
                } else {
                    // Crear un nuevo registro duplicado para este vehículo
                    $newRecord = Parqueadero::create($extraData);
                    $keepIds[] = $newRecord->id;
                }
            }
        }

        // 3. Eliminar registros duplicados que fueron removidos en la vista
        Parqueadero::where('cedula', $master->cedula)
                   ->whereNotIn('id', $keepIds)
                   ->delete();

        Session::flash('message', 'Funcionario y vehículos actualizados (Registros independientes).');
        return redirect()->route('cooringreso.funcionarios.index');
    }

    public function inactivarFuncionario($id)
    {
        $funcionario = Parqueadero::findOrFail($id);
        $nuevoEstado = $funcionario->estado == 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
        $funcionario->update(['estado' => $nuevoEstado]);
        
        Session::flash('message', 'Estado del funcionario cambiado a ' . $nuevoEstado);
        return redirect()->back();
    }

    public function eliminarFuncionario($id)
    {
        Parqueadero::findOrFail($id)->delete();
        Session::flash('message', 'Funcionario eliminado correctamente.');
        return redirect()->route('cooringreso.funcionarios.index');
    }

    public function asignarPuestoAFuncionario($id)
    {
        $funcionario = Parqueadero::with('puesto')->findOrFail($id);
        $puestos     = UsoParqueadero::with('asignaciones')->orderBy('parqueadero')->get();
        return view('monitoreo.funcionarios.assign', compact('funcionario', 'puestos'));
    }

    public function guardarPuestoFuncionario(Request $request)
    {
        $request->validate([
            'funcionario_id' => 'required|exists:parqueadero,id',
            'puesto_id'      => 'required|exists:uso_parqueadero,id',
        ]);

        $funcionario = Parqueadero::findOrFail($request->funcionario_id);
        $puesto      = UsoParqueadero::findOrFail($request->puesto_id);

        // Actualizar TODOS los registros de esta persona con la información del puesto
        Parqueadero::where('placa', $funcionario->placa)->update([
            'parqueadero_id' => $puesto->id,
            'no_parqueadero' => $puesto->parqueadero,
            'ciudad'         => $puesto->ciudad,
            'edificio'       => $puesto->edificio,
            'sotano'         => $puesto->ubicacion, // En parqueadero se llama 'sotano', en uso_parqueadero 'ubicacion'
        ]);

        Session::flash('message', 'Puesto ' . $puesto->parqueadero . ' asignado correctamente.');
        return redirect()->route('cooringreso.funcionarios.index');
    }

    public function desasignarPuestoFuncionario($id)
    {
        $funcionario = Parqueadero::findOrFail($id);
        Parqueadero::where('cedula', $funcionario->cedula)->update([
            'parqueadero_id' => null, 
            'no_parqueadero' => null,
            'ciudad'         => null,
            'edificio'       => null,
            'sotano'         => null,
        ]);
        Session::flash('message', 'Puesto desasignado correctamente.');
        return redirect()->route('cooringreso.funcionarios.index');
    }

    public function historialBitacora(Request $request)
    {
        // Por defecto mostrar el día de hoy si no se envían fechas
        $hoy         = Carbon::now()->toDateString();
        $fecha_desde = $request->get('fecha_desde', $hoy);
        $fecha_hasta = $request->get('fecha_hasta', $hoy);
        $placa       = $request->get('placa');
        $cedula      = $request->get('cedula');

        // Seccional(es) del coordinador autenticado
        $seccionalRaw  =  auth()->user()->seccional ?? '';
        $userSeccional = strtoupper(trim($seccionalRaw));
        $seccionales   = !empty($seccionalRaw)
            ? array_values(array_filter(array_map('trim', explode(',', strtoupper($seccionalRaw)))))
            : [];

        // Detectar dinámicamente si la columna 'ciudad' existe para evitar errores en entornos no migrados
        $tieneColumnaCiudad = \Illuminate\Support\Facades\Schema::hasColumn('bitacora_parqueadero', 'ciudad');

        // Query base con eager loading preventivo
        $query = BitacoraParqueadero::with('empleado');

        // Cargar relaciones solo si existen las tablas correspondientes
        if (\Illuminate\Support\Facades\Schema::hasTable('parqueadero')) {
            $query->with(['puesto.puesto', 'empleado']);
        }

        // ── FILTRO DE SECCIONAL (UBICACIÓN) ───────────────────────────────────
        // Si el usuario tiene seccionales asignadas, aplicamos el filtro restrictivo.
        // Si no (admin global), mostramos todo.
        if (!empty($seccionales)) {
            $query->where(function ($q) use ($seccionales, $tieneColumnaCiudad) {
                // 1. Prioridad: Campo directo 'ciudad' (registros nuevos)
                if ($tieneColumnaCiudad) {
                    $q->whereIn('edificio', $seccionales);
                }

                // 2. Fallback: Relación hacia el puesto asignado (registros antiguos)
                $q->orWhereHas('puesto.puesto', function ($qu) use ($seccionales) {
                    $qu->whereIn('edificio', $seccionales);
                });

                // 3. Fallback: Registros sin relación directa pero que coinciden en seccional
                // (Si la columna existe y el dato fue guardado)
                if ($tieneColumnaCiudad) {
                    $q->orWhere(function ($qEmpty) use ($seccionales) {
                        $qEmpty->whereNull('parqueadero')->whereIn('edificio', $seccionales);
                    });
                }
            });
        }

        // ── FILTROS DE PARÁMETROS ─────────────────────────────────────────────


        if ($fecha_desde && $fecha_hasta) {
            $query->whereBetween('fecha', [$fecha_desde, $fecha_hasta]);
        } elseif ($fecha_desde) {
            $query->where('fecha', '>=', $fecha_desde);
        } elseif ($fecha_hasta) {
            $query->where('fecha', '<=', $fecha_hasta);
        }
        if ($placa) {
            $query->where('placa', strtoupper($placa));
        }

        if ($cedula) {
            $cedulaVal = strtoupper($cedula);
            $query->where(function ($q) use ($cedulaVal) {
                $q->where('cedula', 'LIKE', "%$cedulaVal%")
                  ->orWhere('nombre', 'LIKE', "%$cedulaVal%");
            });
        }

        // ── RESULTADO ─────────────────────────────────────────────────────────
        $bitacora = $query->orderBy('fecha', 'DESC')
            ->orderBy('hora_ingreso', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(50);

        return view('monitoreo.coordinador.bitacoraParqueadero', compact(
            'bitacora',
            'fecha_desde',
            'fecha_hasta',
            'placa',
            'cedula',
            'userSeccional'
        ));
    }

    /* --- MÓDULO INGRESOS TEMPORALES --- */

    public function adminTemporales(Request $request)
    {
        // Leer seccional directo del campo en la BD
        $seccionalRaw =  auth()->user()->seccional ?? '';
        $seccionales  = !empty($seccionalRaw)
            ? array_filter(array_map('trim', explode(',', strtoupper($seccionalRaw))))
            : [];
        $query = Parqueadero::where('calidad', 'TEMPORAL');

        // Filtro por seccional (basado en el creador o manual)
        // Por simplificación, vinculamos temporales a la seccional del usuario que los crea si no tienen puesto
        if (!empty($seccionales)) {
            $query->whereIn('juzgado', $seccionales); // Reutilizamos juzgado para filtrar por ciudad en temporales si es necesario
        }

        if ($request->filled('placa')) {
            $query->where('placa', strtoupper($request->placa));
        }

        if ($request->filled('funcionario')) {
            $val = strtoupper($request->funcionario);
            $query->where(function($q) use ($val) {
                $q->where('cedula', 'LIKE', "%$val%")
                  ->orWhere('nombre', 'LIKE', "%$val%");
            });
        }

        $temporales = $query->orderBy('fecha_fin', 'desc')->paginate(25);
        return view('monitoreo.temporales.index', compact('temporales'));
    }

    public function crearTemporal()
    {
        $ciudades = UsoParqueadero::distinct()->orderBy('ciudad')->pluck('ciudad', 'ciudad');
        return view('monitoreo.temporales.create', compact('ciudades'));
    }

    public function guardarTemporal(Request $request)
    {
        $request->validate([
            'cedula'        => 'required',
            'nombre'        => 'required',
            'empresa'       => 'required',
            'placa'         => 'required',
            'tipo_vehiculo' => 'required',
            'fecha_inicio'  => 'required|date',
            'fecha_fin'     => 'required|date|after_or_equal:fecha_inicio',
            'ciudad'        => 'required'
        ]);

        Parqueadero::create([
            'cedula'               => $request->cedula,
            'nombre'               => strtoupper($request->nombre),
            'empresa'              => strtoupper($request->empresa),
            'placa'                => strtoupper($request->placa),
            'tipo_vehiculo'        => strtoupper($request->tipo_vehiculo),
            'fecha_inicio'         => $request->fecha_inicio,
            'fecha_fin'            => $request->fecha_fin,
            'juzgado'              => strtoupper($request->ciudad), // Guardamos la ciudad en juzgado para filtrar fácil
            'calidad'              => 'TEMPORAL',
            'tipo_ingreso'         => 'GLOBAL', // Por defecto temporales pueden entrar por cualquier portería de la ciudad
            'estado'               => 'ACTIVO'
        ]);

        Session::flash('message', 'Ingreso temporal registrado correctamente.');
        return redirect()->route('cooringreso.temporales.index');
    }

    public function editarTemporal($id)
    {
        $temporal = Parqueadero::findOrFail($id);
        $ciudades = UsoParqueadero::distinct()->orderBy('ciudad')->pluck('ciudad', 'ciudad');
        return view('monitoreo.temporales.edit', compact('temporal', 'ciudades'));
    }

    public function actualizarTemporal(Request $request, $id)
    {
        $temporal = Parqueadero::findOrFail($id);
        $request->validate([
            'cedula'        => 'required',
            'nombre'        => 'required',
            'empresa'       => 'required',
            'placa'         => 'required',
            'tipo_vehiculo' => 'required',
            'fecha_inicio'  => 'required|date',
            'fecha_fin'     => 'required|date|after_or_equal:fecha_inicio',
            'ciudad'        => 'required'
        ]);

        $temporal->update([
            'cedula'               => $request->cedula,
            'nombre'               => strtoupper($request->nombre),
            'empresa'              => strtoupper($request->empresa),
            'placa'                => strtoupper($request->placa),
            'tipo_vehiculo'        => strtoupper($request->tipo_vehiculo),
            'fecha_inicio'         => $request->fecha_inicio,
            'fecha_fin'            => $request->fecha_fin,
            'juzgado'              => strtoupper($request->ciudad),
        ]);

        Session::flash('message', 'Ingreso temporal actualizado.');
        return redirect()->route('cooringreso.temporales.index');
    }

    public function eliminarTemporal($id)
    {
        Parqueadero::findOrFail($id)->delete();
        Session::flash('message', 'Ingreso temporal eliminado.');
        return redirect()->route('cooringreso.temporales.index');
    }

    public function buscarFuncionarioAjax(Request $request)
    {
        $term = strtoupper(str_replace(['-', '.', ' '], '', trim($request->get('term'))));
        if (strlen($term) < 3) {
            return response()->json(['success' => false, 'message' => 'Ingrese al menos 3 caracteres']);
        }

        // 1. Búsqueda EXACTA por cédula o placa en maestro parqueadero (ACTIVO)
        $funcionarios = Parqueadero::where('estado', 'ACTIVO')
            ->where(function($q) use ($term) {
                $q->whereRaw("REPLACE(REPLACE(cedula,' ',''),'-','') = ?", [$term])
                  ->orWhereRaw("UPPER(REPLACE(REPLACE(placa,' ',''),'-','')) = ?", [$term]);
            })
            ->get(['id','cedula','nombre','placa','tipo_vehiculo','parqueadero_id','no_parqueadero','calidad','descripcion_vehiculo']);

        if ($funcionarios->isNotEmpty()) {
            return response()->json(['success' => true, 'data' => $funcionarios]);
        }

        // 2. Fallback EXACTO: buscar en tabla empleados (para mostrar info aunque no esté en parqueadero)
        $empleado = Empleado::where('cedulaE', $term)->first(['cedulaE','nameE','lastnameE','cargo_titular','estado']);

        if ($empleado) {
            return response()->json([
                'success'     => true,
                'from_empleados' => true,
                'data'        => [[
                    'id'              => null,
                    'cedula'          => $empleado->cedulaE,
                    'nombre'          => strtoupper($empleado->nameE . ' ' . $empleado->lastnameE),
                    'placa'           => 'SIN PLACA',
                    'tipo_vehiculo'   => '—',
                    'parqueadero_id'  => null,
                    'no_parqueadero'  => null,
                    'calidad'         => 'FUNCIONARIO',
                    'descripcion_vehiculo' => 'Sin registro de vehículo en parqueadero',
                    'aviso'           => 'Este funcionario no tiene vehículo registrado en el maestro de parqueadero. Regístrelo primero en el módulo de funcionarios.'
                ]]
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No se encontró ningún funcionario o vehículo con ese dato exacto.']);
    }

    public function buscarDatosEmpleadoAjax(Request $request)
    {
        $cedula = trim($request->get('cedula'));
        if (empty($cedula)) {
            return response()->json(['success' => false, 'message' => 'Cédula vacía']);
        }

        $empleado = Empleado::where('cedulaE', $cedula)->first();

        if ($empleado) {
            return response()->json([
                'success' => true,
                'data'    => [
                    'nombre'          => strtoupper($empleado->nameE . ' ' . $empleado->lastnameE),
                    'cargo'           => strtoupper($empleado->cargo_titular ?? ''),
                    'codigo_despacho' => $empleado->cod_dependencia,
                    'calidad'         => ($empleado->clase_nombramiento == 'MAGISTRADO') ? 'MAGISTRADO' : 'FUNCIONARIO'
                ]
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Empleado no encontrado']);
    }


    public function exportarHistorico(Request $request)
    {
        $hoy         = Carbon::now()->toDateString();
        $fecha_desde = $request->get('fecha_desde', $hoy);
        $fecha_hasta = $request->get('fecha_hasta', $hoy);
        $placa       = $request->get('placa');
        $cedula      = $request->get('cedula');
        $tipo        = $request->get('tipo', 'excel');

        $query = BitacoraParqueadero::with('empleado');

        // Aplicar filtro por seccional del usuario
        $seccionalRaw =  auth()->user()->seccional ?? '';
        $seccionales  = !empty($seccionalRaw)
            ? array_filter(array_map('trim', explode(',', strtoupper($seccionalRaw))))
            : [];

        if (!empty($seccionales)) {
            $query->whereIn('edificio', $seccionales);
        }

        if ($fecha_desde && $fecha_hasta) {
            $query->whereBetween('fecha', [$fecha_desde, $fecha_hasta]);
        } elseif ($fecha_desde) {
            $query->where('fecha', '>=', $fecha_desde);
        } elseif ($fecha_hasta) {
            $query->where('fecha', '<=', $fecha_hasta);
        }

        if ($placa) {
            $query->where('placa', strtoupper($placa));
        }

        if ($cedula) {
            $query->where('cedula', 'LIKE', "%$cedula%");
        }

        $datos = $query->orderBy('fecha', 'desc')->get();

        // Obtener datos del funcionario para el PDF (si se filtró por cédula)
        $funcionario = null;
        if ($cedula) {
            $funcionario = Empleado::where('cedulaE', $cedula)->first();
        }

        if ($tipo == 'pdf') {
            $logo = public_path('img/logo rama pdf.png');
            $data = [
                'logo'         => $logo,
                'funcionario'  => $funcionario,
                'resultados'   => $datos,
                'fecha_inicio' => $fecha_desde,
                'fecha_fin'    => $fecha_hasta
            ];
            $pdf = Pdf::loadView('monitoreo.pdf_historico', $data);
            return $pdf->download('historico_ingresos.pdf');
        }

        return Excel::download(new \App\Exports\HistoricoIngresosExport($datos), 'historico_ingresos.xlsx');
    }

    // =========================================================
    //  PERMISOS ESPECIALES (fin de semana / festivos)
    //  Solo vehículos PARTICULARES requieren este permiso.
    // =========================================================

    /**
     * Lista todos los permisos especiales vigentes y futuros.
     * Soporta filtro por cédula.
     */
    public function listarPermisosEspeciales(Request $request)
    {
        $cedula = $request->get('cedula', '');

        $permisos = PermisoEspecialParqueadero::with('coordinador')
            ->when($cedula, fn($q) => $q->where('cedula', $cedula))
            ->orderBy('fecha_permiso', 'desc')
            ->paginate(30);

        // Para el autocomplete: funcionarios registrados como PARTICULARES
        $funcionarios = Parqueadero::where('estado', 'ACTIVO')
            ->where('calidad_vehiculo', 'PARTICULAR')
            ->select('cedula', 'nombre', 'placa')
            ->distinct()
            ->orderBy('nombre')
            ->get();

        return view('monitoreo.coordinador.permisos_especiales', compact('permisos', 'funcionarios', 'cedula'));
    }

    /**
     * Crea un permiso especial para una cédula y fecha determinada.
     */
    public function crearPermisoEspecial(Request $request)
    {
        $this->validate($request, [
            'cedula'        => 'required|string|max:20',
            'fecha_permiso' => 'required|date|after_or_equal:today',
            'motivo'        => 'nullable|string|max:255',
        ]);

        // Verificar que la cédula pertenece a un funcionario ACTIVO con vehículo PARTICULAR
        $funcionario = Parqueadero::where('cedula', $request->cedula)
            ->where('estado', 'ACTIVO')
            ->first();

        if (!$funcionario) {
            return back()->with('error', 'No se encontró un funcionario activo con la cédula ingresada.');
        }

        // Evitar duplicados
        $existe = PermisoEspecialParqueadero::where('cedula', $request->cedula)
            ->where('fecha_permiso', $request->fecha_permiso)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Ya existe un permiso para esa cédula en la fecha indicada.');
        }

        PermisoEspecialParqueadero::create([
            'cedula'        => $request->cedula,
            'fecha_permiso' => $request->fecha_permiso,
            'motivo'        => $request->motivo ? strtoupper($request->motivo) : null,
            'user_id'       =>  auth()->id(),
        ]);

        return back()->with('success', 'Permiso especial otorgado correctamente para el ' . $request->fecha_permiso . '.');
    }

    /**
     * Elimina un permiso especial.
     */
    public function eliminarPermisoEspecial($id)
    {
        $permiso = PermisoEspecialParqueadero::findOrFail($id);
        $permiso->delete();
        return back()->with('success', 'Permiso eliminado correctamente.');
    }
    
    // ========================================================================
    // GESTIÓN DE VEHÍCULOS OFICIALES (Asignación de conductor e historial)
    // ========================================================================

    public function vehiculosOficiales(Request $request)
    {
        $fechaA = Carbon::now()->toDateString();
        
        // Seccional del coordinador
        $seccionalRaw = auth()->user()->seccional ?? '';
        $seccionales = !empty($seccionalRaw) ? array_filter(array_map('trim', explode(',', strtoupper($seccionalRaw)))) : [];

        // Obtener todos los vehículos oficiales (calidad_vehiculo = 'Oficial' o 'OFICIAL' etc.)
        $vehiculos = Parqueadero::whereRaw('LOWER(calidad_vehiculo) = ?', ['oficial'])
            ->get();

        // Para cada vehículo, buscar su estado de ingreso/salida actual
        foreach ($vehiculos as $v) {
            $ultimoRegistro = ControlIngreso::where('parqueadero', $v->id)
                ->latest('id')
                ->first();
                
            if ($ultimoRegistro) {
                $v->ingreso_hoy = $ultimoRegistro->fecha_ingreso . ' ' . $ultimoRegistro->hora_ingreso;
                $v->salida_hoy = $ultimoRegistro->salida ? ($ultimoRegistro->fecha_salida . ' ' . $ultimoRegistro->hora_salida) : null;
                $v->esta_adentro = is_null($ultimoRegistro->salida);
            } else {
                $v->ingreso_hoy = null;
                $v->salida_hoy = null;
                $v->esta_adentro = false;
            }
        }

        // Obtener conductores de la tabla users (rol 27)
        $usersConductores = User::where('rol', 27)->select('cedula','name','lastname')->get();
        
        $conductores = $usersConductores;

        return view('monitoreo.coordinador.vehiculos_oficiales.index', compact('vehiculos', 'conductores'));
    }

    public function historialGlobalReportes(Request $request)
    {
        // Obtener las placas de los vehículos oficiales desde la tabla parqueadero
        $placasOficiales = \App\Models\Parqueadero::whereRaw('LOWER(calidad_vehiculo) = ?', ['oficial'])->pluck('placa')->toArray();

        // Traer todas las inspecciones de esas placas
        $inspecciones = \App\Models\Inspeccion::whereIn('placa', $placasOficiales)
            ->latest('id')
            ->get();
            
        // Anexar la información del parqueadero a cada inspección manualmente
        // ya que el modelo Inspeccion puede estar apuntando a Vehiculo en lugar de Parqueadero
        $vehiculosInfo = \App\Models\Parqueadero::whereIn('placa', $placasOficiales)->get()->keyBy('placa');
        
        foreach ($inspecciones as $inspeccion) {
            $inspeccion->info_parqueadero = $vehiculosInfo->get($inspeccion->placa);
        }
            
        return view('monitoreo.coordinador.vehiculos_oficiales.historial_global', compact('inspecciones'));
    }

    public function asignarConductorVehiculo(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:parqueadero,id',
            'conductor_cedula' => 'required|string',
            'conductor_nombre' => 'required|string',
            'asignacion_tipo' => 'required|in:definitiva,fechas',
            'asignacion_inicio' => 'required_if:asignacion_tipo,fechas|nullable|date',
            'asignacion_fin' => 'required_if:asignacion_tipo,fechas|nullable|date|after_or_equal:asignacion_inicio',
        ]);

        $vehiculo = Parqueadero::findOrFail($request->vehiculo_id);
        $vehiculo->cedula = $request->conductor_cedula;
        $vehiculo->nombre = strtoupper($request->conductor_nombre);
        $vehiculo->asignacion_tipo = $request->asignacion_tipo;
        
        if ($request->asignacion_tipo === 'fechas') {
            $vehiculo->asignacion_inicio = $request->asignacion_inicio;
            $vehiculo->asignacion_fin = $request->asignacion_fin;
        } else {
            $vehiculo->asignacion_inicio = null;
            $vehiculo->asignacion_fin = null;
        }
        
        $vehiculo->visible_para_otros = $request->has('visible_para_otros');
        $vehiculo->exclusivo_para_conductor = $request->has('exclusivo_para_conductor');
        $vehiculo->save();

        return redirect()->back()->with('message', 'Conductor asignado correctamente al vehículo ' . $vehiculo->placa);
    }

    public function quitarConductorVehiculo(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:parqueadero,id'
        ]);

        $vehiculo = Parqueadero::findOrFail($request->vehiculo_id);
        $vehiculo->cedula = null;
        $vehiculo->nombre = null;
        $vehiculo->asignacion_tipo = null;
        $vehiculo->asignacion_inicio = null;
        $vehiculo->asignacion_fin = null;
        $vehiculo->visible_para_otros = true;
        $vehiculo->exclusivo_para_conductor = false;
        $vehiculo->save();

        return redirect()->back()->with('message', 'Conductor removido correctamente del vehículo ' . $vehiculo->placa);
    }

    public function toggleVisibilidadVehiculo(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:parqueadero,id'
        ]);

        $vehiculo = Parqueadero::findOrFail($request->vehiculo_id);
        $vehiculo->oculto_para_conductores = !$vehiculo->oculto_para_conductores;
        $vehiculo->save();

        $estado = $vehiculo->oculto_para_conductores ? 'ocultado a' : 'visible para';
        return redirect()->back()->with('message', 'Vehículo ' . $vehiculo->placa . ' ahora está ' . $estado . ' los conductores.');
    }

    /**
     * AJAX: Buscar conductor por cédula (accesible para coordinador).
     */
    public function buscarConductorAjax($cedula)
    {
        $cedulaClean = strtoupper(str_replace([' ', '-', '.'], '', trim($cedula)));

        // 1. Buscar en tabla conductores
        $conductor = Conductor::where('cedula', $cedulaClean)->first();
        if ($conductor) {
            return response()->json([
                'success' => true,
                'conductor' => ['cedula' => $conductor->cedula],
                'nombre_completo' => strtoupper($conductor->nameE . ' ' . $conductor->lastnameE)
            ]);
        }

        // 2. Buscar en users (rol 27 = conductor)
        $user = User::where('cedula', $cedulaClean)->where('rol', 27)->first();
        if ($user) {
            Conductor::firstOrCreate(
                ['cedula' => $user->cedula],
                ['nameE' => $user->name, 'lastnameE' => $user->lastname ?? '']
            );
            return response()->json([
                'success' => true,
                'conductor' => ['cedula' => $user->cedula],
                'nombre_completo' => strtoupper($user->name . ' ' . $user->lastname)
            ]);
        }

        // 3. Buscar en cualquier usuario (sin filtro de rol — para empleados con acceso al parqueadero)
        $userAny = User::where('cedula', $cedulaClean)->first();
        if ($userAny) {
            return response()->json([
                'success' => true,
                'conductor' => ['cedula' => $userAny->cedula],
                'nombre_completo' => strtoupper($userAny->name . ' ' . $userAny->lastname)
            ]);
        }

        // 4. Buscar en empleados
        $empleado = Empleado::where('cedulaE', $cedulaClean)->first();
        if ($empleado) {
            Conductor::firstOrCreate(
                ['cedula' => $empleado->cedulaE],
                ['nameE' => $empleado->nameE, 'lastnameE' => $empleado->lastnameE]
            );
            return response()->json([
                'success' => true,
                'conductor' => ['cedula' => $empleado->cedulaE],
                'nombre_completo' => strtoupper($empleado->nameE . ' ' . $empleado->lastnameE)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Persona no encontrada con cédula: ' . $cedulaClean . '. Verifique el número.'
        ]);
    }

      public function historial($placa)
    {
        $placaClean = strtoupper(str_replace([' ', '-', '.'], '', trim($placa)));
        
        $vehiculo = Parqueadero::where('estado', 'ACTIVO')
            ->where('calidad_vehiculo', 'OFICIAL')
            ->whereRaw("UPPER(REPLACE(REPLACE(placa,' ',''),'-','')) = ?", [$placaClean])
            ->first();

        if (!$vehiculo) {
            return redirect()->route('cooringreso.vehiculos_oficiales.index')->with('error', 'Vehículo oficial no encontrado.');
        }

        $inspecciones = Inspeccion::where('placa', $vehiculo->placa)
            ->orderBy('fecha', 'DESC')
            ->orderBy('hora', 'DESC')
            ->get();

        return view('monitoreo.coordinador.vehiculos_oficiales.historial', compact('vehiculo', 'inspecciones'));
    }
    
    /**
     * Ver detalles completos de una inspección preoperativa.
     */
    public function verInspeccion($id)
    {
        $inspeccion = Inspeccion::with(['detalles', 'conductor'])->findOrFail($id);
        
        // Obtener datos del vehículo oficial
        $vehiculo = Parqueadero::where('placa', $inspeccion->placa)->where('estado', 'ACTIVO')->first();

        // Agrupar los detalles para mostrarlos organizados en la vista
        $detallesAgrupados = $inspeccion->detalles->groupBy('grupo');

        return view('monitoreo.coordinador.ver_inspeccion', compact('inspeccion', 'vehiculo', 'detallesAgrupados'));
    }

    /**
     * Exportar inspección a PDF
     */
    public function exportarPdf($id)
    {
        $inspeccion = Inspeccion::with(['detalles', 'conductor'])->findOrFail($id);
        
        $vehiculo = Parqueadero::where('placa', $inspeccion->placa)->where('estado', 'ACTIVO')->first();
        $detallesAgrupados = $inspeccion->detalles->groupBy('grupo');

        if ($inspeccion->tipo_vehiculo === 'MOTOCICLETA') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('monitoreo.conductores.pdf_moto', compact('inspeccion', 'vehiculo', 'detallesAgrupados'))
                       ->setPaper('legal', 'portrait')
                       ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            return $pdf->download('inspeccion_moto_'.$inspeccion->placa.'.pdf');
        } else {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('monitoreo.conductores.pdf_carro', compact('inspeccion', 'vehiculo', 'detallesAgrupados'))
                       ->setPaper('legal', 'portrait')
                       ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            return $pdf->download('inspeccion_carro_'.$inspeccion->placa.'.pdf');
        }
    }
    
}
