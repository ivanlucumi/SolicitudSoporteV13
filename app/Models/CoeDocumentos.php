<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoeDocumentos extends Model
{
    protected $table = "documentos_coe";
    protected $fillable = [
				    	'tipo_documento',
                         'descripcion',
                         'documento',
                         'id_user',
    						];
    						
    						
    public function usuario()
    {
       return $this->belongsToMany(User::class,'id_user');//* se utiliza elementos_solicitud porque es la tabla donde esta la relacion de solicitud y elementos */
    }
    
   
}
