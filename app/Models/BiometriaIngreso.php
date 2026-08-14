<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiometriaIngreso extends Model
{
    use HasFactory;

    protected $table = 'biometria_ingresos';
    protected $fillable = [
        'tipo_doc',
        'identificacion',
        'p_apellido',
        's_apellido',
        'p_nombre',
        's_nombre',
        'sexo',
        'f_nacimiento',
        'observaciones',
        'foto',
        'url_imagen',
        'tipo',
        'sas',
        'novedades',
       /* 'ingreso',
        'salida',
        'quien_solicito',
        'tipo_solicitud',
        'parqueadero',
        'vehiculo',
        'vehiculo_autorizado',
        'placa',
        'tipo',
        'caracterisiticas',
        'ingreso_fuera_horario',
        'motivo_ingreso'*/];
}
