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
        Schema::table('gastos', function (Blueprint $table) {
            $table->enum('moneda', ['$', 'UR'])->default('$');
            $table->tinyInteger('estado')->default(0);
            $table->integer('socio_id')->unsigned()->nullable();
            $table->foreignId('socio_id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gastos', function (Blueprint $table) {
            $table->dropColumn('moneda');
            $table->dropColumn('estado');
            $table->dropColumn('socio_id');
        });
    }
};
