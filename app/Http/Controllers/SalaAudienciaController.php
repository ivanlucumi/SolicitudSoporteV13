<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

use App\Models\Elemento;
use App\Models\InventarioSalaAudiencia;
use App\Models\InventarioElementoSalaAudiencia;
use App\Models\Ciudad;

use App\Exports\InventarioExport;

class SalaAudienciaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('administrador');
        
    }

    public function indexSala()
    {
       // dd( auth()->user()->id);
       $ciudades = Ciudad::pluck('nombreCiudad','codigoCiudad');
       if( auth()->user()->id == 1972 ||  auth()->user()->id == 1853){
           $salas = InventarioSalaAudiencia::all();
       }else{
           $salas = InventarioSalaAudiencia::where('id_user', auth()->user()->id)->get();
       }
        
        return view('SalasAudicencia.SalaAudiencia', compact('salas','ciudades'));
    }

    public function storeSala(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'municipio' => 'required|string|max:50', 
            'sede' => 'required|string|max:50',
            'direccion' => 'required|string|max:80',
            'piso' => 'nullable|integer|digits_between:1,2',
            'foto' =>'required|image|max:4096'
        ]);
        
        if ($request->hasFile('foto')) {
                $archivo = $request->file('foto');
                //dd($archivo->getClientOriginalName());
                $nombreArchivo = time() . '' . $request->nombre." ".$request->municipio;
                \Storage::disk('local')->put($nombreArchivo, \File::get($request->file('foto')));
            }
            
        

        InventarioSalaAudiencia::create([
            'nombre' => strtoupper($validatedData['nombre']),
            'municipio' => strtoupper($validatedData['municipio']),
            'sede' => strtoupper($validatedData['sede']),
            'direccion' => strtoupper($validatedData['direccion']),
            'piso' => $validatedData['piso'] ? strtoupper($validatedData['piso']) : null,
            'foto'=> $nombreArchivo,
            'id_user'=> auth()->user()->id,
        ]);

        return back()->with('success','Sala creada correctamente');
    }
    
    public function index(Request $request)
    {
        $salaAudiencia = InventarioSalaAudiencia::findorFail($request->sala_id);
        $inventarioExistente = InventarioElementoSalaAudiencia::where('sala_id', $salaAudiencia->id)->with('elemento')->get();
        
        $elementos = Elemento::where('idCategoria', 8)->get();
        
        // Definir límites para cada tipo de elemento
        $limitesElementos = $this->getElementLimits();
        
        // Clasificar elementos por tipo de restricción
        $elementosUnicos = ['televidor', 'computador', 'impresora', 'amplificador', 'camara', 'microfono presidente'];
        $elementosMultiples = ['extensor microfono','microfono', 'estrados', 'sillas', 'tandem', 'separador'];
        $elementosEspeciales = ['altavoces']; // Solo 2 permitidos
        
        // Contar elementos ya registrados por tipo
        $conteoElementos = [];
        foreach ($inventarioExistente as $item) {
            $nombreElemento = strtolower(trim($item->elemento->nombreElemento));
            $conteoElementos[$nombreElemento] = ($conteoElementos[$nombreElemento] ?? 0) + 1;
        }
        
        // Filtrar elementos disponibles basado en límites
        $elementosDisponibles = $elementos->filter(function($elemento) use ($conteoElementos, $limitesElementos) {
            $nombreElemento = strtolower(trim($elemento->nombreElemento));
            $cantidadActual = $conteoElementos[$nombreElemento] ?? 0;
            $limite = $limitesElementos[$nombreElemento] ?? PHP_INT_MAX;
            
            return $cantidadActual < $limite;
        });
        
        // Agregar iconos a los elementos
        $elementosDisponibles = $elementosDisponibles->map(function($elemento) {
            $elemento->icono = $this->getElementIcon($elemento->nombreElemento);
            return $elemento;
        });
        
        return view('SalasAudicencia.Index', compact(
            'elementosDisponibles', 
            'salaAudiencia', 
            'inventarioExistente',
            'elementosUnicos',
            'elementosMultiples', 
            'elementosEspeciales',
            'conteoElementos',
            'limitesElementos'
        ));
    }
    
    private function getElementLimits()
    {
        return [
            'televidor' => 1,
            'computador' => 1,
            'impresora' => 1,
            'amplificador' => 1,
            'camara' => 1,
            'microfono presidente' => 1,
            'altavoces' => 2,
            // Los demás elementos no tienen límite específico
        ];
    }
    
    private function getElementIcon($nombre) {
        $iconos = [
            'televidor' => 'tv',
            'computador' => 'desktop', 
            'impresora' => 'print',
            'amplificador' => 'volume-up',
            'altavoces' => 'volume-up',
            'camara' => 'camera',
            'microfono presidente' => 'microphone',
            'microfono' => 'microphone',
            'estrados' => 'columns',
            'sillas' => 'user-o',
            'tandem' => 'users',
            'separador' => 'minus'
        ];
        
        return $iconos[strtolower(trim($nombre))] ?? 'cube';
    }

public function store(Request $request)
{
    
    $salaAudiencia = InventarioSalaAudiencia::findorFail($request->sala_id);
    
   /* if( auth()->user()->id != $salaAudiencia->id_user){
       return back()->withErrors([
            'error' => 'Error al guardar el inventario, no es el mismo usuario que creo la Sala: '
        ])->withInput();  
    }*/
    
    if(empty($salaAudiencia)){
       return back()->withErrors([
            'error' => 'Error al guardar el inventario: ' . $e->getMessage()
        ])->withInput(); 
    }
    

        $validated = $request->validate([
            'sala_id' => 'required',
            'elementos' => 'required|array|min:1',
            'elementos.*.cantidad' => 'required|integer|min:1',
            'elementos.*.estado' => 'required|string|max:100',
            'elementos.*.observaciones' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string|max:500',
        ]);

        $salaId = $validated['sala_id'];
        
        //dd($request->all(),$salaId );
        $reglas = $this->getElementLimits();

        foreach ($validated['elementos'] as $elementoId => $el) {
            // 🔹 Obtener nombre del elemento
            $elemento = Elemento::findOrFail($elementoId);
            $nombreElemento = strtolower($elemento->nombre);

            // 🔹 Verificar si el elemento tiene límite
            if (array_key_exists($nombreElemento, $reglas)) {
                $limite = $reglas[$nombreElemento];

                // Cantidad ya registrada en la sala
                $cantidadExistente = InventarioElementoSalaAudiencia::where('sala_id', $salaId)
                    ->where('elemento_id', $elementoId)
                    ->sum('cantidad');

                $cantidadNueva = (int) $el['cantidad'];
                $cantidadTotal = $cantidadExistente + $cantidadNueva;

                if ($cantidadTotal > $limite) {
                    DB::rollBack();
                    return back()->withErrors([
                        'error' => "⚠️ No se puede registrar {$cantidadNueva} {$nombreElemento}(s). 
                        Ya hay {$cantidadExistente} en la sala y el máximo permitido es {$limite}."
                    ])->withInput();
                }
            }

            // ✅ Si pasa la validación, guardamos
            InventarioElementoSalaAudiencia::create([
                'sala_id'       => $salaId,
                'elemento_id'   => $elementoId,
                'cantidad'      => (int) $el['cantidad'],
                'estado'        => strtoupper($el['estado']),
                'observaciones' => !empty($el['observaciones']) ? strtoupper($el['observaciones']) : null,
                'id_user'       =>  auth()->id(),
            ]);
        }

        // Observaciones generales
        $salaAudiencia = InventarioSalaAudiencia::findOrFail($salaId);
        $salaAudiencia->update([
            'observaciones_generales' => strtoupper(
                trim(($salaAudiencia->observaciones_generales ?? '') . ' ' . ($validated['observaciones'] ?? ''))
            )
        ]);
        
        try {
        DB::beginTransaction();

        DB::commit();
        return redirect()->back()->with('success', 'Inventario guardado correctamente ✅');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors([
            'error' => 'Error al guardar el inventario: ' . $e->getMessage()
        ])->withInput();
    }
}


 public function destroy(Request $request, $id)
    {
        try {
            $elemento = InventarioElementoSalaAudiencia::findOrFail($id);
            $elemento->delete();
        
            return redirect()
                ->back()
                ->with('success', 'Elemento eliminado correctamente');
                
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Error al eliminar el elemento: ' . $e->getMessage()
            ]);
        }
    }
    
    public function AdminSalaAudiencia(Request $request)
    {
    try {
        // Cargar salas con sus elementos y la relación elemento
        $salas = \App\Models\InventarioSalaAudiencia::with('inventarioElementos.elemento')->get();

        // Agrupar y normalizar
        foreach ($salas as $sala) {
            $grouped = $sala->inventarioElementos
                ->groupBy(function($item) {
                    // forzar a string para evitar keys mixtas (int/string)
                    return (string) $item->elemento_id;
                })
                ->map(function($items, $elementoId) {
                    // primer registro del grupo
                    $first = $items->first();

                    // nombre seguro (si la relación elemento no existe)
                    $nombre = optional($first->elemento)->nombreElemento ?? 'N/D';

                    // sumar cantidades (forzar int)
                    $cantidadTotal = $items->sum(function($i) {
                        return intval($i->cantidad ?? 0);
                    });

                    // estados únicos y limpios
                    $estados = $items->pluck('estado')
                        ->filter()            // eliminar valores vacíos
                        ->map(fn($s) => trim($s))
                        ->unique()
                        ->values()
                        ->all();

                    // observaciones: juntar (únicas) y también mantener array
                    $observacionesArray = $items->pluck('observaciones')
                        ->filter()
                        ->map(fn($o) => trim($o))
                        ->unique()
                        ->values()
                        ->all();

                    $observacionesTxt = $observacionesArray ? implode('; ', $observacionesArray) : null;

                    return [
                        'elemento_id'     => $elementoId,
                        'nombre'          => $nombre,
                        'cantidad_total'  => $cantidadTotal,
                        'estados'         => $estados,            // array
                        'observaciones'   => $observacionesTxt,   // string para mostrar
                        'observaciones_raw'=> $observacionesArray, // array si necesitas
                        'registros'       => $items->values()     // colección de registros originales (si la vista necesita)
                    ];
                })
                ->values(); // reindex numeric

            $sala->elementosAgrupados = $grouped;
        }

        return view('SalasAudicencia.Admin.Index', compact('salas'));

    } catch (\Throwable $e) {
        \Log::error('Error agrupando inventario: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return back()->withErrors('Error al cargar inventarios: ' . $e->getMessage());
    }
}

    
    public function export()
    {
        return Excel::download(new InventarioExport, 'inventario_salas_audiencia.xlsx');
    }
    
}

