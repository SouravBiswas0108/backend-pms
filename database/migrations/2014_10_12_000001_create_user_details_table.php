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
        Schema::create('user_details', function (Blueprint $table) {
            // Add new columns
            $table->id();
            $table->string('staff_id',20); // Make sure to define the column for the foreign key
            $table->string('gender', 255)->nullable();
            $table->string('designation', 255)->nullable();
            $table->string('cadre', 255)->nullable();
            $table->string('grade_level', 50)->nullable();
            $table->string('org_code', 20)->nullable();
            $table->string('org_name', 200)->nullable();
            $table->text('date_of_current_posting')->nullable();
            $table->text('date_of_MDA_posting')->nullable();
            $table->text('date_of_last_promotion')->nullable();
            $table->string('type', 20);
            $table->string('lang', 10)->default('en');
            $table->string('job_title', 255)->nullable();
            $table->integer('default_pipeline')->nullable();
            $table->integer('created_by');
            $table->integer('is_active')->default(1);
            $table->string('recovery_email', 255)->nullable();
            $table->string('messenger_color', 255)->default('#2180f3');
            $table->tinyInteger('dark_mode')->default(0);
            $table->timestamps();

            // Adding foreign key column
            // Adding foreign key constraint
            $table->foreign('staff_id')
                  ->references('staff_id')
                  ->on('users')
                  ->onDelete('cascade'); // This will ensure that if a user is deleted, related user_details are also deleted


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['staff_id']);

            // Drop the foreign key column
            $table->dropColumn('staff_id');

            // If needed, you can also add code to reverse other changes made in the up method
        });

        Schema::dropIfExists('user_details');
    }
};
