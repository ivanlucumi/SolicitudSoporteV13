<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\EscalafonRegistro;

class NotaEscalafon extends Model
{
    //
    protected $table = "notas_escalafon";

    protected $fillable = ['escalafon_registro_id', 'notas','tipo'];
    

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
