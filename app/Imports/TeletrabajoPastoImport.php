<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

use App\Models\TeletrabajoPasto;
use App\Models\Despacho;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;


class TeletrabajoPastoImport implements /*ToCollection,WithHeadingRow*/ToModel
{
    /**
    * @param Collection $collection
    */
   // public function collection(Collection $rows)
   public function model(array $rows)
    {
       // DD(Carbon::parse($rows[8])->format('Y-mm-dd'),$rows[26],$rows[27],$rows[28],$rows[29]);
       // dd($rows[6], Carbon::parse($rows[6])->format('Y-m-d'));
       
       $radicado =strval($rows[0]);
       
       //$despacho = Despacho::where('codigoDespacho',$radicado)->first();
       //$correo=trim($despacho->correoD);
       //dd($despacho,$rows[0],trim($despacho->correoD),$correo);
       //dd($rows[22]);
       
       $fields = [];
        if (!empty($rows[8])) {
            $fields[] = $rows[8];
        }
        if (!empty($rows[10])) {
            $fields[] = $rows[10];
        }
        if (!empty($rows[12])) {
            $fields[] = $rows[12];
        }
        if (!empty($rows[14])) {
            $fields[] = $rows[14];
        }
        if (!empty($rows[16])) {
            $fields[] = $rows[16];
        }
        
        // Concatenar los campos no vacíos separados por comas
        $result = implode(",", $fields);
        
       // dd($result,$rows[8],$rows[10],$rows[12],$rows[14],$rows[16]);
       
    
       
        
        $teletrabajo = new TeletrabajoPasto();
        $teletrabajo->identificacion = $rows[0];
        $teletrabajo->nombre = $rows[1];
        $teletrabajo->dependencia = $rows[2];
        $teletrabajo->seccional = $rows[3];
        $teletrabajo->fecha_solicitud = $rows[4];
        $teletrabajo->estado = $rows[5];
        $teletrabajo->acuerdo_voluntades = $rows[6];
        $teletrabajo->lunes = $rows[7];
        $teletrabajo->martes = $rows[9];
        $teletrabajo->miercoles = $rows[11];
        $teletrabajo->jueves = $rows[13];
        $teletrabajo->viernes = $rows[15];
        $teletrabajo->dias_teletrabajo = $result;
        $teletrabajo->save();
        
        
    }
        
    
    
}
