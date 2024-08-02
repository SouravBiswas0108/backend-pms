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
        Schema::create('operation_and_processes', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('dept_id');
            $table->string('year');
            $table->longText('operations_and_process');
            // $table->longText('describe_expectations')->nullable();
            // $table->string('min_score')->nullable();
            // $table->string('max_score')->nullable();
            $table->string('quater')->nullable();
            $table->string('aggregate')->nullable();
            // $table->string('quarter_marks')->default('0')->nullable();
            $table->timestamps();

            $table->foreign('dept_id')->references('department_id')->on('departments')->onDelete('cascade');
            $table->foreign('staff_id')->references('staff_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_and_processes');
    }
};
