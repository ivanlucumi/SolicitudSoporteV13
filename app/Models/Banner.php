<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Banner extends Model
{
    //
    protected $table = "banners";

    protected $fillable = ['bNombre', 'bFoto','bextension', 'bLink', 'bTiempo', 'bEstado', 'bCreador', 'bModificador'];

     public function setBFotoAttribute($bFoto){
    	if(!empty($bFoto)){
    	    $originalName = $bFoto->getClientOriginalName();
    	    $extension = $bFoto->getClientOriginalExtension();
    	    // Normalizar el nombre: quitar caracteres especiales, espacios, acentos, etc.
            $normalized = Str::slug($originalName, '-');
    	    
    		$bNombre = now()->format('Ymd_His') . '_' . uniqid() . '.' . $extension;;
    		
    		\Storage::disk('local')->put($bNombre, \File::get($bFoto));
    		$this->attributes['bFoto'] = $bNombre;
    	}
    } 

    public static function bannerIndex(){

        $fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');

        $banner = DB::select('select * from banners where bEstado = 1 AND bCreador != "BIENESTAR" order by created_at desc');

        if ($banner!=null) {
            return $banner;
        }else{
            return null;
        }
    }
    
    public static function bannerIndexBienestar(){

        $fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');

        $banner = DB::select('select * from banners where bEstado = 1 AND bCreador = "BIENESTAR" order by created_at desc');

        if ($banner!=null) {
            return $banner;
        }else{
            return null;
        }
    }

    public static function actualizarEstadoB(){

        $fdia = Carbon::now();
        $fdia = $fdia->format('Y-m-d');
        $banner = Banner::All();
        foreach ($banner as $key => $vbn) {
            if($fdia > $vbn->bTiempo){
                $actualizar = DB::table('banners')->where('id',$vbn->id)->update(['bEstado' => 0]);
            }
        }        
    }
    
}
