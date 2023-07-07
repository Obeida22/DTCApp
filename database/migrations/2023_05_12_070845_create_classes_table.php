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
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('Class_ID');
            $table->string('Class_Name');
            $table->bigInteger('Specialty_ID')->unsigned();
            $table->foreign('Specialty_ID')->references('Specialty_ID')->on('specilties')->onUpdate('cascade');
            $table->bigInteger('Department_ID')->unsigned();
            $table->foreign('Department_ID')->references('Department_ID')->on('departments')->onUpdate('cascade');
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
        Schema::dropIfExists('classes');
    }
};
