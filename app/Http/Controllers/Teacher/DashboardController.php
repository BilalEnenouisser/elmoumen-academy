<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\MaterialPdf;
use App\Models\PdfDownload;
use App\Models\StudyMaterial;

class DashboardController extends Controller
{
    public function index()
    {
        $teacherId = auth('teacher')->id();

        // Get teacher's stats
        $stats = [
            'total_materials' => StudyMaterial::whereHas('blocks.pdfs', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->count(),
            
            'total_pdfs' => MaterialPdf::where('teacher_id', $teacherId)->count(),
            
            'total_downloads' => PdfDownload::whereHas('materialPdf', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->count(),
        ];

        // Get recent materials uploaded by the teacher
        $recentMaterials = StudyMaterial::whereHas('blocks.pdfs', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })
        ->with(['level', 'year', 'field'])
        ->latest()
        ->take(5)
        ->get();

        return view('teacher.dashboard', compact('stats', 'recentMaterials'));
    }
}
