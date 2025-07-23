<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Year;
use App\Models\Field;
use App\Models\StudyMaterial;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = StudyMaterial::with(['level'])->latest()->get();
    return view('admin.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::all();
        return view('admin.materials.create', [
        'levels' => \App\Models\Level::all(),
        'years' => \App\Models\Year::all(),
        'fields' => \App\Models\Field::all(),
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'level_id' => 'required|exists:levels,id',
        'year_id' => 'nullable|exists:years,id',
        'field_id' => 'nullable|exists:fields,id',
        'title' => 'required|string|max:255',
        'type' => 'required|string',
        'pdf_path' => 'nullable|file|mimes:pdf',
        'thumbnail_path' => 'nullable|image',
        'video_link' => 'nullable|url',
    ]);

    $pdfPath = $request->file('pdf_path')?->store('pdfs', 'public');
    $thumbnailPath = $request->file('thumbnail_path')?->store('thumbnails', 'public');

    StudyMaterial::create([
        'level_id' => $request->level_id,
        'year_id' => $request->year_id,
        'field_id' => $request->field_id,
        'title' => $request->title,
        'type' => $request->type,
        'pdf_path' => $pdfPath,
        'video_link' => $request->video_link,
        'thumbnail_path' => $thumbnailPath,
    ]);

    return redirect()->route('admin.materials.index')->with('success', 'Matériel ajouté.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $material = StudyMaterial::findOrFail($id);
    return view('admin.materials.edit', [
        'material' => $material,
        'levels' => Level::all(),
        'years' => Year::all(),
        'fields' => Field::all(),
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $material = StudyMaterial::findOrFail($id);

    $request->validate([
        'level_id' => 'required|exists:levels,id',
        'year_id' => 'nullable|exists:years,id',
        'field_id' => 'nullable|exists:fields,id',
        'title' => 'required|string|max:255',
        'type' => 'required|string',
        'pdf_path' => 'nullable|file|mimes:pdf',
        'thumbnail_path' => 'nullable|image',
        'video_link' => 'nullable|url',
    ]);

    // Optional: Replace files
    if ($request->hasFile('pdf_path')) {
        if ($material->pdf_path) {
            Storage::disk('public')->delete($material->pdf_path);
        }
        $material->pdf_path = $request->file('pdf_path')->store('pdfs', 'public');
    }

    if ($request->hasFile('thumbnail_path')) {
        if ($material->thumbnail_path) {
            Storage::disk('public')->delete($material->thumbnail_path);
        }
        $material->thumbnail_path = $request->file('thumbnail_path')->store('thumbnails', 'public');
    }

    // Update rest
    $material->update([
        'level_id' => $request->level_id,
        'year_id' => $request->year_id,
        'field_id' => $request->field_id,
        'title' => $request->title,
        'type' => $request->type,
        'video_link' => $request->video_link,
    ]);

    return redirect()->route('admin.materials.index')->with('success', 'Matériel mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = StudyMaterial::findOrFail($id);

    if ($material->pdf_path) {
        Storage::disk('public')->delete($material->pdf_path);
    }

    if ($material->thumbnail_path) {
        Storage::disk('public')->delete($material->thumbnail_path);
    }

    $material->delete();

    return redirect()->route('admin.materials.index')->with('success', 'Matériel supprimé.');
    }
}
