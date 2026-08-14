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
        Schema::create('encuesta_siniestros', function (Blueprint $table) {
            $table->id();
            $table->string('consecutivo', 30)->unique()->comment('Ej: SIN-20260818-0001');
            
            // Despacho
            $table->string('despacho_codigo', 20)->nullable();
            $table->string('despacho_nombre', 255)->nullable();
            $table->string('despacho_correo', 255)->nullable();
            $table->string('despacho_ciudad', 150)->nullable();
            $table->string('despacho_direccion', 255)->nullable();
            
            // Titular del despacho
            $table->string('titular_nombre', 255)->nullable();
            $table->string('titular_cedula', 30)->nullable();
            $table->string('titular_cargo', 150)->nullable();
            $table->string('titular_correo', 255)->nullable();
            $table->string('titular_telefono', 50)->nullable();
            
            // Empleados involucrados (JSON array de objetos)
            $table->json('empleados_json')->nullable();
            
            // Información general
            $table->date('fecha_siniestro')->nullable();
            $table->text('observaciones_generales')->nullable();
            
            // Estado: borrador, registrado, enviado, en_revision, cerrado
            $table->string('estado', 30)->default('borrador');
            
            // PDF generado
            $table->string('pdf_path', 500)->nullable();
            $table->timestamp('pdf_generado_at')->nullable();
            
            // Control de correo
            $table->boolean('correo_enviado')->default(false);
            $table->timestamp('correo_enviado_at')->nullable();
            $table->text('correo_destinatarios')->nullable();
            $table->text('correo_error')->nullable();
            
            // Usuario registrador
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuesta_siniestros');
    }
};
