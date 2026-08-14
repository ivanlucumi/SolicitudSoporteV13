<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\SeguimientoPresencialidad;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\DB;

class PresencialidadExport implements FromCollection,WithHeadings
{
    use Exportable;

    protected $presencialidad;

    public function __construct($presencialidad = null)
    {
        $this->presencialidad = $presencialidad;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       // dd($this->presencialidad,'hola');
        //return SeguimientoPresencialidad::all();
        return $this->presencialidad ?: SeguimientoPresencialidad::all();
    }

    public function headings(): array

    {

        return [
            "CODIGO DESPACHO",
            "DESPACHO",
            "DISTRITO" ,
            "CIRCUITO" ,
            "DIA ASISTENCIA" ,
            "FECHA REGISTRO",
            "HORA REGISTRO",
            "NUMERO FUNCIONARIOS"
            
            ];

    }
}
