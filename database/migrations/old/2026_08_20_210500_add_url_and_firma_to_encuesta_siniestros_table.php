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
        Schema::table('encuesta_siniestros', function (Blueprint $table) {
            $table->string('url_fotos', 1000)->nullable()->after('observaciones_generales');
            $table->text('firma_empleado')->nullable()->after('url_fotos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encuesta_siniestros', function (Blueprint $table) {
            $table->dropColumn(['url_fotos', 'firma_empleado']);
        });
    }
};
