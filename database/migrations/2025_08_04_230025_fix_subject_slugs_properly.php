<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all subjects with their related data using raw SQL
        $subjects = DB::table('subjects')
            ->leftJoin('levels', 'subjects.level_id', '=', 'levels.id')
            ->leftJoin('years', 'subjects.year_id', '=', 'years.id')
            ->leftJoin('fields', 'subjects.field_id', '=', 'fields.id')
            ->select('subjects.*', 'levels.name as level_name', 'years.name as year_name', 'fields.name as field_name')
            ->get();
        
        foreach ($subjects as $subject) {
            $baseSlug = Str::slug($subject->name);
            $level = $subject->level_name ? Str::slug($subject->level_name) : '';
            $year = $subject->year_name ? Str::slug($subject->year_name) : '';
            $field = $subject->field_name ? Str::slug($subject->field_name) : '';
            
            // Create a unique slug combining name, level, year, and field
            $slug = $baseSlug;
            if ($level) {
                $slug .= '-' . $level;
            }
            if ($year) {
                $slug .= '-' . $year;
            }
            if ($field) {
                $slug .= '-' . $field;
            }
            
            // Check if this slug already exists
            $originalSlug = $slug;
            $counter = 1;
            
            while (DB::table('subjects')->where('slug', $slug)->where('id', '!=', $subject->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            // Update the subject with the new unique slug
            DB::table('subjects')->where('id', $subject->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration fixes data, so there's no need to reverse it
        // The slugs will remain unique
    }
};
