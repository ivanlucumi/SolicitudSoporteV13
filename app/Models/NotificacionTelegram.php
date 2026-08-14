<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificacionTelegram extends Model
{
    //
    protected $table = "notificaciones_telegram";

    protected $fillable = ['usuario', 'descripcion','ciudad', 'direccion', 'edificio', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    
}
