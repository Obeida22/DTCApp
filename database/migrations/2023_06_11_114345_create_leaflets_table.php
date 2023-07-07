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
        Schema::create('leaflets', function (Blueprint $table) {
            $table->bigIncrements('Leaflet_ID');
            $table->unsignedBigInteger('Department_ID');
            $table->foreign('Department_ID')->references('Department_ID')->on('departments')->onUpdate('cascade');
            $table->unsignedBigInteger('Teacher_ID');
            $table->foreign('Teacher_ID')->references('Teacher_ID')->on('teachers')->onUpdate('cascade');
            $table->string('Leaflet_Title');
            $table->text('Leaflet_Text');
            $table->string('Leaflet_image');//image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaflets');
    }
};
