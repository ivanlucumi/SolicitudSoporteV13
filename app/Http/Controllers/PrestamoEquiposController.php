<?php

namespace App\Http\Controllers;

use App\Models\SolicitudPrestamoEquipo;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PrestamoEquiposController extends Controller
{
    /**
     * Muestra las solicitudes del despacho del usuario logueado.
     */
    public function index()
    {
        $usuario   = auth()->user();
        
        $rol = strtolower(trim($usuario->rol ?? ''));
        if (in_array($rol, ['almacen', 'administrador', 'admin'])) {
            $solicitudes = SolicitudPrestamoEquipo::orderBy('created_at', 'desc')->get();
        } else {
            $solicitudes = SolicitudPrestamoEquipo::where('codigo_despacho', $usuario->cedula)
                            ->orWhere('despacho', $usuario->name)
                            ->orderBy('created_at', 'desc')->get();
        }

        return view('externo.PrestamoEquipos.index', compact('solicitudes'));
    }

    /**
     * Muestra el formulario para crear un acta de entrega temporal.
     */
    public function create()
    {
        $usuario = auth()->user();
        return view('externo.PrestamoEquipos.create', compact('usuario'));
    }

    /**
     * Guarda el acta de entrega temporal en base de datos.
     * Nueva estructura: cada entrada en 'empleados' contiene datos del empleado + sus elementos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cedula_juez'        => 'required',
            'nombre_juez'        => 'required',
            'cargo_titular'      => 'required|string|max:255',
            'correo_titular'     => 'required|email|max:255',
            'fecha_acta'         => 'required|date',
            'empleados'          => 'required|array|min:1',
            'empleados.*.cedula' => 'required',
            'empleados.*.nombre' => 'required',
            'empleados.*.cargo'  => 'required',
            'empleados.*.lugar'  => 'required',
        ]);

        // ── Validar que el Juez Titular exista en la base de datos de empleados
        $juezVal = \App\Models\Empleado::where('cedulaE', $request->cedula_juez)->first();
        if (!$juezVal) {
            return redirect()->back()
                ->withErrors("El Servidor Titular con cédula '{$request->cedula_juez}' no existe en la base de datos de empleados.")
                ->withInput();
        }

        // Forzar datos del juez desde la base de datos
        $nombreJuezReal = trim($juezVal->nameE . ' ' . $juezVal->lastnameE);
        $cargoJuezReal  = $juezVal->cargo_titular;

        // ── Validar que la misma persona no reciba el mismo tipo de elemento dos veces
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

        // ── Validar existencia de cada empleado y estructurar sus elementos
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

        // ── Validar placas duplicadas en solicitudes activas
        if (!empty($placasIngresadas)) {
            $activas = SolicitudPrestamoEquipo::where('estado', '!=', 'Rechazado')->get();
            foreach ($activas as $sol) {
                foreach ((array)$sol->equipos as $empExistente) {
                    foreach ((array)($empExistente['elementos'] ?? []) as $elEx) {
                        $px = $elEx['placa'] ?? '';
                        if ($px && in_array($px, $placasIngresadas)) {
                            return redirect()->back()
                                ->withErrors("La placa '{$px}' ya fue solicitada en Acta #" . str_pad($sol->id, 4, '0', STR_PAD_LEFT) . '.')
                                ->withInput();
                        }
                    }
                }
            }
        }

        // Obtener el circuito del despacho logueado
        $codigoDespacho = auth()->user()->cedula ?? '';
        $despachoInfo = \App\Models\Despacho::where('codigoDespacho', $codigoDespacho)->first();
        $circuitoAsignado = $despachoInfo ? $despachoInfo->circuito : null;

        $solicitud = new SolicitudPrestamoEquipo();
        // No se requiere solicitante extra: el despacho identifica al registrador
        $solicitud->cedula_solicitante = $codigoDespacho;
        $solicitud->nombre_solicitante = auth()->user()->name  ?? '';
        $solicitud->cedula_juez        = $request->cedula_juez;
        $solicitud->nombre_juez        = $nombreJuezReal;
        $solicitud->cargo_titular      = $cargoJuezReal;
        $solicitud->correo_titular     = $request->correo_titular;
        $solicitud->lugar_funciones    = null; // campo movido a cada empleado
        $solicitud->fecha_acta         = $request->fecha_acta;
        $solicitud->codigo_despacho    = $codigoDespacho;
        $solicitud->despacho           = auth()->user()->name  ?? '';
        $solicitud->circuito           = $circuitoAsignado;
        $solicitud->equipos            = $empleadosFormateados;
        $solicitud->estado             = 'Pendiente Carga PDF';
        $solicitud->save();

        return redirect()->route('prestamo.equipos.index')
            ->with('success', 'Acta generada. Descárguela, imprímala, fírmela y cárguela aquí.');
    }

    /**
     * Genera y descarga el PDF del Acta de Entrega Temporal (sin firma).
     */
    public function descargarPdf($id)
    {
        $solicitud = SolicitudPrestamoEquipo::findOrFail($id);

        if ($solicitud->despacho !== auth()->user()->name) {
            abort(403, 'Acceso denegado');
        }

        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true
        ])->loadView('externo.PrestamoEquipos.pdf', compact('solicitud'));
        
        $pdf->setPaper('letter', 'portrait');

        return $pdf->download('Acta_Entrega_' . str_pad($solicitud->id, 4, '0', STR_PAD_LEFT) . '.pdf');
    }

    /**
     * Sube el PDF firmado y cambia el estado a 'En espera de autorizacion de almacen'.
     */
    public function subirPdf(Request $request, $id)
    {
        $request->validate([
            'archivo_pdf' => 'required|mimes:pdf|max:10240'
        ]);

        $solicitud = SolicitudPrestamoEquipo::findOrFail($id);

        if ($solicitud->despacho !== auth()->user()->name) {
            abort(403, 'Acceso denegado');
        }

        if ($request->hasFile('archivo_pdf')) {
            $filename = 'Acta_' . $solicitud->id . '_firmada_' . time() . '.pdf';
            $path     = $request->file('archivo_pdf')->storeAs('prestamo_equipos', $filename, 'public');

            $solicitud->archivo_pdf = $path;
            $solicitud->estado      = 'En espera de autorizacion de almacen';
            $solicitud->save();

            return redirect()->back()->with('success', 'PDF firmado cargado correctamente. La solicitud está en espera de autorización de Almacén.');
        }

        return redirect()->back()->with('error', 'No se pudo subir el archivo.');
    }

    /**
     * Descarga el PDF firmado que fue subido por el usuario.
     */
    public function verPdfFirmado($id)
    {
        $solicitud = SolicitudPrestamoEquipo::findOrFail($id);

        if ($solicitud->despacho !== auth()->user()->name && $solicitud->codigo_despacho !== auth()->user()->cedula) {
            abort(403, 'Acceso denegado');
        }

        if (!$solicitud->archivo_pdf || !\Illuminate\Support\Facades\Storage::disk('public')->exists($solicitud->archivo_pdf)) {
            return redirect()->back()->with('error', 'El archivo no existe.');
        }

        return response()->download(\Illuminate\Support\Facades\Storage::disk('public')->path($solicitud->archivo_pdf));
    }
}
