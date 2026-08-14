<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GrupoReparto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FichaGrReparto extends Model
{
    //
    protected $table      = "ficha_grupo_reparto";
    protected $primaryKey = 'id';
    protected $fillable   = [
    'especialidad',
    'grupo_reparto'
    ];

 
}


