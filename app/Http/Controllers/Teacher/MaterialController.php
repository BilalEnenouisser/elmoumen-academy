<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudyMaterial;
use App\Models\Level;
use App\Models\Year;
use App\Models\Field;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = StudyMaterial::latest()->paginate(10);
        return view('teacher.materials.index', compact('materials'));
    }

    public function create()
    {
        $levels = Level::all();
        $years = Year::all();
        $fields = Field::all();
        return view('teacher.materials.create', compact('levels', 'years', 'fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'level_id' => 'required',
            'year_id' => 'required',
            'type' => 'required',
            'pdf' => 'nullable|file|mimes:pdf',
            'video_link' => 'nullable|url',
            'thumbnail' => 'nullable|image',
        ]);

        $data = $request->only(['title', 'level_id', 'year_id', 'field_id', 'type', 'video_link']);

        if ($request->hasFile('pdf')) {
            $data['pdf_path'] = $request->file('pdf')->store('materials', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('materials', 'public');
        }

        StudyMaterial::create($data);

        return redirect()->route('teacher.materials.index')->with('success', 'Contenu ajouté avec succès.');
    }

    // Add edit, update, delete methods here if needed
}
