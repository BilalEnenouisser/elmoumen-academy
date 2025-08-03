<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Year;
use App\Models\Field;
use App\Models\Subject;
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
        $year = Year::where('slug', $yearSlug)->firstOrFail();

        if (strtolower($level->name) === 'lycée' || strtolower($level->name) === 'lycee') {
            // Show fields for the specific year in Lycée
            $fields = Field::where('level_id', $level->id)
                          ->where('year_id', $year->id)
                          ->get();
            return view('courses.lycee-year', compact('level', 'year', 'fields'));
        }

        // For other levels: show subjects
        $subjects = Subject::with(['level', 'year'])
            ->where('level_id', $level->id)
            ->where('year_id', $year->id)
            ->whereNull('field_id')
            ->get();

        // Return appropriate view based on level
        if (strtolower($level->name) === 'primaire') {
            return view('courses.primaire-year', compact('level', 'year', 'subjects'));
        } elseif (strtolower($level->name) === 'collège' || strtolower($level->name) === 'college') {
            return view('courses.college-year', compact('level', 'year', 'subjects'));
        } elseif (strtolower($level->name) === 'concours') {
            return view('courses.concours-year', compact('level', 'year', 'subjects'));
        } else {
            return view('courses.primaire-year', compact('level', 'year', 'subjects'));
        }
    }

    public function showField($levelSlug, $yearSlug, $fieldSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $year = Year::where('slug', $yearSlug)->firstOrFail();
        $field = Field::where('slug', $fieldSlug)->firstOrFail();

        // Show subjects for this field
        $subjects = Subject::with(['level', 'year', 'field'])
            ->where('level_id', $level->id)
            ->where('year_id', $year->id)
            ->where('field_id', $field->id)
            ->get();

        return view('courses.field', compact('level', 'year', 'field', 'subjects'));
    }

    public function showMaterials($levelSlug, $yearSlug, $subjectSlug)
    {
        $level = Level::where('slug', $levelSlug)->firstOrFail();
        $year = Year::where('slug', $yearSlug)->firstOrFail();
        $subject = Subject::where('slug', $subjectSlug)->firstOrFail();

        // Show materials for this subject
        $materials = StudyMaterial::with(['blocks.pdfs', 'blocks.videos'])
            ->where('level_id', $level->id)
            ->where('year_id', $year->id)
            ->where('subject_id', $subject->id)
            ->get();

        return view('courses.materials', compact('level', 'year', 'subject', 'materials'));
    }
}
