<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteFalla extends Model
{
    use HasFactory;

    protected $table = 'reporte_fallas';

    protected $fillable = [
        'identificacion_empleado',
        'nombre_empleado',
        'codigo_juzgado',
        'juzgado',
        'tipos_falla',
        'obs_conectividad',
        'obs_computo',
        'obs_impresoras',
        'obs_escaner',
        'obs_telefonia',
        'evidencia_conectividad',
        'evidencia_computo',
        'evidencia_impresoras',
        'evidencia_escaner',
        'evidencia_telefonia',
        'obs_ups',
        'evidencia_ups',
        'obs_televisor',
        'evidencia_televisor',
        'obs_sala_audiencia',
        'evidencia_sala_audiencia'
    ];

    /**
     * Los atributos que se deben convertir (cast) a tipos nativos.
     * Al usar array, Laravel automáticamente convierte el JSON de la BD a un array en PHP y viceversa.
     */
    protected $casts = [
        'tipos_falla' => 'array',
        'obs_computo' => 'array',
        'obs_impresoras' => 'array',
        'obs_escaner' => 'array',
        'obs_telefonia' => 'array',
        'obs_ups' => 'array',
        'obs_televisor' => 'array',
        'obs_sala_audiencia' => 'array',
        'evidencia_conectividad' => 'array',
        'evidencia_computo' => 'array',
        'evidencia_impresoras' => 'array',
        'evidencia_escaner' => 'array',
        'evidencia_telefonia' => 'array',
        'evidencia_ups' => 'array',
        'evidencia_televisor' => 'array',
        'evidencia_sala_audiencia' => 'array',
    ];
}
