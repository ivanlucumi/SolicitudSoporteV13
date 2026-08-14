<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Directorio extends Model
{
    //
     protected $table = "directorios";

    protected $fillable = ['dDespacho', 'dCiudad', 'dDireccion', 'dTelefono', 'dExtension', 'dCircuito','dDistricto','dCreador','dModificador'];

    

}
