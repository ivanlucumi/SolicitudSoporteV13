<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Carnet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','cedula','cargo','foto_url','valid_from','valid_until','activo','google_object_id'
    ];

    protected $dates = ['valid_from','valid_until'];
    
    public function isValido(): bool
    {
        if (!$this->activo) {
            return false;
        }
    
        if (
            $this->valid_until &&
            now()->greaterThan($this->valid_until->copy()->addDays(40))
        ) {
            return false;
        }
    
        if (
            $this->valid_from &&
            now()->lessThan($this->valid_from)
        ) {
            return false;
        }
    
        return true;
    }

    /*public function isValido()
    {
        if (! $this->activo) return false;
        if ($this->valid_until && Carbon::now()->gt($this->valid_until)) return false;
        if ($this->valid_from && Carbon::now()->lt($this->valid_from)) return false;
        return true;
    }*/

    public function user()
    {
        return $this->belongsTo(\App\Models\Empleado::class);
    }
}
