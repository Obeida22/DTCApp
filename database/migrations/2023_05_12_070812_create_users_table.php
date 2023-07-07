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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('User_ID');
            $table->string('Name');
            $table->string('Nickname');
            $table->date('Birth_date');
            $table->string('Nationality');
            $table->string('gender');
            $table->integer('Phone_Number')->unique();
            $table->string('Agency_Card_Number')->nullable();
            $table->unsignedBigInteger('Roll_ID');
            $table->foreign('Roll_ID')->references('Roll_ID')->on('rolls')->onUpdate('cascade');
            $table->string('api_token', 80)->unique()->nullable()->default(null);
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
        Schema::dropIfExists('users');
    }
};
