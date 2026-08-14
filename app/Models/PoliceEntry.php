<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliceEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'fecha_ingreso', 'cedula', 'nombre', 'hora_ingreso', 'hora_salida', 'observaciones'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}