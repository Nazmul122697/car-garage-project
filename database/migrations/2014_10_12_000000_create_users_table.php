<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id');
            $table->string('name')->nullable();
            $table->string('designation')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->unique()->unique();
            $table->string('phone')->unique()->nullable();
            $table->string('gender')->nullable();
            $table->foreignId('division')->nullable()->unsigned();
            $table->foreignId('district')->nullable()->unsigned();
            $table->foreignId('country')->nullable()->unsigned();
            $table->string('lab_ref_no')->nullable();
            $table->text('signature')->nullable();
            $table->text('seal')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamp('password_change_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
