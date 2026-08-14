<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Noticias extends Model
{
    //
    protected $table = "noticias";

    protected $fillable = ['nNombre', 'nImagen','nDescripcion','nLink', 'nTiempo', 'nEstado', 'nCreador', 'nModificador'];

    public function setNImagenAttribute($nImagen){
    	if(!empty($nImagen)){
    		$nNombre = Carbon::now()->second.$nImagen->getClientOriginalName();
    		$this->attributes['nImagen'] = $nNombre;
    		\Storage::disk('local')->put($nNombre, \File::get($nImagen));
    	}
    }

    public static function noticiasIndex(){

        $noticia = DB::select('select * from noticias where  nEstado = 1 order by created_at desc');
        //dd($noticia);
        if ($noticia!=null) {
            return $noticia;
        }else{
            return null;
        }

    }

    public static function actualizarEstadoN(){

        $fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');
        $noticia = Noticias::All();
        foreach ($noticia as $key => $vbn) {
            if($fdia > $vbn->bTiempo){
                $actualizar = DB::table('noticias')->where('id',$vbn->id)->update(['nEstado' => 0]);
            }
        }        
    }


}
