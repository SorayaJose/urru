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
        Schema::create('locales', function (Blueprint $table) {
            $table->id();
            //$table->string('nombre');
            $table->string('nombre', 250)->nullable();
            $table->enum('moneda', ['$', 'UR'])->default('$');
            $table->double('alquiler', 10, 2)->nullable();
            $table->date('contrato_desde')->nullable();
            $table->date('contrato_hasta')->nullable();
            $table->double('recargo', 10, 2)->nullable();
            $table->string('garantia', 250)->nullable();
            $table->string('direccion', 250)->nullable();
            $table->string('clase', 100)->nullable();
            $table->foreignId('persona_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('locales');
    }
};
