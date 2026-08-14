<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudHistorialTable extends Migration
{
    public function up()
    {
        Schema::create('solicitud_historial', function (Blueprint $table) {
            $table->id();
            
            // Relacionada a la tabla original (o la nueva si se migra)
            $table->unsignedBigInteger('solicitud_id');
            // Dependiendo del nombre final de la tabla de solicitudes, se haría la foreign key
            // $table->foreign('solicitud_id')->references('id')->on('solicitudes_servicio')->onDelete('cascade');
            
            // Usuario que realizó la acción
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->string('usuario_nombre')->nullable();
            
            $table->string('accion'); // Ej: CAMBIAR_ESTADO, COMENTARIO, ARCHIVO
            $table->string('estado_anterior')->nullable();
            $table->string('estado_nuevo')->nullable();
            
            $table->text('comentario')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitud_historial');
    }
}
