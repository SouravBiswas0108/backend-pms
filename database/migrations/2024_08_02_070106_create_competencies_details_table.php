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
        Schema::create('competencies_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competencies_id');
            $table->text('title');
            $table->text('describe_expectations');
            $table->integer('min_score')->default(0);
            $table->integer('max_score')->default(0);
            $table->integer('quarter_marks')->default('0');
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('competencies_id')->references('id')->on('competencies')->onDelete('cascade');
        });
    }        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencies_details');
    }
};
