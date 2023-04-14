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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('role_id')->nullable()->comment('1 For Employer, 1 For Job Seeker');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('company_name')->nullable();
            $table->string('experiance')->nullable();
            $table->string('title')->nullable();
            $table->string('skill')->nullable();
            $table->string('resume')->nullable();
            $table->tinyInteger('email_verified')->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('confirmation_code')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0 For Inactive, 1 For Active');
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
