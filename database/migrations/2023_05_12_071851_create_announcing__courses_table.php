<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('announcing__courses', function (Blueprint $table) {
            $table->bigIncrements('Course_ID');
            $table->string('Courses_Name');
            $table->unsignedBigInteger('Employee_ID');
            $table->foreign('Employee_ID')->references('Employee_ID')->on('employees')->onUpdate('cascade');
            $table->text('Announcing_Text');
            $table->string('Announcing_Image');//image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcing__courses');
    }
};
