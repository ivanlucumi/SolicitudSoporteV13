<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Ciudad;
use Illuminate\Support\Facades\DB;

class LicenciaOffice extends Model
{
    //
    //
    protected $table = "licencias_office_ltsc_instaladas";
    protected $fillable = [
    	'seccional',
    	'codigo_despacho',
    	'despacho',
    	'identificacion',
    	'funcionario',
    	'email_funcionario',
    	'ip',
    	'nombre_maquina',
    	'fecha_activacion',
    	'observaciones',
    						];
    						
}