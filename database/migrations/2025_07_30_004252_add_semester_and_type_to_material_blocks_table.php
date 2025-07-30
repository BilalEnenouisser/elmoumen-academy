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
            $table->enum('semester', ['Semestre 1', 'Semestre 2'])->nullable()->after('type');
            $table->enum('material_type', ['Cours', 'Séries', 'Devoirs semestre 1', 'Devoirs semestre 2', 'Examens'])->nullable()->after('semester');
            $table->enum('exam_type', ['إمتحانات محلية', 'إمتحانات إقليمية', 'Examens Locaux', 'Examens Régionaux', 'Examens Nationaux Blanc', 'Examens Nationaux'])->nullable()->after('material_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('material_blocks', function (Blueprint $table) {
            $table->dropColumn(['semester', 'material_type', 'exam_type']);
        });
    }
};
