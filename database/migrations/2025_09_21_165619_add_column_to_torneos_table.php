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
            $table->string('nombre');
            $table->string('slug');
            $table->date('fecha');
            $table->date('fecha_cierre');
            $table->text('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->foreignId('pista_id')->constrained()->onDelete('cascade');
            $table->foreignId('escuela_id')->constrained()->onDelete('cascade');
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
            $table->dropColumn('nombre');
            $table->dropColumn('slug');
            $table->dropColumn('fecha');
            $table->dropColumn('fecha_cierre');
            $table->dropColumn('descripcion');
            $table->dropColumn('imagen');
            $table->dropColumn('pista_id');
            $table->dropColumn('escuela_id');
            $table->dropForeign('torneos_pista_id_foreign');
            $table->dropForeign('torneos_escuela_id_foreign');
        });
    }
};
