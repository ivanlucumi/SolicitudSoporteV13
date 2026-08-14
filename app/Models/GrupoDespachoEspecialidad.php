<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoDespachoEspecialidad extends Model
{
    use HasFactory;
    
      protected $table = "grupo_despacho_especialidades";

    protected $fillable = [
                    'despacho_id',
                    'especialidad_id',
        ];
}
