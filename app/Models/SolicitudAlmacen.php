<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Despacho;
use Illuminate\Support\Facades\DB;

class SolicitudAlmacen extends Model
{
    use HasFactory;

    protected $table = "solicitudes_almacen";

    protected $fillable = [
        'id_elemento',
        'elemento',
        'cantidad',
        'observaciones',
        'id_despacho',
        'despacho',
        'circuito',
        'correo_despacho',
        'mes_solicitud',
        'estado_solicitud',
        'fecha_solicitud',
        'cedula','nombre',
        'apellido',
        'cantidad_entregada',
        'fecha_entrega',
        'num_seguimiento',
        'quien_atendio',
        'id_quien_atendio',
        'id_almacen',
        'observacion_cierre'];
    
    
       public function NomDespacho()
    {
       return $this->belongsTo(Despacho::class,'id_despacho');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
    public static function Oficinas($circuito){
        //dd($circuito);
       $OficinasApoyo = ['CALI' => 'almacali@cendoj.ramajudicial.gov.co',
          'BUENAVENTURA' => 'ofapoyobtura@cendoj.ramajudicial.gov.co',
          'BUGA' => 'coordadtivabuga@cendoj.ramajudicial.gov.co',// solicitaron cambio de este correo 'ofapoyobuga@cendoj.ramajudicial.gov.co',
          'CARTAGO'=>'ofservcartago@cendoj.ramajudicial.gov.co',
          'PALMIRA'=>'oapalmira@cendoj.ramajudicial.gov.co',
          'ROLDANILLO' => 'ofservroldanillo@cendoj.ramajudicial.gov.co',
          'SEVILLA' => 'ofservsevilla@cendoj.ramajudicial.gov.co',
          'TULUA' => 'ofservtulua@cendoj.ramajudicial.gov.co']; 
          
          return $OficinasApoyo[$circuito];
    }
    
    
}
