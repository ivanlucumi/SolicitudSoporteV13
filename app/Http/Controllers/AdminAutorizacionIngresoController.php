<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutorizacionIngreso;
use Illuminate\Support\Facades\Mail;
use App\Mail\RespuestaIngresoMail;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminAutorizacionIngresoController extends Controller
{
    /**
     * Muestra el listado de solicitudes para el rol Almacén
     */
    public function index()
    {
        $user = auth()->user();
        
        // Filtrar por circuito si el rol es Almacén
        $query = AutorizacionIngreso::query();
        $rolName = strtolower(trim($user->rol ?? ''));
        if ($rolName === 'almacen' && !empty($user->circuito)) {
            $query->where('circuito', $user->circuito);
        }
        
        $solicitudes = $query->orderBy('created_at', 'desc')->get();
        return view('administrador.solicitudIngreso.index', compact('solicitudes'));
    }

    /**
     * Responde a una solicitud (Autoriza o Deniega)
     */
    public function responder(Request $request, $id)
    {
        $request->validate([
            'estado'                => 'required|in:Autorizada,Denegada',
            'fecha_ingreso'         => 'required_if:estado,Autorizada|nullable|date',
            'hora_ingreso'          => 'required_if:estado,Autorizada|nullable|date_format:H:i',
            'observaciones_almacen' => 'nullable|string|max:1000',
        ]);

        $solicitud = AutorizacionIngreso::findOrFail($id);

        if ($solicitud->estado != 'Pendiente') {
            return redirect()->back()->with('warning', 'Esta solicitud ya fue gestionada y no puede modificarse.');
        }

        $solicitud->estado                = $request->estado;
        $solicitud->observaciones_almacen = $request->observaciones_almacen;

        if ($request->estado === 'Autorizada') {
            $solicitud->fecha_ingreso = $request->fecha_ingreso;
            $solicitud->hora_ingreso  = $request->hora_ingreso;
        } else {
            $solicitud->fecha_ingreso = null;
            $solicitud->hora_ingreso  = null;
        }

        $solicitud->save();

        // ── Obtener correos destino (Titular y Usuario que registró si existe)
        $correosDestino = [];
        if ($solicitud->correo_titular) {
            $correosDestino[] = $solicitud->correo_titular;
        }

        if ($solicitud->correo_usuario) {
            $correosDestino[] = $solicitud->correo_usuario;
        }

        $correosDestino = array_unique($correosDestino);

        if (!empty($correosDestino)) {
            try {
                Mail::to($correosDestino)->send(new RespuestaIngresoMail($solicitud));
            } catch (\Exception $e) {
                // Si falla el correo, igual se guarda el estado pero se avisa
                return redirect()->back()->with('warning', 'Solicitud actualizada, pero hubo un error enviando el correo: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Solicitud ' . strtolower($request->estado) . ' correctamente y notificada por correo.');
    }

    /**
     * Permite descargar el PDF en caso de que quieran verlo directamente en el sistema
     */
    public function descargarPdf($seguimiento)
    {
        $solicitud = AutorizacionIngreso::where('numero_seguimiento', $seguimiento)->firstOrFail();
        
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                  ->loadView('externo.SolicitudIngreso.pdf', compact('solicitud'));
        
        return $pdf->download('Autorizacion_Ingreso_' . $solicitud->numero_seguimiento . '.pdf');
    }
}
