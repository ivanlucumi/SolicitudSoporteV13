<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('encuestas_trabajo_casa', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->string('correo');
            $table->string('cod_despacho')->nullable();
            $table->string('dependencia')->nullable();
            $table->string('ciudad')->nullable();
            
            // Preguntas
            $table->string('tiene_vpn')->nullable(); // SI / NO
            $table->string('requiere_vpn')->nullable(); // SI / NO
            
            // Elementos (SI, NO, SI REQUIERO)
            $table->string('computador');
            $table->string('impresora');
            $table->string('escaner');
            $table->string('conectividad');
            $table->string('silla');
            $table->string('escritorio');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('encuestas_trabajo_casa');
    }
};
