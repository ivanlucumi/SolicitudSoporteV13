<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    //
     protected $table = "categorias";
    protected $fillable = 
   						 [
				    	'id',
				    	'descripcioncategoria',
				    	'prioridad'
   						 ];




     public static function verCategoria()
     {
     $categorias = DB::select('select categorias.id, categorias.descripcioncategoria as descripcioncategoria, tiempo_atencions.prioridad as 						prioridad
									FROM categorias, tiempo_atencions
									WHERE categorias.prioridad = tiempo_atencions.id');
     		return $categorias;
									       
    }	
}
