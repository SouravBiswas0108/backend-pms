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
        Schema::create('monthly_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('dept_id');
            $table->longText('outstanding_performance')->nullable();
            $table->longText('area_of_improvements')->nullable();
            $table->longText('training_needs')->nullable();
            $table->longText('future_goal_expectations')->nullable();
            $table->integer('month');
            $table->text('year');
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
        Schema::dropIfExists('monthly_feedback');
    }
};
