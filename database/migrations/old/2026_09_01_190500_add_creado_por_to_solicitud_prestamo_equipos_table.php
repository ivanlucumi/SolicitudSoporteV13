<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreadoPorToSolicitudPrestamoEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_prestamo_equipos', function (Blueprint $table) {
            $table->unsignedBigInteger('creado_por')->nullable()->after('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_prestamo_equipos', function (Blueprint $table) {
            $table->dropColumn('creado_por');
        });
    }
}
