<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->time('appointment_time');
            $table->date('date');
            $table->text('reason');
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('hospital_id');
            $table->boolean('is_cancelled');
            $table->boolean('viewed');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreign('doctor_id')->references('id') ->on('users');
            $table->foreign('hospital_id')->references('id')->on('hospitals');
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
