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
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
use App\Services\AnalyticsService;

class MaterialController extends Controller
{
    public function index()
    {
        // Get materials that have PDFs uploaded by the current teacher
        $teacherPdfs = MaterialPdf::where('teacher_id', auth('teacher')->id())
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
            'subject_id' => 'required|exists:subjects,id',
            'semesters' => 'required|array',
            'semesters.*' => 'required|in:Semestre 1,Semestre 2',
            'material_types' => 'required|array',
            'material_types.*' => 'required|in:Cours,Séries,Devoirs,Examens',
            'devoir_types' => 'nullable|array',
            'devoir_types.*' => 'nullable|in:Devoir 1,Devoir 2,Devoir 3,Devoir 4',
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
                        if ($pdf && $pdf->isValid()) {
                            $path = $pdf->store('materials/pdfs', 'public');
                            $pdf = $block->pdfs()->create([
                                'pdf_path' => $path,
                                'title' => $request->pdf_titles[$blockIndex][$pdfIndex] ?? $pdf->getClientOriginalName(),
                                'teacher_id' => auth('teacher')->id(),
                            ]);
                            
                            // Track teacher activity
                            AnalyticsService::trackTeacherActivity(
                                null, 
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
        $teacherPdfs = MaterialPdf::where('teacher_id', auth('teacher')->id())
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
        $teacherPdfs = MaterialPdf::where('teacher_id', auth('teacher')->id())
            ->whereHas('materialBlock', function ($query) use ($material) {
                $query->where('study_material_id', $material->id);
            })->get();

        if ($teacherPdfs->isEmpty()) {
            return redirect()->route('teacher.materials.index')
                ->with('error', 'You can only edit materials you have uploaded.');
        }

        $request->validate([
            'semesters' => 'required|array',
            'semesters.*' => 'required|in:Semestre 1,Semestre 2',
            'material_types' => 'required|array',
            'material_types.*' => 'required|in:Cours,Séries,Devoirs,Examens',
            'devoir_types' => 'nullable|array',
            'devoir_types.*' => 'nullable|in:Devoir 1,Devoir 2,Devoir 3,Devoir 4',
            'exam_types' => 'nullable|array',
            'exam_types.*' => 'nullable|in:إمتحانات محلية,إمتحانات إقليمية,Examens Locaux,Examens Régionaux,Examens Nationaux Blanc,Examens Nationaux',
            'pdfs.*.*' => 'nullable|file|mimes:pdf|max:10240',
            'pdf_titles.*.*' => 'nullable|string',
            'video_links.*.*' => 'nullable|url',
            'video_titles.*.*' => 'nullable|string',
        ]);

        try {
            // Create new blocks and their content
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
                        if ($pdf && $pdf->isValid()) {
                            $path = $pdf->store('materials/pdfs', 'public');
                            $pdf = $block->pdfs()->create([
                                'pdf_path' => $path,
                                'title' => $request->pdf_titles[$blockIndex][$pdfIndex] ?? $pdf->getClientOriginalName(),
                                'teacher_id' => auth('teacher')->id(),
                            ]);
                            
                            // Track teacher activity
                            AnalyticsService::trackTeacherActivity(
                                null, 
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
                ->with('success', 'Contenu ajouté avec succès!');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Erreur lors de l\'ajout du contenu: ' . $e->getMessage());
        }
    }

    public function destroy(StudyMaterial $material)
    {
        // Only allow deletion of PDFs uploaded by the teacher
        $teacherPdfs = MaterialPdf::where('teacher_id', auth('teacher')->id())
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
        if ($pdf->teacher_id !== auth('teacher')->id()) {
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

    public function getFieldsByLevelAndYear($levelId, $yearId)
    {
        $fields = Field::where('level_id', $levelId)
                      ->where('year_id', $yearId)
                      ->get();
        return response()->json($fields);
    }

    public function getSubjectsByLevelYearAndField($levelId, $yearId, $fieldId = null)
    {
        try {
            // Cast parameters to integers
            $levelId = (int) $levelId;
            $yearId = (int) $yearId;
            $fieldId = $fieldId ? (int) $fieldId : null;
            
            $query = Subject::where('level_id', $levelId)
                           ->where('year_id', $yearId);
            
            if ($fieldId) {
                $query->where('field_id', $fieldId);
            } else {
                $query->whereNull('field_id');
            }
            
            $subjects = $query->get();
            
            return response()->json($subjects);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
