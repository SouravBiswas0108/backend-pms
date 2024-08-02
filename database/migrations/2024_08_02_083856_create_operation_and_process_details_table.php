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
        Schema::create('operation_and_process_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operation_and_process_id');
            $table->text('describe_expectations');
            $table->integer('min_score')->default(0);
            $table->integer('max_score')->default(0);
            $table->integer('quarter_marks')->default(0);
            $table->timestamps();

            $table->foreign('operation_and_process_id')->references('id')->on('operation_and_processes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_and_process_details');
    }
};
