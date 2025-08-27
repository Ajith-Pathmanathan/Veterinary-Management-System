<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('owner_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farm_id');
            $table->unsignedBigInteger('pet_id');
            $table->date('from_date');
            $table->date('to_date');
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('farm_id')->references('id')->on('farms');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('owner_history');
    }
};
