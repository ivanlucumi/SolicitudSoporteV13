<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Notificacion;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\DB;

class TanqueoExport implements FromCollection,WithHeadings
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
            
            "FECHA_REGISTRO",
            "VEHICULO" ,
            "PLACA" ,
            "CONDUCTOR_CEDULA" ,
            "CONDUCTOR",
            "KILOMETRAJE",
            "NIVEL_TANQUE",
            "OBSERVACIONES" ,
            "IMAGEN(https://www.disajcali.gov.co/Tanqueo/)" ,

            ];

    }
}
