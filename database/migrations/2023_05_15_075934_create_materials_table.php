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
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('Material_ID');
            $table->string('Material_Name');
            $table->unsignedBigInteger('Department_ID');
            $table->foreign('Department_ID')->references('Department_ID')->on('departments')->onUpdate('cascade');
            $table->unsignedBigInteger('Class_ID');
            $table->foreign('Class_ID')->references('Class_ID')->on('classes')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
