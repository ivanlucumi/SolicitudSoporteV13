<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteFallasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_fallas', function (Blueprint $table) {
            $table->id();
            
            // Datos básicos
            $table->string('identificacion_empleado')->nullable();
            $table->string('nombre_empleado');
            $table->string('codigo_juzgado')->nullable();
            $table->string('juzgado');

            // Fallas seleccionadas (JSON array para saber cuáles marcaron)
            $table->json('tipos_falla')->nullable();

            // Observaciones
            $table->text('obs_conectividad')->nullable();
            $table->text('obs_computo')->nullable();
            $table->text('obs_impresoras')->nullable();
            $table->text('obs_escaner')->nullable();
            $table->text('obs_telefonia')->nullable();
            $table->text('obs_ups')->nullable();

            // Evidencias (rutas de archivos, almacenadas en JSON ya que pueden ser múltiples)
            $table->json('evidencia_conectividad')->nullable();
            $table->json('evidencia_computo')->nullable();
            $table->json('evidencia_impresoras')->nullable();
            $table->json('evidencia_escaner')->nullable();
            $table->json('evidencia_telefonia')->nullable();
            $table->json('evidencia_ups')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reporte_fallas');
    }
}
