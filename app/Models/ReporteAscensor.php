<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteAscensor extends Model
{
    //



    protected $table = 'reporte_ascensor';
    protected $fillable = [
        'fecha_reporte',
        'hora_reporte',
        'sede',
        'ascensor',
        'tipo_incidente',
        'descripcion',
        'hora_incidente',
        'codigoAsignado',
        'nombre_reportante',
        'operador',
    ];
   
    public static function Ascensores()
{
    $ascensores = [
        
            'Ascensor 1 - Torre Torre B' => 'Ascensor 1 - Torre Torre B',
            'Ascensor 2 - Torre Torre B' => 'Ascensor 2 - Torre Torre B',
            'Ascensor 3 - Torre Torre B' => 'Ascensor 3 - Torre Torre B',
            'Ascensor 4 - Torre Torre B' => 'Ascensor 4 - Torre Torre B',
            'Ascensor 5 - Torre Torre B' => 'Ascensor 5 - Torre Torre B',
            'Ascensor 6 - Torre Torre B' => 'Ascensor 6 - Torre Torre B',
            'Ascensor 7 - Torre Torre B' => 'Ascensor 7 - Torre Torre B',
            'Ascensor 8 - Torre Torre A' => 'Ascensor 8 - Torre Torre A',
            'Ascensor 9 - Torre Torre A' => 'Ascensor 9 - Torre Torre A',
            'Ascensor PN - Automatico' => 'Ascensor PN - Automatico',
            'Ascensor PN - Manual' => 'Ascensor 9 - Manual',
        
    ];

    return $ascensores;
}

}
