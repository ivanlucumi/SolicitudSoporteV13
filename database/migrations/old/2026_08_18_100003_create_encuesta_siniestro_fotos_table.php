<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encuesta_siniestro_fotos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('elemento_id');
            $table->foreign('elemento_id')->references('id')->on('encuesta_siniestro_elementos')->onDelete('cascade');
            
            $table->string('ruta_archivo', 500)->comment('Ruta relativa dentro de storage/app/public/');
            $table->string('nombre_archivo', 255)->nullable();
            $table->unsignedBigInteger('tamanio')->default(0)->comment('Tamaño en bytes');
            $table->string('mime_type', 50)->default('image/jpeg');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encuesta_siniestro_fotos');
    }
};
