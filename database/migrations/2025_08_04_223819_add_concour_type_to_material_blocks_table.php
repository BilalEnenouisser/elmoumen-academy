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
        Schema::table('material_blocks', function (Blueprint $table) {
            // Add concour_type field
            $table->enum('concour_type', [
                'Concour 1', 'Concour 2', 'Concour 3', 'Concour 4', 'Concour 5',
                'Concour 6', 'Concour 7', 'Concour 8', 'Concour 9', 'Concour 10'
            ])->nullable()->after('name');
        });

        // Update material_type enum to include Concour
        Schema::table('material_blocks', function (Blueprint $table) {
            // Drop the old enum column
            $table->dropColumn('material_type');
        });

        Schema::table('material_blocks', function (Blueprint $table) {
            // Recreate with new enum values including Concour
            $table->enum('material_type', ['Cours', 'Séries', 'Devoirs', 'Examens', 'Concour'])->nullable()->after('semester');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('material_blocks', function (Blueprint $table) {
            // Drop concour_type field
            $table->dropColumn('concour_type');
        });

        // Revert material_type enum
        Schema::table('material_blocks', function (Blueprint $table) {
            // Drop the new enum column
            $table->dropColumn('material_type');
        });

        Schema::table('material_blocks', function (Blueprint $table) {
            // Recreate with old enum values
            $table->enum('material_type', ['Cours', 'Séries', 'Devoirs', 'Examens'])->nullable()->after('semester');
        });
    }
};
