<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicitud_prestamo_equipos', function (Blueprint $table) {
            // Datos del titular del despacho (Sección 1 del acta)
            $table->string('cargo_titular')->nullable()->after('nombre_juez');
            $table->string('correo_titular')->nullable()->after('cargo_titular');
            $table->string('lugar_funciones')->nullable()->after('correo_titular');
            // Fecha del acta (puede ser diferente a created_at)
            $table->date('fecha_acta')->nullable()->after('lugar_funciones');
        });
    }

    public function down(): void
    {
        Schema::table('solicitud_prestamo_equipos', function (Blueprint $table) {
            $table->dropColumn(['cargo_titular', 'correo_titular', 'lugar_funciones', 'fecha_acta']);
        });
    }
};
