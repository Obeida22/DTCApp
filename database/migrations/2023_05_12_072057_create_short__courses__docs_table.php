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
        Schema::create('short__courses__docs', function (Blueprint $table) {
            $table->unsignedBigInteger('Stu_ID');
            $table->foreign('Stu_ID')->references('Stu_ID')->on('short__courses')->onUpdate('cascade');
            $table->string('certificate')->unique(); //image
            $table->string('National_Identity')->unique(); //image
            $table->string('Agency_Card')->unique(); //image
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
        Schema::dropIfExists('short__courses__docs');
    }
};
