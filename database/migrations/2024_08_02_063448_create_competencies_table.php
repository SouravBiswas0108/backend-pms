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
        Schema::create('competencies', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id')->nullable();
            $table->string('dept_id')->nullable();
            $table->string('year')->nullable();
            // $table->longText('title')->nullable();
            $table->longText('competencies')->nullable();
            // $table->longText('describe_expectations')->nullable();
            // $table->string('min_score')->nullable();
            // $table->string('max_score')->nullable();
            $table->string('quarter')->nullable();
            $table->string('aggregate')->nullable();
            // $table->string('quarter_marks')->default('0');
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
        Schema::dropIfExists('competencies');
    }
};
