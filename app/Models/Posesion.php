<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posesion extends Model
{
    protected $table = 'posesiones';

    protected $fillable = [
        
        'tipo_nombramiento',
        'tipo_acto_adtivo',
        'no_acto_adtivo',
        'fecha_acto_administrativo',
        'fecha_posesion',
    ];

    protected $dates = [
        'fecha_acto_administrativo',
        'fecha_posesion'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */
    
    public function registro()
    {
        return $this->hasOne(EscalafonRegistro::class);
    }

}
