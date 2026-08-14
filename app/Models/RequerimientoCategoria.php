<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequerimientoCategoria extends Model
{
    //
    protected $table = "requerimiento_despacho_categoria";
    protected $fillable = ['id','nombre'];
}
