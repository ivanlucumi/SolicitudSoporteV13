<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Escalafon extends Model
{
     protected $table = 'escalafon'; // SOLO si realmente se llama así

    protected $fillable = [
        
        'novedad',
        'tipo_acto',
        'numero_acto',
        'fecha_acto',
        'entidad',
        'convocatoria',
        'estado_actual'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */
    protected $casts = ['fecha_acto' => 'date'];

    public function registros()
    {
        return $this->hasMany(EscalafonRegistro::class);
    }

}