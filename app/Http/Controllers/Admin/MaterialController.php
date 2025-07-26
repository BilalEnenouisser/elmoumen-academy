<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Year;
use App\Models\Field;
use App\Models\StudyMaterial;
use App\Models\MaterialPdf;
use App\Models\MaterialVideo;
use App\Models\MaterialBlock;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = StudyMaterial::with(['level', 'blocks.pdfs', 'blocks.videos'])->latest()->get();
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
            'block_types' => 'required|array',
            'block_types.*' => 'required|string',
            'pdfs.*.*' => 'nullable|file|mimes:pdf',
            'video_links.*.*' => 'nullable|url',
        ]);

        // Create the material
        $material = StudyMaterial::create([
            'level_id' => $request->level_id,
            'year_id' => $request->year_id,
            'field_id' => $request->field_id,
            'title' => $request->title,
        ]);

        // Create blocks and their content
        foreach ($request->block_types as $blockIndex => $blockType) {
            $block = $material->blocks()->create([
                'type' => $blockType,
                'order' => $blockIndex,
            ]);

            // Store PDFs for this block
            if (isset($request->file('pdfs')[$blockIndex])) {
                foreach ($request->file('pdfs')[$blockIndex] as $pdfIndex => $pdf) {
                    if ($pdf) {
                        $path = $pdf->store('pdfs', 'public');
                        $block->pdfs()->create([
                            'pdf_path' => $path,
                            'title' => $request->pdf_titles[$blockIndex][$pdfIndex] ?? null,
                        ]);
                    }
                }
            }

            // Store Videos for this block
            if (isset($request->video_links[$blockIndex])) {
                foreach ($request->video_links[$blockIndex] as $videoIndex => $link) {
                    if ($link) {
                        $block->videos()->create([
                            'video_link' => $link,
                            'title' => $request->video_titles[$blockIndex][$videoIndex] ?? null,
                        ]);
                    }
                }
            }
        }

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
        $material = StudyMaterial::with(['pdfs', 'videos'])->findOrFail($id);
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
            'pdfs.*' => 'nullable|file|mimes:pdf',
            'video_links.*' => 'nullable|url',
        ]);

        // Update material basic info
        $material->update([
            'level_id' => $request->level_id,
            'year_id' => $request->year_id,
            'field_id' => $request->field_id,
            'title' => $request->title,
            'type' => $request->type,
        ]);

        // Store new PDFs
        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $index => $pdf) {
                if ($pdf) {
                    $path = $pdf->store('pdfs', 'public');
                    $material->pdfs()->create([
                        'pdf_path' => $path,
                        'title' => $request->pdf_titles[$index] ?? null,
                    ]);
                }
            }
        }

        // Store new Videos
        if ($request->video_links) {
            foreach ($request->video_links as $index => $link) {
                if ($link) {
                    $material->videos()->create([
                        'video_link' => $link,
                        'title' => $request->video_titles[$index] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.materials.index')->with('success', 'Matériel mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = StudyMaterial::findOrFail($id);

        // Delete all PDFs
        foreach ($material->pdfs as $pdf) {
            Storage::disk('public')->delete($pdf->pdf_path);
        }

        // Delete all videos (no files to delete, just database records)
        $material->videos()->delete();

        $material->delete();

        return redirect()->route('admin.materials.index')->with('success', 'Matériel supprimé.');
    }

    /**
     * Delete a specific PDF
     */
    public function deletePdf(string $pdfId)
    {
        $pdf = MaterialPdf::findOrFail($pdfId);
        Storage::disk('public')->delete($pdf->pdf_path);
        $pdf->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Delete a specific video
     */
    public function deleteVideo(string $videoId)
    {
        $video = MaterialVideo::findOrFail($videoId);
        $video->delete();

        return response()->json(['success' => true]);
    }
}
