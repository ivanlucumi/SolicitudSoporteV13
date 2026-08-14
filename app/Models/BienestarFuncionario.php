<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BienestarFuncionario extends Model
{
    protected $fillable = ['nombre', 'cedula', 'correo', 'telefono', 'cargo', 'despacho'];

    public function acompanantes(): HasMany
    {
        return $this->hasMany(BienestarAcompanante::class);
    }
}