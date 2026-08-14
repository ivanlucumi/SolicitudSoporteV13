<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosAdjuntosTable extends Migration
{
    public function up()
    {
        Schema::create('archivos_adjuntos', function (Blueprint $table) {
            $table->id();
            
            // Relación polimórfica (puede adjuntarse a la solicitud o a un comentario)
            $table->morphs('attachable');
            
            $table->string('nombre_original');
            $table->string('nombre_almacenado')->unique(); // UUID generado
            $table->string('ruta');
            $table->string('mime_type')->nullable();
            $table->bigInteger('peso_bytes')->nullable();
            
            // Si el archivo fue subido por el funcionario o un administrador
            $table->unsignedBigInteger('usuario_id')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('archivos_adjuntos');
    }
}
