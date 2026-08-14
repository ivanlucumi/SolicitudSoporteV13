<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Institucional extends Model
{
    //
    protected $table = "institucionals";

    protected $fillable = ['iTitulo', 'iFoto', 'iDescripcion', 'iTipo', 'iCreador', 'iModificador'];

    public function setIFotoAttribute($iFoto){
    	if(!empty($iFoto)){
    		$iTitulo = Carbon::now()->second.$iFoto->getClientOriginalName();
    		$this->attributes['iFoto'] = $iTitulo;
    		\Storage::disk('local')->put($iTitulo, \File::get($iFoto));
    	}
    }

    public static function Institucional(){
        return DB::table('institucionals');
            //->join('genres','genres.id','=','movies.genre_id')
        
            //->select('movies.*', 'genres.genre')
    }

    public static function verInstitucioonal(){

        $institucionals = DB::select('select * from institucionals where iTipo = "Vision"');

        if ($institucionals!=null) {
            return $institucionals;
        }else{
            return null;
        }
    }
    
    public static function verInstitucioonalM(){

        $institucionals = DB::select('select * from institucionals where iTipo = "Mision"');

        if ($institucionals!=null) {
            return $institucionals;
        }else{
            return null;
        }
    }
}
