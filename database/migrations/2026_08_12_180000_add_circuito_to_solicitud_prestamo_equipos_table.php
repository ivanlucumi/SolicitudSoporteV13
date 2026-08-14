<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCircuitoToSolicitudPrestamoEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_prestamo_equipos', function (Blueprint $table) {
            $table->string('circuito')->nullable()->after('despacho');
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
            $table->dropColumn('circuito');
        });
    }
}
