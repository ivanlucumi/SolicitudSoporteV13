<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EsquemaVacuna extends Model
{
    protected $table = "esquema_vacunacion";

    protected $fillable = ['codigo_despacho',
    'cedula',
    'nombre',
    'cargo',
    'vacuna',
    'dosis',];
    
    public function despacho()
    {
       return $this->belongsTo(User::class,'cedula');
    }
    
  
}
