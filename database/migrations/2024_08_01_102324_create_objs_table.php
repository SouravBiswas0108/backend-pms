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
        Schema::create('objs', function (Blueprint $table) {
            $table->id();
            $table->text('obj_title');
            $table->double('obj_weight');
            $table->text('Initiative');
            $table->text('kpi');
            $table->integer('target');
            $table->text('Responsible');
            $table->unsignedBigInteger('kra_id'); // Foreign key column
            $table->unsignedBigInteger('mpms_id'); // Foreign key column
            $table->timestamps();

            $table->foreign('kra_id')->references('id')->on('kras')->onDelete('cascade');
            $table->foreign('mpms_id')->references('id')->on('mpms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objs');
    }
};
