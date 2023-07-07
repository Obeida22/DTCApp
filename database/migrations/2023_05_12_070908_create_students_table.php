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
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('Student_ID');
            $table->string('Father_name');
            $table->string('Mother_name');
            $table->string('Birth_place');
            $table->string('Recruitment_Division');
            $table->string('English_Name');
            $table->text('Address_Current');
            $table->text('Address_Permanent');
            $table->boolean('Admissions');
            $table->boolean('Graduate');
            $table->string('Type_Certificate');
            $table->integer('Totle_Mark');
            $table->unsignedBigInteger('User_ID');
            $table->foreign('User_ID')->references('User_ID')->on('users')->onUpdate('cascade');
            $table->unsignedBigInteger('Class_ID');
            $table->foreign('Class_ID')->references('Class_ID')->on('classes')->onUpdate('cascade');
            $table->timestamps();
        });
    }
 // $table->string('gender');

 // $table->string('gender');

 // $table->date('Birth_date');
            // $table->string('Nationality');

// $table->string('Name');
            // $table->string('Nickname');

 // $table->unsignedBigInteger('Roll_ID');
            // $table->foreign('Roll_ID')->references('Roll_ID')->on('rolls')->onUpdate('cascade');
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
