<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

use App\Models\TeletrabajoPasto;
use App\Models\Despacho;
use App\Models\NormalizacionAsignados;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;


class NormalizacionImport implements /*ToCollection,WithHeadingRow*/ToModel
{
    
    private $usuario = null;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }
    
   public function model(array $rows)
    {
       
       //dd($this->usuario,$rows);
       
       $radicado = rtrim($rows[0], "-");
       $radicado = rtrim($radicado, " ");
       
       
         NormalizacionAsignados::create(
                        ['radicacion' => $radicado,
                         'despacho' => $rows[0],
                         'user' => $this->usuario,
                         ]);
       
      
        
    }
        
    
    
}
