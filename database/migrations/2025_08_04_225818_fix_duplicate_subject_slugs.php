<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Subject;
use App\Models\Level;
use App\Models\Year;
use App\Models\Field;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all subjects and fix their slugs
        $subjects = Subject::with(['level', 'year', 'field'])->get();
        
        foreach ($subjects as $subject) {
            $baseSlug = Str::slug($subject->name);
            $level = $subject->level ? Str::slug($subject->level->name) : '';
            $year = $subject->year ? Str::slug($subject->year->name) : '';
            $field = $subject->field ? Str::slug($subject->field->name) : '';
            
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
            
            while (Subject::where('slug', $slug)->where('id', '!=', $subject->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            // Update the subject with the new unique slug
            $subject->update(['slug' => $slug]);
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
