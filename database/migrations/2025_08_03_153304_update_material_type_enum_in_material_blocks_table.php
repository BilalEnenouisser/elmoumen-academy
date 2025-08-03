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
            // Drop the old enum column
            $table->dropColumn('material_type');
        });

        Schema::table('material_blocks', function (Blueprint $table) {
            // Recreate with new enum values
            $table->enum('material_type', ['Cours', 'Séries', 'Devoirs', 'Examens'])->nullable()->after('semester');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('material_blocks', function (Blueprint $table) {
            // Drop the new enum column
            $table->dropColumn('material_type');
        });

        Schema::table('material_blocks', function (Blueprint $table) {
            // Recreate with old enum values
            $table->enum('material_type', ['Cours', 'Séries', 'Devoirs semestre 1', 'Devoirs semestre 2', 'Examens'])->nullable()->after('semester');
        });
    }
};
