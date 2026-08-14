<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Auth\User as Authenticatable;


use Auth;

use App\Notifications\ResetPasswordNotification;

use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'id',
        'cedula',
        'name', 
        'email',
        'password',
        'lastname',
        'email',
        'password',
        'rol',
        'tipo_rol',
        'seccional',
        'cambiopassword',
        'certifico_personal',
        'estado_rol',
        'oficina_reparto',
        'encuesta'
                          ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    
    public function getFullNameAttribute()
    {
    return $this->name . ' ' . $this->lastname;
    }

   public function setPasswordAttribute($password){
        if(!empty($password)){
            //dd($password);
           //$this->attributes['password']= bcrypt($password);
           $this->attributes['password'] = Hash::make($password);
        }
    }
    
     /*  public function Ciudad()
    {
       return $this->belongsTo(Ciudad::class,'sala_id');
    }*/
    


     public static function todoUsers(){
        $users = DB::select('select users.*,rols.rol as rol from users,rols where users.rol = rols.id');
        return $users;
    }

    public static function comprobarAdministrador($id){
        $comprobar = DB::select('select * from users where id ='.$id.' and rol = 1');

        if($comprobar != null){
            return true;
        }else{
            return false;
        }
    }
    
    /*public function despachosAsignados()
    {
        
        return Despacho::whereIn('circuito', ['CALI', 'BUGA']);
    }*/
    
    public function despachosAsignados()
    {
        // Circuitos asignados al usuario (pueden venir de la BD)
        //$circuitos = $this->getCircuitosAsignados();
        
        $circuitosRaw =  auth()->user()->circuito_asignado;

        $circuitos = collect(
            is_array($circuitosRaw) ? $circuitosRaw : explode(',', (string) $circuitosRaw)
        )
            ->map(function ($item) {
                return trim($item);
            })
            ->filter()
            ->unique()
            ->values()
            ->all();
            
        if($circuitos){
           return Despacho::query()
            ->when(!empty($circuitos), function ($query) use ($circuitos) {
                $query->whereIn('circuito', $circuitos);
            })
            //->where('tipo', 'DESPACHO')
            ->whereRaw("(estado IS NULL OR LOWER(TRIM(estado)) != 'Inactivo')")
            ->where('nombreDespacho', 'NOT LIKE', '%LABORAL%')
            ->where('nombreDespacho', 'NOT LIKE', '%ADMINISTRATIVO%')
            ->orderBy('nombreDespacho'); 
        }else{
            return Despacho::query()
            ->when(!empty($circuitos), function ($query) use ($circuitos) {
                $query->whereIn('circuito', $circuitos);
            })
            ->where('tipo', 'DESPACHO111')
            ->where('nombreDespacho', 'NOT LIKE', '%LABORAL%')
            ->where('nombreDespacho', 'NOT LIKE', '%ADMINISTRATIVO%')
            ->orderBy('nombreDespacho');
        }
        
       
        
        
    }

    /**
     * Obtiene los circuitos asignados al usuario
     * 
     * @return array
     */
    protected function getCircuitosAsignados()
    {
        return ['PALMIRA11']; // Puede venir de $this->circuitos o relación  'PALMIRA'
    }
    
    
    /**
     * Obtiene las seccionales asignadas al usuario como un array.
     * El campo 'seccional' en la BD puede venir como "CALI, PALMIRA".
     * 
     * @return array
     */
    public function getSeccionales()
    {
        if (empty($this->seccional)) {
            return [];
        }

        return array_map('trim', explode(',', $this->seccional));
    }

}
