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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code')->nullable();
            $table->string('department_code')->nullable();
            $table->string('address');
            $table->string('firstname');
            $table->string('lastname');
            $table->timestamp('birthday');
            $table->string('contact_num');
            $table->string('position');
            $table->string('civil_status');
            $table->string('position_code')->nullable();
            $table->string('position_rank')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
