<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutorizacionIngreso;
use App\Models\Empleado;
use Illuminate\Support\Str;

class AutorizacionIngresoController extends Controller
{
    /**
     * Muestra el histórico de solicitudes del usuario.
     */
    public function index()
    {
        $usuario = auth()->user();
        
        $rol = strtolower(trim($usuario->rol ?? ''));
        if (in_array($rol, ['almacen', 'administrador', 'admin'])) {
            $solicitudes = AutorizacionIngreso::orderBy('created_at', 'desc')->get();
        } else {
            $solicitudes = AutorizacionIngreso::where('id_usuario', $usuario->id)
                            ->orWhere('codigo_despacho', $usuario->cedula)
                            ->orWhere('despacho', $usuario->name)
                            ->orderBy('created_at', 'desc')->get();
        }

        return view('externo.SolicitudIngreso.index', compact('solicitudes'));
    }

    /**
     * Muestra el formulario al usuario final (público o despachos)
     */
    public function create()
    {
        return view('externo.SolicitudIngreso.create');
    }

    /**
     * Guarda la solicitud de ingreso en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'cedula_titular'  => 'required',
            'nombre_titular'  => 'required',
            'cargo_titular'   => 'required|string|max:255',
            'correo_titular'  => 'required|email|max:255',
            'cedula_empleado' => 'required',
            'nombre_empleado' => 'required',
            'cargo_empleado'  => 'required|string|max:255',
            'motivo_ingreso'  => 'required|string|max:2000',
        ]);

        // ── Validar que el Juez Titular exista en la base de datos de empleados
        $titularVal = Empleado::where('cedulaE', $request->cedula_titular)->first();
        if (!$titularVal) {
            return redirect()->back()
                ->withErrors("El Servidor Titular con cédula '{$request->cedula_titular}' no existe en la base de datos de empleados.")
                ->withInput();
        }

        // ── Validar que el Empleado exista
        $empleadoVal = Empleado::where('cedulaE', $request->cedula_empleado)->first();
        if (!$empleadoVal) {
            return redirect()->back()
                ->withErrors("El Empleado con cédula '{$request->cedula_empleado}' no existe en la base de datos de empleados.")
                ->withInput();
        }

        // Determinar circuito y datos del usuario logueado
        $circuito = 'NO DEFINIDO';
        $id_usuario = null;
        $codigo_despacho = null;
        $despacho = null;
        $correo_usuario = null;

        if (auth()->check()) {
            $user = auth()->user();
            $id_usuario = $user->id;
            $codigo_despacho = $user->cedula;
            $despacho = trim($user->name . ' ' . $user->lastname);
            $correo_usuario = $user->email;

            $rolName = strtolower(trim($user->rol ?? ''));
            if ($rolName === 'usuario_despacho' || $rolName === 'despacho' || $rolName === 'usuario') {
                $circuito = $user->despacho->circuito ?? 'NO DEFINIDO';
            } elseif ($rolName === 'almacen') {
                $circuito = $user->circuito ?? 'NO DEFINIDO';
            }
        }

        // Generar número de seguimiento aleatorio único
        $numeroSeguimiento = $this->generarNumeroSeguimiento();

        AutorizacionIngreso::create([
            'numero_seguimiento' => $numeroSeguimiento,
            'id_usuario'         => $id_usuario,
            'codigo_despacho'    => $codigo_despacho,
            'despacho'           => $despacho,
            'fecha_solicitud'    => now()->toDateString(),
            'correo_usuario'     => $correo_usuario,
            'cedula_titular'     => $request->cedula_titular,
            'nombre_titular'     => trim($titularVal->nameE . ' ' . $titularVal->lastnameE),
            'cargo_titular'      => $titularVal->cargo_titular ?? $request->cargo_titular,
            'correo_titular'     => $request->correo_titular,
            'cedula_empleado'    => $request->cedula_empleado,
            'nombre_empleado'    => trim($empleadoVal->nameE . ' ' . $empleadoVal->lastnameE),
            'cargo_empleado'     => $empleadoVal->cargo_titular ?? $request->cargo_empleado,
            'motivo_ingreso'     => $request->motivo_ingreso,
            'estado'             => 'Pendiente',
            'circuito'           => $circuito,
        ]);

        return redirect()->back()->with('success', "¡Solicitud registrada correctamente! Su número de seguimiento es: {$numeroSeguimiento}");
    }

    /**
     * Helper para generar número de seguimiento único
     */
    private function generarNumeroSeguimiento()
    {
        do {
            // Genera algo como ING-A1B2C3
            $numero = 'ING-' . strtoupper(Str::random(6));
        } while (AutorizacionIngreso::where('numero_seguimiento', $numero)->exists());

        return $numero;
    }

    /**
     * Permite descargar el PDF de comprobante usando el número de seguimiento (ruta disfrazada)
     */
    public function descargarPdf($seguimiento)
    {
        $solicitud = AutorizacionIngreso::where('numero_seguimiento', $seguimiento)->firstOrFail();
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                  ->loadView('externo.SolicitudIngreso.pdf', compact('solicitud'));
        
        return $pdf->download('Comprobante_Ingreso_' . $solicitud->numero_seguimiento . '.pdf');
    }

    /**
     * Muestra la página pública de validación al escanear el QR
     */
    public function validarQr($seguimiento)
    {
        $solicitud = AutorizacionIngreso::where('numero_seguimiento', $seguimiento)->firstOrFail();
        
        if ($solicitud->estado === 'Autorizada' && !empty($solicitud->fecha_ingreso)) {
            if (\Carbon\Carbon::parse($solicitud->fecha_ingreso)->startOfDay()->lt(now()->startOfDay())) {
                return redirect()->route('solicitud_ingreso.validar_form')
                    ->with('error', 'La fecha autorizada para este permiso ya pasó (' . \Carbon\Carbon::parse($solicitud->fecha_ingreso)->format('d/m/Y') . '). No está autorizado para ingresar el día de hoy.');
            }
        }

        $empleado = Empleado::where('cedulaE', $solicitud->cedula_empleado)->first();
        return view('externo.SolicitudIngreso.validador', compact('solicitud', 'empleado'));
    }

    /**
     * Muestra el formulario para buscar una solicitud de ingreso
     */
    public function mostrarFormularioValidacion()
    {
        return view('externo.SolicitudIngreso.buscar_validador');
    }

    /**
     * Procesa la búsqueda desde el formulario de validación
     */
    public function procesarFormularioValidacion(Request $request)
    {
        $request->validate([
            'numero_seguimiento' => 'required|string|max:50'
        ]);

        $solicitud = AutorizacionIngreso::where('numero_seguimiento', $request->numero_seguimiento)->first();

        if (!$solicitud) {
            return back()->with('error', 'No se encontró ninguna solicitud de ingreso con el número de seguimiento proporcionado.');
        }

        if ($solicitud->estado === 'Autorizada' && !empty($solicitud->fecha_ingreso)) {
            if (\Carbon\Carbon::parse($solicitud->fecha_ingreso)->startOfDay()->lt(now()->startOfDay())) {
                return back()->with('error', 'La fecha autorizada para este permiso ya pasó (' . \Carbon\Carbon::parse($solicitud->fecha_ingreso)->format('d/m/Y') . '). No está autorizado para ingresar el día de hoy.');
            }
        }

        $empleado = Empleado::where('cedulaE', $solicitud->cedula_empleado)->first();
        return view('externo.SolicitudIngreso.validador', compact('solicitud', 'empleado'));
    }
}
