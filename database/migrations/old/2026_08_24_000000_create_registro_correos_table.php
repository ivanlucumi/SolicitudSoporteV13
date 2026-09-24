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
        Schema::create('registro_correos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ficha_id')->nullable()->comment('ID de FichaPreliminar asociado');
            $table->string('vista')->comment('Ruta de la vista de correo a utilizar');
            $table->longText('datos_json')->nullable()->comment('Datos en formato JSON para la vista');
            $table->text('destinatario')->comment('Direcciones destino separadas por comas');
            $table->text('con_copia')->nullable()->comment('Direcciones CC separadas por comas');
            $table->string('asunto')->comment('Asunto del correo');
            $table->text('adjuntos_json')->nullable()->comment('Rutas de adjuntos en formato JSON');
            $table->enum('estado', ['PENDIENTE', 'ENVIADO', 'FALLIDO'])->default('PENDIENTE');
            $table->integer('intentos')->default(0);
            $table->longText('mensaje_error')->nullable();
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
        Schema::dropIfExists('registro_correos');
    }
};
