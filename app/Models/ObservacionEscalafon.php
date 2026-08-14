<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\EscalafonRegistro;

class ObservacionEscalafon extends Model
{
    //
    protected $table = "observaciones_escalafon";

    protected $fillable = ['escalafon_registro_id', 'observaciones','tipo'];

   /**
     * Relación: Nota pertenece a un EscalafonRegistro
     */
    public function escalafonRegistro()
    {
        return $this->belongsTo(
            EscalafonRegistro::class,
            'escalafon_registro_id',
            'id'
        );
    }


}
