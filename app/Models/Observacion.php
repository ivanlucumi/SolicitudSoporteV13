<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    protected $table = 'observaciones';

    protected $fillable = [
        'escalafon_id',
        'act_circular',
        'reporte_lista',
        'observacion_pre',
        'observacion_pre2',
        'observacion_pre3',
        'nota1',
        'nota2',
        'nota3',
        'nota4',
        'nota5',
        'comentario_circular'
    ];

    protected $casts = [
        'reporte_lista' => 'boolean'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function escalafon()
    {
        return $this->belongsTo(Escalafon::class, 'escalafon_id');
    }
}
