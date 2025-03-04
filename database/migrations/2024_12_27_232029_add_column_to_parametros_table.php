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
        Schema::table('parametros', function (Blueprint $table) {
            $table->double('fondo_servicio', 6, 2);
            $table->double('fondo_1', 6, 2)->nullable();
            $table->double('fondo_2', 6, 2)->nullable();
            $table->double('fondo_3', 6, 2)->nullable();
            $table->double('fondo_4', 6, 2)->nullable();
            $table->double('fondo_5', 6, 2)->nullable();
            $table->double('fondo_cooperativo', 6, 2);
            $table->double('fondo_socorro', 6, 2);
            $table->double('reserva', 6, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parametros', function (Blueprint $table) {
            $table->dropColumn('fondo_servicio');
            $table->dropColumn('fondo_1');
            $table->dropColumn('fondo_2');
            $table->dropColumn('fondo_3');
            $table->dropColumn('fondo_4');
            $table->dropColumn('fondo_5');
            $table->dropColumn('fondo_cooperativo');
            $table->dropColumn('fondo_socorro');
            $table->dropColumn('reserva');
        });
    }
};
