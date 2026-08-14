<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AyudaServisoft extends Model
{
    protected $table = "ayuda_servisoft";
    protected $fillable = 
   						 [
				    	'id',
				    	'categoria',
				    	'manual',
                        'error',
                        'solucion'
   						 ];
}
