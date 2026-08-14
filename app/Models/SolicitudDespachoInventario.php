<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudDespachoInventario extends Model
{
    use HasFactory;

    protected $table = "solicitud_despacho_inventarios";
    protected $fillable = 
   						 [
				    	'inventario_almacen_id',
				    	'despacho_id',
				    	'cantidad',
				    	'estado',
				    	'observaciones'
   						 ];
}


