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
        Schema::create('employee_sub_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_tasks_id');
            $table->text('objectives')->nullable();
            $table->double('objective_weight')->nullable();
            $table->double('gradeed_weight')->nullable();
            $table->double('target')->nullable();
            $table->text('kpi')->nullable();
            $table->text('unit')->nullable();
            $table->tinyInteger('quater');
            $table->text('aggregate')->nullable();
            $table->double('quarter_marks')->default('0');
            $table->double('target_achieved')->default(0);
            $table->double('raw')->default(0);
            $table->double('weighted')->default(0);
            $table->timestamps();

             // Define the foreign key constraint
             $table->foreign('employee_tasks_id')->references('id')->on('employee_tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_sub_tasks');
    }
};
