<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ComiteGenero extends Model
{
    //
    protected $table      = "comite_genero";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'cgtitulo', 'cgdocumento', 'cgcreador', 'cgmodificador'
    ];

    public function setCgdocumentoAttribute($cgdocumento){
    	if(!empty($cgdocumento)){
    		$cgtitulo = Carbon::now()->second.$cgdocumento->getClientOriginalName();
    		$this->attributes['cgdocumento'] = $cgtitulo;
    		\Storage::disk('local')->put($cgtitulo, \File::get($cgdocumento));
    	}
    }

    public static function comiteGeneroIndex(){
        
        $comitg = DB::select('select * from comite_genero order by created_at desc');

        if ($comitg!=null) {
            return $comitg;
        }else{
            return null;
        }
    }

    public static function comiteGenero(){

        $comitg = DB::select('select *, (select concat(name," ",lastname) as nombre from users where cedula = cgcreador) as creador, (select concat(name," ",lastname) as nombre from users where cedula = cgmodificador) as modificador from comite_genero order by created_at desc');

        if ($comitg!=null) {
            return $comitg;
        }else{
            return null;
        }
    }
}
