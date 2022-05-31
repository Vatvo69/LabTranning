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
        Schema::create('submits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentId');
            $table->foreignId('exerciseId');
            $table->string('studentName');
            $table->string('title');
            $table->string('file');
            $table->timestamps();

            $table->foreign('studentId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('exerciseId')->references('id')->on('class_rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submits');
    }
};
