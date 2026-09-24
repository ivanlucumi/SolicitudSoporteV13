<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Ciudad;
use Illuminate\Support\Facades\DB;

class Despacho extends Model
{
    //
    //
    protected $table = "despachos";
    protected $primaryKey = 'codigoDespacho';
    protected $fillable = [
    	'codigoDespacho',
    	'nombreDespacho',
    	'sede',
    	'codCiudad',
    	'direccion',
    	'telefono',
    	'correoD',
    	'atencion_virtual',
    	'correo_demanda',
    	'correo_memoriales',
        'extension',
        'circuito',
        'districto',
        'especialidad',
        'jurisdiccion',
        'tipo_despacho',
        'competencia',
        'subespecialidad',
        'orden',
        'transformado',
        'edificio',
    	'piso',
        'estado',
        'creador',
        'modificador',
        'notificacion_ficha_remision'
    						];

    public static function todoDespachos(){
        $despachos = DB::select('select despachos.*,ciudades.nombreCiudad as ciudad from despachos,ciudades where  despachos.codCiudad = ciudades.codigoCiudad ');
        
        return $despachos;
    }

    public static function despachoIndex(){
        //$desp = DB::select('select despachos.*, ciudades.nombreCiudad as ciudad from despachos, ciudades where despachos.codCiudad = ciudades.codigoCiudad AND estado IS NULL ');
        $desp = DB::table('despachos')
            ->join('ciudades', 'despachos.codCiudad', '=', 'ciudades.codigoCiudad')
            ->select('despachos.*', 'ciudades.nombreCiudad as ciudad')
            ->whereRaw("(estado IS NULL OR LOWER(TRIM(estado)) != 'Inactivo')")
            ->orderBy('nombreDespacho', 'asc')
            ->orderBy('ciudad', 'asc')
            ->get();


//dd($desp);
         if ($desp!=null){
            return $desp;
        }else{
            return null;
        }
    }
    public static function despachoPresencial($USER){
       // dd($USER);
        $desp = DB::select('select despachos.*, ciudades.nombreCiudad as ciudad from despachos, ciudades where despachos.codCiudad = ciudades.codigoCiudad AND circuito="'.$USER.'" AND tipo="DESPACHO" ORDER BY circuito asc');
     // dd($desp);
         if ($desp!=null){
            return $desp;
        }else{
            return null;
        }
    }
    public static function despachoPresencialD($USER){
       //dd($USER);
        $desp = DB::select('select despachos.*, ciudades.nombreCiudad as ciudad from despachos, ciudades where despachos.codCiudad = ciudades.codigoCiudad AND codigoDespacho="'.$USER.'"');
      //dd($desp);
         if ($desp!=null){
            return $desp;
        }else{
            return null;
        }
    }
    
     public static function asistencia($USER){
       //dd($USER);
        $desp = DB::select('select despachos.codigoDespacho,
        despachos.nombreDespacho,
        despachos.districto,
        despachos.circuito,
        seguimiento_presencialidad.asistencia,
        seguimiento_presencialidad.fecha_registro_asistencia,
        seguimiento_presencialidad.despacho_r, 
        seguimiento_presencialidad.num_funcionarios 
        FROM despachos,seguimiento_presencialidad 
        WHERE seguimiento_presencialidad.codigoDespacho_id = despachos.codigoDespacho and codigo_despacho_r='.$USER);  // and vigencia_solicitud=2025
      //dd($desp);
         if ($desp!=null){
            return $desp;
        }else{
            return null;
        }
    }
    
      public function ciudad()
    {
       return $this->belongsTo(Ciudad::class,'codCiudad');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
    
    public function actividades()
    {
        return $this->hasMany(ActividadDespacho::class, 'codigoDespacho', 'codigoDespacho');
    }
    
    public function actividadesDespacho()
    {
        return $this->hasMany(ActividadDespacho::class, 'codigoDespacho', 'codigoDespacho');
    }
    
    public function cargos()
    {
        return $this->hasMany(Cargo::class);
    }
    
}
