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
            $table->dropColumn('semester');
        });

        Schema::table('material_blocks', function (Blueprint $table) {
            // Recreate with new enum values including Concour
            $table->enum('semester', ['Semestre 1', 'Semestre 2', 'Concour'])->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('material_blocks', function (Blueprint $table) {
            // Drop the new enum column
            $table->dropColumn('semester');
        });

        Schema::table('material_blocks', function (Blueprint $table) {
            // Recreate with old enum values
            $table->enum('semester', ['Semestre 1', 'Semestre 2'])->nullable()->after('type');
        });
    }
};
