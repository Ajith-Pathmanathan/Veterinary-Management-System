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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('pet_id')->unique();
            $table->string('breed');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->unsignedBigInteger('farm_id');
            $table->enum('type', ['cow', 'goat', 'other']);
            $table->string('color');
            $table->timestamps();
            $table->foreign('farm_id')->references('id')->on('farms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
