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
        Schema::create('kras', function (Blueprint $table) {
            $table->id();
            $table->text('kra_title');
            $table->integer('kra_weight')->default(0);
            $table->unsignedBigInteger('mpms_id'); // Foreign key column
            $table->year('year');
            $table->timestamps();

             // Define the foreign key constraint
             $table->foreign('mpms_id')->references('id')->on('mpms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kras');
    }
};
