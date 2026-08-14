<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ComiteGeneroEnlaces extends Model
{
    //
    protected $table      = "comite_genero_enlaces";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'cgetitulo', 'cgedescripcion', 'cgelink', 'cgecreador', 'cgemodificador'
    ];

    /*public function setCgeLinkAttribute($cgelink){

    	if(!empty($cgelink)){
    		$cgetitulo = Carbon::now()->second.$cgelink->getClientOriginalName();
            $this->attributes['cgelink'] = $cgetitulo;
            \Storage::disk('local')->put($cgetitulo, \File::get($cgelink));
    	}
    }
*/
    public static function comiteGeneroEnlacesIndex(){

        $comitge = DB::select('select * from comite_genero_enlaces order by created_at desc');

        if ($comitge!=null) {
            return $comitge;
        }else{
            return null;
        }
    }

    public static function comiteGeneroEnlaces(){

        $comitge = DB::select('select *, (select concat(name," ",lastname) as nombre from users where cedula = cgecreador) as creador, (select concat(name," ",lastname) as nombre from users where cedula = cgemodificador) as modificador from comite_genero_enlaces order by created_at desc');

        if ($comitge!=null) {
            return $comitge;
        }else{
            return null;
        }
    }
}
