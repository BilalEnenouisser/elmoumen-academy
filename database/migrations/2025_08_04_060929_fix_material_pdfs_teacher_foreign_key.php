<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, clean up any invalid teacher_id references
        DB::table('material_pdfs')
            ->whereNotIn('teacher_id', function($query) {
                $query->select('id')->from('teachers');
            })
            ->update(['teacher_id' => null]);

        // For now, just ensure the column exists and is nullable
        // The foreign key constraint will be handled separately if needed
        Schema::table('material_pdfs', function (Blueprint $table) {
            if (!Schema::hasColumn('material_pdfs', 'teacher_id')) {
                $table->foreignId('teacher_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse this migration
    }
};
