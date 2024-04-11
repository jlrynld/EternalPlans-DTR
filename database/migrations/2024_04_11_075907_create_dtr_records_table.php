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
        Schema::create('dtr_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('type');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('date');
            $table->string('timein');
            $table->string('timeout');
            $table->string('lunchin');
            $table->string('lunchout');
            $table->timestamps();

            $table->index('user_id');
            $table->index('employee_id');

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
