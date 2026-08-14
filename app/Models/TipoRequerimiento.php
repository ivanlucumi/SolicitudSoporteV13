<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoRequerimiento extends Model
{
    //
    protected $table = "tipo_requerimientos";
   
    protected $fillable = [
    	'id',
    	'nombreRequerimiento'
    						];
}
