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
        Schema::create('monthly_comments', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('dept_id');
            $table->longText('staff_comments')->nullable();
            $table->string('staff_declaration')->nullable();
            $table->string('staff_declaration_date')->nullable();
            $table->string('staff_signature')->nullable();
            $table->longText('supervisor_comments')->nullable();
            $table->string('supervisor_declaration')->nullable();
            $table->string('supervisor_declaration_date')->nullable();
            $table->string('supervisor_signature')->nullable();
            $table->string('year');
            $table->integer('month');
            $table->string('assesment_year');
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
        Schema::dropIfExists('monthly_comments');
    }
};
