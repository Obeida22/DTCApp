<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migration
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short__courses', function (Blueprint $table) {
            $table->bigIncrements('Stu_ID');
            $table->string('Father_name');
            $table->string('Mother_name');
            $table->string('Certificate_Type');
            $table->date('Certificate_Date');
            $table->string('Study_Place');
            $table->boolean('Graduate');
            $table->date('Graduation_Year')->nullable();
            $table->string('Home_Adress');
            $table->boolean('Work');
            $table->string('Work_Type');
            $table->string('English_Name');
            $table->boolean('Admissions');
            // $table->unsignedBigInteger('Roll_ID');
            // $table->foreign('Roll_ID')->references('Roll_ID')->on('rolls')->onUpdate('cascade');
            $table->unsignedBigInteger('User_ID');
            $table->foreign('User_ID')->references('User_ID')->on('users')->onUpdate('cascade');
            $table->unsignedBigInteger('Course_ID');
            $table->foreign('Course_ID')->references('Course_ID')->on('announcing__courses')->onUpdate('cascade');
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
        Schema::dropIfExists('short__courses');
    }
};
