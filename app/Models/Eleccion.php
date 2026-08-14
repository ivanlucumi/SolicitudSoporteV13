<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleccion extends Model
{
    use HasFactory;
    protected $table = "elecciones";

    protected $primaryKey = 'id';
   
    protected $fillable = [
    	'cedula',
    	'nombre',
        'apellidos',
        'correo',
        'dependencia',
        'estado'
    						];
                            

}
