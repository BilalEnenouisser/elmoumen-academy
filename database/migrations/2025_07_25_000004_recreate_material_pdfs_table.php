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
        Schema::dropIfExists('material_pdfs');
        
        Schema::create('material_pdfs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_block_id')->constrained()->onDelete('cascade');
            $table->string('pdf_path');
            $table->string('title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_pdfs');
    }
}; 