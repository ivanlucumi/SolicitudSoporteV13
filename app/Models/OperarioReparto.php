<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperarioReparto extends Model
{
    //
    protected $table      = "operario_repartos";
    protected $primaryKey = 'id';
    protected $fillable   = [
        'nombre',
        'email',
    	'oficina_reparto'
    ];



    public function operario()
    {
       return $this->belongsTo(OficinasReparto::class,'oficina_reparto');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
}
