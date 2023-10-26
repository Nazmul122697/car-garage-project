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
        Schema::create('sample_collection_letter_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_collection_id')->constrained('sample_collection_letters')->cascadeOnDelete();
            $table->unsignedInteger('serial');
            $table->string('sample_name');
            $table->string('sample_code_no');
            $table->unsignedInteger('numbers_of_sample');
            $table->string('test_parameter');
            $table->text('comment');
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
        Schema::dropIfExists('sample_collection_letter_details');
    }
};
