<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
         if (!Schema::hasColumn('years', 'slug')) {
        Schema::table('years', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('name');
        });
    }

    if (!Schema::hasColumn('fields', 'slug')) {
        Schema::table('fields', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('name');
        });
    }
    }

    public function down(): void
    {
        Schema::table('years', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('fields', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
