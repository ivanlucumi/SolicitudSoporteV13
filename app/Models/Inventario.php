<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Elemento;
use App\Models\Despacho;

use Illuminate\Support\Facades\DB;


class Inventario extends Model
{
    //
     protected $table = "inventarios";
   
    protected $fillable = [
    	'id', 
    	'codigoElemento', 
    	'codigoJuzgado', 
		'placaInventario',  
		'marca', 
		'modelo', 
		'serial', 
		'valorArticulo',
		'fechaAsignacion', 
		'estadoPlaca',
		'observacionPlaca'
    						];

 	public static function getInventario($id){
    	$inventario = DB::select('select inventarios.*, elementos.nombreElemento, despachos.nombreDespacho from inventarios, elementos,despachos where inventarios.id ='.$id);
    	return $inventario;
	}

 	public static function todoInventario(){
    	$inventario = DB::select('select inventarios.*, elementos.nombreElemento, despachos.nombreDespacho 
		from inventarios, elementos,despachos
		where inventarios.codigoElemento = elementos.id and despachos.codigoDespacho = inventarios.codigoJuzgado');
    	return $inventario;
	}

	public static function invetarioJuzgado($despacho){
    	$inventario = DB::select('select inventarios.id as idInventario, inventarios.placaInventario, inventarios.marca, inventarios.modelo, inventarios.serial, elementos.nombreElemento FROM inventarios, elementos WHERE inventarios.codigoElemento = elementos.id  AND inventarios.estadoPlaca = "1" AND inventarios.codigoJuzgado ='.$despacho);
    	if($inventario != null){
    	  return $inventario;  
    	}else{
    	  return null;
    	}
    	
    	
	}
    //CONCAT("Inventario:",inventarios.placaInventario," ",elementos.nombreElemento)

    public static function invetarioJuzgadoDinamico($despacho,$id){
        $inventario = DB::select('select elementos.id as idInventario, elementos.nombreElemento, inventarios.placaInventario, inventarios.marca, inventarios.modelo, inventarios.serial, elementos.nombreElemento, inventarios.codigoJuzgado,elementos.idCategoria
            FROM inventarios, elementos 
            WHERE inventarios.codigoElemento = elementos.id  
            AND inventarios.estadoPlaca = "ACTIVOS"
            AND elementos.idCategoria = '."'$id'".' 
            AND inventarios.codigoJuzgado = '.$despacho);
        if($inventario != null){
          return $inventario;  
        }else{
          return null;
        }
        
        
    }

    /*
    
     */

	public static function codigoJuzgado($id){
    	$inventario = DB::select('select users.cedula FROM users WHERE users.id ='.$id);
    	return $inventario;
	}


    public function elementoI()
    {
       return $this->belongsTo(Elemento::class,'codigoElemento');   }


public function despachoI()
    {
       return $this->belongsTo(Despacho::class,'codigoJuzgado');
    }


}
