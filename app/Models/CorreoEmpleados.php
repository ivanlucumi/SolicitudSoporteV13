<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CorreoEmpleados extends Model
{
    protected $table = 'correos_empleados_judiciales';
    protected $fillable = [
        'correo_despacho',
        'despacho',
        'id_despacho',
        'cedula',
        'nombre',
        'cargo',
        'correo_institucional',
        'dependencia'];


  
}
