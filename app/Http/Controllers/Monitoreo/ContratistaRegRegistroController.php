<?php

namespace App\Http\Controllers\Monitoreo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\IngresoContratista;
use App\Models\RegistroIngresoContratista;

class ContratistaRegRegistroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checarsesion');
    }

    /**
     * Vista de Registro de Ingreso (Para Portería)
     */
    public function index()
    {
        $puerta =  auth()->user()->direccion_porteria ??  auth()->user()->name;
        
        $ingresosHoy = RegistroIngresoContratista::whereDate('fecha_ingreso', Carbon::now()->toDateString())
            ->with('contratista')
            ->orderBy('id', 'desc')
            ->take(15)
            ->get()
            ->map(function($r) {
                return [
                    'hora'    => $r->hora_ingreso,
                    'cedula'  => $r->contratista->cedula ?? 'N/A',
                    'nombre'  => $r->contratista->nombre ?? 'N/A',
                    'empresa' => $r->contratista->empresa ?? 'N/A',
                    'puerta'  => $r->puerta,
                    'tipo'    => $r->tipo,
                    'foto'    => ($r->contratista && $r->contratista->foto) ? asset('contratista/' . $r->contratista->foto) : null,
                ];
            });

        return view('monitoreo.parqueadero.registro.ingreso', compact('puerta', 'ingresosHoy'));
    }

    /**
     * Busca un contratista por cédula vía Ajax (mantener para compatibilidad)
     */
    public function buscarContratista(Request $request)
    {
        $cedula = $request->get('cedula');
        $contratista = IngresoContratista::where('cedula', $cedula)->first();

        if ($contratista) {
            return response()->json([
                'found' => true,
                'contratista' => $contratista
            ]);
        }

        return response()->json(['found' => false]);
    }

    /**
     * Auto-registra el ingreso/salida del contratista (AJAX — para escáner/teclado)
     * - 1ª vez en el día: INGRESO
     * - Escaneado nuevamente: SALIDA (y así alternando)
     * Todos los eventos se registran siempre.
     */
    public function autoRegistrar(Request $request)
    {
        $cedulaRaw = $request->get('cedula');
        
        // Limpieza de escáner 2D: Intentar extraer el número de cédula (6 a 11 dígitos)
        // Si no hay un bloque largo, simplemente limpiamos espacios.
        if (preg_match('/\d{6,11}/', $cedulaRaw, $matches)) {
            $cedula = $matches[0];
        } else {
            $cedula = trim($cedulaRaw);
        }

        $puerta = strtoupper($request->get('puerta', 'PORTAL'));

        if (!$cedula) {
            return response()->json(['success' => false, 'message' => 'Ingrese un número de cédula válido.']);
        }

        $contratista = IngresoContratista::where('cedula', $cedula)->first();

        if (!$contratista) {
            return response()->json([
                'success' => false,
                'message' => 'Contratista no encontrado. Verifique la cédula o contacte al coordinador.'
            ]);
        }

        if (!$contratista->activo) {
            return response()->json([
                'success' => false,
                'message' => 'El contratista <strong>' . e($contratista->nombre) . '</strong> se encuentra <b>INACTIVO</b>. Contacte al coordinador.'
            ]);
        }

        // Contar eventos del día para este contratista
        $eventosHoy = RegistroIngresoContratista::where('contratista_id', $contratista->id)
            ->whereDate('fecha_ingreso', Carbon::now()->toDateString())
            ->count();

        // Impar de eventos previos → siguiente es INGRESO; par → SALIDA
        // 0 eventos → 1er INGRESO | 1 evento → SALIDA | 2 → INGRESO | 3 → SALIDA ...
        $tipo = ($eventosHoy % 2 === 0) ? 'INGRESO' : 'SALIDA';

        // Registrar evento (siempre)
        RegistroIngresoContratista::create([
            'contratista_id' => $contratista->id,
            'fecha_ingreso'  => Carbon::now()->toDateString(),
            'hora_ingreso'   => Carbon::now()->toTimeString(),
            'puerta'         => $puerta,
            'tipo'           => $tipo,
            'user_id'        =>  auth()->user()->id,
        ]);

        // URL de la foto (disk 'contratista' -> public/contratista/)
        $fotoUrl = null;
        if ($contratista->foto) {
            $fotoUrl = asset('contratista/' . $contratista->foto);
        }

        return response()->json([
            'success'  => true,
            'tipo'     => $tipo,
            'nombre'   => $contratista->nombre,
            'cedula'   => $contratista->cedula,
            'empresa'  => $contratista->empresa ?? 'Sin empresa registrada',
            'foto'     => $fotoUrl,
            'hora'     => Carbon::now()->format('H:i:s'),
            'puerta'   => $puerta,
        ]);
    }


    /**
     * Almacena el ingreso del contratista (ruta POST clásica — fallback)
     */
    public function storeIngreso(Request $request)
    {
        $this->validate($request, [
            'contratista_id' => 'required|exists:ingreso_contratistas,id',
            'puerta'         => 'required'
        ]);

        RegistroIngresoContratista::create([
            'contratista_id' => $request->contratista_id,
            'fecha_ingreso'  => Carbon::now()->toDateString(),
            'hora_ingreso'   => Carbon::now()->toTimeString(),
            'puerta'         => strtoupper($request->puerta),
            'user_id'        =>  auth()->user()->id
        ]);

        Session::flash('success', 'Ingreso registrado correctamente.');
        return redirect()->back();
    }

    /**
     * Gestión de Contratistas (Para Coordinador)
     */
    public function gestionContratistas(Request $request)
    {
        $query = IngresoContratista::query();

        if ($request->has('cedula') && $request->cedula != '') {
            $query->where('cedula', $request->cedula);
        }

        $contratistas = $query->orderBy('nombre', 'asc')->paginate(20);

        return view('monitoreo.coordinador.parqueadero.gestion.contratistas', compact('contratistas'));
    }

    /**
     * Crea o actualiza un contratista (con soporte de foto)
     */
    public function storeContratista(Request $request)
    {
        $this->validate($request, [
            'cedula'  => 'required|unique:ingreso_contratistas,cedula,' . $request->id,
            'nombre'  => 'required',
            'empresa' => 'required',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'cedula'  => $request->cedula,
            'nombre'  => strtoupper($request->nombre),
            'empresa' => strtoupper($request->empresa),
            'activo'  => $request->has('activo') ? 1 : 0,
        ];

        // Manejar upload de foto
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            // Borrar foto anterior si existe
            if ($request->id) {
                $existing = IngresoContratista::find($request->id);
                if ($existing && $existing->foto) {
                    Storage::disk('contratista')->delete($existing->foto);
                }
            }
            // Guardar en el disco 'contratistas'
            $archivo = $request->file('foto');
            $filename = time() . '_' . $request->cedula;
            
            // Usamos putFileAs para que Laravel maneje la creación del directorio si no existe
            Storage::disk('contratista')->putFileAs('', $archivo, $filename);
            
            $data['foto'] = $filename;
        }

        IngresoContratista::updateOrCreate(
            ['id' => $request->id],
            $data
        );

        Session::flash('success', 'Contratista guardado correctamente.');
        return redirect()->route('coordinador.ingresos');
    }

    /**
     * Informe de Ingresos (Para Coordinador)
     * Soporta filtro por: cédula, fecha_inicial y fecha_final
     */
    public function informeIngreso(Request $request)
    {
        $fechaInicial = $request->get('fecha_inicial', Carbon::now()->toDateString());
        $fechaFinal   = $request->get('fecha_final',   Carbon::now()->toDateString());
        $cedula       = $request->get('cedula', '');

        $query = RegistroIngresoContratista::with(['contratista', 'portero'])
            ->whereDate('fecha_ingreso', '>=', $fechaInicial)
            ->whereDate('fecha_ingreso', '<=', $fechaFinal)
            ->orderBy('fecha_ingreso', 'desc')
            ->orderBy('hora_ingreso', 'desc');

        // Filtro por cédula del contratista
        if ($cedula) {
            $query->whereHas('contratista', function ($q) use ($cedula) {
                $q->where('cedula', $cedula);
            });
        }

        $ingresos = $query->get();

        return view('monitoreo.coordinador.parqueadero.informe.ingresos', compact(
            'ingresos', 'fechaInicial', 'fechaFinal', 'cedula'
        ));
    }

}
