<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaIncidenteItem extends Model
{
    protected $table = "categoria_incidente_item";
    //protected $primaryKey = 'id';
    protected $fillable = [
				    	'categoria_item_id',
                        'item',
             			'observaciones'
    						];
}
