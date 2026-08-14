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
use App\Models\DiaFamilia;

use Maatwebsite\Excel\Concerns\WithHeadingRow;


class DiaFamiliaImport implements ToModel
{
    /**
    * @param Collection $collection
    */
   // public function collection(Collection $rows)
   public function model(array $rows)
    {
        //dd($rows);
        
         DiaFamilia::create(
                        ['nombre_servidor' => strtoupper($rows[0]),
                         'identificacion' => strtoupper($rows[1]),
                         'despacho' => strtoupper($rows[2]),
                         'cargo' => strtoupper($rows[3]),
                         'contacto' => $rows[4],
                         'email' => $rows[5],
                         'acompanante_1' => strtoupper($rows[6]),
                         'identificacion_a1' => $rows[7],
                         'parentezco_1' => strtoupper($rows[8]),
                         'acompanante_2' => strtoupper($rows[9]),
                         'identificacion_a2' => $rows[10],
                         'parentezco_2' => strtoupper($rows[11]),
                         
                         ]);
                
    }
   
}
