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
        Schema::table('reporte_fallas', function (Blueprint $table) {
            $table->json('obs_ups')->nullable()->after('obs_telefonia');
            $table->json('evidencia_ups')->nullable()->after('evidencia_telefonia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reporte_fallas', function (Blueprint $table) {
            $table->dropColumn(['obs_ups', 'evidencia_ups']);
        });
    }
};
