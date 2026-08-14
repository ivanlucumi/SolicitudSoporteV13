<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BienestarAcompanante extends Model
{
    protected $fillable = ['funcionario_id', 'parentezco', 'nombre', 'cedula'];

    public function funcionario(): BelongsTo
    {
        return $this->belongsTo(BienestarFuncionario::class);
    }
}