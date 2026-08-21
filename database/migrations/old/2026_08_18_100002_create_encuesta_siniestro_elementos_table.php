<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encuesta_siniestro_elementos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('encuesta_siniestro_id');
            $table->foreign('encuesta_siniestro_id')->references('id')->on('encuesta_siniestros')->onDelete('cascade');
            
            // Referencia opcional al inventario existente
            $table->unsignedBigInteger('inventario_id')->nullable()->comment('FK a inventarios.id si existe en inventario');
            
            // Información del elemento
            $table->string('tipo_elemento', 150)->nullable();
            $table->string('nombre_elemento', 255)->nullable();
            $table->string('placa', 100)->nullable();
            $table->string('serial', 150)->nullable();
            $table->string('marca', 150)->nullable();
            $table->string('modelo', 150)->nullable();
            $table->string('estado_anterior', 100)->nullable();
            $table->string('estado_posterior', 100)->nullable();
            $table->text('descripcion_dano')->nullable();
            $table->text('observaciones')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encuesta_siniestro_elementos');
    }
};
