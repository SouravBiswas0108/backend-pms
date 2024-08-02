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
        Schema::create('employee_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id', 20);
            $table->string('dept_id', 20);
            $table->year('year');
            $table->unsignedBigInteger('kra_id');
            $table->double('kra_weight')->nullable();
            // $table->longText('objectives')->nullable();
            // $table->double('objective_weight')->nullable();
            // $table->double('gradeed_weight')->nullable();
            // $table->double('target')->nullable();
            // $table->text('kpi')->nullable();
            // $table->text('unit')->nullable();
            // $table->tinyInteger('quater')->nullable();
            // $table->longText('aggregate')->nullable();
            // $table->string('quarter_marks', 255)->default('0')->nullable();
            // $table->string('target_achieved', 500)->nullable();
            // $table->string('raw', 500)->nullable();
            // $table->string('weighted', 500)->nullable();
            $table->timestamps();

             // Define the foreign key constraint
             $table->foreign('kra_id')->references('id')->on('kras')->onDelete('cascade');
             $table->foreign('dept_id')->references('department_id')->on('departments')->onDelete('cascade');
             $table->foreign('staff_id')->references('staff_id')->on('users')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_tasks');
    }
};
