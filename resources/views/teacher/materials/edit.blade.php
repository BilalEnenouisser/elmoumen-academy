@extends('layouts.teacher')

@section('title', 'Edit Material')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Material</h1>
        <p class="text-gray-600">Add more PDFs and videos to: {{ $material->title }}</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Current Material Info -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <h3 class="font-semibold text-gray-900 mb-2">Material Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div>
                <span class="font-medium">Title:</span> {{ $material->title }}
            </div>
            <div>
                <span class="font-medium">Level:</span> {{ $material->level->name }}
            </div>
            <div>
                <span class="font-medium">Year:</span> {{ $material->year->name }}
            </div>
            @if($material->field)
                <div>
                    <span class="font-medium">Field:</span> {{ $material->field->name }}
                </div>
            @endif
        </div>
    </div>

    <!-- Your Current PDFs -->
    @if($teacherPdfs->count() > 0)
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Current PDFs</h3>
            <div class="space-y-3">
                @foreach($teacherPdfs as $pdf)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 18h12V6l-4-4H4v16z"/>
                            </svg>
                            <div>
                                <div class="font-medium">{{ $pdf->title }}</div>
                                <div class="text-sm text-gray-500">{{ $pdf->materialBlock->type }} - {{ $pdf->materialBlock->semester }}</div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ asset('storage/' . $pdf->pdf_path) }}" 
                               target="_blank" 
                               class="text-blue-600 hover:text-blue-800 text-sm">
                                👁️ View
                            </a>
                            <form action="{{ route('teacher.materials.pdf.delete', $pdf) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Delete this PDF?')" 
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Add New Content Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Content</h3>
        
        <form action="{{ route('teacher.materials.update', $material) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- PDF Uploads -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Upload New PDFs
                </label>
                <div id="pdf_uploads" class="space-y-3">
                    <div class="pdf-upload-row flex gap-3">
                        <input type="file" name="pdfs[]" accept=".pdf" 
                               class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <input type="text" name="pdf_titles[]" placeholder="PDF Title (optional)" 
                               class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>
                <button type="button" onclick="addPdfRow()" 
                        class="mt-2 text-green-600 hover:text-green-800 text-sm">
                    ➕ Add another PDF
                </button>
            </div>

            <!-- Video Links -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Add Video Links
                </label>
                <div id="video_links" class="space-y-3">
                    <div class="video-link-row flex gap-3">
                        <input type="url" name="video_links[]" placeholder="Video URL" 
                               class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <input type="text" name="video_titles[]" placeholder="Video Title (optional)" 
                               class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>
                <button type="button" onclick="addVideoRow()" 
                        class="mt-2 text-green-600 hover:text-green-800 text-sm">
                    ➕ Add another video
                </button>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('teacher.materials.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Add Content
                </button>
            </div>
        </form>
    </div>

    <script>
        // Add PDF row
        function addPdfRow() {
            const container = document.getElementById('pdf_uploads');
            const newRow = document.createElement('div');
            newRow.className = 'pdf-upload-row flex gap-3';
            newRow.innerHTML = `
                <input type="file" name="pdfs[]" accept=".pdf" 
                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <input type="text" name="pdf_titles[]" placeholder="PDF Title (optional)" 
                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <button type="button" onclick="removeRow(this)" 
                        class="px-2 py-2 text-red-600 hover:text-red-800">🗑️</button>
            `;
            container.appendChild(newRow);
        }

        // Add video row
        function addVideoRow() {
            const container = document.getElementById('video_links');
            const newRow = document.createElement('div');
            newRow.className = 'video-link-row flex gap-3';
            newRow.innerHTML = `
                <input type="url" name="video_links[]" placeholder="Video URL" 
                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <input type="text" name="video_titles[]" placeholder="Video Title (optional)" 
                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <button type="button" onclick="removeRow(this)" 
                        class="px-2 py-2 text-red-600 hover:text-red-800">🗑️</button>
            `;
            container.appendChild(newRow);
        }

        // Remove row
        function removeRow(button) {
            button.parentElement.remove();
        }
    </script>
@endsection
