<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\EncuestaTrabajoCasa;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormatoTrabajoCasaMail;
use Illuminate\Support\Facades\Log;

class EncuestaTrabajoCasaController extends Controller
{
    public function paso1()
    {
        return response()->view('encuesta_trabajo_casa.paso1')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function validarPaso1(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string',
            'fecha_expedicion' => 'required|date',
            'correo' => 'required|email'
        ]);

        $yaExiste = EncuestaTrabajoCasa::where('cedula', $request->cedula)->exists();
        if ($yaExiste) {
            return back()->with('error', 'El número de cédula ingresado ya cuenta con un registro para esta encuesta.')->withInput();
        }

        $empleado = Empleado::where('cedulaE', $request->cedula)->first();

        if (!$empleado) {
            return back()->with('error', 'La cédula ingresada no se encuentra registrada en el sistema.')->withInput();
        }

        if (empty($empleado->fecha_expedicion)) {
            return back()->with('error_fecha', 'Debe actualizar sus datos. Por favor, envíe su información a gmstdesajvalle3@cendoj.ramajudicial.gov.co o actualícela a través de SIRIS.')->withInput();
        }

        // Validar que la fecha ingresada coincida con la BD (asumiendo formato Y-m-d)
        // Convertimos ambas a formato Y-m-d para comparar
        $fechaIngresada = \Carbon\Carbon::parse($request->fecha_expedicion)->format('Y-m-d');
        $fechaDB = \Carbon\Carbon::parse($empleado->fecha_expedicion)->format('Y-m-d');
        
        if ($fechaIngresada !== $fechaDB) {
            return back()->with('error', 'La fecha de expedición no coincide con nuestros registros.')->withInput();
        }

        // Obtener el Despacho real y la ciudad haciendo join con ciudades
        $despacho = \App\Models\Despacho::leftJoin('ciudades', 'despachos.codCiudad', '=', 'ciudades.codigoCiudad')
            ->where('codigoDespacho', $empleado->cod_dependencia)
            ->orWhere('codigoDespacho', $empleado->cod_despacho)
            ->select('despachos.*', 'ciudades.nombreCiudad as ciudad_real')
            ->first();

        // Guardar en sesión temporalmente
        session()->put('tc_empleado', $empleado);
        session()->put('tc_correo', $request->correo);
        session()->put('tc_despacho', $despacho);

        return redirect()->route('trabajo_casa.paso2');
    }

    public function paso2()
    {
        if (!session()->has('tc_empleado')) {
            return redirect()->route('trabajo_casa.paso1')->with('error', 'Sesión expirada. Por favor inicie de nuevo.');
        }

        $empleado = json_decode(json_encode(session('tc_empleado')));
        $despacho = session('tc_despacho') ? json_decode(json_encode(session('tc_despacho'))) : null;

        return response()->view('encuesta_trabajo_casa.paso2', [
            'empleado' => $empleado,
            'correo' => session('tc_correo'),
            'despacho' => $despacho
        ])->header('Cache-Control', 'no-cache, no-store, must-revalidate')
          ->header('Pragma', 'no-cache')
          ->header('Expires', '0');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string|unique:encuestas_trabajo_casa,cedula',
            'correo' => 'required|email',
            'cod_despacho' => 'nullable|string',
            'correo_dependencia' => 'nullable|string',
            'dependencia' => 'nullable|string',
            'ciudad' => 'nullable|string',
            'computador' => 'required|in:REQUIERE,NO REQUIERE',
            'impresora' => 'required|in:REQUIERE,NO REQUIERE',
            'escaner' => 'required|in:REQUIERE,NO REQUIERE',
            'conectividad' => 'required|in:REQUIERE,NO REQUIERE',
            'silla' => 'required|in:REQUIERE,NO REQUIERE',
            'escritorio' => 'required|in:REQUIERE,NO REQUIERE',
            'aplicaciones' => 'required|array|min:1',
            'otra_aplicacion' => 'nullable|string',
            'cuenta_todos_elementos' => 'required|in:SI,NO',
        ]);

        try {
            $encuesta = new EncuestaTrabajoCasa();
            $encuesta->cedula = $request->cedula;
            $encuesta->correo = $request->correo;
            $encuesta->cod_despacho = $request->cod_despacho;
            $encuesta->correo_dependencia = $request->correo_dependencia;
            $encuesta->dependencia = $request->dependencia;
            $encuesta->ciudad = $request->ciudad;
            
            // Logica VPN
            if ($request->has('tiene_vpn')) {
                $encuesta->tiene_vpn = $request->tiene_vpn;
            }
            if ($request->has('requiere_vpn')) {
                $encuesta->requiere_vpn = $request->requiere_vpn;
            }

            $encuesta->computador = $request->computador;
            $encuesta->impresora = $request->impresora;
            $encuesta->escaner = $request->escaner;
            $encuesta->conectividad = $request->conectividad;
            $encuesta->silla = $request->silla;
            $encuesta->escritorio = $request->escritorio;
            
            if ($request->has('aplicaciones') && is_array($request->aplicaciones)) {
                $apps = $request->aplicaciones;
                if (in_array('Otra', $apps) && $request->has('otra_aplicacion')) {
                    $key = array_search('Otra', $apps);
                    if ($key !== false) {
                        $apps[$key] = 'Otra: ' . $request->otra_aplicacion;
                    }
                }
                $encuesta->aplicaciones = implode(', ', $apps);
            }
            if ($request->has('cuenta_todos_elementos')) {
                $encuesta->cuenta_todos_elementos = $request->cuenta_todos_elementos;
            }
            
            $encuesta->save();

            // Enviar correo
            try {
                Mail::to($request->correo)->send(new FormatoTrabajoCasaMail($encuesta));
            } catch (\Exception $mailEx) {
                Log::error("Fallo enviando correo encuesta trabajo en casa: " . $mailEx->getMessage());
                return redirect()->route('trabajo_casa.paso1')->with('warning', 'Tus respuestas han sido guardadas, pero hubo un problema al enviar el formato a tu correo.');
            }

            // Limpiar variables de sesión
            session()->forget(['tc_empleado', 'tc_correo', 'tc_despacho']);

            return redirect()->route('trabajo_casa.paso1')->with('success', 'Formulario enviado correctamente. Se ha enviado una copia a tu correo electrónico.');

        } catch (\Exception $e) {
            Log::error("Error guardando encuesta trabajo en casa: " . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al guardar la información. Por favor intente de nuevo.')->withInput();
        }
    }
}
