<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conductores_novedades', function (Blueprint $table) {
            $table->id();
            $table->string('placa', 20)->index();
            $table->string('conductor_cedula', 30)->index();
            $table->unsignedBigInteger('inspeccion_id')->nullable()->index();
            $table->date('fecha')->index();
            $table->text('descripcion');
            $table->string('estado', 20)->default('PENDIENTE'); // PENDIENTE, SOLUCIONADO
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conductores_novedades');
    }
};
