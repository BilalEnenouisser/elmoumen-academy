<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudyMaterial;
use App\Models\MaterialBlock;
use App\Models\MaterialPdf;
use App\Models\MaterialVideo;
use App\Models\Level;
use App\Models\Year;
use App\Models\Field;
use Illuminate\Support\Facades\Storage;
use App\Services\AnalyticsService;

class MaterialController extends Controller
{
    public function index()
    {
        // Get materials that have PDFs uploaded by the current teacher
        $teacherPdfs = MaterialPdf::where('teacher_id', auth()->id())
            ->with(['materialBlock.studyMaterial.level', 'materialBlock.studyMaterial.year'])
            ->get();

        // Group by study material
        $materials = $teacherPdfs->groupBy('materialBlock.studyMaterial.id')
            ->map(function ($pdfs) {
                return $pdfs->first()->materialBlock->studyMaterial;
            });

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
            'title' => 'required|string|max:255',
            'level_id' => 'required|exists:levels,id',
            'year_id' => 'nullable|exists:years,id',
            'field_id' => 'nullable|exists:fields,id',
            'semesters' => 'required|array',
            'semesters.*' => 'required|in:Semestre 1,Semestre 2',
            'material_types' => 'required|array',
            'material_types.*' => 'required|in:Cours,Séries,Devoirs semestre 1,Devoirs semestre 2,Examens',
            'exam_types' => 'nullable|array',
            'exam_types.*' => 'nullable|in:إمتحانات محلية,إمتحانات إقليمية,Examens Locaux,Examens Régionaux,Examens Nationaux Blanc,Examens Nationaux',
            'pdfs.*.*' => 'nullable|file|mimes:pdf|max:10240',
            'pdf_titles.*.*' => 'nullable|string',
            'video_links.*.*' => 'nullable|url',
            'video_titles.*.*' => 'nullable|string',
        ]);

        try {
            // Create the study material
            $material = StudyMaterial::create([
                'level_id' => $request->level_id,
                'year_id' => $request->year_id,
                'field_id' => $request->field_id,
                'title' => $request->title,
            ]);

            // Create blocks and their content
            foreach ($request->material_types as $blockIndex => $materialType) {
                $block = $material->blocks()->create([
                    'type' => $materialType,
                    'semester' => $request->semesters[$blockIndex],
                    'material_type' => $request->material_types[$blockIndex],
                    'exam_type' => $request->exam_types[$blockIndex] ?? null,
                    'order' => $blockIndex,
                ]);

                // Store PDFs for this block
                if (isset($request->file('pdfs')[$blockIndex])) {
                    foreach ($request->file('pdfs')[$blockIndex] as $pdfIndex => $pdf) {
                        if ($pdf && $pdf->isValid()) {
                            $path = $pdf->store('materials/pdfs', 'public');
                            $pdf = $block->pdfs()->create([
                                'pdf_path' => $path,
                                'title' => $request->pdf_titles[$blockIndex][$pdfIndex] ?? $pdf->getClientOriginalName(),
                                'teacher_id' => auth()->id(),
                            ]);
                            
                            // Track teacher activity
                            AnalyticsService::trackTeacherActivity(
                                auth()->id(), 
                                'upload_pdf', 
                                "Uploaded PDF: {$pdf->title} to {$material->title}"
                            );
                        }
                    }
                }

                // Store Videos for this block
                if (isset($request->video_links[$blockIndex])) {
                    foreach ($request->video_links[$blockIndex] as $videoIndex => $link) {
                        if (!empty($link)) {
                            $block->videos()->create([
                                'video_link' => $link,
                                'title' => $request->video_titles[$blockIndex][$videoIndex] ?? 'Video',
                            ]);
                        }
                    }
                }
            }

            return redirect()->route('teacher.materials.index')
                ->with('success', 'Material uploaded successfully!');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error uploading material: ' . $e->getMessage());
        }
    }

    public function edit(StudyMaterial $material)
    {
        // Check if teacher has uploaded any PDFs for this material
        $teacherPdfs = MaterialPdf::where('teacher_id', auth()->id())
            ->whereHas('materialBlock', function ($query) use ($material) {
                $query->where('study_material_id', $material->id);
            })->get();

        if ($teacherPdfs->isEmpty()) {
            return redirect()->route('teacher.materials.index')
                ->with('error', 'You can only edit materials you have uploaded.');
        }

        $levels = Level::all();
        $years = Year::all();
        $fields = Field::all();

        return view('teacher.materials.edit', compact('material', 'levels', 'years', 'fields', 'teacherPdfs'));
    }

    public function update(Request $request, StudyMaterial $material)
    {
        // Check if teacher has uploaded any PDFs for this material
        $teacherPdfs = MaterialPdf::where('teacher_id', auth()->id())
            ->whereHas('materialBlock', function ($query) use ($material) {
                $query->where('study_material_id', $material->id);
            })->get();

        if ($teacherPdfs->isEmpty()) {
            return redirect()->route('teacher.materials.index')
                ->with('error', 'You can only edit materials you have uploaded.');
        }

        $request->validate([
            'pdfs.*.*' => 'nullable|file|mimes:pdf|max:10240',
            'pdf_titles.*.*' => 'nullable|string',
            'video_links.*.*' => 'nullable|url',
            'video_titles.*.*' => 'nullable|string',
        ]);

        try {
            // Handle new PDF uploads to existing blocks
            if ($request->hasFile('pdfs')) {
                foreach ($request->file('pdfs') as $blockIndex => $blockPdfs) {
                    if (isset($material->blocks[$blockIndex])) {
                        $block = $material->blocks[$blockIndex];
                        
                        foreach ($blockPdfs as $pdfIndex => $pdfFile) {
                            if ($pdfFile && $pdfFile->isValid()) {
                                $pdfPath = $pdfFile->store('materials/pdfs', 'public');
                                
                                $pdf = MaterialPdf::create([
                                    'material_block_id' => $block->id,
                                    'pdf_path' => $pdfPath,
                                    'title' => $request->pdf_titles[$blockIndex][$pdfIndex] ?? $pdfFile->getClientOriginalName(),
                                    'teacher_id' => auth()->id(),
                                ]);
                                
                                // Track teacher activity
                                AnalyticsService::trackTeacherActivity(
                                    auth()->id(), 
                                    'upload_pdf', 
                                    "Uploaded PDF: {$pdf->title} to {$material->title}"
                                );
                            }
                        }
                    }
                }
            }

            // Handle new video links to existing blocks
            if ($request->video_links) {
                foreach ($request->video_links as $blockIndex => $blockVideos) {
                    if (isset($material->blocks[$blockIndex])) {
                        $block = $material->blocks[$blockIndex];
                        
                        foreach ($blockVideos as $videoIndex => $videoLink) {
                            if (!empty($videoLink)) {
                                MaterialVideo::create([
                                    'material_block_id' => $block->id,
                                    'video_link' => $videoLink,
                                    'title' => $request->video_titles[$blockIndex][$videoIndex] ?? 'Video',
                                ]);
                            }
                        }
                    }
                }
            }

            return redirect()->route('teacher.materials.index')
                ->with('success', 'Material updated successfully!');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating material: ' . $e->getMessage());
        }
    }

    public function destroy(StudyMaterial $material)
    {
        // Only allow deletion of PDFs uploaded by the teacher
        $teacherPdfs = MaterialPdf::where('teacher_id', auth()->id())
            ->whereHas('materialBlock', function ($query) use ($material) {
                $query->where('study_material_id', $material->id);
            })->get();

        if ($teacherPdfs->isEmpty()) {
            return redirect()->route('teacher.materials.index')
                ->with('error', 'You can only delete materials you have uploaded.');
        }

        try {
            // Delete PDFs and their files
            foreach ($teacherPdfs as $pdf) {
                if (Storage::disk('public')->exists($pdf->pdf_path)) {
                    Storage::disk('public')->delete($pdf->pdf_path);
                }
                $pdf->delete();
            }

            return redirect()->route('teacher.materials.index')
                ->with('success', 'Material deleted successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting material: ' . $e->getMessage());
        }
    }

    public function deletePdf(MaterialPdf $pdf)
    {
        // Check if the PDF belongs to the current teacher
        if ($pdf->teacher_id !== auth()->id()) {
            return back()->with('error', 'You can only delete PDFs you have uploaded.');
        }

        try {
            if (Storage::disk('public')->exists($pdf->pdf_path)) {
                Storage::disk('public')->delete($pdf->pdf_path);
            }
            $pdf->delete();

            return back()->with('success', 'PDF deleted successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting PDF: ' . $e->getMessage());
        }
    }

    public function getYearsByLevel($levelId)
    {
        $years = Year::where('level_id', $levelId)->get();
        return response()->json($years);
    }
}
