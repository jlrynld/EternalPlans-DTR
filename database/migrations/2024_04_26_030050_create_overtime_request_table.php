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
        Schema::create('overtime_request', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code');
            $table->string('from_time');
            $table->string('to_time');
            $table->timestamp('date');
            $table->string('nature_of_work');
            $table->string('remarks')->nullable();
            $table->string('recommended_by_code');
            $table->string('recommended_by_remarks');
            $table->string('approved_by_code');
            $table->string('approved_by_remarks')->nullable();
            $table->boolean('status');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime_request');
    }
};
