<?php

namespace App\Http\Controllers\Monitoreo;

use App\Models\ReporteAscensor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;


use Telegram\Bot\Laravel\Facades\Telegram;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IncidentesExport;


class ReporteAscensorControllerController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('auth');
        //$this->middleware('checarsesion');
        //$this->middleware('fichas');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ascensores = ReporteAscensor::Ascensores();
        //dd($ascensores);
        return view('monitoreo.reporteascensor.index',compact('ascensores'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function reporte(Request $request)
    {
       
        $query = ReporteAscensor::query();
        
        // Aplicar filtros
        if ($request->filled('fecha_inicio')) {
            $query->where('fecha_reporte', '>=', $request->fecha_inicio);
        }
        
        if ($request->filled('fecha_fin')) {
            $query->where('fecha_reporte', '<=', $request->fecha_fin);
        }
        
        if ($request->filled('sede')) {
            $query->where('sede', $request->sede);
        }
        
        if ($request->filled('tipo_incidente')) {
            $query->where('tipo_incidente', $request->tipo_incidente);
        }
        
        $incidentes = $query->orderBy('fecha_reporte', 'desc')
                           ->orderBy('hora_reporte', 'desc')
                           ->paginate(25);
        
        //$sedes = ReporteAscensor::distinct('sede')->pluck('sede');
        $tiposIncidente = ReporteAscensor::distinct('tipo_incidente')->pluck('tipo_incidente');
        
        
        return view('monitoreo.reporteascensor.Listado', compact('incidentes', 'tiposIncidente'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function DescargarReporte(Request $request)
    {
         $fechaInicio = $request->input('fecha_inicio', now()->subMonth()->format('Y-m-d'));
        $fechaFin = $request->input('fecha_fin', now()->format('Y-m-d'));
        
        return Excel::download(new IncidentesExport(
            $request->fecha_inicio,
            $request->fecha_fin,
            $request->sede,
            $request->tipo_incidente
        ), 'reporte_incidentes_'.now()->format('YmdHis').'.xlsx');
    }

    public function store(Request $request)
    {
        //dd( $request->all());
        
        DB::beginTransaction();

        $this->validate($request, [
            'fecha_reporte' => 'required|date',
            'hora_reporte' => 'required|date_format:H:i',
            'hora_incidente' => 'required|date_format:H:i',
            //'sede' => 'required|string|max:100',
            'ascensor' => 'required|string|max:100',
            'tipo_incidente' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'codigoAsignado' => 'nullable|string|max:50',
            'nombre_reportante' => 'required|string|max:100',
            'operador' => 'nullable|string|max:100',
        ]);
        // Validar los datos de entrada
        if($request->input('tipo_incidente') == 'Otro'){
            $this->validate($request, [
               'otro_tipo_incidente' => 'required|string|max:30',
            ]);

            $tipo_incidente = $request->input('otro_tipo_incidente');
        }else{
            $tipo_incidente = $request->input('tipo_incidente');
        }

        try {
            // Crear un nuevo reporte de ascensor
            $reporte = new ReporteAscensor();
            $reporte->fecha_reporte = $request->input('fecha_reporte');
            $reporte->hora_reporte = $request->input('hora_reporte');
            $reporte->sede = $request->input('sede');
            $reporte->ascensor = $request->input('ascensor');
            $reporte->tipo_incidente = $tipo_incidente;
            $reporte->descripcion = $request->input('descripcion');
            $reporte->hora_incidente = $request->input('hora_incidente');
            $reporte->codigoAsignado = $request->input('codigoAsignado');
            $reporte->nombre_reportante = $request->input('nombre_reportante');
            $reporte->operador = $request->input('operador');
            $reporte->save();
        
            DB::commit();

            $data              =  json_decode(json_encode($reporte), true);
            
            //$correoNotificacion1='gmstdesajvalle3@cendoj.ramajudicial.gov.co';

            $correoNotificacion1='aadisajcali@cendoj.ramajudicial.gov.co';
            $correoNotificacion2='ecantec@cendoj.ramajudicial.gov.co';
            $correoNotificacion3='caadesajvalle@Cendoj.ramajudicial.gov.co';
            $correoNotificacion4='carlos.hernandez@otis.com';
            $asunto="Reporte de Incidente en Ascensor ".$reporte->ascensor;
            Mail::send('emails/ascensor/correo', $data, function ($mail) use ($correoNotificacion1,$correoNotificacion2,$correoNotificacion3,$correoNotificacion4,$asunto) {
                    $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
                    $mail->to($correoNotificacion1);
                    $mail->to($correoNotificacion2);
                    $mail->to($correoNotificacion3);
                    $mail->to($correoNotificacion4);
                    $mail->subject($asunto);
                });

            
            // Redirigir a la vista de reporte con un mensaje de éxito
            return redirect()->route('monitoreo.index.ascensor')->with('success', 'Reporte de ascensor creado exitosamente.');
            
          }catch (\Exception $e) {
              DB::rollback();
              return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
          } catch (\Throwable $e) {
              DB::rollback();
              return back()->with('success', "Se presento un error, informe a soporte <br>".$e->getMessage())->withInput();
          }
 
        
        
    
        //
    }
    /**
     * Display the specified resource.
     */
    public function show(ReporteAscensorConttroller $reporteAscensorConttroller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReporteAscensorConttroller $reporteAscensorConttroller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReporteAscensorConttroller $reporteAscensorConttroller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReporteAscensorConttroller $reporteAscensorConttroller)
    {
        //
    }
}
