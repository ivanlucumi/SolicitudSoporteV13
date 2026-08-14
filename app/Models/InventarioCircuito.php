<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\InventarioAlmacen;
use App\Models\InventarioCircuito;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;


class InventarioCircuito extends Model
{
    use HasFactory;

    protected $table = "inventarios_circuitos";
    protected $fillable = 
   						 [
				    	'user_id',
				    	'inventario_general_id',
				    	'cantidad_disponible',
				    	'circuito',
				    	'status'
   						 ];
   						 
   	public function almacen()
        {
            return $this->belongsTo(InventarioAlmacen::class, 'inventario_general_id', 'inventario_id');
        }
   						 
   						 
   	public function inventario()
    {
        return $this->belongsTo(InventarioAlmacen::class, 'inventario_general_id', 'inventario_id');
    }
    
    
  /* public static function InventarioAlmaceCircuito($circuito)
{
    $idsConCircuito = InventarioCircuito::where('status', 'Disponible')
        ->pluck('inventario_general_id')
        ->toArray();

    $almacenes = InventarioAlmacen::where('status', 'Disponible')
        ->whereNotIn('inventario_id', $idsConCircuito)
        ->get()
        ->map(function ($item) {
            return (object)[
                'inventario_id' => $item->inventario_id,
                'codigo_interno' => $item->codigo_interno,
                'descripcion' => $item->descripcion,
                'cantidad_final' => $item->cantidad_final,
                'user_id' => null,
                'cantidad_disponible' => null,
                'circuito' => null,
            ];
        });

    $circuitos = InventarioCircuito::with(['almacen' => function ($query) {
            $query->select('inventario_id', 'codigo_interno', 'descripcion', 'cantidad_final');
        }])
        ->where('status', 'Disponible')
        ->where('circuito', $circuito)
        ->get()
        ->map(function ($item) {
            return (object)[
                'inventario_id' => $item->inventario_general_id,
                'codigo_interno' => $item->almacen->codigo_interno ?? null,
                'descripcion' => $item->almacen->descripcion ?? null,
                'cantidad_final' => $item->almacen->cantidad_final ?? null,
                'user_id' => $item->user_id,
                'cantidad_disponible' => $item->cantidad_disponible,
                'circuito' => $item->circuito,
            ];
        });
        
        dd($almacenes
        ->merge($circuitos)
        ->sortBy('descripcion')
        ->values());

    // Combinar y ordenar por descripción ascendente
    return $almacenes
        ->merge($circuitos)
        ->sortBy('descripcion')
        ->values(); // opcional: reindexa los resultados
}*/


public static function InventarioAlmaceCircuito($circuito){
    // IDs de inventario ya asignados a un circuito
    $idsConCircuito = InventarioCircuito::where('status', 'Disponible')
        ->pluck('inventario_general_id')
        ->toArray();

    // Inventario en almac��n que NO est�� en circuito
    $almacenes = InventarioAlmacen::where('status', 'Disponible')
        ->whereNotIn('inventario_id', $idsConCircuito)
        ->get()
        ->map(function ($item) {
            return (object)[
                'inventario_id' => $item->inventario_id,
                'codigo_interno' => $item->codigo_interno,
                'descripcion' => $item->descripcion ?? '', // Asegura que no sea null
                'cantidad_final' => $item->cantidad_final,
                'user_id' => null,
                'cantidad_disponible' => null,
                'circuito' => null,
            ];
        });
        
    

    // Inventario en circuito
    $circuitos = InventarioCircuito::with(['almacen' => function ($query) {
            $query->select('inventario_id', 'codigo_interno', 'descripcion', 'cantidad_final');
        }])
        ->where('status', 'Disponible')
        ->where('circuito', $circuito)
        ->get()
        ->map(function ($item) {
            return (object)[
                'inventario_id' => $item->inventario_general_id,
                'codigo_interno' => $item->almacen->codigo_interno ?? '',
                'descripcion' => $item->almacen->descripcion ?? '', // Asegura que no sea null
                'cantidad_final' => $item->almacen->cantidad_final ?? 0,
                'user_id' => $item->user_id,
                'cantidad_disponible' => $item->cantidad_disponible,
                'circuito' => $item->circuito,
            ];
        });
        

    // Combinar y ordenar por descripci��n ascendente
    return $almacenes
        ->merge($circuitos)
        ->sortBy('descripcion')
        ->values();
}


public static function InventarioAlmacenCircuito2($circuito)
{
    
    // Inventario en almac��n
    $almacenes = InventarioAlmacen::where('status', 'Disponible')
        ->get()
        ->map(function ($item) {
            return (object)[
                'inventario_id'       => $item->inventario_id,
                'codigo_interno'      => $item->codigo_interno,
                'descripcion'         => $item->descripcion ?? '',
                'cantidad_final'      => $item->cantidad_final ?? 0,
                'user_id'             => null,
                'cantidad_disponible' => null,
                'circuito'            => null,
            ];
        });

    // Inventario en circuito del circuito especificado
    $circuitos = InventarioCircuito::with(['almacen' => function ($query) {
            $query->select('inventario_id', 'codigo_interno', 'descripcion', 'cantidad_final');
        }])
        ->where('status', 'Disponible')
        ->where('circuito', $circuito)
        ->get()
        ->map(function ($item) {
            return (object)[
                'inventario_id'       => $item->inventario_general_id,
                'codigo_interno'      => $item->almacen->codigo_interno ?? '',
                'descripcion'         => $item->almacen->descripcion ?? '',
                'cantidad_final'      => $item->almacen->cantidad_final ?? 0,
                'user_id'             => $item->user_id,
                'cantidad_disponible' => $item->cantidad_disponible,
                'circuito'            => $item->circuito,
            ];
        });

    // Combinar, eliminar duplicados y ordenar
    $inventario = $almacenes
        ->merge($circuitos)
        ->unique('inventario_id') // Evita que se repitan
        ->sortBy('descripcion')
        ->values();

    if ( auth()->user()->email === "siriscali@cendoj.ramajudicial.gov.co") {
        //dd($inventario,$almacenes,$circuitos);
    }

    return $inventario;
}


    
}

