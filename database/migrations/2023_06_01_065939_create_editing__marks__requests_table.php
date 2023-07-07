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
        Schema::create('editing__marks__requests', function (Blueprint $table) {
            $table->unsignedBigInteger('Department_ID');
            $table->foreign('Department_ID')->references('Department_ID')->on('departments')->onUpdate('cascade');
            $table->unsignedBigInteger('Student_ID');
            $table->foreign('Student_ID')->references('Student_ID')->on('students')->onUpdate('cascade');
            $table->unsignedBigInteger('Class_ID');
            $table->foreign('Class_ID')->references('Class_ID')->on('classes')->onUpdate('cascade');
            $table->unsignedBigInteger('Teacher_ID');
            $table->foreign('Teacher_ID')->references('Teacher_ID')->on('teachers')->onUpdate('cascade');
            $table->unsignedBigInteger('Material_ID');
            $table->foreign('Material_ID')->references('Material_ID')->on('materials')->onUpdate('cascade');
            $table->integer('Earned_Mark');
            $table->text('Text_Editing_Mark');
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
        Schema::dropIfExists('editing__marks__requests');
    }
};
