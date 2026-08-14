<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiempoAtencion extends Model
{
    //
    protected $table = "tiempo_atencions";
   
    protected $fillable = [
    	'id',
    	'prioridad',
    	'maximoD'
    						];
}
