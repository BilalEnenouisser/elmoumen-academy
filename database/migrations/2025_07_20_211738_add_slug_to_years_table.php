<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('years', function (Blueprint $table) {
        $table->string('slug')->nullable()->after('name');
    });

    // Generate slugs for existing rows
    foreach (\App\Models\Year::all() as $year) {
        $year->slug = \Illuminate\Support\Str::slug($year->name . '-' . $year->id);
        $year->save();
    }

    Schema::table('years', function (Blueprint $table) {
        $table->unique('slug');
    });
}

public function down(): void
{
    Schema::table('years', function (Blueprint $table) {
        $table->dropUnique(['slug']);
        $table->dropColumn('slug');
    });
}
};
