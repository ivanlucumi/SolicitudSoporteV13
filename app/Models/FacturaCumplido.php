<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaCumplido extends Model
{
        protected $table = "factura_cumplidos";

    protected $fillable = [
                    'num_cumplido',
                    'seccional',
                    'mes_facturado',
                	'sede', 
                	'caso',
                	'repetido',
                	'cambio',
                	'usuario',
                	'repuesto',
                	'ubicacion',
                	'codigo_csj',
                	'fecha_entrega_repuesto',
                	'serial',
                	'marca',
                	'modelo',
                	'cantidad',
                	'valor_unitario',
                	'valor_total_iva'
        
        ];


}
