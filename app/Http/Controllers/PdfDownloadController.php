<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialPdf;
use Illuminate\Support\Facades\Storage;
use App\Services\AnalyticsService;

class PdfDownloadController extends Controller
{
    public function download(MaterialPdf $pdf)
    {
        // Check if file exists
        if (!Storage::disk('public')->exists($pdf->pdf_path)) {
            abort(404, 'PDF file not found');
        }

        // Track the download
        AnalyticsService::trackPdfDownload(request(), $pdf->id);
        
        // Redirect to a view page that embeds the PDF
        return view('pdf.viewer', [
            'pdf' => $pdf,
            'pdfUrl' => asset('storage/' . $pdf->pdf_path)
        ]);
    }
    
    private function getDownloadFilename(MaterialPdf $pdf)
    {
        // If title is set, use it as filename
        if (!empty($pdf->title)) {
            $filename = $pdf->title;
        } else {
            // Extract original filename from pdf_path
            $filename = basename($pdf->pdf_path);
            // Remove any timestamp prefix if it exists
            $filename = preg_replace('/^\d+_/', '', $filename);
        }
        
        // Ensure the filename has .pdf extension
        if (!str_ends_with(strtolower($filename), '.pdf')) {
            $filename .= '.pdf';
        }
        
        // Clean the filename (remove special characters that might cause issues)
        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
        
        return $filename;
    }
}
