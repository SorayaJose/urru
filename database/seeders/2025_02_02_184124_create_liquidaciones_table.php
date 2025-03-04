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
        Schema::create('liquidaciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->date('mes')->nullable();
            $table->integer('recibo_desde')->unsigned()->nullable();
            $table->integer('recibo_hasta')->unsigned()->nullable();
            $table->decimal('ur', 8, 2);
            $table->decimal('ipc', 8, 2);
            $table->decimal('fondo_servicio', 8, 2)->nullable();
            $table->decimal('fondo_1', 8, 2)->nullable();
            $table->decimal('fondo_2', 8, 2)->nullable();
            $table->decimal('fondo_3', 8, 2)->nullable();
            $table->decimal('fondo_4', 8, 2)->nullable();
            $table->decimal('fondo_5', 8, 2)->nullable();
            $table->decimal('fondo_cooperativo', 8, 2);
            $table->decimal('fondo_socorro', 8, 2);
            $table->decimal('reserva', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liquidaciones');
    }
};
