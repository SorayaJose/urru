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
            $table->double('valor_auto', 6, 3);
            $table->double('valor_moto', 6, 3);
            $table->double('valor_bici', 6, 3);
            $table->string('mensaje_recibo')->nullable();
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
            $table->dropColumn('valor_auto');
            $table->dropColumn('valor_moto');
            $table->dropColumn('valor_bici');
            $table->dropColumn('mensaje_recibo');
        });
    }
};
