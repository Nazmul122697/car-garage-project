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
        Schema::create('application_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('assign_user_id')->nullable()->unsigned();
            $table->foreignId('forward_user_id')->nullable()->unsigned();
            $table->foreignId('lab_user_id')->nullable()->unsigned();
            $table->date('assign_date')->nullable();
            $table->text('remark')->nullable();
            $table->string('doc_file')->nullable();
            $table->integer('step_name')->comment('1 => fa1, 2 =>fso, 3 =>lab, 4 => fa2, 5 => so1, 6 => director1, 7 => member, 8 => director2, 9 => so2');
            $table->integer('previous_step_name')->nullable()->comment('1 => fa1, 2 =>fso, 3 =>lab, 4 => fa2, 5 => so1, 6 => director1, 7 => member, 8 => director2, 9 => so2');
            $table->integer('application_status')->default(0)->comment('0 => Pending, 1 => In Progress, 2 => Rejected, 3 => Request Sample Collect, 4 => Sample Collected, 5 => Resampling, 6 => On Hold, 7 => Finalized');
            $table->boolean('isResampling')->default(0);
            $table->boolean('helper_status')->default(0);
            $table->boolean('isSkipped')->default(0);
            $table->boolean('isRejected')->default(0);
            $table->boolean('isFinalized')->default(0);
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
        Schema::dropIfExists('application_steps');
    }
};
