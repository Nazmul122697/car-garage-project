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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->longText('history')->nullable();
            $table->longText('history_bn')->nullable();
            $table->longText('mission')->nullable();
            $table->longText('mission_bn')->nullable();
            $table->longText('vision')->nullable();
            $table->longText('vision_bn')->nullable();
            $table->longText('strategy')->nullable();
            $table->longText('strategy_bn')->nullable();
            $table->longText('goals')->nullable();
            $table->longText('goals_bn')->nullable();
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
        Schema::dropIfExists('abouts');
    }
};
