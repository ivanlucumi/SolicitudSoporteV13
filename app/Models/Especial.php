<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Especial extends Model
{
    //
    protected $table = "especial";

    protected $fillable = ['eFoto', 'eTiempo', 'eEstado', 'eCreador', 'eModificador'];

    public function setEFotoAttribute($eFoto){
        $img="dato";
    	if(!empty($eFoto)){
    		$img = Carbon::now()->second.$eFoto->getClientOriginalName();
    		$this->attributes['eFoto'] = $img;
    		\Storage::disk('local')->put($img, \File::get($eFoto));
    	}
    }

    public static function especilIndex(){

        $fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');

        $especial = DB::select('select * from especial where eEstado = 1 order by created_at desc');

        if ($especial!=null) {
            return $especial;
        }else{
            return null;
        }
    }

    public static function actualizarEstadoE(){

        $fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');
        $especialI = Especial::All();
        foreach ($especialI as $key => $vbn) {
            if($fdia > $vbn->bTiempo){
                $actualizar = DB::table('especial')->where('id',$vbn->id)->update(['eEstado' => 0]);
            }
        }        
    }


}
