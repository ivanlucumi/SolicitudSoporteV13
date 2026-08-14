<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

use App\Models\EstadoExpediente;
use App\Models\Empleado;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;


class EstadoExpedienteImports implements /*ToCollection,WithHeadingRow*/ToModel
{
    /**
    * @param Collection $collection
    */
   // public function collection(Collection $rows)
   public function model(array $rows)
    {
       // dd($rows[6], Carbon::parse($rows[6])->format('Y-m-d'));
        
        $expediente = new EstadoExpediente();
        $expediente->radicado= $rows[0];
        $expediente->ni= $rows[1];
        $expediente->cedula_procesado= $rows[3];
        $expediente->nombre_procesado= strtoupper($rows[2]);
        $expediente->delito= $rows[4];
        $expediente->sede= $rows[10];
        $expediente->no_caja= $rows[7];
        $expediente->cuadernos= $rows[8];
        $expediente->folios= $rows[9];
        $expediente->tipo_expediente= $rows[13];
        $expediente->fecha_digitalizado= null;
        $expediente->asunto_archivo= $rows[5];
        $expediente->fecha_archivo= Carbon::parse($rows[6])->format('Y-m-d');
        $expediente->observaciones= $rows[11];
        $expediente->creado_por= $rows[12];
        $expediente->save();
        
         /*EstadoExpediente::create(
                        ['cedulaE' => $rows[0],
                         'nameE' => strtoupper($rows[1]),
                         'lastnameE' => strtoupper($rows[2]),
                         'clase_nombramiento' => strtoupper($rows[3]),
                         'cod_cargo' => $rows[4],
                         'cargo_titular' => strtoupper($rows[5]),
                         'cod_dependencia' => $rows[6],
                         'dependencia_titular' => strtoupper($rows[7]),
                         'ciudad_ubicacion_laboral' => strtoupper($rows[8]),
                         'cod_despacho' => $rows[9],
                         
                         ]);*/
        
    }
        
    
    
}
