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
        Schema::create('mission__students', function (Blueprint $table) {
            $table->bigIncrements('Mission_ID');
            $table->string('Mission_Name');
            $table->text('Mission_Text');
            $table->unsignedBigInteger('Student_ID');
            $table->foreign('Student_ID')->references('Student_ID')->on('students')->onUpdate('cascade');
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
        Schema::dropIfExists('mission__students');
    }
};
