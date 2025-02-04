<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('history_transfer', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id', 20); // Set VARCHAR(20)
            $table->string('ministry_id',20)->nullable();
            $table->text('reason')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            // Foreign key constraint (assuming staff_id references users table)
            $table->foreign('staff_id')->references('staff_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('history_transfer');
    }
};
