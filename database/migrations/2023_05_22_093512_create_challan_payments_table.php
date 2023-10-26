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
        Schema::create('challan_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('bank_slip')->nullable();
            $table->date('date')->nullable();
            $table->string('bank_amount')->nullable();
            $table->boolean('isEchallan')->default(0);
            $table->string('certificate_vat_challan')->nullable();
            $table->string('bfsa_vat_challan')->nullable();
            $table->string('certificate_challan_file')->nullable();
            $table->string('bfsa_challan_file')->nullable();
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
        Schema::dropIfExists('challan_payments');
    }
};
