<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ComiteGeneroGaleria extends Model
{
    //
    protected $table      = "comite_genero_galeria";
    protected $primaryKey = 'id';
    protected $fillable   = [
    	'cggTitulo', 'cggImagen', 'cggdescripcion', 'cggFecha', 
    	'cggEstado', 'cggCreador', 'cggModificador'
    ];

    /*public function setCggImagenAttribute($cggImagen){
    	if(!empty($cggImagen)){
            $dato = Carbon::now()->second.$cggImagen->getClientOriginalName();
            $this->attributes['cggImagen'] = $dato;
            \Storage::disk('local')->put($dato, \File::get($cggImagen));
        }
    }*/

    public static function comiteGeneroGaleriaIndex(){
    	//mostramos en el front- end los que su estado sea 1-> disponible
        $comitge = DB::select('select * from comite_genero_galeria where cggEstado = 1 order by created_at desc');

        if ($comitge!=null) {
            return $comitge;
        }else{
            return null;
        }
    }

    public static function comiteGeneroGaleria(){

        $comitge = DB::select('select *, (select concat(name," ",lastname) as nombre from users where cedula = cggCreador) as creador, (select concat(name," ",lastname) as nombre from users where cedula = cggModificador) as modificador from comite_genero_galeria order by created_at desc');

        if ($comitge!=null) {
            return $comitge;
        }else{
            return null;
        }
    }

    public static function comiteGeneroGaleriaIndexVer(){
        $total  = DB::select('select * from comite_genero_galeria where cggEstado = 1');
        $total1 = count($total);
        //dd($total1);
        $penultimo      = $total1 - 1;
        $antepenultimo  = $total1 - 2;
        $ultimo         = $total1;

        if($total != null){
            if ($total >= 3) {
                $mostrar = DB::select('select * from comite_genero_galeria where id = "'.$antepenultimo.'" or id = "'.$penultimo.'" or id = "'.$ultimo.'" order by created_at desc');
                //dd($mostrar);
                return $mostrar;
            }else{
                $mostrar = DB::select('select * from comite_genero_galeria where id = "'.$ultimo.'" order by created_at desc');
                return $mostrar;
            }
        }else{
            return null;
        } 
    }

}
