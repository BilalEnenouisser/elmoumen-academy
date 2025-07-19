<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Year;
use App\Models\Field;
use App\Models\Subject;
use App\Models\StudyMaterial;

class CourseController extends Controller
{
    public function showLevel($level)
{
    $level = Level::where('name', $level)->firstOrFail();
    $years = $level->years;
    return view('courses.level', compact('level', 'years'));
}

public function showYear($level, $year)
{
    $level = Level::where('name', $level)->firstOrFail();
    $year = Year::where('id', $year)->where('level_id', $level->id)->firstOrFail();

    // If Lycée, show fields
    if ($level->name === 'Lycée') {
        $fields = $level->fields;
        return view('courses.lycee_fields', compact('level', 'year', 'fields'));
    }

    // Else, show subjects
    $subjects = Subject::all();
    return view('courses.subjects', compact('level', 'year', 'subjects'));
}

public function showField($level, $year, $field)
{
    $level = Level::where('name', $level)->firstOrFail();
    $year = Year::findOrFail($year);
    $field = Field::findOrFail($field);
    $subjects = Subject::all();

    return view('courses.subjects', compact('level', 'year', 'field', 'subjects'));
}

public function showSubject($level, $year, $field, $subject)
{
    $subject = Subject::findOrFail($subject);

    $materials = StudyMaterial::where('subject_id', $subject->id)
        ->when($level, fn($q) => $q->whereHas('level', fn($q2) => $q2->where('name', $level)))
        ->when($year, fn($q) => $q->where('year_id', $year))
        ->when($field, fn($q) => $q->where('field_id', $field))
        ->get()
        ->groupBy('type'); // Group by Cours / Séries

    return view('courses.materials', compact('subject', 'materials'));
}
}
