@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Welcome to the Admin Panel</h1>

    <!-- Analytics Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_users'] }}</p>
                </div>
            </div>
        </div>

        <!-- Online Users -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Online Users</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['online_users'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Teachers -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Teachers</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_teachers'] }}</p>
                </div>
            </div>
        </div>

        <!-- Online Teachers -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Online Teachers</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['online_teachers'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- PDF Downloads -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">📄 PDF Downloads</h3>
                <span class="text-2xl font-bold text-blue-600">{{ $stats['total_pdf_downloads'] }}</span>
            </div>
            <div class="space-y-2">
                @foreach($stats['top_downloaded_pdfs'] as $pdf)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $pdf->materialPdf->title ?? 'PDF' }}</span>
                        <span class="font-semibold">{{ $pdf->download_count }} downloads</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Video Clicks -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">🎬 Video Clicks</h3>
                <span class="text-2xl font-bold text-red-600">{{ $stats['total_video_clicks'] }}</span>
            </div>
            <div class="space-y-2">
                @foreach($stats['top_clicked_videos'] as $video)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $video->categoryVideo->title ?? 'Video' }}</span>
                        <span class="font-semibold">{{ $video->click_count }} clicks</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Page Views -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">👁️ Page Views</h3>
                <span class="text-2xl font-bold text-green-600">{{ $stats['total_page_views'] }}</span>
            </div>
            <p class="text-sm text-gray-600">Total page views tracked</p>
        </div>
    </div>

    <!-- Teacher Upload Stats -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">👨‍🏫 Teacher Upload Activity</h3>
        <div class="space-y-3">
            @foreach($stats['teacher_upload_stats'] as $teacher)
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                    <div>
                        <span class="font-medium">{{ $teacher->user->name ?? 'Unknown Teacher' }}</span>
                        <span class="text-sm text-gray-500 ml-2">{{ $teacher->user->email ?? '' }}</span>
                    </div>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $teacher->upload_count }} uploads
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <!-- Teachers -->
        <a href="{{ route('admin.teachers.index') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">👨‍🏫 Manage Teachers</h2>
            <p class="text-gray-600 mt-2">Add, edit, or remove teachers.</p>
        </a>

        <!-- Materials -->
        <a href="{{ route('admin.materials.index') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">📚 Manage Materials</h2>
            <p class="text-gray-600 mt-2">Upload PDFs, videos, or other materials.</p>
        </a>

        <!-- Marquee -->
        <a href="{{ route('admin.marquees.index') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">📢 Manage Marquee Bar</h2>
            <p class="text-gray-600 mt-2">Add or remove announcement messages.</p>
        </a>

        <!-- Messages -->
        <a href="{{ route('admin.messages.index') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">✉️ View Messages</h2>
            <p class="text-gray-600 mt-2">See contact form submissions from users.</p>
        </a>

        <!-- Structure -->
        <a href="{{ route('admin.structure') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">🏛️ Structure Management</h2>
            <p class="text-gray-600 mt-2">Manage levels, years, fields</p>
        </a>

        <!-- Videos -->
        <a href="{{ route('admin.category-videos.index') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">🎬 Videos</h2>
            <p class="text-gray-600 mt-2">Manage videos by categories (آباء, تلاميذ, أجي تغير حياتك).</p>
        </a>
    </div>
@endsection
