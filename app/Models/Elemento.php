<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Elemento extends Model
{
    //
    //
    protected $table = "elementos";

    protected $primaryKey = 'id';
   
    protected $fillable = [
    	'id',
    	'nombreElemento',
        'idCategoria'
    						];


    public static function getElementos(){
    	$elementos = DB::select('select elementos.*, categorias.descripcioncategoria FROM elementos, categorias WHERE elementos.idCategoria = categorias.id');
    	return $elementos;
    }

   /* public function solicitude()
    {
       return $this->belongsToMany(Solicitud::class,'elementos_solicitud');
    }*/
}

