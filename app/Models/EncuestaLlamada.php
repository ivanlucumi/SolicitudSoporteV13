<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaLlamada extends Model
{
    use HasFactory;

    protected $table = 'encuesta_llamadas';

    protected $fillable = [
        'cedula',
        'celular',
        'correo',
        'municipio',
        'nombre',
        'despacho',
        'cargo',
        'estado',
        'usuario_id',
        'locked_at',
        'observaciones',
    ];

    protected $casts = [
        'locked_at' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
