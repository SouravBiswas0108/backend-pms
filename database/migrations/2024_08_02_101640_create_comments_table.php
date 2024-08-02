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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('dept_id');
            $table->string('comment')->nullable();
            $table->string('date')->nullable();
            $table->string('signature')->nullable();
            $table->tinyInteger('declaration')->default(0);
            $table->string('role');
            $table->tinyInteger('form_no');
            $table->tinyInteger('quater');
            $table->integer('year');
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
        Schema::dropIfExists('comments');
    }
};
