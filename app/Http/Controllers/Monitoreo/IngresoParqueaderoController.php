<?php

namespace App\Http\Controllers\Monitoreo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use App\Models\ControlIngreso;
use App\Models\Vehiculo;
use App\Models\Parqueadero;
use App\Models\RestriccionLaboral;
use App\Models\ContratoActivo;
use App\Models\UsoParqueadero;
use App\Models\BitacoraParqueadero;
use App\Models\User;
use App\Models\PermisoEspecialParqueadero;
use App\Mail\NovedadParqueaderoMail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IngresoParqueaderoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('parqueadero');
    }

    // =========================================================
    //  HELPER: Validar restricción de día para vehículos particulares
    //  Vehículos OFICIAL: sin restricción (L-D)
    //  Vehículos PARTICULAR: solo L-V, salvo permiso especial del coordinador
    // =========================================================
    private function validarDiaIngreso(Parqueadero $parqueadero): ?array
    {
        $calidadVehiculo = strtoupper(trim($parqueadero->calidad_vehiculo ?? ''));

        // Solo aplica la restricción a vehículos PARTICULARES
        if ($calidadVehiculo !== 'PARTICULAR') {
            return null; // Sin restricción
        }

        $hoy = Carbon::now();
        $diaSemana = $hoy->dayOfWeek; // 0 = Domingo, 6 = Sábado

        if ($diaSemana !== Carbon::SATURDAY && $diaSemana !== Carbon::SUNDAY) {
            return null; // L-V: sin restricción para particulares
        }

        // Es fin de semana: verificar si hay permiso especial del coordinador
        $cedula = $parqueadero->cedula;
        $fechaHoy = $hoy->toDateString();

        if (PermisoEspecialParqueadero::tienePermiso($cedula, $fechaHoy)) {
            return null; // Tiene permiso especial, puede ingresar
        }

        $diaNombre = $diaSemana === Carbon::SATURDAY ? 'Sábado' : 'Domingo';
        return [
            'status'  => 1,
            'message' => "Vehículo PARTICULAR ({$parqueadero->placa}): no autorizado para ingresar en {$diaNombre}. "
                        . 'Solicite un permiso especial al Coordinador de Ingreso.'
        ];
    }

    public function index()
    {
        return app(PorteriaParqueaderoController::class)->index();
    }

    // =========================================================
    //  REGISTRO DE INGRESO
    //  Flujo: parqueadero → puesto() → uso_parqueadero
    //  control_ingreso.parqueadero = parqueadero.id (FK)
    //  bitacora_parqueadero.parqueadero = parqueadero.id (FK)
    // =========================================================
    public function registrarIngreso(Request $request, $id)
    {
        $fechaA    = Carbon::now()->toDateString();
        $hora      = Carbon::now()->totimeString();
        $novedades = $request->novedades ? strtoupper(trim($request->novedades)) : null;
        $idClean   = strtoupper(str_replace([' ', '-', '.'], '', trim($id)));

        // 1. Buscar en tabla `parqueadero` (el maestro de autorizados)
        if ($request->filled('parq')) {
            $parqueadero = Parqueadero::with('puesto')->where('id', $request->parq)->where('estado', 'ACTIVO')->first();
        } else {
            $parqueadero = Parqueadero::with('puesto')
                ->where('estado', 'ACTIVO')
                ->where(function ($q) use ($idClean) {
                    $q->where('cedula', $idClean)
                      ->orWhereRaw("UPPER(REPLACE(REPLACE(placa,' ',''),'-','')) = ?", [$idClean]);
                })
                ->first();
        }

        if ($parqueadero) {
            // Validación restricción de día (Particular: solo L-V, salvo permiso especial)
            $errorDia = $this->validarDiaIngreso($parqueadero);
            if ($errorDia) return response()->json($errorDia);

            // Validación TEMPORAL vigencia
            if ($parqueadero->calidad === 'TEMPORAL') {
                if ($fechaA < $parqueadero->fecha_inicio || $fechaA > $parqueadero->fecha_fin) {
                    return response()->json(['status' => 1, 'message' => "Permiso temporal vencido (válido: {$parqueadero->fecha_inicio} al {$parqueadero->fecha_fin})." ]);
                }
            }

            // Validación ya adentro (basada en el ÚLTIMO registro)
            $ultimoRegistro = BitacoraParqueadero::where('parqueadero', $parqueadero->id)->latest('id')->first();
            if ($ultimoRegistro && is_null($ultimoRegistro->hora_salida)) {
                return response()->json(['status' => 1, 'message' => 'Este vehículo ya está registrado adentro. Debe registrar la salida antes de volver a ingresar.']);
            }

            // Validación capacidad y estado del puesto físico (uso_parqueadero)
            $puesto = $parqueadero->puesto; // UsoParqueadero via parqueadero_id
            if ($puesto) {
                if ($puesto->estado === 'INACTIVO') {
                    return response()->json(['status' => 1, 'message' => "El puesto de parqueadero ({$puesto->parqueadero}) está INACTIVO / DESHABILITADO."]);
                }
                if (!$puesto->tieneCapacidad()) {
                    $adentro = $puesto->vehiculosAdentro();
                    return response()->json(['status' => 1, 'message' => "Puesto lleno: {$adentro}/{$puesto->capacidad} vehículo(s) adentro."]);
                }
            }

            // Validación seccional/portería
            $miSeccionales = array_filter(array_map('trim', explode(',', strtoupper( auth()->user()->seccional ?? ''))));
            $edificio      = strtoupper(trim($puesto->edificio ?? $parqueadero->edificio ?? ''));
            $esGlobal      = strtoupper($parqueadero->tipo_ingreso ?? '') === 'GLOBAL';
            if (!$esGlobal && !empty($miSeccionales) && !empty($edificio) && !in_array($edificio, $miSeccionales)) {
                return response()->json(['status' => 1, 'message' => "Restricción: Este vehículo debe ingresar por {$edificio}."]);
            }

            // --- Log diario (control_ingreso) ---
            // IMPORTANTE: parqueadero = parqueadero.id (FK real)
            $vehiculo = Vehiculo::updateOrCreate(
                ['placa' => strtoupper($parqueadero->placa)],
                ['tipo' => strtoupper($parqueadero->tipo_vehiculo), 'caracteristicas' => strtoupper($parqueadero->descripcion_vehiculo ?? '')]
            );
            $ingreso = ControlIngreso::create([
                'identificacion'      => $parqueadero->cedula,
                'fullname'            => $parqueadero->nombre,
                'fecha_ingreso'       => $fechaA,
                'hora_ingreso'        => $hora,
                'ingreso'             =>  auth()->user()->name . ' a las ' . $hora,
                'despacho'            => ($parqueadero->juzgado ?? $parqueadero->cargo ?? '') . ' ' . ($parqueadero->especialidad ?? ''),
                'quien_solicito'      => '0000',
                'tipo_solicitud'      => $parqueadero->calidad === 'TEMPORAL' ? 'TEMPORAL' : 'EMPLEADO',
                'vehiculo_autorizado' => 'AUTORIZADO',
                'vehiculo'            => $vehiculo->id,
                'parqueadero'         => $parqueadero->id,   // FK → parqueadero.id
                'porteria'            =>  auth()->user()->direccion_porteria ?? null,
                'ciudad'              => $puesto->ciudad ?? $parqueadero->ciudad ?? null,
                'edificio'            => $edificio ?: null,
            ]);

            // Marcar puesto ocupado
            $parqueadero->ocupado = 'OCUPADO'; $parqueadero->save();
            if ($puesto) $puesto->update(['estado' => 'OCUPADO']);

            // --- Bitácora histórica ---
            $bitacora = BitacoraParqueadero::create([
                'cedula'                 => $parqueadero->cedula,
                'nombre'                 => $parqueadero->nombre,
                'empresa'                => $parqueadero->empresa,
                'vehiculo'               => $parqueadero->descripcion_vehiculo,
                'placa'                  => strtoupper($parqueadero->placa),
                'fecha'                  => $fechaA,
                'hora_ingreso'           => $hora,
                'quien_registro_ingreso' =>  auth()->user()->name,
                'parqueadero'            => $parqueadero->id,  // FK → parqueadero.id
                'no_puesto'              => $puesto->parqueadero ?? $parqueadero->no_parqueadero,
                'ciudad'                 => $puesto->ciudad ?? $parqueadero->ciudad ?? null,
                'edificio'               => $edificio ?: null,
                'porteria'               =>  auth()->user()->direccion_porteria ?? 'GENERAL',
                'tipo_ingreso'           => $parqueadero->calidad === 'TEMPORAL' ? 'TEMPORAL' : 'EMPLEADO',
                'novedades'              => $novedades ? 'INGRESO: ' . $novedades : null,
            ]);

            if (!empty($novedades)) {
                try {
                    $this->notificarCoordinadores($bitacora, $novedades);
                } catch (\Throwable $e) {
                    \Log::error('[Parqueadero] Fallo crítico al invocar notificación: ' . $e->getMessage());
                }
            }
            
            return response()->json(['status' => 0, 'message' => 'Ingreso registrado']);
        }

        // 2. Fallback: visitante ya registrado en control_ingreso
        // Buscar el último registro de ingreso del visitante
        $visitante = ControlIngreso::where('identificacion', $idClean)->latest('id')->first();

        if ($visitante) {
            // Si el visitante no tiene salida registrada, está adentro
            if (is_null($visitante->salida)) {
                return response()->json(['status' => 1, 'message' => 'Este visitante ya está registrado adentro. Debe registrar la salida antes de volver a ingresar.']);
            }

            // Si ya salió, le permitimos reingresar creando un nuevo log de hora_ingreso
            $visitante->update([
                'fecha_ingreso'=> $fechaA,
                'hora_ingreso' => $hora,
                'ingreso'      =>  auth()->user()->name . ' a las ' . $hora,
                'salida'       => null, 'hora_salida' => null,
            ]);
            $bitacora = BitacoraParqueadero::create([
                'cedula'                 => $visitante->identificacion,
                'nombre'                 => $visitante->fullname,
                'vehiculo'               => $visitante->caracteristicas ?? ($visitante->vehiculo ?? 'VISITANTE'),
                'placa'                  => strtoupper($visitante->placa ?? 'N/A'),
                'fecha'                  => $fechaA, 'hora_ingreso' => $hora,
                'quien_registro_ingreso' =>  auth()->user()->name,
                'porteria'               =>  auth()->user()->direccion_porteria ?? 'GENERAL',
                'tipo_ingreso'           => 'VISITANTE',
                'novedades'              => $novedades ? 'INGRESO: ' . $novedades : null,
            ]);
            if (!empty($novedades)) $this->notificarCoordinadores($bitacora, $novedades);
            return response()->json(['status' => 0, 'message' => 'Reingreso registrado']);
        }

        return response()->json(['status' => 1, 'message' => 'No se encontró el registro.']);
    }

    // =========================================================
    //  REGISTRO DE SALIDA
    //  Busca el registro en parqueadero → libera puesto (uso_parqueadero)
    //  Actualiza control_ingreso y bitacora_parqueadero
    // =========================================================
    public function registrarSalida(Request $request, $id)
    {
        $fechaA    = Carbon::now()->toDateString();
        $hora      = Carbon::now()->totimeString();
        $novedades = $request->novedades ? strtoupper(trim($request->novedades)) : null;
        $idClean   = strtoupper(str_replace([' ', '-', '.'], '', trim($id)));

        // Buscar el registro maestro en parqueadero
        if ($request->filled('parq')) {
            $parqueadero = Parqueadero::with('puesto')->find($request->parq);
        } else {
            $parqueadero = Parqueadero::with('puesto')
                ->where(function ($q) use ($idClean) {
                    $q->where('cedula', $idClean)
                      ->orWhereRaw("UPPER(REPLACE(REPLACE(placa,' ',''),'-','')) = ?", [$idClean]);
                })->first();
        }

        if ($parqueadero) {
            // === AGREGADO: Validar si es oficial y tiene inspección APTO hoy ===
            if (strtoupper(trim($parqueadero->calidad_vehiculo ?? '')) === 'OFICIAL') {
                $insp = \App\Models\Inspeccion::where('placa', $parqueadero->placa)
                    ->where('fecha', $fechaA)
                    ->latest('id')
                    ->first();
                    
                if (!$insp) {
                    return response()->json(['status' => 1, 'message' => 'El vehículo oficial no tiene diagnóstico (inspección) registrado para hoy. No se permite la salida.']);
                }
                
                if ($insp->estado === 'NO APTO') {
                    return response()->json(['status' => 1, 'message' => 'El vehículo oficial fue diagnosticado como NO APTO. No se permite la salida.']);
                }
            }
            // ===================================================================

            // Verificar ingreso activo (sin importar fecha)
            $ingresoActivo = ControlIngreso::where('parqueadero', $parqueadero->id)
                ->whereNull('salida')->latest('id')->first();
                
            $bitacora = BitacoraParqueadero::where('parqueadero', $parqueadero->id)
                ->whereNull('hora_salida')->latest('id')->first();

            if (!$ingresoActivo && !$bitacora) {
                return response()->json(['status' => 1, 'message' => 'Este vehículo no tiene ingreso activo.']);
            }

            // Actualizar log diario
            if ($ingresoActivo) {
                $ingresoActivo->update(['hora_salida' => $hora, 'salida' =>  auth()->user()->name . ' a las ' . $hora]);
            }

            // Cerrar bitácora (último registro sin salida)
            if ($bitacora) {
                $notaFinal = $novedades
                    ? ($bitacora->novedades ? $bitacora->novedades . ' | SALIDA: ' . $novedades : 'SALIDA: ' . $novedades)
                    : $bitacora->novedades;
                
                $bitacora->hora_salida = $hora;
                $bitacora->quien_registro_salida =  auth()->user()->name;
                $bitacora->novedades = $notaFinal;
                $bitacora->save();

                if (!empty($novedades)) { 
                    $bitacora->tipo_ingreso = 'SALIDA'; 
                    $this->notificarCoordinadores($bitacora, $novedades); 
                }
            }

            // Liberar puesto en parqueadero
            $parqueadero->ocupado = 'LIBRE'; $parqueadero->save();

            // Liberar uso_parqueadero si el puesto quedó completamente vacío
            $puesto = $parqueadero->puesto;
            if ($puesto && !$puesto->tieneCapacidad() === false) {
                // revalidar si aún hay alguien adentro
                if ($puesto->vehiculosAdentro() === 0) {
                    $puesto->update(['estado' => 'LIBRE']);
                }
            } elseif ($puesto) {
                if ($puesto->vehiculosAdentro() === 0) $puesto->update(['estado' => 'LIBRE']);
            }

            return response()->json(['status' => 0, 'message' => 'Salida registrada']);
        }

        // Fallback: visitante sin registro en parqueadero maestro (sin importar fecha)
        $visitanteSalida = ControlIngreso::where('identificacion', $idClean)
            ->whereNull('salida')->latest('id')->first();
            
        $bitacora = BitacoraParqueadero::where('cedula', $idClean)
            ->whereNull('hora_salida')->latest('id')->first();

        if ($visitanteSalida || $bitacora) {
            if ($visitanteSalida) {
                $visitanteSalida->update(['hora_salida' => $hora, 'salida' =>  auth()->user()->name . ' a las ' . $hora]);
            }
            
            if ($bitacora) {
                $notaFinal = $novedades
                    ? ($bitacora->novedades ? $bitacora->novedades . ' | SALIDA: ' . $novedades : 'SALIDA: ' . $novedades)
                    : $bitacora->novedades;
                
                $bitacora->hora_salida = $hora;
                $bitacora->quien_registro_salida =  auth()->user()->name;
                $bitacora->novedades = $notaFinal;
                $bitacora->save();

                if (!empty($novedades)) {
                    $bitacora->tipo_ingreso = 'SALIDA_VISITANTE';
                    $this->notificarCoordinadores($bitacora, $novedades);
                }
            }
            return response()->json(['status' => 0, 'message' => 'Salida de visitante registrada']);
        }

        return response()->json(['status' => 1, 'message' => 'No se encontró ingreso activo.']);
    }

    public function registrareinngreso(Request $request, $id)
    {
        $fechaA = Carbon::now()->toDateString();
        $hora   = Carbon::now()->totimeString();
        if ($request->ajax()) {
            $controlViejo = ControlIngreso::find($id);
            if ($controlViejo) {
                $control = $controlViejo->replicate();
                $control->fecha_ingreso = $fechaA;
                $control->hora_ingreso  = $hora;
                $control->ingreso       =  auth()->user()->name . ' a las ' . $hora;
                $control->salida        = null;
                $control->hora_salida   = null;
                $control->save();
                if ($control->parqueadero) {
                    $puesto = Parqueadero::find($control->parqueadero);
                    if ($puesto) {
                        // Validar si el puesto físico está inactivo antes de reingresar
                        $physPuesto = $puesto->puesto; // Relación a UsoParqueadero
                        if ($physPuesto && $physPuesto->estado === 'INACTIVO') {
                            $control->delete(); // Eliminar la réplica creada líneas arriba
                            return response()->json(['status' => 1, 'message' => "El puesto asignado ({$physPuesto->parqueadero}) se encuentra INACTIVO."]);
                        }
                        $puesto->ocupado = 'OCUPADO';
                        $puesto->save();
                        if ($puesto->parqueadero_id) {
                            UsoParqueadero::where('id', $puesto->parqueadero_id)->update(['estado' => 'OCUPADO']);
                        }
                        BitacoraParqueadero::create([
                            'cedula'                 => $control->identificacion,
                            'nombre'                 => $control->fullname,
                            'vehiculo'               => $puesto->tipo_vehiculo ?? 'VEHICULO',
                            'placa'                  => strtoupper($puesto->placa ?? 'N/A'),
                            'fecha'                  => $fechaA,
                            'hora_ingreso'           => $hora,
                            'quien_registro_ingreso' =>  auth()->user()->name,
                            'parqueadero'            => $puesto->id,
                            'no_puesto'              => $puesto->no_parqueadero,
                            'edificio'               => $puesto->edificio,
                            'porteria'               =>  auth()->user()->direccion_porteria ?? 'GENERAL',
                            'tipo_ingreso'           => 'REINGRESO',
                        ]);
                    }
                }
                return response()->json(['status' => 0, 'message' => 'Reingreso registrado']);
            }
            return response()->json(['status' => 1, 'message' => 'Registro no encontrado']);
        }
    }

    public function registrarIngresoVeh(Request $request, $id)
    {
        $fechaA      = Carbon::now()->toDateString();
        $hora        = Carbon::now()->totimeString();
        $novedades   = $request->novedades ? strtoupper(trim($request->novedades)) : null;
        $parqueadero = Parqueadero::find($request->parq);
        if (!$parqueadero) return response()->json(['status' => 1, 'message' => 'Registro no encontrado']);

        // Validación restricción de día (Particular: solo L-V, salvo permiso especial)
        $errorDia = $this->validarDiaIngreso($parqueadero);
        if ($errorDia) return response()->json($errorDia);

        $puesto = UsoParqueadero::find($parqueadero->parqueadero_id);
        if ($puesto) {
            if ($puesto->estado === 'INACTIVO') {
                return response()->json(['status' => 1, 'message' => "El puesto ({$puesto->parqueadero}) está INACTIVO."]);
            }
            $cap = intval($puesto->capacidad ?? 1);
            $ids = $puesto->asignaciones()->pluck('id');
            // Capacidad total de vehículos con ingreso activo en ese puesto
            $adentro = ControlIngreso::whereIn('parqueadero', $ids)
                ->whereNull('salida')->count();
            if ($adentro >= $cap) return response()->json(['status' => 1, 'message' => "Puesto lleno: {$adentro}/{$cap}."]);
        }
        
        $ultimoControl = ControlIngreso::where('parqueadero', $request->parq)->latest('id')->first();
        if ($ultimoControl && is_null($ultimoControl->salida)) {
            return response()->json(['status' => 1, 'message' => 'Este vehículo ya está registrado adentro. Debe registrar la salida antes de volver a ingresar.']);
        }
        
        $ingreso = ControlIngreso::create([
            'identificacion'     => $parqueadero->cedula,
            'fullname'           => $parqueadero->nombre,
            'fecha_ingreso'      => $fechaA,
            'hora_ingreso'       => $hora,
            'ingreso'            =>  auth()->user()->name . ' a las ' . $hora,
            'despacho'           => ($parqueadero->juzgado ?? '') . ' ' . ($parqueadero->especialidad ?? ''),
            'quien_solicito'     => '0000',
            'tipo_solicitud'     => 'EMPLEADO',
            'vehiculo_autorizado'=> 'AUTORIZADO',
            'parqueadero'        => $request->parq,
            'porteria'           =>  auth()->user()->direccion_porteria ?? null,
        ]);
        $vehiculo = Vehiculo::updateOrCreate(
            ['placa' => strtoupper($parqueadero->placa)],
            ['tipo' => strtoupper($parqueadero->tipo_vehiculo), 'caracteristicas' => strtoupper($parqueadero->descripcion_vehiculo)]
        );
        $ingreso->vehiculo = $vehiculo->id; $ingreso->save();
        if ($puesto) $puesto->update(['estado' => 'OCUPADO']);
        $bitacora = BitacoraParqueadero::create([
            'cedula'                 => $parqueadero->cedula,
            'nombre'                 => $parqueadero->nombre,
            'vehiculo'               => $parqueadero->tipo_vehiculo,
            'placa'                  => strtoupper($parqueadero->placa),
            'fecha'                  => $fechaA,
            'hora_ingreso'           => $hora,
            'quien_registro_ingreso' =>  auth()->user()->name,
            'parqueadero'            => $request->parq,
            'no_puesto'              => $parqueadero->no_parqueadero,
            'ciudad'                 => $parqueadero->ciudad,
            'edificio'               => $parqueadero->edificio,
            'porteria'               =>  auth()->user()->direccion_porteria ?? null,
            'tipo_ingreso'           => 'EMPLEADO',
            'novedades'              => $novedades,
        ]);
        $parqueadero->ocupado = 'OCUPADO'; $parqueadero->save();
        if (!empty($novedades)) {
            try {
                $this->notificarCoordinadores($bitacora, $novedades);
            } catch (\Throwable $e) {
                \Log::error('[Parqueadero] Fallo crítico al invocar notificación (Dos): ' . $e->getMessage());
            }
        }
        return response()->json(['status' => 0, 'message' => 'Ingreso registrado']);
    }

    public function registrarSalidaVeh(Request $request, $id)
    {
        $fechaA      = Carbon::now()->toDateString();
        $hora        = Carbon::now()->totimeString();
        $parqueadero = Parqueadero::find($request->parq);
        if (!$parqueadero) return response()->json(['status' => 1, 'message' => 'Registro no encontrado']);

        if (strtoupper(trim($parqueadero->calidad_vehiculo ?? '')) === 'OFICIAL') {
            $insp = \App\Models\Inspeccion::where('placa', $parqueadero->placa)
                ->where('fecha', $fechaA)
                ->latest('id')
                ->first();
                
            if (!$insp) {
                return response()->json(['status' => 1, 'message' => 'El vehículo oficial no tiene diagnóstico (inspección) registrado para hoy. No se permite la salida.']);
            }
            
            if ($insp->estado === 'NO APTO') {
                return response()->json(['status' => 1, 'message' => 'El vehículo oficial fue diagnosticado como NO APTO. No se permite la salida.']);
            }
        }
        
        $ingresoActivo = ControlIngreso::where('identificacion', $id)
            ->where('parqueadero', $request->parq)->whereNull('salida')->latest('id')->first();
            
        if($ingresoActivo) {
            $ingresoActivo->update(['hora_salida' => $hora, 'salida' =>  auth()->user()->name . ' a las ' . $hora]);
        }
        
        $bitacoraActiva = BitacoraParqueadero::where('parqueadero', $request->parq)->where('cedula', $id)
            ->whereNull('hora_salida')->latest('id')->first();
        if ($bitacoraActiva) {
            $bitacoraActiva->update(['hora_salida' => $hora, 'quien_registro_salida' =>  auth()->user()->name]);
        }
            
        $parqueadero->ocupado = 'LIBRE'; $parqueadero->save();
        if ($parqueadero->parqueadero_id) {
            $puesto = UsoParqueadero::find($parqueadero->parqueadero_id);
            if ($puesto) {
                $aun = ControlIngreso::whereIn('parqueadero', $puesto->asignaciones()->pluck('id'))
                    ->whereNull('salida')->count();
                if ($aun === 0) $puesto->update(['estado' => 'LIBRE']);
            }
        }
        return response()->json(['status' => 0, 'message' => 'Salida registrada']);
    }

    public function verificaringresoParqueadero(Request $request, $id)
    {
        $fechaA  = Carbon::now()->toDateString();
        $idClean = strtoupper(str_replace([' ', '-', '.'], '', trim($id)));
        $restriccion = RestriccionLaboral::where('cedula', $idClean)->first();
        if ($restriccion) {
            return response()->json([[
                'Restriccion' => $restriccion->orientacion_para_seccional,
                'cedula'      => $restriccion->cedula,
                'nombre'      => $restriccion->nombre,
                'impedimento' => 'rest',
            ]]);
        }
        $miSeccionales = array_filter(array_map('trim', explode(',', strtoupper( auth()->user()->seccional ?? ''))));
        $array = [];

        // --- 2. CONSULTA EN PARQUEADERO (Eloquent + Relación) ---
        $parqueaderos = Parqueadero::with('puesto')
            ->where('estado', 'ACTIVO')
            ->where(function ($q) use ($idClean) {
                $q->where('cedula', $idClean)
                  ->orWhereRaw("UPPER(REPLACE(REPLACE(placa,' ',''),'-','')) = ?", [$idClean]);
            })
            ->get();

        // --- 3. Visitantes (Solo por Cédula y que estén ADENTRO sin importar fecha) ---
        $visitantes = ControlIngreso::where('identificacion', $idClean)
            ->whereNull('salida')
            ->get();

        if ($parqueaderos->isEmpty() && $visitantes->isEmpty()) return response()->json(null);

        foreach ($parqueaderos as $p) {
            $puesto    = $p->puesto;
            $edificio  = strtoupper(trim($puesto->edificio ?? $p->edificio ?? ''));
            
            $ultimoBitacora = BitacoraParqueadero::where('parqueadero', $p->id)->latest('id')->first();
            $yaIngreso = $ultimoBitacora && is_null($ultimoBitacora->hora_salida);
            
            $permitido = true; $msg = '';
            
            // Validación de parqueadero no asignado o en blanco
            if (!$puesto && empty($p->no_parqueadero)) {
                $permitido = false; 
                $msg = "EL VEHÍCULO NO TIENE UN PUESTO DE PARQUEADERO ASIGNADO.";
            }

            // Validación de portería/edificio
            if ($permitido && !empty($miSeccionales) && !empty($edificio) && !in_array($edificio, $miSeccionales)) {
                $permitido = false; $msg = "Debe ingresar por: {$edificio}";
            }

            // Validación de capacidad y estado (INACTIVO)
            $puestoLleno = false;
            if (!$yaIngreso && $puesto) {
                if ($puesto->estado === 'INACTIVO') {
                    $permitido = false;
                    $msg = "Puesto ({$puesto->parqueadero}) se encuentra INACTIVO.";
                } elseif (!$puesto->tieneCapacidad()) {
                    $puestoLleno = true;
                    $msg = "Puesto lleno: " . $puesto->vehiculosAdentro() . "/" . ($puesto->capacidad ?? 1) . " vehículos adentro";
                    $permitido = false;
                }
            }

            $array[] = [
                'id_parq'              => $p->id,
                'cedula'               => $p->cedula,
                'nombre'               => $p->nombre,
                'juzgado'              => trim(($p->cargo ?? '') . ' ' . ($p->juzgado ?? '') . ' ' . ($p->especialidad ?? '')) ?: 'N/A',
                'empresa'              => $p->empresa,
                'placa'                => strtoupper($p->placa),
                'tipo_vehiculo'        => $p->tipo_vehiculo,
                'descripcion_vehiculo' => $p->descripcion_vehiculo ?? '',
                'ocupado'              => $p->ocupado,
                'ya_ingreso'           => $yaIngreso,
                'no_puesto'            => $puesto->parqueadero ?? $p->no_parqueadero ?? 'N/A',
                'parqueadero_disponible' => $puesto->parqueadero ?? $p->no_parqueadero ?? 'N/A',
                'edificio'             => $edificio ?: 'N/A',
                'ubicacion_detalle'    => trim(($puesto->parqueadero ?? $p->no_parqueadero ?? '') . ' · ' . $edificio),
                'permitido_porteria'   => $permitido,
                'mensaje_porteria'     => $msg,
                'puesto_lleno'         => $puestoLleno,
                'calidad'              => $p->calidad ?? 'PERMANENTE',
                'impedimento'          => 'no',
                'novedades_hoy'        => BitacoraParqueadero::where('parqueadero', $p->id)->where('fecha', $fechaA)->whereNotNull('novedades')->latest()->value('novedades') ?? '',
                'mas'                  => $parqueaderos->count() > 1 ? 2 : 1,
                'capacidad_puesto'     => $puesto->capacidad ?? 1,
                'adentro_hoy'          => $puesto ? $puesto->vehiculosAdentro() : 0,
            ];
        }
        foreach ($visitantes as $v) {
            $array[] = [
                'id_parq' => null, 'cedula' => $v->identificacion, 'nombre' => $v->fullname,
                'juzgado' => $v->despacho ?? 'N/A', 'placa' => strtoupper($v->placa ?? 'N/A'),
                'tipo_vehiculo' => 'VISITANTE', 'descripcion_vehiculo' => '',
                'ocupado' => is_null($v->salida) ? 'ADENTRO' : 'LIBRE',
                'ya_ingreso' => is_null($v->salida), 'no_puesto' => 'VISITANTE',
                'parqueadero_disponible' => 'VISITANTE', 'edificio' => 'N/A',
                'permitido_porteria' => true, 'mensaje_porteria' => '', 'calidad' => 'VISITANTE',
                'impedimento' => 'no', 'novedades_hoy' => '', 'mas' => 1,
                'capacidad_puesto' => 1,
                'adentro_hoy' => 0,
            ];
        }
        return response()->json($array);
    }

    public function CoordVerificarIngreso(Request $request, $id)
    {
        $fechaA    = Carbon::now()->toDateString();
        $registros = ControlIngreso::where('identificacion', $id)->where('fecha_ingreso', $fechaA)->get();
        if ($registros->isEmpty()) return response()->json(null);
        $results = [];
        foreach ($registros as $r) {
            $vehiculoIng = ($r->vehiculo_autorizado === 'AUTORIZADO') ? Vehiculo::find($r->vehiculo) : null;
            array_push($results, $r, $vehiculoIng);
        }
        return response()->json($results);
    }

    public function contarUsuarios(?Request $request = null)
    {
        $count  = BitacoraParqueadero::whereNull('hora_salida')->distinct('cedula')->count('cedula');
        return response()->json($count);
    }

    public function verificarVehiculo(Request $request, $id)
    {
        $ctrl = ControlIngreso::find($id);
        if ($ctrl && $ctrl->vehiculo) return response()->json(Vehiculo::find($ctrl->vehiculo));
        return response()->json(null);
    }

    public function autorizarVehiculo(Request $request, $id)
    {
        $ctrl = ControlIngreso::find($id);
        if (!$ctrl) return response()->json(['mensaje' => 'No se puede autorizar']);
        ControlIngreso::where('identificacion', $ctrl->identificacion)
            ->where('vehiculo', $ctrl->vehiculo)->where('vehiculo_autorizado', 'PENDIENTE')
            ->update(['vehiculo_autorizado' => 'AUTORIZADO']);
        return response()->json(['mensaje' => 'Vehículo Autorizado']);
    }

    public function denegarVehiculo(Request $request, $id)
    {
        $ctrl = ControlIngreso::find($id);
        if (!$ctrl) return response()->json(['mensaje' => 'Error al negar']);
        ControlIngreso::where('identificacion', $ctrl->identificacion)
            ->where('vehiculo', $ctrl->vehiculo)->where('vehiculo_autorizado', 'PENDIENTE')
            ->update(['vehiculo_autorizado' => 'NEGADO']);
        return response()->json(['mensaje' => 'Ingreso negado']);
    }

    public function reportarSalida(Request $request, $id)
    {
        $fechaA    = Carbon::now()->toDateString();
        $hora      = Carbon::now()->totimeString();
        $registros = ControlIngreso::where('identificacion', $id)->where('fecha_ingreso', $fechaA)
            ->whereNotNull('ingreso')->where('hora_ingreso', '<', $hora)->whereNull('salida')->get();
        if ($registros->isEmpty()) return response()->json(['mensaje' => 'No ha reportado ingreso o ya lo realizó']);
        foreach ($registros as $r) { $r->salida =  auth()->user()->name . ' a las ' . $hora; $r->hora_salida = $hora; $r->save(); }
        return response()->json(['mensaje' => 'Registro de salida exitoso']);
    }

    public function DescargarRegistroParq()
    {
        $date = Carbon::now()->toDateString();
        if (!ControlIngreso::whereDate('created_at', $date)->exists()) {
            Session::flash('message', 'No se encontraron datos para generar el excel');
            return $this->index();
        }
        $products = DB::select('SELECT identificacion, fullname as nombre, fecha_ingreso, hora_ingreso, despacho,
            (SELECT tipo FROM vehiculos WHERE vehiculos.id = control_ingresos.vehiculo) as vehiculo,
            (SELECT placa FROM vehiculos WHERE vehiculos.id = control_ingresos.vehiculo) as placa,
            (SELECT no_parqueadero FROM parqueadero WHERE parqueadero.id = control_ingresos.parqueadero) as parqueadero
            FROM control_ingresos WHERE DATE(created_at) = ?', [$date]);
        return response()->streamDownload(function () use ($products) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Identificacion', 'Nombre', 'Fecha', 'Hora Ingreso', 'Despacho', 'Vehiculo', 'Placa', 'Parqueadero']);
            foreach ($products as $row) fputcsv($out, (array) $row);
            fclose($out);
        }, 'ingreso_parqueadero_' . $date . '.csv');
    }

    private function notificarCoordinadores($bitacora, string $novedades): void
    {
        try {
            
            
            // 1. Obtener correos de coordinadores (Rol 10)
            // Filtramos nulos, vacíos y aseguramos que sean correos válidos
            $coordinadores = User::where('rol', 10)
                ->whereNotNull('email')
                ->where('email', '<>', '')
                ->pluck('email')
                ->filter(function($email) {
                    return filter_var($email, FILTER_VALIDATE_EMAIL);
                })
                ->unique()
                ->toArray();

            if (empty($coordinadores)) {
                \Log::warning('[Parqueadero] No hay coordinadores (Rol 10) con correo válido para notificar.');
                return;
            }

            // 2. Preparar el mailable
            $mailable = new NovedadParqueaderoMail($bitacora, $novedades);

            // 3. Enviar
            Mail::to($coordinadores)->send($mailable);

            \Log::info('[Parqueadero] Notificación enviada a: ' . implode(', ', $coordinadores));
            
        } catch (\Throwable $e) {
            \Log::error('[Parqueadero] Error crítico notificando novedad: ' . $e->getMessage(), [
                'placa'     => $bitacora->placa ?? 'N/A',
                'novedades' => $novedades,
                'file'      => $e->getFile(),
                'line'      => $e->getLine()
            ]);
        }
    }
}

