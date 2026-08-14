<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Torre extends Model
{
    //
    protected $table      = "torres";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	't_nombre', 
    	't_creador', 
    	't_modificador',
    ];
}
