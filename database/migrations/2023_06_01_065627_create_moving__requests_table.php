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
        Schema::create('moving__requests', function (Blueprint $table) {
            $table->unsignedBigInteger('Department_ID');
            $table->foreign('Department_ID')->references('Department_ID')->on('departments')->onUpdate('cascade');
            $table->unsignedBigInteger('Student_ID');
            $table->foreign('Student_ID')->references('Student_ID')->on('students')->onUpdate('cascade');
            $table->unsignedBigInteger('Class_ID');
            $table->foreign('Class_ID')->references('Class_ID')->on('classes')->onUpdate('cascade');
            $table->text('Request_text');
            $table->integer('total_marks');
            $table->unsignedBigInteger('Department_ID_New');
            $table->foreign('Department_ID_New')->references('Department_ID')->on('departments')->onUpdate('cascade');
            $table->unsignedBigInteger('Class_ID_New');
            $table->foreign('Class_ID_New')->references('Class_ID')->on('classes')->onUpdate('cascade');
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
        Schema::dropIfExists('moving__requests');
    }
};
