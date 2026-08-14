<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUbicacionToSeguridadStTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Deshabilitar temporalmente el modo estricto para evitar error 1067 por 'updated_at' con valor 0000-00-00
        \Illuminate\Support\Facades\DB::statement("SET SESSION sql_mode=''");

        Schema::table('seguridad_st', function (Blueprint $table) {
            if (!Schema::hasColumn('seguridad_st', 'ubicacion')) {
                $table->string('ubicacion')->nullable()->default('SST');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seguridad_st', function (Blueprint $table) {
            if (Schema::hasColumn('seguridad_st', 'ubicacion')) {
                $table->dropColumn('ubicacion');
            }
        });
    }
}
