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
        Schema::create('recibos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('mes', 20)->nullable();
            $table->tinyInteger('estado')->default(0);
            $table->double('debe', 6, 2);
            $table->double('haber', 6, 2);
            $table->double('total', 6, 2);
            $table->unsignedBigInteger('socio_id');
            $table->unsignedBigInteger('liquidacion_id');
            //$table->unsignedBigInteger('reciboable_id');
            //$table->string('reciboable_type');
            //$table->foreignId('liquidacion_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('recibos');
    }
};
