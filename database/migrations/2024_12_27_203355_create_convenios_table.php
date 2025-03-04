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
        Schema::create('convenios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->tinyInteger('estado')->default(0);
            $table->tinyInteger('cuotas')->default(0);
            $table->double('valor', 6, 2);
            $table->double('total', 6, 2);
            $table->tinyInteger('pagas')->default(0);
            $table->foreignId('socio_id')->constrained()->onDelete('cascade');
            $table->foreignId('rubro_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('convenios');
    }
};
