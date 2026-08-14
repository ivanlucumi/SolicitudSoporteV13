<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Notificacion;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\DB;

class NotificacionExport implements FromCollection,WithHeadings
{
    use Exportable;

    protected $notificaciones;

    public function __construct($notificaciones = null)
    {
        $this->notificaciones = $notificaciones;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Notificacion::all();
        return $this->notificaciones ?: Notificacion::all();
    }

    public function headings(): array

    {

        return [
            
            "FECHA_RECIBIDO",
            "OFICIO" ,
            "DESPACHO" ,
            "NUMERO_RADICADO_PROCESO" ,
            "DELITO",
            "CLASE_AUDIENCIA",
            "FECHA_AUDIENCIA",
            "HORA_INICIO" ,
            "LUGAR" ,
            "TIPO_PARTE" ,
            "TIPO_IDENTIFICACION",
            "IDENTIFICACION" ,
            "NOMBRE_APELLIDO" ,
            "DIRECCION" ,
            "CORREO_CITADO" ,
            "TELEFONO_CITADO",
            "CIUDAD" ,
            "TIPO_NOTIFICACION" ,
            "OBSERVACIONES" ,
            "CODIGODESPACHO" ,
            "CORREO_DESPACHO",
            "TELEFONO_DESPACHO",

            ];

    }
}
