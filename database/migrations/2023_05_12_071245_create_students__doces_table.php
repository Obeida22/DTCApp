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
        Schema::create('students__doces', function (Blueprint $table) {
            $table->unsignedBigInteger('Student_ID');
            $table->foreign('Student_ID')->references('Student_ID')->on('students')->onUpdate('cascade');
            $table->string('Certificate')->unique(); //image
            $table->string('National_Identity')->unique(); //image
            $table->string('Agency_Card')->unique(); //image
            $table->string('Souls_Restriction')->unique(); //image
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
        Schema::dropIfExists('students__doces');
    }
};
