<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Hora extends Model
{
    //
    protected $table      = "vhoras_habilitadas";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'hora', 
    	'cedula',
    	'confirmado'
    ];
}
