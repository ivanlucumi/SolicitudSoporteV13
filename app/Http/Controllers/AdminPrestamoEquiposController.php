<?php

namespace App\Http\Controllers;

use App\Models\SolicitudPrestamoEquipo;
use Illuminate\Http\Request;

class AdminPrestamoEquiposController extends Controller
{
    /**
     * Lista TODAS las solicitudes para el administrador.
     */
    public function index()
    {
        $solicitudes = SolicitudPrestamoEquipo::orderBy('created_at', 'desc')->get();
        return view('administrador.prestamoEquipos.index', compact('solicitudes'));
    }

    /**
     * Actualiza el estado de la solicitud (ruta administrador).
     */
    public function actualizarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required',
        ]);

        $solicitud = SolicitudPrestamoEquipo::findOrFail($id);
        $solicitud->estado = $request->estado;
        if ($request->has('observaciones_almacen')) {
            $solicitud->observaciones_almacen = $request->observaciones_almacen;
        }
        $solicitud->save();

        return redirect()->back()->with('success', 'El estado de la solicitud se ha actualizado correctamente.');
    }

    // =========================================================
    // MÓDULO ALMACÉN
    // =========================================================

    /**
     * Lista solicitudes que ya tienen PDF firmado cargado (listas para autorizar).
     * Almacén solo ve las que están en 'En espera de autorizacion de almacen'.
     */
    public function indexAlmacen()
    {
        $circuitoAlmacen = auth()->user()->circuito;

        // Solicitudes activas QUE YA TIENEN el PDF firmado adjunto
        $pendientes = SolicitudPrestamoEquipo::whereNotIn('estado', ['Retirado', 'Rechazado'])
            ->whereNotNull('ruta_pdf_firmado')
            ->when($circuitoAlmacen, function ($query, $circuito) {
                return $query->where('circuito', $circuito);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Historial: las ya gestionadas (Retirado o Rechazado)
        $historial = SolicitudPrestamoEquipo::whereIn('estado', ['Retirado', 'Rechazado'])
            ->when($circuitoAlmacen, function ($query, $circuito) {
                return $query->where('circuito', $circuito);
            })
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('administrador.prestamoEquipos.almacen', compact('pendientes', 'historial'));
    }

    /**
     * Gestiona la solicitud desde almacén: cambia estado y guarda observaciones.
     * Estado puede ser: cualquier estado válido del workflow.
     */
    public function gestionarSolicitud(Request $request, $id)
    {
        $request->validate([
            'estado'                => 'required|in:Pendiente Carga PDF,En espera de autorizacion de almacen,Retirado,Rechazado',
            'observaciones_almacen' => 'nullable|string|max:1000',
        ]);

        $solicitud = SolicitudPrestamoEquipo::findOrFail($id);

        // Impedir modificar si ya fue procesada como Retirado o Rechazado — solo desde el modal Gestionar
        // que puede reabrir el estado. Solo bloqueamos re-gestión si ya está cerrada y
        // viene del modal rápido (Autorizar / Rechazar) con estado Retirado o Rechazado.
        // El modal Gestionar envía cualquier estado, así que no bloqueamos.

        $estadoNuevo = $request->estado;

        // Si viene del modal rápido de autorizar y ya estaba cerrada, alertar
        if (in_array($solicitud->estado, ['Retirado', 'Rechazado'])
            && !in_array($estadoNuevo, ['Pendiente Carga PDF', 'En espera de autorizacion de almacen'])
        ) {
            return redirect()->back()->with('error', 'Esta solicitud ya fue procesada. Use "Gestionar" para cambiar el estado.');
        }

        $solicitud->estado               = $estadoNuevo;
        $solicitud->observaciones_almacen = $request->observaciones_almacen ?? null;
        $solicitud->save();

        $mensajes = [
            'Retirado'                          => 'Solicitud marcada como equipo retirado correctamente.',
            'Rechazado'                         => 'Solicitud rechazada/cancelada correctamente.',
            'Pendiente Carga PDF'               => 'Estado actualizado a: Pendiente Carga PDF.',
            'En espera de autorizacion de almacen' => 'Estado actualizado a: En espera de autorización.',
        ];

        return redirect()->back()->with('success', $mensajes[$estadoNuevo] ?? 'Estado actualizado correctamente.');
    }

    /**
     * Muestra/descarga el PDF firmado para que almacén lo revise.
     */
    public function verPdf($id)
    {
        $solicitud = SolicitudPrestamoEquipo::findOrFail($id);

        if (!$solicitud->archivo_pdf) {
            return redirect()->back()->with('error', 'Esta solicitud no tiene un PDF firmado cargado.');
        }

        // Intentar con Storage facade (más confiable)
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($solicitud->archivo_pdf)) {
            $path = \Illuminate\Support\Facades\Storage::disk('public')->path($solicitud->archivo_pdf);
            return response()->download($path, 'Solicitud_' . str_pad($solicitud->id, 4, '0', STR_PAD_LEFT) . '_firmada.pdf', [
                'Content-Type' => 'application/pdf',
            ]);
        }

        // Fallback: redirigir a la URL pública del storage
        $url = \Illuminate\Support\Facades\Storage::disk('public')->url($solicitud->archivo_pdf);
        return redirect($url);
    }

    /**
     * Descarga un Excel con todos los equipos solicitados y su respectivo estado de entrega.
     */
    public function descargarExcel()
    {
        $circuitoAlmacen = auth()->user()->circuito;
        return (new \App\Exports\PrestamoEquiposExport($circuitoAlmacen))->download('Equipos_Solicitados.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    /**
     * Marca un elemento específico de un empleado como entregado o pendiente.
     */
    public function marcarElementoEntregado(Request $request, $id)
    {
        $request->validate([
            'emp_index' => 'required|integer',
            'el_index'  => 'required|integer',
            'entregado' => 'required|boolean',
        ]);

        $solicitud = SolicitudPrestamoEquipo::findOrFail($id);
        $empIndex = $request->input('emp_index');
        $elIndex = $request->input('el_index');
        $entregado = (bool)$request->input('entregado');

        $equipos = $solicitud->equipos;
        if (isset($equipos[$empIndex]['elementos'][$elIndex])) {
            $equipos[$empIndex]['elementos'][$elIndex]['entregado'] = $entregado;
            $solicitud->equipos = $equipos;
            $solicitud->save();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Estado de entrega del elemento actualizado.'
                ]);
            }

            return redirect()->back()->with('success', 'Estado del elemento actualizado.');
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Elemento no encontrado.'
            ], 404);
        }

        return redirect()->back()->with('error', 'Elemento no encontrado.');
    }
}

