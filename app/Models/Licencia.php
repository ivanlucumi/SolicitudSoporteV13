<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    protected $fillable = ['no_resolucion', 'fecha', 'tiempo'];

    protected $casts = ['fecha' => 'date'];

    public function registro()
    {
        return $this->hasOne(EscalafonRegistro::class);
    }
}