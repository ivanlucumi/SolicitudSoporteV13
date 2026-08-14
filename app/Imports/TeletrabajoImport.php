<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

use App\Models\Teletrabajo2024;
use App\Models\Despacho;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;


class TeletrabajoImport implements /*ToCollection,WithHeadingRow*/ToModel
{
    /**
    * @param Collection $collection
    */
   // public function collection(Collection $rows)
   public function model(array $rows)
    {
       // dd($rows);
       // DD(Carbon::parse($rows[8])->format('Y-mm-dd'),$rows[26],$rows[27],$rows[28],$rows[29]);
       // dd($rows[6], Carbon::parse($rows[6])->format('Y-m-d'));
       
       $radicado =strval($rows[0]);
       
       //$despacho = Despacho::where('codigoDespacho',$radicado)->first();
       //$correo=trim($despacho->correoD);
       //dd($despacho,$rows[0],trim($despacho->correoD),$correo);
       //dd($rows[22]);
       
       if($rows[32]=='SI'){
          $lunes='LUNES '; 
       }else{
          $lunes=null;  
       }
       if($rows[33]=='SI'){
          $martes='MARTES '; 
       }else{
          $martes=null;  
       }
       if($rows[34]=='SI'){
          $miercoles='MIERCOLES '; 
       }else{
          $miercoles=null;  
       }
       if($rows[35]=='SI'){
          $jueves='JUEVES '; 
       }else{
          $jueves=null;  
       }
       if($rows[36]=='SI'){
          $viernes='VIERNES '; 
       }else{
          $viernes=null;  
       }
       
       if($rows[22]=='SI'){
           $anuencia="CON ANUENCIA";
       }else{
           $anuencia="SIN ANUENCIA";
       }
       //$rows[25]
       
       if($rows[25]=='SI'){
           $favorable="FAVORABLE";
       }else{
           $favorable=NULL;
       }
        
        $teletrabajo = new Teletrabajo2024();
        $teletrabajo->corporacion = $rows[1];
        $teletrabajo->seccional = $rows[2];
        $teletrabajo->especialidad = $rows[3];
        $teletrabajo->codigo_despacho = $rows[0];
        $teletrabajo->despacho = $rows[4];
        //$teletrabajo->correo_despacho = $correo;
        $teletrabajo->direccion_teletrabajo = preg_replace('/\s+/', '', $rows[5]); 
        $teletrabajo->estado = $rows[6];
        $teletrabajo->estado_solicitud = $rows[7];
        $teletrabajo->fecha_solicitud = $rows[8];
        $teletrabajo->municipio = $rows[9];
        $teletrabajo->municipio_teletrabajo = $rows[10];
        $teletrabajo->identificacion = $rows[11];
        $teletrabajo->nombre_servidor = $rows[12];
        $teletrabajo->cargo = $rows[13];
        $teletrabajo->celular = $rows[14];
        $teletrabajo->correo_personal = $rows[15];
        $teletrabajo->correo_institucional = $rows[16];
        $teletrabajo->departamento_teletrabajo = $rows[17];
        $teletrabajo->nombre_nominador = $rows[18];
        $teletrabajo->identidad_nominador = $rows[19];
        $teletrabajo->cargo_nominador = $rows[20];
        $teletrabajo->tipo_servidor_judicial = $rows[21];
        $teletrabajo->anuencia_nominador = $anuencia;
        $teletrabajo->correo_nominador = $rows[23];
        $teletrabajo->departamento_judicial = $rows[24];
        $teletrabajo->favorable = $favorable;
        $teletrabajo->fecha_anuencia = $rows[26];
        $teletrabajo->fecha_firma_servidor = $rows[27];
        $teletrabajo->fecha_formalizacion = $rows[28];
        $teletrabajo->fecha_posecion = $rows[29];
        $teletrabajo->genero = $rows[30];
        $teletrabajo->lactante = $rows[31];
        $teletrabajo->dias_teletrabajo = $lunes.$martes.$miercoles.$jueves.$viernes;
        $teletrabajo->observaciones_visita= $rows[37];
        $teletrabajo->vigencia_solicitud= $rows[38];
        $teletrabajo->save();
        
        
    }
        
    
    
}
