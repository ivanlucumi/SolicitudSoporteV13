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
        Schema::table('despachos', function (Blueprint $table) {
            if (!Schema::hasColumn('despachos', 'sede')) {
                $table->string('sede', 100)->nullable()->after('nombreDespacho');
            }
            if (!Schema::hasColumn('despachos', 'edificio')) {
                $table->string('edificio', 50)->nullable()->after('districto');
            }
            if (!Schema::hasColumn('despachos', 'piso')) {
                $table->string('piso', 20)->nullable()->after('edificio');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('despachos', function (Blueprint $table) {
            if (Schema::hasColumn('despachos', 'sede')) {
                $table->dropColumn('sede');
            }
            if (Schema::hasColumn('despachos', 'edificio')) {
                $table->dropColumn('edificio');
            }
            if (Schema::hasColumn('despachos', 'piso')) {
                $table->dropColumn('piso');
            }
        });
    }
};
