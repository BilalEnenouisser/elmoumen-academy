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
        // Page views tracking
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('page_url');
            $table->string('page_title')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // PDF downloads tracking
        Schema::create('pdf_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_pdf_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });

        // Video clicks tracking
        Schema::create('video_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_video_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });

        // User sessions tracking (for online users)
        Schema::create('user_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('session_id');
            $table->timestamp('last_activity');
            $table->timestamps();
        });

        // Teacher activity tracking
        Schema::create('teacher_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('action'); // 'login', 'upload_pdf', 'upload_video', 'create_material'
            $table->json('details')->nullable(); // Additional data about the action
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_activities');
        Schema::dropIfExists('user_sessions');
        Schema::dropIfExists('video_clicks');
        Schema::dropIfExists('pdf_downloads');
        Schema::dropIfExists('page_views');
    }
};
