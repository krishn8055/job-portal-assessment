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
        Schema::create('post_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title')->nullable();
            $table->text('job_description')->nullable();
            $table->integer('emp_id')->nullable();
            $table->string('skill')->nullable();
            $table->string('experience_year')->nullable();
            $table->string('experience_month')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0 For Inactive, 1 For Active');
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
        Schema::dropIfExists('post_jobs');
    }
};
