<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\RequerimientosDespachos;
use App\Models\Notificacion;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\DB;

class RequerimientosExport implements FromCollection,WithHeadings
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
        return $this->requerimientos ?: RequerimientosDespachos::all();
        
    }
    
    public function headings(): array

    {

        return [
            
            "DESPACHO ID",
            "DESPACHO" ,
            "CORREO" ,
            "TIPO SOLICITUD" ,
            "OBSERVACIONES",
            "FECHA SOLICITUD",
            "CANTIDAD DE ELEMENTOS",
            "REGISTRA" ,
            "FOTOGRAFIA" 

            ];

    }
    
}
