<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaTrabajoCasa extends Model
{
    use HasFactory;

    protected $table = 'encuestas_trabajo_casa';

    protected $fillable = [
        'cedula',
        'correo',
        'cod_despacho',
        'correo_dependencia',
        'dependencia',
        'ciudad',
        'tiene_vpn',
        'requiere_vpn',
        'computador',
        'impresora',
        'escaner',
        'conectividad',
        'silla',
        'escritorio',
        'aplicaciones',
        'cuenta_todos_elementos',
    ];
}
