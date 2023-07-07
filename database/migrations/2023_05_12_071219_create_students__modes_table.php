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
        Schema::create('students__modes', function (Blueprint $table) {
            $table->unsignedBigInteger('Student_ID');
            $table->foreign('Student_ID')->references('Student_ID')->on('students')->onUpdate('cascade');
            $table->string('Agency_Card_Number')->unique();
            $table->boolean('Existence_Hard_Case');
            $table->string('Hard_Case')->nullable();
            $table->string('Disability_Status');
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
        Schema::dropIfExists('students__modes');
    }
};
