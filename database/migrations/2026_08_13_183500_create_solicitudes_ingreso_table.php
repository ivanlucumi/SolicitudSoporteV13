<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_ingreso', function (Blueprint $table) {
            $table->id();
            $table->string('numero_seguimiento')->unique();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->string('codigo_despacho')->nullable();
            $table->string('despacho')->nullable();
            $table->date('fecha_solicitud')->nullable();
            $table->string('correo_usuario')->nullable();
            $table->string('cedula_titular');
            $table->string('nombre_titular');
            $table->string('cargo_titular');
            $table->string('correo_titular');
            $table->string('cedula_empleado');
            $table->string('nombre_empleado');
            $table->string('cargo_empleado');
            $table->text('motivo_ingreso');
            $table->string('estado')->default('Pendiente'); // Pendiente, Autorizada, Denegada
            $table->date('fecha_ingreso')->nullable();
            $table->time('hora_ingreso')->nullable();
            $table->text('observaciones_almacen')->nullable();
            $table->string('circuito');
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
        Schema::dropIfExists('solicitudes_ingreso');
    }
};
