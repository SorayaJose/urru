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
        Schema::create('parametros', function (Blueprint $table) {
            $table->id();
            $table->double('ipc', 6, 2);
            $table->double('ur', 6, 2);
            $table->double('ur_anterior', 6, 2);
            $table->double('dorm_1', 6, 2)->nullable();
            $table->double('dorm_2', 6, 2)->nullable();
            $table->double('dorm_3', 6, 2)->nullable();
            $table->double('dorm_4', 6, 2)->nullable();
            $table->double('dorm_5', 6, 2)->nullable();
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
        Schema::dropIfExists('parametros');
    }
};
