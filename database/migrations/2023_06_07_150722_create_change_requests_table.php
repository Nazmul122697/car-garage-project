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
        Schema::create('change_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->text('remark')->nullable();
            $table->text('invoice_id')->nullable();
            $table->text('document')->nullable();
            $table->tinyInteger('isChallan')->nullable();
            $table->timestamp('request_created_at')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamp('request_updated_at')->nullable();
            $table->tinyInteger('status')->nullable()->comment('0=>pending, 1=> updated');
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
        Schema::dropIfExists('change_requests');
    }
};
