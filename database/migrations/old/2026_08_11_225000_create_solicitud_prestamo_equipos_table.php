<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudPrestamoEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_prestamo_equipos', function (Blueprint $table) {
            $table->id();
            
            $table->string('cedula_solicitante');
            $table->string('nombre_solicitante');
            
            $table->string('cedula_juez');
            $table->string('nombre_juez');
            
            $table->string('codigo_despacho');
            $table->string('despacho');
            
            // JSON array: [{tipo: 'Torre', placa: '1234'}, ...]
            $table->json('equipos'); 
            
            // Path al archivo PDF firmado subido por el usuario
            $table->string('archivo_pdf')->nullable(); 
            
            // Estado del flujo
            $table->string('estado')->default('Pendiente Carga PDF'); // Pendiente Carga PDF, En espera de autorizacion, Retirado, Rechazado
            
            // Observaciones hechas por el almacén
            $table->text('observaciones_almacen')->nullable();

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
        Schema::dropIfExists('solicitud_prestamo_equipos');
    }
}
