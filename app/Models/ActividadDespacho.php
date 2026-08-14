<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActividadDespacho extends Model
{
   protected $table = 'actividades_despacho';

    protected $fillable = [
        'codigoDespacho',
        'visitado',
        'capacitado',
        'con_usuarios',
        'en_produccion',
        'usuarios_solicitados',
        'observaciones',
        'observaciones_capacitaciones',
    ];

    protected $casts = [
        'visitado' => 'boolean',
        'capacitado' => 'boolean',
        'con_usuarios' => 'boolean',
        'en_produccion' => 'boolean',
        'usuarios_solicitados' => 'array',
    ];

    public function despacho()
    {
        return $this->belongsTo(Despacho::class, 'codigoDespacho', 'codigoDespacho');
    }
}