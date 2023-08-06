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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->foreignId('group_id')->constrained();
            $table->string('name');
            $table->unsignedTinyInteger('won')->default(0);                      // Số trận thắng
            $table->unsignedTinyInteger('draw')->default(0);                     // Số trận hòa
            $table->unsignedTinyInteger('lost')->default(0);                     // Số trận thua
            $table->unsignedTinyInteger('goals_for')->default(0);                // Số bàn thắng ghi được
            $table->unsignedTinyInteger('goals_against')->default(0);            // Số bàn thua phải nhận
            $table->unsignedTinyInteger('points')->default(0);                   // Điểm

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
        Schema::dropIfExists('teams');
    }
};
