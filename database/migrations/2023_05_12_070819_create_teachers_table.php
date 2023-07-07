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

        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('Teacher_ID');
            // $table->string('First_Name');
            // $table->string('Last_Name');
            $table->string('Certificate_Name');
            $table->bigInteger('Department_ID')->unsigned();
            $table->foreign('Department_ID')->references('Department_ID')->on('departments')->onUpdate('cascade');
            $table->unsignedBigInteger('User_ID');
            $table->foreign('User_ID')->references('User_ID')->on('users')->onUpdate('cascade');
            $table->unique('User_ID');
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
        Schema::dropIfExists('teachers');
    }
};
