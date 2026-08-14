<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExclusivoConductorToParqueaderoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parqueadero', function (Blueprint $table) {
            $table->boolean('exclusivo_para_conductor')->default(false)->after('visible_para_otros');
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
            $table->dropColumn('exclusivo_para_conductor');
        });
    }
}
