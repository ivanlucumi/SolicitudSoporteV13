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
        Schema::create('inspecciones', function (Blueprint $table) {
            $table->id();
            $table->string('placa', 20)->index();
            $table->string('conductor_cedula', 30)->index();
            $table->date('fecha')->index();
            $table->time('hora');
            $table->string('tipo_vehiculo', 20); // VEHICULO o MOTOCICLETA
            $table->integer('kilometraje');
            $table->string('estado', 20); // APTO, OBSERVACIONES, NO APTO
            $table->text('observaciones')->nullable();
            $table->longText('firma_conductor')->nullable(); // Guardar canvas en base64
            $table->string('quien_registro', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspecciones');
    }
};
