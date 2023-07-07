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
        Schema::create('incoming__consultings', function (Blueprint $table) {
            $table->bigIncrements('Consulting_ID');
            $table->foreign('Consulting_ID')->references('Consulting_ID')->on('consultings')->onUpdate('cascade');
            $table->text('Question_Title');
            $table->text('Question_Text');
            $table->unsignedBigInteger('User_ID');
            $table->foreign('User_ID')->references('User_ID')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('incoming__consultings');
    }
};
