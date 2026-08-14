<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Sst extends Model
{
    //
    protected $table      = "seguridad_st";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'sst_titulo', 'sst_documento', 'sst_creador', 'sst_modificador','ubicacion'
    ];

    public function setSstdocumentoAttribute($sst_documento){
    	if(!empty($sst_documento)){
    		$sst_titulo = Carbon::now()->second.$sst_documento->getClientOriginalName();
    		$this->attributes['sst_documento'] = $sst_titulo;
    		\Storage::disk('local')->put($sst_titulo, \File::get($sst_documento));
    	}
    }

   

   
}
