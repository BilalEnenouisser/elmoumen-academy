@extends('layouts.teacher')

@section('title', 'My Materials')

@section('actions')
    <a href="{{ route('teacher.materials.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
        ➕ Add New Material
    </a>
@endsection

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">My Materials</h1>
        <p class="text-gray-600">Manage your uploaded educational materials</p>
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

    @if($materials->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Material
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Level/Year
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Your PDFs
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Blocks
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($materials as $material)
                            @php
                                $teacherPdfs = \App\Models\MaterialPdf::where('teacher_id', auth()->id())
                                    ->whereHas('materialBlock', function ($query) use ($material) {
                                        $query->where('study_material_id', $material->id);
                                    })->get();
                                
                                $teacherBlocks = \App\Models\MaterialBlock::where('study_material_id', $material->id)
                                    ->whereHas('pdfs', function ($query) {
                                        $query->where('teacher_id', auth()->id());
                                    })->get();
                            @endphp
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $material->title }}</div>
                                        @if($material->field)
                                            <div class="text-sm text-gray-500">{{ $material->field->name }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $material->level->name }}</div>
                                    @if($material->year)
                                        <div class="text-sm text-gray-500">{{ $material->year->name }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $teacherPdfs->count() }} PDFs
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @foreach($teacherBlocks as $block)
                                            <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded mr-1 mb-1">
                                                {{ $block->material_type }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $material->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('teacher.materials.edit', $material) }}" 
                                           class="text-green-600 hover:text-green-900">
                                            ✏️ Edit
                                        </a>
                                        <form action="{{ route('teacher.materials.destroy', $material) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this material? This will only delete your uploaded PDFs.')" 
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                🗑️ Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Detailed PDF List -->
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">📄 Your Uploaded PDFs</h3>
            <div class="space-y-3">
                @php
                    $allTeacherPdfs = \App\Models\MaterialPdf::where('teacher_id', auth()->id())
                        ->with(['materialBlock.studyMaterial.level', 'materialBlock.studyMaterial.year'])
                        ->orderBy('created_at', 'desc')
                        ->get();
                @endphp
                
                @if($allTeacherPdfs->count() > 0)
                    @foreach($allTeacherPdfs as $pdf)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 18h12V6l-4-4H4v16z"/>
                                </svg>
                                <div>
                                    <div class="font-medium">{{ $pdf->title }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ $pdf->materialBlock->studyMaterial->title }} - 
                                        {{ $pdf->materialBlock->studyMaterial->level->name }}
                                        @if($pdf->materialBlock->studyMaterial->year)
                                            - {{ $pdf->materialBlock->studyMaterial->year->name }}
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $pdf->materialBlock->material_type }} - {{ $pdf->materialBlock->semester }}
                                    </div>
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
                @else
                    <p class="text-gray-600 text-center py-4">No PDFs uploaded yet.</p>
                @endif
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No materials yet</h3>
            <p class="text-gray-600 mb-4">You haven't uploaded any materials yet.</p>
            <a href="{{ route('teacher.materials.create') }}" 
               class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Upload Your First Material
            </a>
        </div>
    @endif
@endsection
