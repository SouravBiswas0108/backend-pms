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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id', 20)->unique();
            $table->string('ippis_no', 200);
            $table->tinyInteger('active_status')->default(0);// active status 0 means active 1 means inactive
            $table->integer('status')->default(1);
            $table->string('F_name');
            $table->string('M_name', 255)->nullable();
            $table->string('L_name', 255)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('designation', 255)->default('staff');
            $table->string('cadre', 255)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
