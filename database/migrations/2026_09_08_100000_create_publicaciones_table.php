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
        Schema::create('publicaciones_circulares', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_publicacion');
            $table->string('numero_acta')->nullable();
            $table->date('fecha')->nullable();
            $table->text('asunto')->nullable();
            $table->string('archivo_pdf')->nullable();
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
        Schema::dropIfExists('publicaciones_circulares');
    }
};
