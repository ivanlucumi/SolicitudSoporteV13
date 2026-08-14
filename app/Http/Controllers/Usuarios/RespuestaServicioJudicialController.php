<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\ServicioJudicial;
use Illuminate\Validation\Rule;


class RespuestaServicioJudicialController extends Controller
{
    
     //
    public function __construct(){
         $this->middleware('auth');
        // $this->middleware('Reparto');

     }
     
     public function create()
    {
        $servicios = ServicioJudicial::serviciosPredefinidos();
        $despachos = ServicioJudicial::despachosDisponibles();
        return view('usuario.ServiciosJudiciales.form', compact('servicios', 'despachos'));
    }
    
    
public function store(Request $request)
{
    $input = $request->all();
    $user =  auth()->user();
    
    // Validar que haya al menos un servicio seleccionado
    if (!isset($input['servicios'])) {
        return back()->with('error', 'Debe seleccionar al menos un servicio.')->withInput();
    }

    $serviciosRegistrados = 0;
    $errores = [];

    foreach ($input['servicios'] as $id => $servicioData) {
        // Verificar si el servicio está seleccionado
        if (!isset($servicioData['seleccionado'])) {
            continue;
        }

        // Determinar si es un servicio personalizado
        $isCustom = isset($servicioData['custom']);
        $nombreServicio = $isCustom ? $servicioData['nombre'] : $servicioData['nombre'];

        // Validar campos requeridos
        if (empty($servicioData['tipo_servicio'])) {
            $errores[] = "El tipo de servicio es requerido para: " . $nombreServicio;
            continue;
        }

        if ($isCustom && empty($nombreServicio)) {
            $errores[] = "El nombre es requerido para servicios personalizados";
            continue;
        }

        // Verificar si el servicio ya existe para este despacho
        $servicioExistente = ServicioJudicial::where('servicio', $nombreServicio)
            ->where('despacho_id', $user->cedula)
            ->first();

        if ($servicioExistente) {
            $errores[] = "El servicio '{$nombreServicio}' ya está registrado, recarge la pagina";
            
             if ( auth()->check()) {
             auth()->user()->update(['encuesta' => 1]);
            }
            
            continue;
        }

        // Preparar datos para guardar
        $data = [
            'despacho_id' => $user->cedula,
            'despacho' => $user->name . ' ' . $user->lastname,
            'email_despacho' => $user->email,
            'servicio' => $nombreServicio,
            'tipo_servicio' => $servicioData['tipo_servicio'],
            'observaciones' => $servicioData['observacion'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        try {
            ServicioJudicial::create($data);
             auth()->user()->update(['encuesta' => 1]);
            $serviciosRegistrados++;
        } catch (\Exception $e) {
            \Log::error("Error al guardar servicio '{$nombreServicio}' - Usuario: {$user->cedula} - Error: " . $e->getMessage());
            $errores[] = "Error al guardar el servicio '{$nombreServicio}'";
        }
    }

    if (count($errores) > 0) {
        return back()
            ->with('error', implode('<br>', $errores))
            ->withInput();
    }

    if ($serviciosRegistrados > 0) {
        
        if ( auth()->check()) {
           // DD( auth()->user()->update(['encuesta' => 1]));
            // Marcar al usuario como que completó la encuesta
             auth()->user()->update(['encuesta' => 1]);
        }
        
        Session::flash('success', "Se registraron {$serviciosRegistrados} servicios exitosamente.");
        
        return redirect('/usuarios');
        
    }

    return back()
        ->with('error', 'No se registraron servicios. Verifique los datos e intente nuevamente.')
        ->withInput();
}
    

/*public function store(Request $request)
{
    $input = $request->all();

    $servicios = [
        'Alimentos en el exterior',
        'Desarchivo de procesos',
        'Radicación de demandas, acciones constitucionales y otras solicitudes',
        'Vigilancia Judicial Administrativa',
        'Información sobre el pago de sentencias y conciliaciones - DEAJ',
        'Información Reparto Oficina de Apoyo Penal',
        'Consulta órdenes de captura vigente con fecha de los hechos anterior al año 2005',
        'Depósitos Judiciales',
        'Diligencia Acta de Compromiso Penal',
        'Presentaciones personales para las medidas de aseguramiento no privativas de la libertad',
        'Autorización especiales de personas privadas de la libertad (PPL)',
        'Registro de solicitudes de audiencias de control de garantías',
        'Registro de escritos de acusación para juzgados penales de conocimiento',
        'Radicación de memoriales',
        'Consulta de programación y grabaciones de audiencias judiciales',
        'Reclamación sobre la prescripción de depósitos judiciales',
        'Trámites cobro coactivo Direcciones Seccionales',
        'Consulta de procesos nacional unificada',
        'Validación de sentencias judiciales',
        'Consulta de personas emplazadas',
        'Biblioteca Virtual - SIDN',
    ];

    // Validar que se haya seleccionado un servicio
    if (!isset($input['servicio'])) {
        return back()->with('error', 'Debe seleccionar un servicio.')->withInput();
    }

    $selectedServicio = $input['servicio'];
    $isCustom = strpos($selectedServicio, 'custom_') === 0;
    $index = $isCustom ? substr($selectedServicio, 7) : $selectedServicio;

    // Validar que el índice exista
    if (!$isCustom && !array_key_exists($index, $servicios)) {
        return back()->with('error', 'El servicio seleccionado no es válido.')->withInput();
    }

    // Reglas de validación
    $rules = [
        'servicio' => 'required|string',
        "tipo_servicio.$index" => ['required', Rule::in(['presencial', 'virtual', 'ambos'])],
        "observacion.$index" => 'nullable|string|max:500',
    ];

    if ($isCustom) {
        $rules["custom_servicio_nombre.$index"] = 'required|string|max:255';
    }

    $validated = $request->validate($rules);

    // Obtener el nombre del servicio
    $servicioNombre = $isCustom
        ? $validated['custom_servicio_nombre'][$index]
        : $servicios[$index];

    $data = [
        'despacho_id' =>  auth()->user()->cedula,
        'despacho' =>  auth()->user()->name . ' ' .  auth()->user()->lastname,
        'email_despacho' =>  auth()->user()->email,
        'servicio' => $servicioNombre,
        'tipo_servicio' => $validated['tipo_servicio'][$index],
        'observaciones' => $validated['observacion'][$index] ?? null,
        'created_at' => now(),
        'updated_at' => now(),
    ];

    // Marcar encuesta como respondida
    if ( auth()->check()) {
         auth()->user()->update(['encuesta' => 1]);
    }

    // Verificar si ya fue registrado
    $existe = ServicioJudicial::where('servicio', $data['servicio'])
        ->where('despacho_id',  auth()->user()->cedula)
        ->first();

    if ($existe) {
        return back()
            ->with('error', 'Este servicio ya ha sido registrado anteriormente por su despacho.')
            ->withInput();
    }

    try {
        ServicioJudicial::create($data);
        return back()->with('success', 'El servicio judicial ha sido registrado exitosamente.');
    } catch (\Exception $e) {
        \Log::error('Error al guardar servicio judicial - Usuario: ' .  auth()->user()->cedula . ' - Error: ' . $e->getMessage());
        return back()->with('error', 'Ocurrió un error al registrar el servicio. Intente nuevamente.')->withInput();
    }
}*/
  
}