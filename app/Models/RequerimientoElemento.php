<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequerimientoElemento extends Model
{
    //
    protected $table = "requerimiento_despacho_elements";
    protected $fillable = ['category_id','elemento'];
}
