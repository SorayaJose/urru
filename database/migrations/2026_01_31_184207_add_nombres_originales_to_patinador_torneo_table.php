<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patinador_torneo', function (Blueprint $table) {
            $table->string('cancion_nombre_original')->nullable()->after('cancion');
            $table->string('cancion2_nombre_original')->nullable()->after('cancion2');
            $table->string('archivo_nombre_original')->nullable()->after('archivo');
            $table->string('archivo2_nombre_original')->nullable()->after('archivo2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patinador_torneo', function (Blueprint $table) {
            $table->dropColumn(['cancion_nombre_original', 'cancion2_nombre_original', 'archivo_nombre_original', 'archivo2_nombre_original']);
        });
    }
};
