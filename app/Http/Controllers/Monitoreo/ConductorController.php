<?php

namespace App\Http\Controllers\Monitoreo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Inspeccion;
use App\Models\InspeccionDetalle;
use App\Models\ConductorNovedad;
use App\Models\Conductor;
use App\Models\Vehiculo;
use App\Models\Parqueadero;
use App\Models\Empleado;
use App\Models\User;

use Barryvdh\DomPDF\Facade as PDF;

class ConductorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('conductor');
    }

    /**
     * Dashboard del Módulo de Conductores.
     */
    public function index()
    {
        $hoy = Carbon::today()->toDateString();

        // 1. Contadores del Semáforo
        $totalAptos = Inspeccion::where('fecha', $hoy)->where('estado', 'APTO')->count();
        $totalObservaciones = Inspeccion::where('fecha', $hoy)->where('estado', 'OBSERVACIONES')->count();
        $totalNoAptos = Inspeccion::where('fecha', $hoy)->where('estado', 'NO APTO')->count();

        $cedula = auth()->user()->cedula;

        // 2. Comprobar si el conductor tiene restricciones (por fechas o marcadas manualmente como exclusivas)
        $tieneRestriccion = Parqueadero::where('estado', 'ACTIVO')
            ->whereRaw('LOWER(calidad_vehiculo) = ?', ['oficial'])
            ->where('cedula', $cedula)
            ->where(function($q) use ($hoy) {
                $q->where('exclusivo_para_conductor', true)
                  ->orWhere(function($q2) use ($hoy) {
                      $q2->where('asignacion_tipo', 'fechas')
                         ->where('asignacion_inicio', '<=', $hoy)
                         ->where('asignacion_fin', '>=', $hoy);
                  });
            })
            ->exists();

        if ($tieneRestriccion) {
            // Regla 1: Si tiene restricción activa, SÓLO ve TODOS los vehículos que tenga asignados (pero no libres ni de otros)
            $vehiculosOficiales = Parqueadero::where('estado', 'ACTIVO')
                ->whereRaw('LOWER(calidad_vehiculo) = ?', ['oficial'])
                ->where('cedula', $cedula)
                ->get();
        } else {
            // Regla 2: Puede ver los suyos definitivos, los libres, y los de otros si son visibles
            $vehiculosOficiales = Parqueadero::where('estado', 'ACTIVO')
                ->whereRaw('LOWER(calidad_vehiculo) = ?', ['oficial'])
                ->where('oculto_para_conductores', false)
                ->where(function ($query) use ($cedula) {
                    $query->where('cedula', $cedula) // Los suyos
                          ->orWhereNull('cedula')    // Los no asignados
                          ->orWhere(function ($q2) { 
                              // Los de otros que tienen permiso de ser visibles
                              $q2->whereNotNull('cedula')
                                 ->where('visible_para_otros', true);
                          });
                })
                ->get();
        }

        // Determinar estado de inspección para cada uno hoy
        foreach ($vehiculosOficiales as $v) {
            $insp = Inspeccion::where('placa', $v->placa)
                ->where('conductor_cedula', auth()->user()->cedula)
                ->where('fecha', $hoy)
                ->latest('id')
                ->first();
            $v->inspeccion_hoy = $insp;
            $v->inspeccion_estado = $insp ? $insp->estado : 'PENDIENTE';
        }

        // 3. Novedades activas hoy
        $novedadesQuery = ConductorNovedad::with(['conductor', 'vehiculo'])
            ->where('estado', 'PENDIENTE');
            
        if (auth()->user()->rol == 27) {
            $novedadesQuery->where('conductor_cedula', auth()->user()->cedula);
        }
            
        $novedades = $novedadesQuery->orderBy('id', 'DESC')->get();

        return view('monitoreo.conductores.index', compact('totalAptos', 'totalObservaciones', 'totalNoAptos', 'vehiculosOficiales', 'novedades'));
    }

    /**
     * AJAX: Buscar información de conductor por cédula.
     */
    public function buscarConductor($cedula)
    {
        $cedulaClean = strtoupper(str_replace([' ', '-', '.'], '', trim($cedula)));
        
        // 1. Buscar en tabla conductores
        $conductor = Conductor::where('cedula', $cedulaClean)->first();
        
        if ($conductor) {
            return response()->json([
                'success' => true,
                'conductor' => ['cedula' => $conductor->cedula],
                'nombre_completo' => strtoupper($conductor->nameE . ' ' . $conductor->lastnameE)
            ]);
        }

        // 2. Buscar en users (rol 27 = conductor)
        $user = User::where('cedula', $cedulaClean)->where('rol', 27)->first();
        if ($user) {
            // Registrar en conductores para futura referencia
            $conductor = Conductor::firstOrCreate(
                ['cedula' => $user->cedula],
                ['nameE' => $user->name, 'lastnameE' => $user->lastname ?? '']
            );
            return response()->json([
                'success' => true,
                'conductor' => ['cedula' => $user->cedula],
                'nombre_completo' => strtoupper($user->name . ' ' . $user->lastname)
            ]);
        }

        // 3. Fallback a Empleado
        $empleado = Empleado::where('cedulaE', $cedulaClean)->first();
        if ($empleado) {
            $conductor = Conductor::firstOrCreate(
                ['cedula' => $empleado->cedulaE],
                ['nameE' => $empleado->nameE, 'lastnameE' => $empleado->lastnameE]
            );
            return response()->json([
                'success' => true,
                'conductor' => ['cedula' => $empleado->cedulaE],
                'nombre_completo' => strtoupper($empleado->nameE . ' ' . $empleado->lastnameE)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Conductor no encontrado. Verifique que esté registrado en el sistema como conductor.'
        ]);
    }

    /**
     * Formulario para crear inspección preoperativa de un vehículo oficial.
     */
    public function crearInspeccion($placa)
    {
        $placaClean = strtoupper(str_replace([' ', '-', '.'], '', trim($placa)));
        
        // El vehículo oficial debe estar registrado y activo en parqueadero
        $vehiculoParqueadero = Parqueadero::with('puesto')
            ->where('estado', 'ACTIVO')
            ->where('calidad_vehiculo', 'OFICIAL')
            ->whereRaw("UPPER(REPLACE(REPLACE(placa,' ',''),'-','')) = ?", [$placaClean])
            ->first();

        if (!$vehiculoParqueadero) {
            return redirect()->route('conductores.index')
                ->with('error', 'El vehículo oficial con placa ' . $placa . ' no está registrado o activo en el sistema.');
        }

        // Definir si es Moto o Carro
        $tipoVehiculo = (str_contains(strtoupper($vehiculoParqueadero->tipo_vehiculo ?? ''), 'MOTO') 
            || str_contains(strtoupper($vehiculoParqueadero->descripcion_vehiculo ?? ''), 'MOTO')) 
            ? 'MOTOCICLETA' : 'VEHICULO';

        // Obtener preguntas F-SGSST-105 (Vehículo) o F-SGSST-109 (Moto)
        $preguntas = $this->getChecklistPreguntas($tipoVehiculo);

        return view('monitoreo.conductores.inspeccion_form', compact('vehiculoParqueadero', 'tipoVehiculo', 'preguntas'));
    }

    /**
     * Guardar inspección preoperativa y determinar estado del semáforo.
     */
    public function guardarInspeccion(Request $request)
    {
        $request->validate([
            'placa' => 'required|string',
            'conductor_cedula' => 'required|string',
            'tipo_vehiculo' => 'required|string',
            'kilometraje' => 'required|integer',
            'respuestas' => 'required|array',
            'observaciones_items' => 'nullable|array',
            'observaciones' => 'nullable|string',
            'firma' => 'nullable|string'
        ]);

        $vehiculo = Parqueadero::where('placa', $request->placa)->firstOrFail();

        $placa = strtoupper($request->placa);
        $cedula = $request->conductor_cedula;
        $tipoVehiculo = $request->tipo_vehiculo;
        $kilometraje = $request->kilometraje;
        $respuestas = $request->respuestas;
        $observacionesItems = $request->observaciones_items ?? [];
        $firma = $request->firma;

        // Determinar ítems críticos según tipo de vehículo
        $criticos = $this->getCriticalItems($tipoVehiculo);
        
        $estado = 'APTO'; // Por defecto
        $detallesAGuardar = [];
        $failedItems = [];

        $preguntas = $this->getChecklistPreguntas($tipoVehiculo);

        foreach ($preguntas as $grupoKey => $grupo) {
            foreach ($grupo['items'] as $itemKey => $itemName) {
                $resultado = $respuestas[$itemKey] ?? 'SI';
                $observacion = $observacionesItems[$itemKey] ?? null;

                $esFalloEnSi = in_array($itemKey, [
                    'simit_comparendos', 
                    'salud_alcohol', 
                    'salud_estado_general', 
                    'salud_estado_emocional', 
                    'salud_estado_visual'
                ]);

                $esFallo = $esFalloEnSi ? ($resultado === 'SI') : ($resultado === 'NO');

                // Si hay fallo, validar que tenga observación obligatoria
                if ($esFallo) {
                    if (empty(trim($observacion))) {
                        return back()->withInput()->with('error', 'El ítem "' . $itemName . '" marcó una alerta (' . $resultado . '). Es obligatorio escribir una observación.');
                    }
                    
                    $failedItems[] = $itemName . ': ' . $observacion;

                    // Si es un ítem crítico o un fallo grave de salud/comparendos, queda NO APTO
                    if (in_array($itemKey, $criticos) || $esFalloEnSi) {
                        $estado = 'NO APTO';
                    } elseif ($estado !== 'NO APTO') {
                        $estado = 'OBSERVACIONES';
                    }
                }

                $detallesAGuardar[] = [
                    'grupo' => $grupo['titulo'],
                    'item' => $itemKey,
                    'nombre_item' => $itemName,
                    'resultado' => $resultado,
                    'observacion' => $observacion
                ];
            }
        }

        DB::beginTransaction();
        try {
            // Guardar Cabecera de Inspección
            $inspeccion = Inspeccion::create([
                'placa' => $placa,
                'conductor_cedula' => $cedula,
                'fecha' => Carbon::today()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'tipo_vehiculo' => $tipoVehiculo,
                'kilometraje' => $kilometraje,
                'estado' => $estado,
                'observaciones' => $request->observaciones,
                'firma_conductor' => $firma,
                'quien_registro' => auth()->user()->name
            ]);

            // Guardar Detalles
            foreach ($detallesAGuardar as $d) {
                $d['inspeccion_id'] = $inspeccion->id;
                InspeccionDetalle::create($d);
            }

            // Actualizar el vehículo en parqueadero para que la portería vea quién lo conduce hoy
            $vehiculo->cedula = $cedula;
            $conductorModel = Conductor::where('cedula', $cedula)->first();
            if ($conductorModel) {
                $vehiculo->nombre = strtoupper($conductorModel->nameE . ' ' . $conductorModel->lastnameE);
            } else {
                $vehiculo->nombre = auth()->user()->name;
            }
            $vehiculo->save();

            // Registrar Novedad automática si el vehículo quedó NO APTO
            if ($estado === 'NO APTO') {
                ConductorNovedad::create([
                    'placa' => $placa,
                    'conductor_cedula' => $cedula,
                    'inspeccion_id' => $inspeccion->id,
                    'fecha' => Carbon::today()->toDateString(),
                    'descripcion' => 'Vehículo marcado como NO APTO en inspección preoperativa diaria. Detalles fallidos: ' . implode(' | ', $failedItems),
                    'estado' => 'PENDIENTE'
                ]);
            }

            DB::commit();

            try {
                // Notificar por correo a Coordinadores y al Conductor
                $coordinadores = User::where('rol', 10)->whereNotNull('email')->get();
                $destinatarios = $coordinadores->pluck('email')->toArray();
                
                $correoConductor = auth()->user()->email;
                if (!empty($correoConductor) && !in_array($correoConductor, $destinatarios)) {
                    $destinatarios[] = $correoConductor;
                }
                
                if (count($destinatarios) > 0) {
                    $dataEmail = [
                        'inspeccion' => $inspeccion,
                        'failedItems' => $failedItems
                    ];
                    
                    Mail::send('emails.monitoreo.inspeccion_vehiculo', $dataEmail, function ($message) use ($destinatarios, $placa) {
                        $message->from('informacion@disajcali.gov.co', 'Sistema SIRIS CALI');
                        $message->to($destinatarios);
                        $message->subject('Inspección Preoperativa - Vehículo ' . strtoupper($placa));
                    });
                }
            } catch (\Exception $e) {
                \Log::error('Error al enviar correo de inspección: ' . $e->getMessage());
            }

            return redirect()->route('conductores.index')
                ->with('success', 'Inspección preoperativa de la placa ' . $placa . ' guardada con éxito. Estado: ' . $estado);

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al guardar la inspección: ' . $e->getMessage());
        }
    }

    /**
     * Ver detalles completos de una inspección preoperativa.
     */
    public function verInspeccion($id)
    {
        $inspeccion = Inspeccion::with(['detalles', 'conductor'])->findOrFail($id);
        
        // Obtener datos del vehículo oficial
        $vehiculo = Parqueadero::where('placa', $inspeccion->placa)->where('estado', 'ACTIVO')->first();

        // Agrupar los detalles para mostrarlos organizados en la vista
        $detallesAgrupados = $inspeccion->detalles->groupBy('grupo');

        return view('monitoreo.conductores.ver_inspeccion', compact('inspeccion', 'vehiculo', 'detallesAgrupados'));
    }

    /**
     * Exportar inspección a PDF
     */
    public function exportarPdf($id)
    {
        $inspeccion = Inspeccion::with(['detalles', 'conductor'])->findOrFail($id);
        
        $vehiculo = Parqueadero::where('placa', $inspeccion->placa)->where('estado', 'ACTIVO')->first();
        $detallesAgrupados = $inspeccion->detalles->groupBy('grupo');

        if ($inspeccion->tipo_vehiculo === 'MOTOCICLETA') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('monitoreo.conductores.pdf_moto', compact('inspeccion', 'vehiculo', 'detallesAgrupados'))
                       ->setPaper('legal', 'portrait')
                       ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            return $pdf->download('inspeccion_moto_'.$inspeccion->placa.'.pdf');
        } else {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('monitoreo.conductores.pdf_carro', compact('inspeccion', 'vehiculo', 'detallesAgrupados'))
                       ->setPaper('legal', 'portrait')
                       ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            return $pdf->download('inspeccion_carro_'.$inspeccion->placa.'.pdf');
        }
    }

    /**
     * Historial de inspecciones tipo Línea de Tiempo (timeline) para un vehículo oficial.
     */
    public function historial($placa)
    {
        $placaClean = strtoupper(str_replace([' ', '-', '.'], '', trim($placa)));
        
        $vehiculo = Parqueadero::where('estado', 'ACTIVO')
            ->where('calidad_vehiculo', 'OFICIAL')
            ->whereRaw("UPPER(REPLACE(REPLACE(placa,' ',''),'-','')) = ?", [$placaClean])
            ->first();

        if (!$vehiculo) {
            return redirect()->route('conductores.index')->with('error', 'Vehículo oficial no encontrado.');
        }

        $inspecciones = Inspeccion::where('placa', $vehiculo->placa)
            ->where('conductor_cedula', auth()->user()->cedula)
            ->orderBy('fecha', 'DESC')
            ->orderBy('hora', 'DESC')
            ->get();

        return view('monitoreo.conductores.historial', compact('vehiculo', 'inspecciones'));
    }

    /**
     * Helper: Preguntas del checklist para vehículos o motos.
     */
    private function getChecklistPreguntas($tipo)
    {
        if ($tipo === 'MOTOCICLETA') {
            return [
                'condiciones_moto' => [
                    'titulo' => 'CONDICIONES DE LA MOTOCICLETA',
                    'items' => [
                        'doc_moto' => 'Documentos: Verifica la tarjeta de propiedad, SOAT y revisión técnico mecánica (si aplica)',
                        'luces_moto' => 'Luces: Verifica el funcionamiento correcto de luces altas y bajas, posición, direccionales y freno.',
                        'bocina_moto' => 'Bocina: Verifica su funcionamiento.',
                        'espejos_moto' => 'Espejos: Revisa y posiciona correctamente los espejos.',
                        'liquidos_moto' => 'Niveles de líquidos: Revisa los niveles de aceite, líquido de frenos y refrigerante (si aplica).',
                        'fugas_moto' => 'Fugas de fluidos: Revisa que no existan fugas ni humedades en el motor, suspensión, frenos y líquido refrigerante (si aplica).',
                        'frenos_moto' => 'Estado de frenos: Verifica la tensión del pedal y el estado de las pastillas.',
                        'transmision_moto' => 'Transmisión: Verifica la tensión de la cadena y lubricación.',
                        'llantas_moto' => 'Estado de llantas: Verifica la profundidad del labrado, presión, cortaduras o protuberancia.',
                        'kit_prevencion' => 'Kit de prevención: Revisa las herramientas y el impermeable.'
                    ]
                ],
                'epp' => [
                    'titulo' => 'ELEMENTOS DE PROTECCIÓN PERSONAL (EPP)',
                    'items' => [
                        'casco' => 'Casco: Revisa el estado estructural, no fisuras ni partes rotas',
                        'chaleco' => 'Chaleco reflectivo',
                        'equipo_lluvia' => 'Equipo de lluvia: Zapatos resortados y sellados con suela tipo PVC, Cintas adhesivas en brazos, piernas y espalda, Chaqueta con capucha, ajuste frontal por medio de broches y Pantalón resortado en la cintura.',
                        'botas_seguridad' => 'Botas de seguridad',
                        'guantes' => 'Guantes'
                    ]
                ],
                'salud' => [
                    'titulo' => 'REPORTE DE LAS CONDICIONES DE SALUD DEL CONDUCTOR*',
                    'items' => [
                        'salud_descanso' => 'Horas de descanso Previas (Mínimo 7)',
                        'salud_alcohol' => 'Consumo de alcohol, medicamentos o sustancias psicoactivas',
                        'salud_estado_general' => 'Estado general de salud (dolor, mareo, fiebre, fatiga, estrés)',
                        'salud_estado_emocional' => 'Estado emocional (alteración, ansiedad, malestar)',
                        'salud_estado_visual' => 'Estado visual y auditivo',
                        'salud_buena_condicion' => 'Doy fe de mi buena condición de salud para conducir'
                    ]
                ]
            ];
        }

        // F-SGSST-105 (Vehículo/Automóvil/Camioneta)
        return [
            'revision_simit' => [
                'titulo' => 'REVISIÓN SIMIT',
                'items' => [
                    'simit_revisado' => '¿Revisó el día anterior de conducción, o el día de hoy, la plataforma SIMIT, para verificar comparendos registrados al automotor?',
                    'simit_comparendos' => 'En la revisión del SIMIT, ¿se encontraron comparendos impuestos al automotor?'
                ]
            ],
            'documentacion' => [
                'titulo' => 'DOCUMENTACIÓN',
                'items' => [
                    'documentacion_completa' => '¿Cuenta usted con la documentación completa? (Si marca NO, indique los faltantes en observaciones)'
                ]
            ],
            'estado_vehiculo' => [
                'titulo' => 'ESTADO DEL VEHÍCULO Y NIVELES',
                'items' => [
                    'luces_externas' => 'Estado de las luces externas del vehículo',
                    'espejos' => 'Estado de los espejos',
                    'llantas' => 'Estado de las llantas',
                    'aceite' => 'Estado del aceite',
                    'liquido_frenos' => 'Nivel del líquido de frenos',
                    'refrigerante' => 'Nivel del refrigerante',
                    'limpiabrisas' => 'Nivel del líquido limpiabrisas, estado del limpiabrisas y parabrisas',
                    'liquido_direccion' => 'Nivel del líquido de la dirección',
                    'cinturon_seguridad' => 'Estado del cinturón de seguridad',
                    'equipo_carretera' => 'Estado del equipo de carreteras y el botiquín'
                ]
            ],
            'salud' => [
                'titulo' => 'REPORTE DE LAS CONDICIONES DE SALUD DEL CONDUCTOR*',
                'items' => [
                    'salud_descanso' => 'Horas de descanso Previas (Mínimo 7)',
                    'salud_alcohol' => 'Consumo de alcohol, medicamentos o sustancias psicoactivas',
                    'salud_estado_general' => 'Estado general de salud (dolor, mareo, fiebre, fatiga, estrés)',
                    'salud_estado_emocional' => 'Estado emocional (alteración, ansiedad, malestar)',
                    'salud_estado_visual' => 'Estado visual y auditivo',
                    'salud_buena_condicion' => 'Doy fe de mi buena condición de salud para conducir'
                ]
            ]
        ];
    }

    /**
     * Helper: Obtener lista de ítems críticos que provocan estado NO APTO si se marcan como NO.
     */
    private function getCriticalItems($tipo)
    {
        if ($tipo === 'MOTOCICLETA') {
            return [
                'doc_moto',
                'luces_moto',
                'frenos_moto',
                'llantas_moto',
                'casco'
            ];
        }

        return [
            'documentacion_completa',
            'luces_externas',
            'llantas',
            'liquido_frenos',
            'cinturon_seguridad'
        ];
    }
}
