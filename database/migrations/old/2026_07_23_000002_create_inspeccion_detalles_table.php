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
        Schema::create('inspeccion_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspeccion_id')->constrained('inspecciones')->onDelete('cascade');
            $table->string('grupo', 50); // DOCUMENTACION, LUCES, etc.
            $table->string('item', 50);  // soat_vigente, frenos, etc.
            $table->string('nombre_item', 150);
            $table->string('resultado', 10); // SI, NO, N/A
            $table->string('observacion', 255)->nullable(); // Obligatorio si resultado es NO
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspeccion_detalles');
    }
};
