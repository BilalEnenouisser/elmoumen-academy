<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Year;
use App\Models\Field;
use App\Models\Subject;
use App\Models\Material;

class CourseController extends Controller
{
    public function showLevel($levelSlug)
    {
    $level = Level::where('slug', $levelSlug)->firstOrFail();
    $years = $level->years; // assuming a relationship exists
    return view('courses.level', compact('level', 'years')); // ❌ Do NOT pass $slug directly
    }

    public function showYear($levelSlug, $yearSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $year = Year::where('slug', $yearSlug)->firstOrFail();

        $subjects = Subject::where('year_id', $year->id)->get();

        return view('courses.year', compact('level', 'year', 'subjects'));
    }

    public function showField($levelSlug, $yearSlug, $fieldSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $year = Year::where('slug', $yearSlug)->firstOrFail();
        $field = Field::where('slug', $fieldSlug)->firstOrFail();

        $subjects = Subject::where('year_id', $year->id)
                           ->where('field_id', $field->id)
                           ->get();

        return view('courses.field', compact('level', 'year', 'field', 'subjects'));
    }

    public function showSubject($levelSlug, $yearSlug, $fieldSlug, $subjectSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $year = Year::where('slug', $yearSlug)->firstOrFail();
        $field = Field::where('slug', $fieldSlug)->firstOrFail();
        $subject = Subject::where('slug', $subjectSlug)->firstOrFail();

        $materials = Material::where('subject_id', $subject->id)->get();

        return view('courses.subject', compact('level', 'year', 'field', 'subject', 'materials'));
    }
}
