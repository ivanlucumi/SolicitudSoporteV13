<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Detenido;

use Illuminate\Support\Carbon;

class SolicitudAudiencia extends Model
{
    protected $table = "solicitud_audiencias";

    protected $fillable = [
        'codigo_despacho',
        'nombre_entidad',
        'fecha_prgramada',
        'hora_inicio', 
        'hora_fin',
        'email',
        'nombre_entidad',
        'ciudad_destino',
        'entidad_destino',
        'numero_radicado_proceso',
        'declarante_indiciado',
        'direccion',
        'telefono',
        'audiencia_privada',
        'detenido',
        'id_conexion',
        'codigo',
        'num_agendamiento',
        'sala',
        'enlace',
        'editar',
        'fecha_solicitud',
        'solicitud_audiencias_id',
        'quien_asigno',
        'fecha_asignacion'];
        
        
   
    
    public function Detenidos()
    {
       return $this->hasMany(Detenido::class,'solicitud_audiencias_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
      public function Agendador()
    {
       return $this->belongsTo(User::class,'quien_asigno');
    }
    
       public function scopeFecha($query, $fecha){
        //dd( $fecha);
        

        
        if($fecha != ""){
            //$fechademas = Carbon::parse($fecha);
            //$fechademas->addDays(15); 
            $query->where('fecha_prgramada', $fecha);
            //$query->whereBetween('fecha_prgramada', [$fecha, $fechademas])
            //dd( $query);
        }
    }

    public function scopeUbicacion($query, $cuidad){
        //dd( $cuidad);
        if($cuidad != ""){
            $query->where('ciudad_destino','LIKE', '%' .$cuidad.'%' );
            //dd( $query);
        }
    }

    public function scopeUbicacionm($query, $cuidad){
        //dd( $cuidad);
        if($cuidad != ""){
            $query->where('ciudad_destino','!=', strtoupper($cuidad));
            //dd( $query);
        }
    }

    public function scopeEntidad($query, $entidad){
        //dd( $entidad);
        if($entidad != ""){
            $query->where('nombre_entidad','LIKE', '%' .$entidad.'%' );
            //dd( $query);
        }
    }

    public function scopeCiudad($query, $ciudad){
        //dd( $ciudad);
        if($ciudad != ""){
            $query->where('ciudad_destino','LIKE', '%'.$ciudad.'%' );
            //dd( $query);
        }
    }

    public function scopeEmail($query, $email){
        //dd( $email);
        if($email != ""){
            $query->where('email','LIKE', '%'.$email.'%');
            //dd( $query);
        }
    }
    public function scopeRadicado($query, $radicado){
        //dd( $radicado);
        if($radicado != ""){
            $query->where('radicado', $radicado);
            //dd( $query);
        }
    }
    
    public function scopeDespacho($query, $despacho){
        
        if($despacho){
            $query->where('codigo_despacho', $despacho);
            //dd( $query);
        }
    }
    
    public function scopeProcesado($query, $procesado){
        
        if($procesado){
            $query->where('cedula_procesado', $procesado);
            //dd( $query);
        }
    }
    public function scopeNombreP($query, $n_procesado){
        
        if($n_procesado){
            $query->where('nombre_procesado', $n_procesado);
            //dd( $query);
        }
    }
    

   

}

