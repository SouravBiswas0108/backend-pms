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
        Schema::create('department_staff', function (Blueprint $table) {
            $table->id();
            $table->string('department_id', 20);
            $table->string('org_code', 20)->nullable();
            $table->string('staff_id', 20)->nullable();
            $table->string('assign_role_name')->nullable();
            $table->string('assign_role_id', 20)->nullable();
            $table->string('supervisor_id', 20)->nullable();
            $table->integer('created_by')->default(1);
            $table->integer('year');
            $table->timestamps();

            $table->foreign('department_id')->references('department_id')->on('departments')->onDelete('cascade');
            $table->foreign('staff_id')->references('staff_id')->on('users')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('staff_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_staff');
    }
};
