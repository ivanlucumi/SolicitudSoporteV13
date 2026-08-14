<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\SeguimientoPresencialidad;
use App\Models\Notificacion;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;



use Illuminate\Support\Facades\DB;

class SeguimientoPresencialidadExport implements FromCollection,WithHeadings
{
    use Exportable;

    protected $requerimientos;

    public function __construct($requerimientos = null)
    {
        $this->requerimientos = $requerimientos;
    }
    public function collection()
    {
        //return RequerimientosDespachos::all();
        return $this->requerimientos ?: SeguimientoPresencialidad::all();
        
    }
    
    public function headings(): array

    {

        return [
            
            "DESPACHO ID",
            "DESPACHO" ,
            "IDENTIFICACION" ,
            "NOMBRE" ,
            "CARGO",
            "EN TELETRABAJO",
            "NOVEDAD",
            "FECHA REGISTRO"

            ];

    }
    /*
    'id_despacho','despacho','id_elemento','elemento', 'cantidad','observaciones','correo_despacho','mes_solicitud','estado_solicitud'
    */
    
}
