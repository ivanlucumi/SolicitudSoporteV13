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
        Schema::table('encuestas_trabajo_casa', function (Blueprint $table) {
            $table->string('cuenta_todos_elementos')->nullable()->after('aplicaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encuestas_trabajo_casa', function (Blueprint $table) {
            $table->dropColumn('cuenta_todos_elementos');
        });
    }
};
