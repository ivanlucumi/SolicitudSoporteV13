<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
    use HasFactory;

    protected $table = "segmentos";

    protected $fillable = [
        'seccional',
        'municipio',
        'sede',
        'direccion',
        'piso',
        'torre',
        'vlan',
        'direccionamiento_red',
        'observaciones'
        
    ];
}

