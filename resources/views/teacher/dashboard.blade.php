@extends('layouts.teacher')

@section('title', 'Teacher Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Welcome to Your Teacher Dashboard</h1>

    <!-- Teacher Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Materials -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Materials</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_materials'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total PDFs -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total PDFs</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_pdfs'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Downloads -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Downloads</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_downloads'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Materials -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">📚 Recent Materials</h3>
        @if(isset($recentMaterials) && $recentMaterials->count() > 0)
            <div class="space-y-3">
                @foreach($recentMaterials as $material)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                        <div>
                            <span class="font-medium">{{ $material->title }}</span>
                            <span class="text-sm text-gray-500 ml-2">{{ $material->level->name }} - {{ $material->year->name }}</span>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('teacher.materials.edit', $material) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                            <span class="text-gray-400">|</span>
                            <span class="text-sm text-gray-500">{{ $material->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No materials uploaded yet.</p>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Add New Material -->
        <a href="{{ route('teacher.materials.create') }}" class="p-6 bg-white rounded shadow hover:bg-green-50 transition">
            <h2 class="text-lg font-semibold text-green-600">➕ Add New Material</h2>
            <p class="text-gray-600 mt-2">Upload new PDFs, videos, or other educational materials.</p>
        </a>

        <!-- View All Materials -->
        <a href="{{ route('teacher.materials.index') }}" class="p-6 bg-white rounded shadow hover:bg-green-50 transition">
            <h2 class="text-lg font-semibold text-green-600">📚 View All Materials</h2>
            <p class="text-gray-600 mt-2">Manage and edit your uploaded materials.</p>
        </a>
    </div>
@endsection 