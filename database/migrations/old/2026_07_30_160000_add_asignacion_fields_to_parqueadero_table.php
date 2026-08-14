<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAsignacionFieldsToParqueaderoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parqueadero', function (Blueprint $table) {
            $table->string('asignacion_tipo')->nullable()->after('estado'); // 'fechas' o 'definitiva'
            $table->date('asignacion_inicio')->nullable()->after('asignacion_tipo');
            $table->date('asignacion_fin')->nullable()->after('asignacion_inicio');
            $table->boolean('oculto_para_conductores')->default(false)->after('asignacion_fin');
            $table->boolean('visible_para_otros')->default(true)->after('oculto_para_conductores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parqueadero', function (Blueprint $table) {
            $table->dropColumn([
                'asignacion_tipo',
                'asignacion_inicio',
                'asignacion_fin',
                'oculto_para_conductores',
                'visible_para_otros'
            ]);
        });
    }
}
