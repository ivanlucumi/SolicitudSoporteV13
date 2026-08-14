<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTvYSalasToReporteFallasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reporte_fallas', function (Blueprint $table) {
            $table->json('obs_televisor')->nullable();
            $table->json('evidencia_televisor')->nullable();
            
            $table->json('obs_sala_audiencia')->nullable();
            $table->json('evidencia_sala_audiencia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reporte_fallas', function (Blueprint $table) {
            $table->dropColumn([
                'obs_televisor', 
                'evidencia_televisor', 
                'obs_sala_audiencia', 
                'evidencia_sala_audiencia'
            ]);
        });
    }
}
