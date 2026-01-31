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
        Schema::table('torneos', function (Blueprint $table) {
            $table->boolean('cancion')->default(true);
            $table->boolean('cancion1')->default(true);
            $table->boolean('archivo')->default(true);
            $table->boolean('archivo2')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('torneos', function (Blueprint $table) {
            $table->dropColumn('cancion');
            $table->dropColumn('cancion2');
            $table->dropColumn('archivo');
            $table->dropColumn('archivo2');
        });
    }
};
