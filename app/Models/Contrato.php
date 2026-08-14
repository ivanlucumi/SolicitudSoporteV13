<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Contrato extends Model
    {
        
        // Conexi贸n a otra base de datos definida en config/database.php 
        protected $connection = 'mysql_contratos'; 
        
        protected $fillable = [
            'numero','tipo','contratista','fecha_inicio','fecha_polizas','objeto','valor',
            'forma_pago','fecha_terminacion','fecha_cierre','documento_inicial',
            'apoyo_supervision_id','estado','firmo_acta','subio_secop','cerro_contrato','subio_secop2','termino_contrato_secop2'
        ];
    
        protected $dates = [
            'fecha_inicio','fecha_polizas','fecha_terminacion','fecha_cierre'
        ];
    
        public function apoyo()
        {
           // return $this->belongsTo(User::class, 'apoyo_supervision_id');
        }
    
        public function novedades()
        {
            return $this->hasMany(ContratoNovedad::class);
        }
        
        public function adiciones()
        {
            return $this->hasMany(ContratoAdicion::class);
        }
        
        
        // 1️⃣ ¿Tiene adiciones?
        public function getTieneAdicionesAttribute()
        {
            return $this->adiciones()->exists();
        }
    
        // 2️⃣ Total valor adicionado
        public function getTotalAdicionesAttribute()
        {
            return $this->adiciones()->sum('valor_adicion');
        }
    
        // 3️⃣ Valor total del contrato
        public function getValorTotalAttribute()
        {
            return $this->valor + $this->total_adiciones;
        }
    
        // 4️⃣ Fecha de terminación final (con prórrogas)
        public function getFechaTerminacionFinalAttribute()
        {
            $dias = $this->adiciones()->sum('dias_prorroga');
    
            return ($dias > 0 && $this->fecha_terminacion)
                ? $this->fecha_terminacion->copy()->addDays($dias)
                : $this->fecha_terminacion;
        }
        
        
        /* 🔴🟡🟢 SEMÁFORO */
        public function getSemaforoInicioAttribute() 
        {
            $dias = now()->diffInDays($this->fecha_inicio, false);
    
            if ($dias < 0) return 'danger';     // vencido
            if ($dias <= 30) return 'warning';  // por vencer
            return 'success';                   // vigente
        }
    
        /* 🔴🟡🟢 SEMÁFORO */
        public function getSemaforoAttribute()
        {
            $dias = now()->diffInDays($this->fecha_terminacion, false);
    
            if ($dias < 0) return 'danger';     // vencido
            if ($dias <= 30) return 'warning';  // por vencer
            return 'success';                   // vigente
        }
        
         /* 🔴🟡🟢 SEMÁFORO */
        public function getSemaforoCierreAttribute()
        {
            $dias = now()->diffInDays($this->fecha_cierre, false);
    
            if ($dias < 0) return 'danger';     // vencido
            if ($dias <= 30) return 'warning';  // por vencer
            return 'success';                   // vigente
        }
    }
