<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

use App\Models\MigracionBestdoc;
use App\Models\ControlDigitalizacionProtoDos;
use App\Models\Empleado;

use Maatwebsite\Excel\Concerns\WithHeadingRow;


class BestdocImports implements /*ToCollection,WithHeadingRow*/ToModel/*,WithChunkReading,WithBatchInserts*/
{
    /**
    * @param Collection $collection
    */
   // public function collection(Collection $rows)
  /* public function model(array $rows)
    {
        
         Empleado::create(
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
                         
                         ]);
                
    }*/
        
    
    
    
     public function model(array $rows)
    {
       // dd($rows);
        //dd($rows[0],$rows[1],$rows[2],$rows[3]);
        //
         if( $rows[0] != null && $rows[1] != null   )
                {
                    
                  $consulta =ControlDigitalizacionProtoDos::where('radicacion',$rows[0])->first();  
                    
                   //dd('entre2');
                   //dd($registro['despacho_id']);
                   if($consulta == null){
                       ControlDigitalizacionProtoDos::create(
                        ['radicacion' => $rows[0],
                        'despacho' => strtoupper($rows[1]),
                         'municipio' => strtoupper($rows[2]),
                         'especialidad' => strtoupper($rows[3])
                         ]);
                      }/*else{
                           ControlDigitalizacionProtoDos::create(
                        ['radicacion' => $rows[1],
                        'despacho' => $rows[0],
                         //'municipio' => $rows[2],
                         'especialidad' => $rows[2],
                         'repetido_en_excel'=>'RADICACION REPETIDA EN EL ID'.$consulta->id.' EN EL DESPACHO '.$consulta->despacho]);
                      }*/
                }
        
    }
    
    /*public function batchSize(): int
    {
        return 64632;
    }
    
    public function chunkSize(): int
    {
        return 5000;
    }*/
}
