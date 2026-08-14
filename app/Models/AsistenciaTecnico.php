<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class AsistenciaTecnico extends Model
{
    use HasFactory;
    
       protected $table = 'asistencia_tecnicos';
    protected $fillable = [
        'user_id',
        'sede',
        'fecha_registro',
        'hora_ingreso',
        'hora_salida',
        'ip_ingreso',
        'ip_salida',
        'observaciones',
        'latitude',
        'longitude'];


public static function Sedes(){
        //dd($circuito);
       $sedes = ['CALI PALACIO DE JUSTICIA' => 'CALI PALACIO DE JUSTICIA',
          'CALI EDIFICIO GOYA' => 'CALI EDIFICIO GOYA',
          'CALI PALACIO NACIONAL' => 'CALI PALACIO NACIONAL',
          'BUGA'=>'BUGA',
          'PALMIRA'=>'PALMIRA',
          'ROLDANILLO' => 'ROLDANILLO',
          'SEVILLA' => 'SEVILLA',
          'TULUA' => 'TULUA',
          'CARTAGO' => 'CARTAGO',
          'BUENAVENTURA' => 'BUENAVENTURA'];

          
          ksort($sedes);
      return $sedes;
    }

  public function usuario()
    {
       return $this->belongsTo(User::class,'user_id');
    }
    
}
