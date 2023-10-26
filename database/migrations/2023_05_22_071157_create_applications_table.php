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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            // $table->foreignId('division_id')->constrained('divisions')->onDelete('cascade');
            // $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('type_good_id')->constrained('type_goods')->onDelete('cascade');
            $table->string('applied_id');
            $table->string('erc_no');
            $table->string('exporter_name');
            $table->text('exporter_address');
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->string('lc_no');
            $table->date('lc_date');
            $table->string('manufacturer_name');
            $table->text('manufacturer_address');
            $table->foreignId('manufacturer_country_id')->constrained('countries')->onDelete('cascade');
            $table->date('manufacturing_date');
            $table->date('expired_date');
            $table->string('buyer_name');
            $table->string('buyer_address');
            $table->string('buyer_email');
            $table->foreignId('buyer_country_id')->constrained('countries')->onDelete('cascade');
            $table->string('product_name');
            $table->date('probable_date');
            $table->string('port_loading');
            $table->string('port_discharge');
            $table->string('address_consignment');
            $table->string('consignment_country');
            $table->string('shipping_mark');
            $table->string('no_packing');
            $table->string('kind_packing');
            $table->string('hs_code');
            $table->string('description_goods');
            $table->string('net_weight')->nullable();
            $table->string('weight')->nullable();
            $table->string('temperature')->nullable();
            $table->string('mode_of_transport')->nullable();
            $table->string('quantity')->nullable();
            $table->string('fob_cfr_value')->nullable();
            $table->string('upload_document')->nullable();
            $table->enum('payment_type',['bank','online'])->nullable();
            $table->text('remark')->nullable();
            $table->date('inspection_date')->nullable();
            $table->date('sample_collect')->nullable();
            $table->dateTime('completion_date')->nullable();
            $table->dateTime('issued_date')->nullable();
            $table->integer('application_status')->default(0)->comment('0 => Pending, 1 => In Progress, 2 => Rejected, 3 => Request Sample Collect, 4 => Sample Collected, 5 => Resampling, 6 => On Hold, 7 => Finalized');
            $table->unsignedBigInteger('onhold_by')->nullable();
            $table->string('reference_no')->nullable()->comment('lab ref no');
            $table->string('certificate_ref_no')->nullable()->comment('auto generated');
            $table->string('report_issued_by')->nullable();
            $table->text('proforma_invoice')->nullable();
            $table->text('packing_list')->nullable();
            $table->text('test_parameter')->nullable();
            $table->text('declaration')->nullable();
            $table->boolean('isRejected')->default(0);
            $table->boolean('isFinalized')->default(0);
            $table->boolean('is_delay_notified')->default(false);
            // $table->boolean('process_status')->default(1)->comment('1 = process && 0 = onhold');
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
        Schema::dropIfExists('applications');
    }
};
