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
        Schema::create('monthly_performance_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('planning_performance_id')->nullable();
            $table->string('staff_id');
            $table->string('dept_id');
            $table->string('task');
            $table->longText('performance_expectation');
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->longText('output_status')->nullable();
            $table->longText('issues')->nullable();
            $table->integer('month');
            $table->integer('year');
            $table->string('assesment_year')->nullable();
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
        Schema::dropIfExists('monthly_performance_reviews');
    }
};
