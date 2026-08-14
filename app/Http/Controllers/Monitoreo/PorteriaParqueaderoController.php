<?php

namespace App\Http\Controllers\Monitoreo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\ControlIngreso;
use App\Models\Parqueadero;
use App\Models\UsoParqueadero;
use App\Models\BitacoraParqueadero;
use App\Models\RestriccionLaboral;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;

class PorteriaParqueaderoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('parqueadero');
    }

    // =========================================================
    //  DASHBOARD: Historial del día para esta portería
    // =========================================================
    public function index()
    {
        $fechaA   = Carbon::now()->toDateString();
        $seccionalRaw =  auth()->user()->seccional ?? '';
        $seccionales  = !empty($seccionalRaw)
            ? array_filter(array_map('trim', explode(',', strtoupper($seccionalRaw))))
            : [];

        // Historial real del día leído desde bitácora (fuente de verdad histórica)
        // Se realiza un LEFT JOIN con la tabla parqueadero para asegurar que traiga nombre e identificación 
        // del funcionario incluso si no quedaron registrados en la bitácora.
        $ingresos = BitacoraParqueadero::select(
                'bitacora_parqueadero.*', 
                'p.nombre as nombre_puesto', 
                'p.cedula as cedula_puesto', 
                'p.despacho as despacho_puesto',
                DB::raw("CASE 
                    WHEN bitacora_parqueadero.vehiculo LIKE '% - %' THEN SUBSTRING_INDEX(bitacora_parqueadero.vehiculo, ' - ', -1)
                    ELSE p.descripcion_vehiculo 
                END as descripcion_puesto")
            )
            ->leftJoin('parqueadero as p', 'bitacora_parqueadero.parqueadero', '=', 'p.id')
            ->where(function($q) use ($fechaA) {
                $q->where('bitacora_parqueadero.fecha', $fechaA)
                  ->orWhereNull('bitacora_parqueadero.hora_salida');
            })
            ->when(!empty($seccionales), function($q) use ($seccionales) {
                $q->where(function($q2) use ($seccionales) {
                    $q2->whereIn(DB::raw('TRIM(bitacora_parqueadero.edificio)'), $seccionales)
                       ->orWhereNull('bitacora_parqueadero.edificio');
                });
            })
            ->orderBy('bitacora_parqueadero.id', 'DESC')
            ->get();

        // Personas actualmente ADENTRO en ESTA portería
        $contarUsuario = BitacoraParqueadero::whereNull('hora_salida')
            ->when(!empty($seccionales), function($q) use ($seccionales) {
                $q->where(function($q2) use ($seccionales) {
                    $q2->whereIn(DB::raw('TRIM(edificio)'), $seccionales)
                       ->orWhereNull('edificio');
                });
            })
            ->distinct('cedula')
            ->count('cedula');

        // Conteo por tipo de vehículo en ESTA portería
        $contarMotos = BitacoraParqueadero::whereNull('hora_salida')
            ->when(!empty($seccionales), function($q) use ($seccionales) {
                $q->where(function($q2) use ($seccionales) {
                    $q2->whereIn(DB::raw('TRIM(edificio)'), $seccionales)
                       ->orWhereNull('edificio');
                });
            })
            ->where(function ($q) {
                $q->where('vehiculo', 'LIKE', 'MOTO%')
                  ->orWhere('vehiculo', 'LIKE', 'BIKE%');
            })
            ->count();

        $contarCarros = BitacoraParqueadero::whereNull('hora_salida')
            ->when(!empty($seccionales), function($q) use ($seccionales) {
                $q->where(function($q2) use ($seccionales) {
                    $q2->whereIn(DB::raw('TRIM(edificio)'), $seccionales)
                       ->orWhereNull('edificio');
                });
            })
            ->where(function ($q) {
                $q->where('vehiculo', 'LIKE', 'CARRO%')
                  ->orWhere('vehiculo', 'LIKE', 'AUTO%')
                  ->orWhere('vehiculo', 'LIKE', 'CAMION%')
                  ->orWhere('vehiculo', 'LIKE', 'VEHICULO%');
            })
            ->count();

        return view('monitoreo.parqueadero', compact('ingresos', 'contarUsuario', 'contarMotos', 'contarCarros'));
    }

    // =========================================================
    //  BÚSQUEDA UNIFICADA por Placa o Cédula
    //
    //  Flujo:
    //   1. RestriccionLaboral  → bloqueo inmediato
    //   2. JOIN parqueadero + uso_parqueadero → funcionarios ACTIVOS
    //   3. BitacoraParqueadero (hoy) → determinar si ya está adentro
    //   4. ControlIngreso (hoy) → visitantes registrados hoy
    // =========================================================
    public function verificaringresoPorPlaca($id)
    {
        $fechaA  = Carbon::now()->toDateString();
        $idClean = strtoupper(str_replace([' ', '-', '.'], '', trim($id)));

        // --- 1. Restricción Laboral ---
        $restriccion = RestriccionLaboral::where('cedula', $idClean)->first();
        if ($restriccion) {
            return response()->json([[
                'Restriccion' => $restriccion->orientacion_para_seccional,
                'cedula'      => $restriccion->cedula,
                'nombre'      => $restriccion->nombre,
                'impedimento' => 'rest',
            ]]);
        }

        // --- 2. CONSULTA EN PARQUEADERO (Maestro) + RELACIÓN CON USO_PARQUEADERO ---
        // Seguimos la instrucción: Buscar en parqueadero y traer info de puesto vía relación
        $registros = Parqueadero::with('puesto')
            ->where('estado', 'ACTIVO')
            ->where(function ($q) use ($idClean) {
                $q->where('cedula', $idClean)
                  ->orWhereRaw("UPPER(REPLACE(REPLACE(placa,' ',''),'-','')) = ?", [$idClean]);
            })
            ->get();

        // --- 3. Visitante en ControlIngreso de hoy (o anteriores si están ADENTRO) ---
        $visitantes = ControlIngreso::where('identificacion', $idClean)
            ->whereNull('salida')
            ->get();

        if ($registros->isEmpty() && $visitantes->isEmpty()) {
            return response()->json(null);
        }

        $response      = [];
        $miSeccionales = array_filter(array_map('trim', explode(',', strtoupper( auth()->user()->seccional ?? ''))));

        // --- Procesar funcionarios/contratistas ---
        foreach ($registros as $reg) {
            $puesto = $reg->puesto; // El objeto UsoParqueadero relacionado

            // ¿Ya está adentro? (Sin importar fecha)
            $ultimoBitacora = BitacoraParqueadero::where('parqueadero', $reg->id)
                ->latest('id')
                ->first();
            $yaIngreso = $ultimoBitacora && is_null($ultimoBitacora->hora_salida);

            // Validación de portería/edificio (Seccional)
            $edificio    = strtoupper(trim($puesto->edificio ?? $reg->edificio ?? ''));
            $permitido   = true;
            $msgPorteria = '';

            // Validación de parqueadero no asignado o en blanco
            if (!$puesto && empty($reg->no_parqueadero)) {
                $permitido   = false;
                $msgPorteria = "EL VEHÍCULO NO TIENE UN PUESTO DE PARQUEADERO ASIGNADO.";
            }
            
            if ($permitido && !empty($miSeccionales) && !empty($edificio) && !in_array($edificio, $miSeccionales)) {
                $permitido   = false;
                $msgPorteria = "Este vehículo debe ingresar por el edificio: {$edificio}";
            }

            // Validar que el vehículo oficial tenga un conductor asignado para poder salir
            $esOficial = strtoupper(trim($reg->calidad_vehiculo ?? '')) === 'OFICIAL';
            if ($yaIngreso && $esOficial) {
                if (empty($reg->cedula) || empty($reg->nombre)) {
                    $permitido = false;
                    $msgPorteria = "El vehículo OFICIAL no tiene un conductor asignado. Asigne uno antes de registrar la salida.";
                }
            }

            // Validación de capacidad y estado (INACTIVO) del puesto físico
            $puestoLleno  = false;
            if (!$yaIngreso && $puesto) {
                if ($puesto->estado === 'INACTIVO') {
                    $permitido   = false;
                    $msgPorteria = "El puesto ({$puesto->parqueadero}) está INACTIVO / DESHABILITADO.";
                } elseif (!$puesto->tieneCapacidad()) {
                    $puestoLleno = true;
                    $adentro     = $puesto->vehiculosAdentro();
                    $msgPorteria = "Puesto lleno: {$adentro}/{$puesto->capacidad} vehículo(s) adentro";
                    $permitido   = false;
                }
            }

            // Novedad más reciente de hoy
            $novedadHoy = BitacoraParqueadero::where('parqueadero', $reg->id)
                ->where('fecha', $fechaA)
                ->whereNotNull('novedades')
                ->latest()
                ->value('novedades');

            $empleado = Empleado::where('cedulaE', $reg->cedula)->first();
            $foto_empleado = null;
            if ($empleado) {
                if (!empty($empleado->foto)) {
                    $foto_empleado = (str_starts_with($empleado->foto, 'http') || str_starts_with($empleado->foto, 'data:')) 
                        ? $empleado->foto 
                        : asset($empleado->foto);
                } else {
                    $foto_empleado = $empleado->foto_url; // fallback a la foto en public/img/carnet
                }
            }
            // Validación de vehículos oficiales e inspección diaria
            $esOficial = strtoupper(trim($reg->calidad_vehiculo ?? '')) === 'OFICIAL';
            $inspeccionHoy = null;
            $inspeccionEstado = 'PENDIENTE';

            if ($esOficial) {
                $insp = \App\Models\Inspeccion::where('placa', $reg->placa)
                    ->where('fecha', $fechaA)
                    ->latest('id')
                    ->first();
                if ($insp) {
                    $inspeccionHoy = [
                        'id' => $insp->id,
                        'estado' => $insp->estado,
                        'fecha' => $insp->fecha ? $insp->fecha->toDateString() : $fechaA,
                        'hora' => $insp->hora,
                        'quien_registro' => $insp->quien_registro
                    ];
                    $inspeccionEstado = $insp->estado;
                }
            }

            $response[] = [
                'id_parq'              => $reg->id,
                'cedula'               => $reg->cedula,
                'nombre'               => $reg->nombre,
                'juzgado'              => trim(($reg->cargo ?? '') . ' ' . ($reg->juzgado ?? '') . ' ' . ($reg->especialidad ?? '')) ?: 'N/A',
                'empresa'              => $reg->empresa,
                'placa'                => strtoupper($reg->placa),
                'tipo_vehiculo'        => $reg->tipo_vehiculo,
                'descripcion_vehiculo' => $reg->descripcion_vehiculo ?? '',
                'ocupado'              => $reg->ocupado,
                'ya_ingreso'           => $yaIngreso,
                'no_puesto'            => $puesto->parqueadero ?? $reg->no_parqueadero ?? 'N/A',
                'edificio'             => $edificio ?: 'N/A',
                'ubicacion_detalle'    => trim(($puesto->parqueadero ?? $reg->no_parqueadero ?? 'N/A') . ' · ' . $edificio),
                'permitido_porteria'   => $permitido && !$puestoLleno,
                'mensaje_porteria'     => $msgPorteria,
                'puesto_lleno'         => $puestoLleno,
                'calidad'              => $reg->calidad ?? 'PERMANENTE',
                'tipo_persona'         => 'FUNCIONARIO',
                'impedimento'          => 'no',
                'observaciones_previas'=> $reg->observaciones ?? '',
                'novedades_hoy'        => $novedadHoy ?? '',
                'capacidad_puesto'     => $puesto->capacidad ?? 1,
                'adentro_hoy'          => $puesto ? $puesto->vehiculosAdentro() : 0,
                'foto_empleado'        => $foto_empleado,
                'calidad_vehiculo'     => $reg->calidad_vehiculo ?? 'PARTICULAR',
                'es_oficial'           => $esOficial,
                'inspeccion_hoy'       => $inspeccionHoy,
                'inspeccion_estado'    => $inspeccionEstado,
            ];
        }

        // --- Procesar visitantes ---
        foreach ($visitantes as $vis) {
            $response[] = [
                'id_parq'              => null,
                'cedula'               => $vis->identificacion,
                'nombre'               => $vis->fullname,
                'juzgado'              => $vis->despacho ?? 'N/A',
                'empresa'              => null,
                'placa'                => strtoupper($vis->placa ?? 'N/A'),
                'tipo_vehiculo'        => 'VISITANTE',
                'descripcion_vehiculo' => '',
                'ocupado'              => is_null($vis->salida) ? 'ADENTRO' : 'LIBRE',
                'ya_ingreso'           => is_null($vis->salida),
                'no_puesto'            => 'VISITANTE',
                'edificio'             => 'N/A',
                'ubicacion_detalle'    => 'VISITANTE',
                'permitido_porteria'   => true,
                'mensaje_porteria'     => '',
                'puesto_lleno'         => false,
                'calidad'              => 'VISITANTE',
                'tipo_persona'         => 'VISITANTE',
                'impedimento'          => 'no',
                'observaciones_previas'=> '',
                'novedades_hoy'        => '',
                'capacidad_puesto'     => 1,
                'adentro_hoy'          => 0,
                'foto_empleado'        => null,
            ];
        }

        return response()->json($response);
    }

    // =========================================================
    //  CONTADOR ASÍNCRONO
    // =========================================================
    public function contarUsuario()
    {
        $fechaA   = Carbon::now()->toDateString();
        $seccional =  auth()->user()->seccional;
        $count    = BitacoraParqueadero::whereNull('hora_salida')
            ->when(!empty($seccional), function($q) use ($seccional) {
                $seccs = array_filter(array_map('trim', explode(',', strtoupper($seccional))));
                if(!empty($seccs)){
                    $q->where(function($q2) use ($seccs) {
                        $q2->whereIn(DB::raw('TRIM(edificio)'), $seccs)
                           ->orWhereNull('edificio');
                    });
                }
            })
            ->distinct('cedula')
            ->count('cedula');
        return response()->json($count);
    }
}
