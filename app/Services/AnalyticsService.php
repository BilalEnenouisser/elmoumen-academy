<?php

namespace App\Services;

use App\Models\PageView;
use App\Models\PdfDownload;
use App\Models\VideoClick;
use App\Models\UserSession;
use App\Models\TeacherActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalyticsService
{
    public static function trackPageView(Request $request, $pageTitle = null)
    {
        PageView::create([
            'page_url' => $request->fullUrl(),
            'page_title' => $pageTitle,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'user_id' => Auth::id(),
        ]);
    }

    public static function trackPdfDownload(Request $request, $materialPdfId)
    {
        PdfDownload::create([
            'material_pdf_id' => $materialPdfId,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    public static function trackVideoClick(Request $request, $categoryVideoId)
    {
        VideoClick::create([
            'category_video_id' => $categoryVideoId,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    public static function trackUserSession($userId, $sessionId)
    {
        UserSession::updateOrCreate(
            ['user_id' => $userId, 'session_id' => $sessionId],
            ['last_activity' => now()]
        );
    }

    public static function trackTeacherActivity($userId, $action, $details = null)
    {
        TeacherActivity::create([
            'user_id' => $userId,
            'action' => $action,
            'details' => $details,
        ]);
    }

    public static function getOnlineUsers()
    {
        return UserSession::where('last_activity', '>=', now()->subMinutes(5))
            ->with('user')
            ->get()
            ->unique('user_id');
    }

    public static function getOnlineTeachers()
    {
        return UserSession::where('last_activity', '>=', now()->subMinutes(5))
            ->whereHas('user', function ($query) {
                $query->where('role', 'teacher');
            })
            ->with('user')
            ->get()
            ->unique('user_id');
    }

    public static function getDashboardStats()
    {
        $totalUsers = \App\Models\User::count();
        $totalTeachers = \App\Models\User::where('role', 'teacher')->count();
        $onlineUsers = self::getOnlineUsers()->count();
        $onlineTeachers = self::getOnlineTeachers()->count();
        
        $totalPdfDownloads = PdfDownload::count();
        $totalVideoClicks = VideoClick::count();
        $totalPageViews = PageView::count();
        
        $topDownloadedPdfs = PdfDownload::with('materialPdf')
            ->selectRaw('material_pdf_id, COUNT(*) as download_count')
            ->groupBy('material_pdf_id')
            ->orderBy('download_count', 'desc')
            ->limit(5)
            ->get();
            
        $topClickedVideos = VideoClick::with('categoryVideo')
            ->selectRaw('category_video_id, COUNT(*) as click_count')
            ->groupBy('category_video_id')
            ->orderBy('click_count', 'desc')
            ->limit(5)
            ->get();
            
        // Get teacher upload stats with teacher names
        $teacherUploadStats = \App\Models\MaterialPdf::whereNotNull('teacher_id')
            ->with('teacher')
            ->selectRaw('teacher_id, COUNT(*) as upload_count')
            ->groupBy('teacher_id')
            ->orderBy('upload_count', 'desc')
            ->limit(5)
            ->get();

        return [
            'total_users' => $totalUsers,
            'total_teachers' => $totalTeachers,
            'online_users' => $onlineUsers,
            'online_teachers' => $onlineTeachers,
            'total_pdf_downloads' => $totalPdfDownloads,
            'total_video_clicks' => $totalVideoClicks,
            'total_page_views' => $totalPageViews,
            'top_downloaded_pdfs' => $topDownloadedPdfs,
            'top_clicked_videos' => $topClickedVideos,
            'teacher_upload_stats' => $teacherUploadStats,
        ];
    }
} 