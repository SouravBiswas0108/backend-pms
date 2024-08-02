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
        Schema::create('overall_assesment_comments', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('dept_id');
            $table->string('supervisor_id');
            $table->text('employee_strength');
            $table->text('areas_improvement');
            $table->integer('year');
            $table->tinyInteger('quater')->nullable();
            $table->timestamps();

            $table->foreign('dept_id')->references('department_id')->on('departments')->onDelete('cascade');
            $table->foreign('staff_id')->references('staff_id')->on('users')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('staff_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overall_assesment_comments');
    }
};
