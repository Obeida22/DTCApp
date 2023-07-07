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
        Schema::create('department__teachers', function (Blueprint $table) {
            $table->unsignedBigInteger('Department_ID');
            $table->foreign('Department_ID')->references('Department_ID')->on('departments')->onUpdate('cascade');
            $table->unsignedBigInteger('Teacher_ID');
            $table->foreign('Teacher_ID')->references('Teacher_ID')->on('teachers')->onUpdate('cascade');
            $table->unsignedBigInteger('Manager_ID')->nullable();
            $table->foreign('Manager_ID')->references('Teacher_ID')->on('teachers')->onUpdate('cascade');
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
        Schema::dropIfExists('department__teachers');
    }
};
