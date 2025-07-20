<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::table('levels', function (Blueprint $table) {
        $table->string('slug')->nullable()->after('name'); // <-- make it nullable for now
    });

    // Add slugs manually for existing data
    foreach (\App\Models\Level::all() as $level) {
        $slug = \Str::slug($level->name);
        $level->slug = $slug;
        $level->save();
    }

    // Now make it unique (after filling it)
    Schema::table('levels', function (Blueprint $table) {
        $table->unique('slug');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
