@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6 text-blue-700">
        Matériaux - {{ $year->name }} / {{ $level->name }}
    </h1>

    @if($materials->isEmpty())
        <div class="text-gray-600">Aucune ressource disponible pour cette année.</div>
    @else
        <div class="space-y-6" x-data="{ openAccordion: null }">
            @php
                // Group materials by semester and then by material name
                $semester1Materials = $materials->filter(function($material) {
                    return $material->blocks->where('semester', 'Semestre 1')->count() > 0;
                });
                $semester2Materials = $materials->filter(function($material) {
                    return $material->blocks->where('semester', 'Semestre 2')->count() > 0;
                });
            @endphp
            
            @if($semester1Materials->count() > 0)
            <div class="bg-white rounded-xl p-4 shadow">
                <h3 class="text-xl font-bold text-blue-600 mb-4 border-b pb-2">Semestre 1</h3>
                <div class="space-y-3">
                    @foreach($semester1Materials as $material)
                    @php
                        // Determine the color for the main accordion button based on material types
                        $mainButtonColor = 'bg-white';
                        $mainBorderColor = 'border-gray-200';
                        $mainTextColor = 'text-gray-800';
                        
                        $semester1Blocks = $material->blocks->where('semester', 'Semestre 1');
                        $hasDevoirs = $semester1Blocks->whereIn('material_type', ['Devoirs semestre 1', 'Devoirs semestre 2'])->count() > 0;
                        $hasExamens = $semester1Blocks->where('material_type', 'Examens')->count() > 0;
                        
                        if ($hasExamens) {
                            $mainButtonColor = 'bg-purple-50';
                            $mainBorderColor = 'border-purple-200';
                            $mainTextColor = 'text-purple-800';
                        } elseif ($hasDevoirs) {
                            $mainButtonColor = 'bg-red-50';
                            $mainBorderColor = 'border-red-200';
                            $mainTextColor = 'text-red-800';
                        }
                    @endphp
                    <div class="bg-[#F5F7FA] rounded-2xl shadow p-4">
                        <!-- Material Header (Accordion Button) -->
                        <button @click="openAccordion = openAccordion === '{{ $material->id }}' ? null : '{{ $material->id }}'"
                            class="w-full flex items-center justify-between px-4 py-4 rounded-xl {{ $mainButtonColor }} {{ $mainBorderColor }} border {{ $mainTextColor }} text-xl font-[Montserrat] focus:outline-none transition">
                            <span>{{ $material->title }}</span>
                            <svg :class="{'rotate-180': openAccordion === '{{ $material->id }}'}" class="w-7 h-7 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        
                        <!-- Expanded Content - All blocks for this material -->
                        <div x-show="openAccordion === '{{ $material->id }}'" x-transition class="mt-4 space-y-4">
                            @foreach($material->blocks->where('semester', 'Semestre 1')->sortBy('order') as $block)
                            <div class="bg-gray-50 rounded-lg p-4">
                                @php
                                    $blockColor = 'bg-white';
                                    $borderColor = 'border-gray-200';
                                    $textColor = 'text-gray-800';
                                    if ($block->material_type == 'Devoirs semestre 1') {
                                        $blockColor = 'bg-red-50';
                                        $borderColor = 'border-red-200';
                                        $textColor = 'text-red-800';
                                    } elseif ($block->material_type == 'Devoirs semestre 2') {
                                        $blockColor = 'bg-red-50';
                                        $borderColor = 'border-red-200';
                                        $textColor = 'text-red-800';
                                    } elseif ($block->material_type == 'Examens') {
                                        $blockColor = 'bg-purple-50';
                                        $borderColor = 'border-purple-200';
                                        $textColor = 'text-purple-800';
                                    }
                                @endphp
                                
                                <!-- Block Type Header -->
                                <div class="flex items-center justify-between mb-3 px-3 py-2 rounded-lg {{ $blockColor }} {{ $borderColor }} border {{ $textColor }}">
                                    <span class="font-semibold">{{ $block->type }}</span>
                                    @if($block->material_type == 'Examens' && $block->exam_type)
                                        <span class="text-sm opacity-75">{{ $block->exam_type }}</span>
                                    @endif
                                </div>
                                
                                <!-- PDFs for this block -->
                                @foreach($block->pdfs as $pdf)
                                <div class="flex items-center gap-4 p-3 bg-white rounded-lg mb-2">
                                    <div>
                                        <img src="{{ asset('images/pdf-icon.png') }}" alt="PDF" class="w-8 h-8" />
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-[#0F2239] font-semibold">{{ $pdf->title ?? 'PDF' }}</div>
                                        <div class="text-xs text-gray-500">PDF • {{ $block->type }}</div>
                                    </div>
                                    <a href="{{ asset('storage/' . $pdf->pdf_path) }}" target="_blank" class="ml-2" onclick="trackPdfDownload({{ $pdf->id }})">
                                        <svg class="w-6 h-6 text-[#0F2239]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" />
                                            <path d="M7 11l5 5 5-5" />
                                            <path d="M12 4v12" />
                                        </svg>
                                    </a>
                                </div>
                                @endforeach

                                <!-- Videos for this block -->
                                @foreach($block->videos as $video)
                                <div class="flex items-center gap-4 p-3 bg-white rounded-lg mb-2 cursor-pointer" onclick="window.open('{{ $video->video_link }}', '_blank')">
                                    <div>
                                        <div class="w-8 h-8 rounded bg-gray-200 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-gray-400">voir la vidéo</div>
                                        <div class="text-[#0F2239] font-semibold">{{ $video->title ?? 'Vidéo' }}</div>
                                    </div>
                                    <a href="{{ $video->video_link }}" target="_blank" class="ml-2">
                                        <svg class="w-6 h-6 text-[#0F2239]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <polygon points="5 3 19 12 5 21 5 3" fill="#0F2239"/>
                                        </svg>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            
            @if($semester2Materials->count() > 0)
            <div class="bg-white rounded-xl p-4 shadow">
                <h3 class="text-xl font-bold text-green-600 mb-4 border-b pb-2">Semestre 2</h3>
                <div class="space-y-3">
                    @foreach($semester2Materials as $material)
                    @php
                        // Determine the color for the main accordion button based on material types
                        $mainButtonColor = 'bg-white';
                        $mainBorderColor = 'border-gray-200';
                        $mainTextColor = 'text-gray-800';
                        
                        $semester2Blocks = $material->blocks->where('semester', 'Semestre 2');
                        $hasDevoirs = $semester2Blocks->whereIn('material_type', ['Devoirs semestre 1', 'Devoirs semestre 2'])->count() > 0;
                        $hasExamens = $semester2Blocks->where('material_type', 'Examens')->count() > 0;
                        
                        if ($hasExamens) {
                            $mainButtonColor = 'bg-purple-50';
                            $mainBorderColor = 'border-purple-200';
                            $mainTextColor = 'text-purple-800';
                        } elseif ($hasDevoirs) {
                            $mainButtonColor = 'bg-red-50';
                            $mainBorderColor = 'border-red-200';
                            $mainTextColor = 'text-red-800';
                        }
                    @endphp
                    <div class="bg-[#F5F7FA] rounded-2xl shadow p-4">
                        <!-- Material Header (Accordion Button) -->
                        <button @click="openAccordion = openAccordion === '{{ $material->id }}' ? null : '{{ $material->id }}'"
                            class="w-full flex items-center justify-between px-4 py-4 rounded-xl {{ $mainButtonColor }} {{ $mainBorderColor }} border {{ $mainTextColor }} text-xl font-[Montserrat] focus:outline-none transition">
                            <span>{{ $material->title }}</span>
                            <svg :class="{'rotate-180': openAccordion === '{{ $material->id }}'}" class="w-7 h-7 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        
                        <!-- Expanded Content - All blocks for this material -->
                        <div x-show="openAccordion === '{{ $material->id }}'" x-transition class="mt-4 space-y-4">
                            @foreach($material->blocks->where('semester', 'Semestre 2')->sortBy('order') as $block)
                            <div class="bg-gray-50 rounded-lg p-4">
                                @php
                                    $blockColor = 'bg-white';
                                    $borderColor = 'border-gray-200';
                                    $textColor = 'text-gray-800';
                                    if ($block->material_type == 'Devoirs semestre 1') {
                                        $blockColor = 'bg-red-50';
                                        $borderColor = 'border-red-200';
                                        $textColor = 'text-red-800';
                                    } elseif ($block->material_type == 'Devoirs semestre 2') {
                                        $blockColor = 'bg-red-50';
                                        $borderColor = 'border-red-200';
                                        $textColor = 'text-red-800';
                                    } elseif ($block->material_type == 'Examens') {
                                        $blockColor = 'bg-purple-50';
                                        $borderColor = 'border-purple-200';
                                        $textColor = 'text-purple-800';
                                    }
                                @endphp
                                
                                <!-- Block Type Header -->
                                <div class="flex items-center justify-between mb-3 px-3 py-2 rounded-lg {{ $blockColor }} {{ $borderColor }} border {{ $textColor }}">
                                    <span class="font-semibold">{{ $block->type }}</span>
                                    @if($block->material_type == 'Examens' && $block->exam_type)
                                        <span class="text-sm opacity-75">{{ $block->exam_type }}</span>
                                    @endif
                                </div>
                                
                                <!-- PDFs for this block -->
                                @foreach($block->pdfs as $pdf)
                                <div class="flex items-center gap-4 p-3 bg-white rounded-lg mb-2">
                                    <div>
                                        <img src="{{ asset('images/pdf-icon.png') }}" alt="PDF" class="w-8 h-8" />
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-[#0F2239] font-semibold">{{ $pdf->title ?? 'PDF' }}</div>
                                        <div class="text-xs text-gray-500">PDF • {{ $block->type }}</div>
                                    </div>
                                    <a href="{{ asset('storage/' . $pdf->pdf_path) }}" target="_blank" class="ml-2" onclick="trackPdfDownload({{ $pdf->id }})">
                                        <svg class="w-6 h-6 text-[#0F2239]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" />
                                            <path d="M7 11l5 5 5-5" />
                                            <path d="M12 4v12" />
                                        </svg>
                                    </a>
                                </div>
                                @endforeach

                                <!-- Videos for this block -->
                                @foreach($block->videos as $video)
                                <div class="flex items-center gap-4 p-3 bg-white rounded-lg mb-2 cursor-pointer" onclick="window.open('{{ $video->video_link }}', '_blank')">
                                    <div>
                                        <div class="w-8 h-8 rounded bg-gray-200 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-gray-400">voir la vidéo</div>
                                        <div class="text-[#0F2239] font-semibold">{{ $video->title ?? 'Vidéo' }}</div>
                                    </div>
                                    <a href="{{ $video->video_link }}" target="_blank" class="ml-2">
                                        <svg class="w-6 h-6 text-[#0F2239]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <polygon points="5 3 19 12 5 21 5 3" fill="#0F2239"/>
                                        </svg>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    @endif
</div>
<!-- Alpine.js CDN (if not already included) -->
<script src="//unpkg.com/alpinejs" defer></script>

<script>
function trackPdfDownload(pdfId) {
    fetch(`/track/pdf-download/${pdfId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
}

function trackVideoClick(videoId) {
    fetch(`/track/video-click/${videoId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
}
</script>
@endsection
