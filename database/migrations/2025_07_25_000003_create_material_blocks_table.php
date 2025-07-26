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
        Schema::create('material_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_material_id')->constrained()->onDelete('cascade');
            $table->string('type'); // Cours, Séries, etc.
            $table->integer('order')->default(0); // For ordering blocks
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_blocks');
    }
}; 