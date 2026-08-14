<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\SolicitudAlmacen;
use App\Models\Notificacion;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;



use Illuminate\Support\Facades\DB;

class AlmacenExport implements FromCollection,WithHeadings
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
        return $this->requerimientos ?: SolicitudAlmacen::all();
        
    }
    
    public function headings(): array

    {

        return [
            
            "DESPACHO ID",
            "DESPACHO" ,
            "ID ELEMENTO" ,
            "ELEMENTO" ,
            "CANTIDAD",
            "FECHA SOLICITUD",
            "OBSERVACIONES",
            "FCHA RESPUESTA",
            "CANTIDAD ENTREGADA",
            "TITULAR DESPACHO CEDULA",
            "TITULAR DESPACHO NOMBRE",
            "TITULAR DESPACHO APELLIDO",
            "QUIEN ATENDIÓ"

            ];

    }
    /*
    'id_despacho','despacho','id_elemento','elemento', 'cantidad','observaciones','correo_despacho','mes_solicitud','estado_solicitud'
    */
    
}
