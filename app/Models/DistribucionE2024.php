<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Ciudad;
use Illuminate\Support\Facades\DB;

class DistribucionE2024 extends Model
{
    //
    //
    protected $table = "distribucion_equipo_2024";
    protected $fillable = [
    	'codigo_despacho',
    	'despacho',
    	'numero',
    	'correo_despacho',
    						];
    						
}