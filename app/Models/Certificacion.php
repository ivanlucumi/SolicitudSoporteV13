<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    // Nombre de la tabla (opcional, si no sigue la convención)
    protected $table = 'recursos_humanos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'identificacion',
        'apellido_1',
        'apellido_2',
        'nombre_1',
        'nombre_2',
        'cargo',
        'eps',
        'pension',
        'correo',
        'certificacion',
        'estado'
    ];

    // Casts para garantizar tipos correctos
    protected $casts = [
        'identificacion' => 'string',
        'correo'         => 'string',
        'eps'            => 'string',
        'pension'        => 'string',
    ];

    // Si tu tabla tiene timestamps (sí la tiene según la imagen)
    public $timestamps = true;

    public function getNombreCompletoAttribute()
    {
        // Filtra valores vacíos y une solo los que existan
        return trim(collect([
            $this->nombre_1,
            $this->nombre_2,
            $this->apellido_1,
            $this->apellido_2
        ])->filter()->join(' '));
    }
}
