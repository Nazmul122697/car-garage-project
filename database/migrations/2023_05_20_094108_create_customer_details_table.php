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
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->string('company_name')->unique()->nullable();
            $table->string('nature')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('nid_file')->nullable();
            $table->string('erc_no')->nullable();
            $table->date('erc_expiry_date')->nullable();
            $table->string('erc_file')->nullable();
            $table->string('bin_no')->nullable();
            $table->date('bin_expiry_date')->nullable();
            $table->string('bin_file')->nullable();
            $table->string('tin_no')->nullable();
            $table->date('tin_expiry_date')->nullable();
            $table->string('tin_file')->nullable();
            $table->string('trade_no')->nullable();
            $table->date('trade_expiry_date')->nullable();
            $table->string('trade_file')->nullable();
            $table->string('company_logo')->nullable();
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
        Schema::dropIfExists('customer_details');
    }
};
