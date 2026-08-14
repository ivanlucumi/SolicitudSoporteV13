<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TodoUno extends Model
{
    //
    protected $table      = "Inventario_computadores_todoenuno";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'num_caja', 
    	'todo_en_uno', 
    	'serial_equipo',
    	'teclado_placa', 
    	'teclado_serial', 
    	'mouse_placa',
    	'mouse_serial', 
    	'codigo_despacho', 
    	'despacho',
    	'num_salida', 
    	'fecha_salida', 
    	'entregado_a',
    	'cedula_funcionario', 
    	'nombre_funcionario', 
    	'firma_funcionario',
    ];
}