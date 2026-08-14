<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalActivo extends Model
{
    protected $table = "personal_activo";
    //protected $primaryKey = 'id';
    protected $fillable = [
				    	'despacho',
                         'empleado',
                         'estado',
                         'reemplazo',
    						];
    						
  public function empleadoAct()
    {
       return $this->belongsTo(Persona::class,'empleado');
    }
    
 public function remplazoDes()
    {
       return $this->belongsTo(Persona::class,'reemplazo');
    }
    
public function despachoAct()
    {
       return $this->belongsTo(Despacho::class,'despacho','codigoDespacho');
    }
}
