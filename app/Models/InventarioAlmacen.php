<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioAlmacen extends Model
{
    use HasFactory;

    protected $table = "inventarios_almacen";
    protected $fillable = 
   						 [
				    	'inventario_id',
				    	'codigo_interno',
				    	'descripcion',
				    	'cantidad_final',
				    	'status'
   						 ];
}

