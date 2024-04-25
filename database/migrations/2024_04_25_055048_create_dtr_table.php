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
            $table->string('employee_code');
            $table->timestamp('date');
            $table->time('time_in');
            $table->time('lunch_out')->nullable();
            $table->time('lunch_in')->nullable();
            $table->time('time_out')->nullable();
            $table->string('status');
            $table->string('total_hours')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtr');
    }
};
