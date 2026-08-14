<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaIncidente extends Model
{
    protected $table = "categoria_incidente";
    //protected $primaryKey = 'id';
    protected $fillable = [
				    	'categoria',
             			'observaciones'
    						];

 public function items(){
    return $this->belongsTo(CategoriaIncidenteItem::class,'categoria_item_id');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
 }

}
