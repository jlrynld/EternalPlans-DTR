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
        Schema::create('pto_request', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code');
            $table->string('type_code');
            $table->time('from_time');
            $table->time('to_time');
            $table->string('reason');
            $table->string('supervisor_code');
            $table->string('supervisor_remarks')->nullable();
            $table->string('department_head_code');
            $table->string('department_head_remarks')->nullable();
            $table->string('division_head_code');
            $table->string('division_head_remarks')->nullable();
            $table->bigInteger('with_pay');
            $table->bigInteger('without_pay');
            $table->string('head_code');
            $table->string('head_remarks')->nullable();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pto_request');
    }
};
