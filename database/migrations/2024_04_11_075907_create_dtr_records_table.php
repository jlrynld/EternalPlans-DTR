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
        Schema::create('dtr', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');      
            $table->string('date');
            $table->string('time_in');
            $table->string('lunch_out')->nullable();
            $table->string('lunch_in')->nullable();
            $table->string('time_out')->nullable();
            $table->string('status');
            $table->string('total_hours')->nullable();   
            $table->timestamps();

            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtr_record');
    }
};
