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
        Schema::table('study_materials', function (Blueprint $table) {
            $table->dropForeign(['subject_id']); // Remove foreign key constraint
            $table->dropColumn('subject_id');    // Remove the column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('study_materials', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_id');
        // If you want to restore the foreign key:
        // $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }
};
