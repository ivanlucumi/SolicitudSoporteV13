<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_servicio', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('numero_solicitud')->unique();
            
            // Si hay una tabla despachos u oficinas, se relacionaría aquí
            $table->string('dependencia_id')->nullable(); 
            $table->string('dependencia_nombre')->nullable();
            $table->string('dependencia_email')->nullable();
            
            $table->string('solicitante_identificacion')->index();
            $table->string('solicitante_nombre');
            
            $table->string('tipo_solicitud')->index();
            $table->string('medio_solicitud')->nullable();
            
            $table->text('descripcion')->nullable();
            $table->text('respuesta')->nullable(); // Si se requiere guardar última rta rápida
            
            $table->string('estado')->index()->default('ABIERTO'); // ABIERTO, ASIGNADO, CERRADO...
            
            // Referencia al usuario administrador que toma el caso
            $table->unsignedBigInteger('responsable_id')->nullable()->index();
            $table->string('responsable_nombre')->nullable();
            
            $table->timestamp('fecha_solucion')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes_servicio');
    }
}
