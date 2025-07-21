<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Year;
use App\Models\Field;
use App\Models\StudyMaterial;

class CourseController extends Controller
{
    public function showLevel($levelSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $years = $level->years;
        return view('courses.level', compact('level', 'years'));
    }

    public function showYear($levelSlug, $yearSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $year = Year::where('slug', $yearSlug)->firstOrFail(); // ✅ FIXED

        // If Lycée, redirect to choose field
        if (strtolower($level->slug) === 'lycee') {
            $firstField = $level->fields()->first();
            if ($firstField) {
                return redirect()->route('courses.field', [
                    'level' => $level->slug,
                    'year' => $year->slug,
                    'field' => $firstField->slug,
                ]);
            } else {
                abort(404, 'No fields found for this level.');
            }
        }

        // Else: return materials directly
        $materials = StudyMaterial::where('level_id', $level->id)
            ->where('year_id', $year->id)
            ->get();

        return view('courses.year', compact('level', 'year', 'materials'));
    }

    public function showField($levelSlug, $yearSlug, $fieldSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $year = Year::where('slug', $yearSlug)->firstOrFail();  // ✅ FIXED
        $field = Field::where('slug', $fieldSlug)->firstOrFail(); // ✅ FIXED

        $materials = StudyMaterial::where('level_id', $level->id)
            ->where('year_id', $year->id)
            ->where('field_id', $field->id)
            ->get();

        return view('courses.field', compact('level', 'year', 'field', 'materials'));
    }
}
