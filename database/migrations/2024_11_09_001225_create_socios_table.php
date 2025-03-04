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
        Schema::create('socios', function (Blueprint $table) {
            $table->id();
            $table->double('capital', 10, 2)->nullable();
            $table->boolean('cochera')->nullable();
            $table->boolean('luz_cochera')->nullable();
            $table->integer('moto')->nullable();
            $table->integer('bici')->nullable();
            $table->double('biblioteca', 6, 2)->nullable();
            $table->boolean('activo')->default(true);
            $table->string('auxiliar', 100)->nullable();
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
        Schema::dropIfExists('socios');
    }
};
