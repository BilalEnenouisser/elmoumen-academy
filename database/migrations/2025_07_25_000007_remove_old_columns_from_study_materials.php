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
            $table->dropColumn(['type', 'pdf_path', 'video_link', 'thumbnail_path']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('study_materials', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('video_link')->nullable();
            $table->string('thumbnail_path')->nullable();
        });
    }
}; 