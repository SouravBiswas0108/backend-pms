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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_id', 20)->unique();
            $table->string('department_name');
            // $table->longText('staff_list')->nullable();
            // $table->text('assignRoleDetails')->nullable();
            $table->string('org_code', 20)->nullable();
            $table->integer('created_by')->default(1);
            // $table->year('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
