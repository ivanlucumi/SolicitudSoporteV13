<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('encuestas_trabajo_casa', function (Blueprint $table) {
            $table->string('aplicaciones')->nullable()->after('escritorio');
        });
    }

    public function down()
    {
        Schema::table('encuestas_trabajo_casa', function (Blueprint $table) {
            $table->dropColumn('aplicaciones');
        });
    }
};
