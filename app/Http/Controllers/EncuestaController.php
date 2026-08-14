<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuesta;
use App\Models\SolicitudCreacionUsuario;
use App\Models\EncuestaUsoAplicativo;

use App\Models\ReporteIncidente;
use App\Models\EncuestaMantenimiento;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Exports\EncuestaExport;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;

class EncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return view('externo.Encuesta.Index');
        return view('externo.Encuesta.Encuesta');
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
        // Validación de datos para garantizar que los campos requeridos estén completos y con el formato correcto
        $validatedData = $request->validate([
            
            'q1' => 'string|max:255',
            'observaciones_soportecorreoelectronico' => 'nullable|string|max:500',
            'q2' => 'string|max:255',
            'observaciones_paginaramajudicial' => 'nullable|string|max:500',
            'q3' => 'string|max:255',
            'observaciones_justiciaxxi' => 'nullable|string|max:500',
            'q4' => 'string|max:255',
            'observaciones_tybajusticiaxxi' => 'nullable|string|max:500',
            'q5' => 'string|max:255',
            'observaciones_conectividadeinternet' => 'nullable|string|max:500',
            'q6' => 'string|max:255',
            'observaciones_firmaelectronica' => 'nullable|string|max:500',
            'q7' => 'string|max:255',
            'observaciones_siugj_sgde' => 'nullable|string|max:500',
            'q8' => 'string|max:255',
            'observaciones_mesadeayuda' => 'nullable|string|max:500',
            'q9' => 'string|max:255',
            'observaciones_salaaudiencia' => 'nullable|string|max:500',
            //'q10' => 'string|max:255',
            //'observaciones_soporteaudienciasvirtuales' => 'nullable|string|max:500',
            'q10' => 'string|max:255',
            'observaciones_usuariodominio' => 'nullable|string|max:500',
            
            /*'q12' => 'string|max:255',
            'observaciones_bestdoc' => 'nullable|string|max:500',*/
            
            'q12' => 'string|max:255',
            'observaciones_siugj' => 'nullable|string|max:500',
        ]);
        
        DB::beginTransaction();
         try{ 

       $encuesta = new Encuesta();

        // Asignar los valores a cada atributo
        /*$encuesta->usuario =  auth()->user()->name;
        $encuesta->correo_usuario =  auth()->user()->email;
        $encuesta->despacho = $request->despacho;*/
        $encuesta->email = $request->q1;
        $encuesta->observaciones_email = $request->observaciones_soportecorreoelectronico;
        
        $encuesta->pagina_rama_judicial = $request->q2;
        $encuesta->observaciones_paginaramajudicial = $request->observaciones_paginaramajudicial;
        
        $encuesta->justiciaxxi = $request->q3;
        $encuesta->observaciones_justiciaxxi = $request->observaciones_justiciaxxi;
        
        $encuesta->tybajusticiaxxi = $request->q4;
        $encuesta->observaciones_tybajusticiaxxi = $request->observaciones_tybajusticiaxxi;
        
        $encuesta->internet = $request->q5;
        $encuesta->observaciones_internet = $request->observaciones_conectividadeinternet;
        
        $encuesta->firmaelectronica = $request->q6;
        $encuesta->observaciones_firmaelectronica = $request->observaciones_firmaelectronica;
        
        $encuesta->siug_sgde = $request->q7;
        $encuesta->observaciones_siugj_sgde = $request->observaciones_sgde;
        
        $encuesta->mesadeayuda = $request->q8;
        $encuesta->observaciones_mesadeayuda = $request->observaciones_mesadeayuda;
        
        $encuesta->salaaudiencia = $request->q9;
        $encuesta->observaciones_salaaudiencia = $request->observaciones_salaaudiencia;
        
        $encuesta->usuariodominio = $request->q10;
        $encuesta->observaciones_usuariodominio = $request->observaciones_usuariodominio;
        
        //$encuesta->audienciasvirtuales = $request->q10;
        //$encuesta->observaciones_soporteaudienciasvirtuales = $request->observaciones_soporteaudienciasvirtuales;
        
         //$encuesta->siugj = $request->q12;
        //$encuesta->observaciones_siugj = $request->observaciones_siugj;
        
        
        if ( auth()->check()) {
          $encuesta->usuario =  auth()->user()->name;
          $encuesta->correo_usuario =  auth()->user()->email;  
        }
         

        // Guardar el registro en la base de datos
        $encuesta->save();
        
        //dd($encuesta->save());
        
        
        if ( auth()->check()) {
           // DD( auth()->user()->update(['encuesta' => 1]));
            // Marcar al usuario como que complet�� la encuesta
             auth()->user()->update(['encuesta' => 1]);
        }

        
        DB::commit();
            
        return back()->with('error', "�0�3�0�3Gracias por su tiempo y sus respuestas!! <br>");  
            
            
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
        
        

    }

   public function datosClasificados()
{
    $datos = DB::select("
       SELECT  
            categoria,
            SUM(CASE WHEN valor = 'Muy Satisfactoria' THEN 1 ELSE 0 END) AS muy_satisfactorio,
            SUM(CASE WHEN valor = 'Satisfactoria' THEN 1 ELSE 0 END) AS satisfactorio,
            SUM(CASE WHEN valor = 'Normal' THEN 1 ELSE 0 END) AS normal,
            SUM(CASE WHEN valor = 'Poco Satisfactoria' THEN 1 ELSE 0 END) AS poco_satisfactorio,
            SUM(CASE WHEN valor = 'No Satisfactoria' THEN 1 ELSE 0 END) AS no_satisfactorio,
            SUM(CASE WHEN valor = 'No Aplica' THEN 1 ELSE 0 END) AS no_aplica
        FROM (
            SELECT 'email' AS categoria, email AS valor, created_at FROM encuesta
            UNION ALL
            SELECT 'Pagina Rama Judicial' AS categoria, pagina_rama_judicial AS valor, created_at FROM encuesta
            UNION ALL
            SELECT 'Justicia XXI', justiciaxxi, created_at FROM encuesta
            UNION ALL
            SELECT 'Internet', internet, created_at FROM encuesta
            UNION ALL
            SELECT 'Usuario Dominio', usuariodominio, created_at FROM encuesta
            UNION ALL
            SELECT 'Firma Electronica', firmaelectronica, created_at FROM encuesta
            UNION ALL
            SELECT 'Mesa de Ayuda', mesadeayuda, created_at FROM encuesta
            UNION ALL
            SELECT 'Sala de Audiencia', salaaudiencia, created_at FROM encuesta
            UNION ALL
            SELECT 'Siugj y Sgde', siug_sgde, created_at FROM encuesta
            UNION ALL
            SELECT 'Tyba', 	tybajusticiaxxi, created_at FROM encuesta
        ) subconsulta
        WHERE  created_at >= '2026-01-13'
        GROUP BY categoria;
     ");
     
     //WHERE YEAR(created_at) = 2025

    return response()->json($datos);
}

   
    public function show(Encuesta $encuesta)
    {
        $resultados  = DB::select("
        SELECT  
            categoria,
            SUM(CASE WHEN valor = 'Muy Satisfactoria' THEN 1 ELSE 0 END) AS muy_satisfactorio,
            SUM(CASE WHEN valor = 'Satisfactoria' THEN 1 ELSE 0 END) AS satisfactorio,
            SUM(CASE WHEN valor = 'Normal' THEN 1 ELSE 0 END) AS normal,
            SUM(CASE WHEN valor = 'Poco Satisfactoria' THEN 1 ELSE 0 END) AS poco_satisfactorio,
            SUM(CASE WHEN valor = 'No Satisfactoria' THEN 1 ELSE 0 END) AS no_satisfactorio,
            SUM(CASE WHEN valor = 'No Aplica' THEN 1 ELSE 0 END) AS no_aplica
        FROM (
            SELECT 'email' AS categoria, email AS valor, created_at FROM encuesta
            UNION ALL
            SELECT 'Pagina Rama Judicial' AS categoria, pagina_rama_judicial AS valor, created_at FROM encuesta
            UNION ALL
            SELECT 'Justicia XXI', justiciaxxi, created_at FROM encuesta
            UNION ALL
            SELECT 'Internet', internet, created_at FROM encuesta
            UNION ALL
            SELECT 'Usuario Dominio', usuariodominio, created_at FROM encuesta
            UNION ALL
            SELECT 'Firma Electronica', firmaelectronica, created_at FROM encuesta
            UNION ALL
            SELECT 'Mesa de Ayuda', mesadeayuda, created_at FROM encuesta
            UNION ALL
            SELECT 'Sala de Audiencia', salaaudiencia, created_at FROM encuesta
            UNION ALL
            SELECT 'Siugj y Sgde', siug_sgde, created_at FROM encuesta
            UNION ALL
            SELECT 'Tyba', 	tybajusticiaxxi, created_at FROM encuesta
        ) subconsulta
        WHERE created_at >= '2026-01-13'
        GROUP BY categoria;

     ");
     
     return view('externo.Encuesta.ResultadoEncuesta',compact('resultados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function IndexEncuenta(Encuesta $encuesta)
    {
            return view('usuario.EncuestaAplicativo.EncuestaAplicativo');
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function saveEncuentas(Request $request)
    {
         DB::beginTransaction();
         try{ 
     
      //dd($request->all(),count($request->usuario));
       
         
         if(!empty($request->problemas)){
         $problemasSgde=implode(', ',$request->problemas);
         }else{
          $problemasSgde = null;   
         }
         
         if(!empty($request->aplicativo)){
         $aplicativos=implode(', ',$request->aplicativo);
         }else{
          $aplicativos = null;   
         }
         
         if(!empty($request->problemasiugj)){
         $siugnovedades=implode(', ',$request->problemasiugj);
         }else{
          $siugnovedades = null;   
         }
         $siugnovedades = preg_replace('/[^\x00-\x7F]/', '', $siugnovedades);
        
         //dd($ProblemasSiugj,$request->problemasiugj);
         
         
         //EncuestaUsoAplicativo
         $reporte = new EncuestaUsoAplicativo();
           $reporte->despacho_id =  auth()->user()->cedula;
           $reporte->despacho =  auth()->user()->name . " " .  auth()->user()->lastname;
           $reporte->email_despacho =  auth()->user()->email;
           $reporte->aplicativo = $aplicativos;
           $reporte->cantidadExpedientesSgde = $request->cantidadExpedientesSgde;
           $reporte->capacitacionsgde = $request->capacitacionsgde;
           $reporte->problemas_sgde = $problemasSgde;
           $reporte->otros_sgde = $request->problemasSGDE;
           $reporte->cantidadExpedientesSiugj = $request->cantidadExpedientesSiugj;
           $reporte->novedades_siugj = $siugnovedades;
           $reporte->otros_problemasiugj = $request->otros_problemasiugj;
           $reporte->cantidadExpedientesOneDrive = $request->cantidadExpedientesOneDrive;
           $reporte->cantidadExpedientesSharePoint = $request->cantidadExpedientesSharePoint;
           
           
           $reporte ->save();
         
         //dd($request->all(),count($request->usuario));
         
         
         if($request->hasUsers =="si"){
             
             foreach ($request->usuario as $appId => $users) {
                // dd($users,$appId);
                    
                        $solicitud = SolicitudCreacionUsuario::create([
                            'codigo_despacho' =>  auth()->user()->cedula,
                            'despacho' =>  auth()->user()->name . " " .  auth()->user()->lastname,
                            'email_despacho' =>  auth()->user()->email,
                            'id_encuesta' => $reporte->id ?? null, // Asegurar que tenga valor
                            'aplicativo'=>$request->usuario[$appId],
                            'cedula' => $request->userCedula[$appId],
                            'nombre' => $request->userName[$appId],
                            'correo' => $request->userEmail[$appId],
                            'usuario_dominio' => $request->userDomain[$appId],
                            'cargo' => $request->userCargo[$appId],
                        ]);
                    
                }
        }
        
        //dd($request->all(),implode(',',$request->problemas),count($request->usuario ),$request->userCargo[0]);
          
         DB::commit();
            
         Session::flash('success','Guardado con exito');
           return redirect()->back();    
            
            
        }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Encuesta $encuesta)
    {
        //
    }
    
    
    public function exportarEncuestaDetallada()
    {
        $fecha = now()->format('Ymd_His');
        return Excel::download(new EncuestaExport, "encuesta_detallada_{$fecha}.xlsx");
    }
    
    
    
    public function EncuestaMantenimiento(Request $request, $consecutivo)
    {
       $reporte = ReporteIncidente::where('consecutivo', $consecutivo)->firstOrFail();

        if (EncuestaMantenimiento::where('consecutivo', $consecutivo)->exists()) {
            return view('encuestas.ya_respondida');
        }
    
        return view('externo.Encuesta.EncuestaMantenimiento', compact('reporte'));
    }
    
    public function guardarEncuestaMantenimiento(Request $request, $consecutivo){
        
         $reporte = ReporteIncidente::where('consecutivo', $consecutivo)->firstOrFail();
    
        if (EncuestaMantenimiento::where('consecutivo', $reporte->id)->exists()) {

                return redirect()->back()
                    ->with('encuesta_respondida', 'La encuesta ya fue diligenciada anteriormente.');
            }
    
        $request->validate([
            'problema_solucionado' => 'required',
            'tiempo_respuesta' => 'required|integer|min:1|max:5',
            'atencion_personal' => 'required|integer|min:1|max:5',
            'calidad_tecnica' => 'required|integer|min:1|max:5',
            'satisfaccion_general' => 'required|integer|min:1|max:5'
        ]);
    
        EncuestaMantenimiento::create([
            'consecutivo' => $reporte->id,
            'problema_solucionado' => $request->problema_solucionado,
            'tiempo_respuesta' => $request->tiempo_respuesta,
            'atencion_personal' => $request->atencion_personal,
            'calidad_tecnica' => $request->calidad_tecnica,
            'satisfaccion_general' => $request->satisfaccion_general,
            'comentario' => $request->comentario
        ]);
    
        return Redirect::to('/');
    }
    
    public function ajaxEncuesta(Request $request,$consecutivo)
        {
            $encuesta = EncuestaMantenimiento::where('consecutivo', $consecutivo)->first();
        
            if(!$encuesta){
                return response()->json(['error' => 'No existe encuesta']);
            }
        
            return response()->json($encuesta);
        }
            
            public function estadisticasMantenimiento(Request $request)
        {
             $categorias = DB::table('reporte_incidente')
                ->select('categoria')
                ->distinct()
                ->get();
        
            $items = DB::table('reporte_incidente')
                ->select('item')
                ->distinct()
                ->get();
        
        
            return view('administrador.Encuesta.ver_encuesta_mantenimiento',
                compact('categorias','items'));
        }
    
    
    public function ajaxEstadisticas(Request $request)
    {
        $base = DB::table('reporte_incidente as ri')
            ->leftJoin('reporte_incidentes_encuestas as enc', 'ri.id', '=', 'enc.consecutivo');
            
            
    
        // ================= FILTROS =================
    
        if ($request->filled('fecha_inicio')) {
            $base->whereDate('ri.created_at', '>=', $request->fecha_inicio);
        }
    
        if ($request->filled('fecha_fin')) {
            $base->whereDate('ri.created_at', '<=', $request->fecha_fin);
        }
    
        if ($request->filled('categoria')) {
            $base->where('ri.categoria', $request->categoria);
        }
    
        if ($request->filled('item')) {
            $base->where('ri.item', $request->item);
        }
    
        if ($request->filled('estado')) {
            $base->where('ri.estado', $request->estado);
        }
    
        // ================= KPI GENERAL =================
    
        $kpi = (clone $base)->select(
            DB::raw('COUNT(DISTINCT ri.id) as total_casos'),
            DB::raw('SUM(CASE WHEN ri.estado = "REALIZADO" THEN 1 ELSE 0 END) as casos_realizados'),
            DB::raw('SUM(CASE WHEN ri.estado != "REALIZADO" THEN 1 ELSE 0 END) as casos_pendientes'),
            DB::raw('COUNT(enc.id) as total_encuestas'),
            DB::raw('ROUND(AVG(enc.satisfaccion_general),2) as promedio_general'),
            DB::raw('ROUND(AVG(enc.tiempo_respuesta),2) as promedio_tiempo'),
            DB::raw('ROUND(AVG(enc.atencion_personal),2) as promedio_atencion'),
            DB::raw('ROUND(AVG(enc.calidad_tecnica),2) as promedio_calidad')
        )->first();
        
        //dd($kpi);
    
        // ================= CATEGOR�0�1AS =================
    
        $categorias = (clone $base)
            ->select(
                'ri.categoria',
                DB::raw('COUNT(DISTINCT ri.id) as total_casos'),
                DB::raw('COUNT(enc.id) as total_encuestas'),
                DB::raw('ROUND(AVG(enc.satisfaccion_general),2) as promedio')
            )
            ->groupBy('ri.categoria')
            ->orderByDesc('total_casos')
            ->get();
    
        // ================= ITEMS =================
    
        $items = (clone $base)
            ->select(
                'ri.categoria',
                'ri.item',
                DB::raw('COUNT(DISTINCT ri.id) as total_casos'),
                DB::raw('COUNT(enc.id) as total_encuestas'),
                DB::raw('ROUND(AVG(enc.satisfaccion_general),2) as promedio'),
                DB::raw('ROUND(AVG(enc.satisfaccion_general),2) as promedio_general'),
                DB::raw('ROUND(AVG(enc.tiempo_respuesta),2) as promedio_tiempo'),
                DB::raw('ROUND(AVG(enc.atencion_personal),2) as promedio_atencion'),
                DB::raw('ROUND(AVG(enc.calidad_tecnica),2) as promedio_calidad')
            )
            ->groupBy('ri.categoria','ri.item')
            ->orderByDesc('total_casos')
            ->get();
    
        return response()->json([
            'kpi'        => $kpi,
            'categorias' => $categorias,
            'items'      => $items
        ]);
    }
    
   /* public function ajaxEstadisticas(Request $request)
    {
        $base = DB::table('reporte_incidentes_encuestas as enc')
            ->join('reporte_incidente as ri', 'ri.id', '=', 'enc.consecutivo');
    
        // ===============================
        // FILTROS (desde encuesta)
        // ===============================
    
        if ($request->filled('fecha_inicio')) {
            $base->whereDate('enc.created_at', '>=', $request->fecha_inicio);
        }
    
        if ($request->filled('fecha_fin')) {
            $base->whereDate('enc.created_at', '<=', $request->fecha_fin);
        }
    
        if ($request->filled('categoria')) {
            $base->where('ri.categoria', $request->categoria);
        }
    
        if ($request->filled('item')) {
            $base->where('ri.item', $request->item);
        }
    
        if ($request->filled('estado')) {
            $base->where('ri.estado', $request->estado);
        }
    
        // ===============================
        // KPI GENERAL (solo encuestas)
        // ===============================
    
        $kpi = (clone $base)->select(
            DB::raw('COUNT(DISTINCT enc.id) as total_encuestas'),
            DB::raw('COUNT(DISTINCT ri.id) as total_casos'),
            DB::raw('ROUND(AVG(enc.satisfaccion_general),2) as promedio_general'),
            DB::raw('ROUND(AVG(enc.tiempo_respuesta),2) as promedio_tiempo'),
            DB::raw('ROUND(AVG(enc.atencion_personal),2) as promedio_atencion'),
            DB::raw('ROUND(AVG(enc.calidad_tecnica),2) as promedio_calidad')
        )->first();
    
        // ===============================
        // AGRUPADO POR CATEGORIA
        // ===============================
    
        $categorias = (clone $base)
            ->select(
                'ri.categoria',
                DB::raw('COUNT(enc.id) as total_encuestas'),
                DB::raw('COUNT(DISTINCT ri.id) as total_casos'),
                DB::raw('ROUND(AVG(enc.satisfaccion_general),2) as promedio')
            )
            ->groupBy('ri.categoria')
            ->orderByDesc('promedio')
            ->get();
    
        // ===============================
        // AGRUPADO POR ITEM
        // ===============================
    
        $items = (clone $base)
            ->select(
                'ri.categoria',
                'ri.item',
                DB::raw('COUNT(enc.id) as total_encuestas'),
                DB::raw('COUNT(DISTINCT ri.id) as total_casos'),
                DB::raw('ROUND(AVG(enc.satisfaccion_general),2) as promedio')
            )
            ->groupBy('ri.categoria','ri.item')
            ->orderByDesc('promedio')
            ->get();
    
        return response()->json([
            'kpi'        => $kpi,
            'categorias' => $categorias,
            'items'      => $items
        ]);
    }*/
    
    
    
    
    
    
    
}
