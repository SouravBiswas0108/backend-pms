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
        Schema::table('department_staff', function (Blueprint $table) {
            //
            $table->string('officer_id', 20)->nullable()->after('supervisor_id');
            $table->foreign('officer_id')->references('staff_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('department_staff', function (Blueprint $table) {
            //
        });
    }
};
