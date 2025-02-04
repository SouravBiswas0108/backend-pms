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
        Schema::create('overall_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id',20);
            $table->string('department_id', 20);
            $table->integer('year');
            $table->tinyInteger('quater');
            $table->decimal('sub_total_rating_expectations', 10, 3);
            $table->decimal('sub_total_rating_competencies', 10, 3);
            $table->decimal('sub_total_rating_operations', 10, 3);
            $table->decimal('overall_rating', 10, 3);
            $table->timestamps();

            $table->foreign('staff_id')->references('staff_id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('department_id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overall_assessments');
    }
};
