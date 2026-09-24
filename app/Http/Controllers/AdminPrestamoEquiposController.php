<?php

namespace App\Http\Controllers;

use App\Models\SolicitudPrestamoEquipo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

        // TODAS las solicitudes activas (no cerradas) — incluye las que aún no tienen PDF firmado
        $pendientes = SolicitudPrestamoEquipo::whereNotIn('estado', ['Retirado', 'Rechazado','Rechazado / Cancelado','Cancelado'])
            ->whereNotNull('archivo_pdf')
            ->when($circuitoAlmacen, function ($query, $circuito) {
                return $query->where('circuito', $circuito);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Historial: las ya gestionadas (Retirado o Rechazado)
        $historial = SolicitudPrestamoEquipo::whereIn('estado', ['Retirado', 'Rechazado','Cancelado'])
            ->when($circuitoAlmacen, function ($query, $circuito) {
                return $query->where('circuito', $circuito);
            })
            ->orderBy('updated_at', 'asc')
            ->get();

        return view('administrador.prestamoEquipos.almacen', compact('pendientes', 'historial'));
    }

    /**
     * Muestra el formulario para crear un acta desde el módulo de Almacén.
     */
    public function createAlmacen()
    {
        // Se envían todos los despachos activos para que Almacén seleccione a cuál asignarle el equipo
        $despachos = \App\Models\Despacho::whereRaw("(estado IS NULL OR LOWER(TRIM(estado)) != 'Inactivo')")
                        ->orderBy('nombreDespacho', 'asc')
                        ->get();
        return view('administrador.prestamoEquipos.create_almacen', compact('despachos'));
    }

    /**
     * Guarda el acta generada desde Almacén.
     */
    public function storeAlmacen(Request $request)
    {
        $request->validate([
            'codigo_despacho'    => 'required',
            'cedula_juez'        => 'required',
            'nombre_juez'        => 'required',
            'cargo_titular'      => 'required|string|max:255',
            'correo_titular'     => 'required|email|max:255',
            'fecha_acta'         => 'required|date',
            'edificio'           => 'required|string|max:255',
            'piso'               => 'required|string|max:255',
            'empleados'          => 'required|array|min:1',
            'empleados.*.cedula' => 'required',
            'empleados.*.nombre' => 'required',
            'empleados.*.cargo'  => 'required',
            'empleados.*.lugar'  => 'required',
        ]);

        $despachoInfo = \App\Models\Despacho::where('codigoDespacho', $request->codigo_despacho)->first();
        if (!$despachoInfo) {
            return redirect()->back()->withErrors("El despacho seleccionado no es válido.")->withInput();
        }

        // Validar que el Juez Titular exista
        $juezVal = \App\Models\Empleado::where('cedulaE', $request->cedula_juez)->first();
        if (!$juezVal) {
            return redirect()->back()
                ->withErrors("El Servidor Titular con cédula '{$request->cedula_juez}' no existe en la base de datos de empleados.")
                ->withInput();
        }

        $nombreJuezReal = trim($juezVal->nameE . ' ' . $juezVal->lastnameE);
        $cargoJuezReal  = $juezVal->cargo_titular;

        // Validar que la misma persona no reciba el mismo tipo de elemento dos veces
        $erroresPersona = [];
        foreach ($request->empleados as $emp) {
            $cedula   = $emp['cedula'] ?? '';
            $tipos    = [];
            foreach ($emp['elementos'] ?? [] as $el) {
                $tipo = trim($el['elemento'] ?? '');
                if ($tipo) {
                    if (in_array($tipo, $tipos)) {
                        $erroresPersona[] = "El empleado CC {$cedula} tiene el elemento '{$tipo}' registrado más de una vez.";
                    }
                    $tipos[] = $tipo;
                }
            }
        }
        if (!empty($erroresPersona)) {
            return redirect()->back()->withErrors($erroresPersona)->withInput();
        }

        $placasIngresadas = [];
        $empleadosFormateados = [];

        foreach ($request->empleados as $index => $emp) {
            $cedula = trim($emp['cedula'] ?? '');
            
            $empVal = \App\Models\Empleado::where('cedulaE', $cedula)->first();
            if (!$empVal) {
                return redirect()->back()
                    ->withErrors("El empleado de la fila " . ($index + 1) . " con cédula '{$cedula}' no existe en la base de datos de empleados.")
                    ->withInput();
            }

            $nombreReal = trim($empVal->nameE . ' ' . $empVal->lastnameE);
            $cargoReal  = $empVal->cargo_titular ?? '';

            $elementos = [];
            foreach ($emp['elementos'] ?? [] as $el) {
                $placa = trim($el['placa'] ?? '');
                if ($placa) $placasIngresadas[] = $placa;
                $elementos[] = [
                    'elemento' => $el['elemento'] ?? '',
                    'placa'    => $placa,
                    'serial'   => $el['serial']   ?? '',
                    'marca'    => $el['marca']    ?? '',
                    'estado'   => $el['estado']   ?? 'Bueno',
                ];
            }
            $empleadosFormateados[] = [
                'cedula'   => $cedula,
                'nombre'   => $nombreReal,
                'cargo'    => $cargoReal,
                'lugar'    => $emp['lugar']    ?? '',
                'elementos'=> $elementos,
            ];
        }

        if (!empty($placasIngresadas) || true) {
            $activas = SolicitudPrestamoEquipo::where('estado', '!=', 'Rechazado')->get();
            $elementosActivosPorEmpleado = [];
            
            foreach ($activas as $sol) {
                foreach ((array)$sol->equipos as $empExistente) {
                    $ced = $empExistente['cedula'] ?? '';
                    if ($ced) {
                        foreach ((array)($empExistente['elementos'] ?? []) as $elEx) {
                            // 1. Recopilar elementos para validación cruzada
                            $tipoEx = trim($elEx['elemento'] ?? '');
                            if ($tipoEx) {
                                $elementosActivosPorEmpleado[$ced][] = $tipoEx;
                            }
                        }
                    }
                }
            }
            
            // Validar que el empleado no esté pidiendo un elemento que ya tiene activo
            foreach ($request->empleados as $emp) {
                $cedula = trim($emp['cedula'] ?? '');
                if ($cedula) {
                    foreach ($emp['elementos'] ?? [] as $el) {
                        $tipo = trim($el['elemento'] ?? '');
                        if ($tipo && isset($elementosActivosPorEmpleado[$cedula]) && in_array($tipo, $elementosActivosPorEmpleado[$cedula])) {
                            return redirect()->back()
                                ->withErrors("El servidor con cédula {$cedula} ya tiene una solicitud o préstamo activo para el elemento '{$tipo}'. Puede solicitar otros elementos, pero no el mismo.")
                                ->withInput();
                        }
                    }
                }
            }
        }

        $despachoInfo->edificio = $request->edificio;
        $despachoInfo->piso = $request->piso;
        $despachoInfo->save();

        $solicitud = new SolicitudPrestamoEquipo();
        $solicitud->cedula_solicitante = $despachoInfo->codigoDespacho;
        $solicitud->nombre_solicitante = $despachoInfo->nombreDespacho;
        $solicitud->cedula_juez        = $request->cedula_juez;
        $solicitud->nombre_juez        = $nombreJuezReal;
        $solicitud->cargo_titular      = $cargoJuezReal;
        $solicitud->correo_titular     = $request->correo_titular;
        $solicitud->lugar_funciones    = null; 
        $solicitud->creado_por         = auth()->user()->id; // Nueva columna
        $solicitud->fecha_acta         = $request->fecha_acta;
        $solicitud->codigo_despacho    = $despachoInfo->codigoDespacho;
        $solicitud->despacho           = $despachoInfo->nombreDespacho;
        $solicitud->circuito           = $despachoInfo->circuito;
        $solicitud->equipos            = $empleadosFormateados;
        $solicitud->estado             = 'Pendiente Carga PDF';
        $solicitud->save();

        $solicitud->save();

        return redirect()->route('almacen.prestamo.equipos.creaciones')
            ->with('descargar_pdf', $solicitud->id)
            ->with('success', 'Acta generada con éxito. Se está descargando el PDF, por favor imprímalo, hágalo firmar y súbalo a continuación.');
    }

    /**
     * Genera y descarga el PDF del Acta de Entrega Temporal (sin firma) para Almacén.
     */
    public function descargarPdfAlmacen($id)
    {
        $solicitud = SolicitudPrestamoEquipo::findOrFail($id);

        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true
        ])->loadView('externo.PrestamoEquipos.pdf', compact('solicitud'));
        
        $pdf->setPaper('letter', 'portrait');

        return $pdf->download('Acta_Entrega_' . str_pad($solicitud->id, 4, '0', STR_PAD_LEFT) . '.pdf');
    }

    /**
     * Muestra las actas creadas por almacén que aún no tienen PDF cargado
     */
    public function creacionesPendientes(Request $request)
    {
        $pendientes = SolicitudPrestamoEquipo::where('creado_por', auth()->user()->id)
            ->where(function($q) {
                $q->whereNull('archivo_pdf')
                  ->orWhere('archivo_pdf', '')
                  ->orWhere('estado', 'Pendiente Carga PDF');
            })
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('administrador.prestamoEquipos.creaciones', compact('pendientes'));
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

    public function subirPdfAlmacen(Request $request, $id)
    {
        $request->validate([
            'archivo_pdf' => 'required|mimes:pdf|max:10240', // max 10MB
        ]);

        $solicitud = SolicitudPrestamoEquipo::findOrFail($id);

        if ($request->hasFile('archivo_pdf')) {
            $archivo = $request->file('archivo_pdf');
            $nombreArchivo = 'acta_' . $solicitud->id . '_' . time() . '.pdf';
            $ruta = $archivo->storeAs('prestamo_equipos/actas_firmadas', $nombreArchivo, 'public');

            $solicitud->archivo_pdf = $ruta;
            
            // Si estaba pendiente de carga de PDF, avanza de estado
            if (in_array($solicitud->estado, ['Pendiente Carga PDF', ''])) {
                $solicitud->estado = 'En espera de autorizacion de almacen';
            }
            
            $solicitud->save();

            return redirect()->back()->with('success', 'PDF firmado subido correctamente.');
        }

        return redirect()->back()->with('error', 'No se ha podido subir el archivo.');
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

