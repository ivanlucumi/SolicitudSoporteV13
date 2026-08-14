<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\InventarioAlmacen;
use App\Models\InventarioCircuito;

use App\Models\Elemento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;

class InventarioSalaAudiencia extends Model
{
    use HasFactory;

    protected $table = "inventario_sala_audiencia";
    protected $fillable = ['nombre','ciudad','municipio','sede','direccion','piso','foto','observaciones_generales','id_user'];

    public function inventarioElementos()
    {
        return $this->hasMany(InventarioElementoSalaAudiencia::class, 'sala_id', 'id'); //InventarioElementoSalaAudiencia
    }
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function elementos()
    {
        return $this->hasMany(Elemento::class, 'sala_id');
    }
    // Relación con la tabla pivote de elementos asignados
    public function elementosAsignados()
    {
        return $this->hasMany(InventarioElementoSalaAudiencia::class, 'sala_id');
    }

}