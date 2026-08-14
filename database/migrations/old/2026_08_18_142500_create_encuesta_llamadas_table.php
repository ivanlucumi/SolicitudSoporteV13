<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncuestaLlamadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuesta_llamadas', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->nullable();
            $table->string('celular')->nullable();
            $table->string('correo')->nullable();
            $table->string('municipio')->nullable();
            $table->string('nombre')->nullable();
            $table->string('despacho')->nullable();
            $table->string('cargo')->nullable();
            
            // Estado de la llamada
            $table->string('estado')->default('Pendiente'); // Pendiente, En proceso, Llamado
            
            // Lógica de concurrencia
            $table->unsignedInteger('usuario_id')->nullable()->comment('Usuario que toma el registro para llamar');
            $table->timestamp('locked_at')->nullable();
            
            // Observaciones de la encuesta
            $table->text('observaciones')->nullable();
            
            $table->timestamps();

            // Foreign key a users
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encuesta_llamadas');
    }
}
