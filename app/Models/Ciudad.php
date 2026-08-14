<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    //
    protected $table = "ciudades";
    protected $primaryKey = 'codigoCiudad';
    protected $fillable = [
				    	'codigoCiudad',
             			'nombreCiudad'
    						];
    						
    public function despacho(){
    return $this->belongsTo(Despacho::class,'codCiudad');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
}
