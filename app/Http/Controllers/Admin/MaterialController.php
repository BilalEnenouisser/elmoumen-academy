<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Year;
use App\Models\Field;
use App\Models\Subject;
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
            'subject_id' => 'nullable|exists:subjects,id',
            'title' => 'required|string|max:255',
            'semesters' => 'required|array',
            'semesters.*' => 'required|in:Semestre 1,Semestre 2',
            'material_types' => 'required|array',
            'material_types.*' => 'required|in:Cours,Séries,Devoirs,Examens',
            'devoir_types' => 'nullable|array',
            'devoir_types.*' => 'nullable|in:Devoir 1,Devoir 2,Devoir 3,Devoir 4',
            'exam_types' => 'nullable|array',
            'exam_types.*' => 'nullable|in:إمتحانات محلية,إمتحانات إقليمية,Examens Locaux,Examens Régionaux,Examens Nationaux Blanc,Examens Nationaux',
            'pdfs.*.*' => 'nullable|file|mimes:pdf',
            'video_links.*.*' => 'nullable|url',
        ]);

        // Create the material
        $material = StudyMaterial::create([
            'level_id' => $request->level_id,
            'year_id' => $request->year_id,
            'field_id' => $request->field_id,
            'subject_id' => $request->subject_id,
            'title' => $request->title,
        ]);

        // Create blocks and their content
        foreach ($request->material_types as $blockIndex => $materialType) {
            // Determine the name for the block
            $blockName = null;
            if ($materialType === 'Devoirs' && isset($request->devoir_types[$blockIndex])) {
                $blockName = $request->devoir_types[$blockIndex];
            }
            
            $block = $material->blocks()->create([
                'type' => $materialType,
                'semester' => $request->semesters[$blockIndex],
                'material_type' => $request->material_types[$blockIndex],
                'name' => $blockName,
                'exam_type' => $request->exam_types[$blockIndex] ?? null,
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
        $material = StudyMaterial::with(['blocks.pdfs', 'blocks.videos'])->findOrFail($id);
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
            'subject_id' => 'nullable|exists:subjects,id',
            'title' => 'required|string|max:255',
            'semesters' => 'required|array',
            'semesters.*' => 'required|in:Semestre 1,Semestre 2',
            'material_types' => 'required|array',
            'material_types.*' => 'required|in:Cours,Séries,Devoirs,Examens',
            'exam_types' => 'nullable|array',
            'exam_types.*' => 'nullable|in:إمتحانات محلية,إمتحانات إقليمية,Examens Locaux,Examens Régionaux,Examens Nationaux Blanc,Examens Nationaux',
            'pdfs.*.*' => 'nullable|file|mimes:pdf',
            'video_links.*.*' => 'nullable|url',
        ]);

        // Update material basic info
        $material->update([
            'level_id' => $request->level_id,
            'year_id' => $request->year_id,
            'field_id' => $request->field_id,
            'subject_id' => $request->subject_id,
            'title' => $request->title,
        ]);

        // Get existing blocks
        $existingBlocks = $material->blocks()->orderBy('order')->get();
        
        // Update or create blocks
        foreach ($request->material_types as $blockIndex => $materialType) {
            // Update existing block or create new one
            if (isset($existingBlocks[$blockIndex])) {
                $block = $existingBlocks[$blockIndex];
                $block->update([
                    'type' => $materialType,
                    'semester' => $request->semesters[$blockIndex],
                    'material_type' => $request->material_types[$blockIndex],
                    'exam_type' => $request->exam_types[$blockIndex] ?? null,
                ]);
            } else {
                $block = $material->blocks()->create([
                    'type' => $materialType,
                    'semester' => $request->semesters[$blockIndex],
                    'material_type' => $request->material_types[$blockIndex],
                    'exam_type' => $request->exam_types[$blockIndex] ?? null,
                    'order' => $blockIndex,
                ]);
            }

            // Handle PDFs for this block
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

            // Handle Videos for this block
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

        // Remove blocks that are no longer in the form
        $newBlockCount = count($request->material_types);
        $existingBlocks->slice($newBlockCount)->each(function($block) {
            // Delete PDFs
            foreach ($block->pdfs as $pdf) {
                Storage::disk('public')->delete($pdf->pdf_path);
            }
            $block->pdfs()->delete();
            
            // Delete videos
            $block->videos()->delete();
            
            // Delete block
            $block->delete();
        });

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

    /**
     * Get years by level for dynamic filtering
     */
    public function getYearsByLevel(string $levelId)
    {
        $years = Year::where('level_id', $levelId)->get();
        return response()->json($years);
    }

    /**
     * Get fields by level and year for dynamic filtering
     */
    public function getFieldsByLevelAndYear(string $levelId, string $yearId)
    {
        $fields = Field::where('level_id', $levelId)
                      ->where('year_id', $yearId)
                      ->get();
        return response()->json($fields);
    }

    /**
     * Get subjects by level, year and field for dynamic filtering
     */
    public function getSubjectsByLevelYearAndField(string $levelId, string $yearId, string $fieldId = null)
    {
        $query = Subject::where('level_id', $levelId)
                       ->where('year_id', $yearId);
        
        if ($fieldId) {
            $query->where('field_id', $fieldId);
        } else {
            $query->whereNull('field_id');
        }
        
        $subjects = $query->get();
        
        return response()->json($subjects);
    }
}
