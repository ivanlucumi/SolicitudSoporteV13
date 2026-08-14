<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DespachoHistorial extends Model
{
    protected $table = 'despacho_historial';
    protected $fillable = ['despacho','email', 'user_id', 'accion'];

    public function despacho()
    {
        return $this->belongsTo(Despacho::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}