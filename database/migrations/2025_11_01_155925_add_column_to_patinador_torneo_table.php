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
            $table->string('cancion2')->nullable();
            $table->string('archivo')->nullable();
            $table->string('archivo2')->nullable();
            $table->foreignId('patinador_id')->constrained('patinadores')->onDelete('cascade');
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
            $table->dropColumn('cancion2');
            $table->dropColumn('archivo');
            $table->dropColumn('archivo2');
            $table->dropColumn('patinador_id');
        });
    }
};
