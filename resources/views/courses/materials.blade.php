@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-cover bg-center bg-fixed text-white py-20" style="background-image: url('{{ asset('images/bgsec.jpg') }}');">
    <div class="absolute inset-0" style="background-color: rgba(31, 41, 55, 0.85);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Matériaux d'Étude
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                {{ $year->name }} - {{ $level->name }}
            </p>
        </div>
    </div>
</section>

<!-- Materials Section -->
<section class="relative bg-cover bg-center bg-fixed py-20" style="background-image: url('{{ asset('images/bgsec.jpg') }}');">
    <div class="absolute inset-0" style="background-color: rgba(0,7,25,0.72);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        @if($materials->isEmpty())
            <div class="text-center">
                <div class="w-24 h-24 bg-white bg-opacity-20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-4">Aucune ressource disponible</h2>
                <p class="text-lg text-blue-100 max-w-2xl mx-auto">
                    Aucune ressource n'est actuellement disponible pour cette année. Veuillez revenir plus tard.
                </p>
            </div>
        @else
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Ressources Pédagogiques
                </h2>
                <p class="text-lg text-blue-100 max-w-2xl mx-auto">
                    Découvrez tous les cours, exercices et évaluations disponibles pour cette année
                </p>
            </div>

            <div class="space-y-8" x-data="{ openAccordion: null }">
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
                <div class="bg-white bg-opacity-15 backdrop-blur-lg border border-white border-opacity-30 rounded-2xl overflow-hidden shadow-xl">
                    <div class="bg-[#111827] backdrop-blur-sm px-8 py-6">
                        <h3 class="text-2xl font-bold text-white mb-2">Semestre 1</h3>
                        <p class="text-gray-300">Première partie de l'année scolaire</p>
                    </div>
                    <div class="p-8">
                        <div class="space-y-6">
                            @foreach($semester1Materials as $material)
                            @php
                                // Determine the color for the main accordion button based on material types
                                $semester1Blocks = $material->blocks->where('semester', 'Semestre 1');
                                $hasDevoirs = $semester1Blocks->where('material_type', 'Devoirs')->count() > 0;
                                $hasExamens = $semester1Blocks->where('material_type', 'Examens')->count() > 0;
                                $hasCours = $semester1Blocks->where('material_type', 'Cours')->count() > 0;
                                $hasSeries = $semester1Blocks->where('material_type', 'Series')->count() > 0;
                                
                                // Set button colors based on material types
                                if ($hasExamens) {
                                    $buttonBg = 'bg-yellow-500/20';
                                    $buttonBorder = 'border-yellow-400/30';
                                    $buttonHover = 'hover:bg-yellow-500/30';
                                    $buttonText = 'text-yellow-100';
                                } elseif ($hasDevoirs) {
                                    $buttonBg = 'bg-red-500/20';
                                    $buttonBorder = 'border-red-400/30';
                                    $buttonHover = 'hover:bg-red-500/30';
                                    $buttonText = 'text-red-100';
                                } else {
                                    // Normal color for Cours/Series
                                    $buttonBg = 'bg-white/10';
                                    $buttonBorder = 'border-white/20';
                                    $buttonHover = 'hover:bg-white/20';
                                    $buttonText = 'text-white';
                                }
                            @endphp
                            <div class="bg-white bg-opacity-10 backdrop-blur-md border border-white border-opacity-20 rounded-xl overflow-hidden">
                                <!-- Material Header (Accordion Button) -->
                                <button @click="openAccordion = openAccordion === '{{ $material->id }}' ? null : '{{ $material->id }}'"
                                    class="w-full flex items-center justify-between px-6 py-4 rounded-xl {{ $buttonText }} text-xl font-semibold focus:outline-none transition-all duration-300 {{ $buttonBg }} {{ $buttonBorder }} border {{ $buttonHover }} backdrop-blur-sm">
                                    <span>{{ $material->title }}</span>
                                    <svg :class="{'rotate-180': openAccordion === '{{ $material->id }}'}" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                
                                <!-- Expanded Content - All blocks for this material -->
                                <div x-show="openAccordion === '{{ $material->id }}'" x-transition class="p-6 space-y-4">
                                    @foreach($material->blocks->where('semester', 'Semestre 1')->sortBy('order') as $block)
                                    <div class="bg-white bg-opacity-5 backdrop-blur-sm rounded-lg p-4">
                                        <!-- Block Type Header -->
                                        <div class="flex items-center justify-between mb-4 px-4 py-3 rounded-lg bg-white bg-opacity-10 backdrop-blur-sm">
                                            <span class="font-semibold text-white">
                                                @if($block->name)
                                                    {{ $block->name }}
                                                @else
                                                    {{ $block->material_type }}
                                                @endif
                                            </span>
                                            @if($block->material_type == 'Examens' && $block->exam_type)
                                                <span class="text-sm opacity-75 text-blue-100">{{ $block->exam_type }}</span>
                                            @endif
                                        </div>
                                        
                                        <!-- PDFs for this block -->
                                        @foreach($block->pdfs as $pdf)
                                        <div class="flex items-center gap-4 p-4 bg-white bg-opacity-5 backdrop-blur-sm rounded-lg mb-3">
                                            <div>
                                                <img src="{{ asset('images/pdf-icon.png') }}" alt="PDF" class="w-10 h-10" />
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-white font-semibold">{{ $pdf->title ?? 'PDF' }}</div>
                                                <div class="text-sm text-blue-100">PDF • {{ $block->material_type }}</div>
                                            </div>
                                            <a href="{{ asset('storage/' . $pdf->pdf_path) }}" target="_blank" class="ml-2 p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" onclick="trackPdfDownload({{ $pdf->id }})">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" />
                                                    <path d="M7 11l5 5 5-5" />
                                                    <path d="M12 4v12" />
                                                </svg>
                                            </a>
                                        </div>
                                        @endforeach

                                        <!-- Videos for this block -->
                                        @foreach($block->videos as $video)
                                        <div class="flex items-center gap-4 p-4 bg-white bg-opacity-5 backdrop-blur-sm rounded-lg mb-3 cursor-pointer" onclick="window.open('{{ $video->video_link }}', '_blank')">
                                            <div>
                                                <div class="w-10 h-10 rounded bg-red-500 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm text-blue-100">voir la vidéo</div>
                                                <div class="text-white font-semibold">{{ $video->title ?? 'Vidéo' }}</div>
                                            </div>
                                            <a href="{{ $video->video_link }}" target="_blank" class="ml-2 p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
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
                </div>
                @endif
                
                @if($semester2Materials->count() > 0)
                <div class="bg-white bg-opacity-15 backdrop-blur-lg border border-white border-opacity-30 rounded-2xl overflow-hidden shadow-xl">
                    <div class="bg-[#111827] backdrop-blur-sm px-8 py-6">
                        <h3 class="text-2xl font-bold text-white mb-2">Semestre 2</h3>
                        <p class="text-gray-300">Deuxième partie de l'année scolaire</p>
                    </div>
                    <div class="p-8">
                        <div class="space-y-6">
                            @foreach($semester2Materials as $material)
                            @php
                                // Determine the color for the main accordion button based on material types
                                $semester2Blocks = $material->blocks->where('semester', 'Semestre 2');
                                $hasDevoirs = $semester2Blocks->where('material_type', 'Devoirs')->count() > 0;
                                $hasExamens = $semester2Blocks->where('material_type', 'Examens')->count() > 0;
                                $hasCours = $semester2Blocks->where('material_type', 'Cours')->count() > 0;
                                $hasSeries = $semester2Blocks->where('material_type', 'Series')->count() > 0;
                                
                                // Set button colors based on material types
                                if ($hasExamens) {
                                    $buttonBg = 'bg-yellow-500/20';
                                    $buttonBorder = 'border-yellow-400/30';
                                    $buttonHover = 'hover:bg-yellow-500/30';
                                    $buttonText = 'text-yellow-100';
                                } elseif ($hasDevoirs) {
                                    $buttonBg = 'bg-red-500/20';
                                    $buttonBorder = 'border-red-400/30';
                                    $buttonHover = 'hover:bg-red-500/30';
                                    $buttonText = 'text-red-100';
                                } else {
                                    // Normal color for Cours/Series
                                    $buttonBg = 'bg-white/10';
                                    $buttonBorder = 'border-white/20';
                                    $buttonHover = 'hover:bg-white/20';
                                    $buttonText = 'text-white';
                                }
                            @endphp
                            <div class="bg-white bg-opacity-10 backdrop-blur-md border border-white border-opacity-20 rounded-xl overflow-hidden">
                                <!-- Material Header (Accordion Button) -->
                                <button @click="openAccordion = openAccordion === '{{ $material->id }}' ? null : '{{ $material->id }}'"
                                    class="w-full flex items-center justify-between px-6 py-4 rounded-xl {{ $buttonText }} text-xl font-semibold focus:outline-none transition-all duration-300 {{ $buttonBg }} {{ $buttonBorder }} border {{ $buttonHover }} backdrop-blur-sm">
                                    <span>{{ $material->title }}</span>
                                    <svg :class="{'rotate-180': openAccordion === '{{ $material->id }}'}" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                
                                <!-- Expanded Content - All blocks for this material -->
                                <div x-show="openAccordion === '{{ $material->id }}'" x-transition class="p-6 space-y-4">
                                    @foreach($material->blocks->where('semester', 'Semestre 2')->sortBy('order') as $block)
                                    <div class="bg-white bg-opacity-5 backdrop-blur-sm rounded-lg p-4">
                                        <!-- Block Type Header -->
                                        <div class="flex items-center justify-between mb-4 px-4 py-3 rounded-lg bg-white bg-opacity-10 backdrop-blur-sm">
                                            <span class="font-semibold text-white">
                                                @if($block->name)
                                                    {{ $block->name }}
                                                @else
                                                    {{ $block->material_type }}
                                                @endif
                                            </span>
                                            @if($block->material_type == 'Examens' && $block->exam_type)
                                                <span class="text-sm opacity-75 text-blue-100">{{ $block->exam_type }}</span>
                                            @endif
                                        </div>
                                        
                                        <!-- PDFs for this block -->
                                        @foreach($block->pdfs as $pdf)
                                        <div class="flex items-center gap-4 p-4 bg-white bg-opacity-5 backdrop-blur-sm rounded-lg mb-3">
                                            <div>
                                                <img src="{{ asset('images/pdf-icon.png') }}" alt="PDF" class="w-10 h-10" />
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-white font-semibold">{{ $pdf->title ?? 'PDF' }}</div>
                                                <div class="text-sm text-blue-100">PDF • {{ $block->material_type }}</div>
                                            </div>
                                            <a href="{{ asset('storage/' . $pdf->pdf_path) }}" target="_blank" class="ml-2 p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors" onclick="trackPdfDownload({{ $pdf->id }})">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" />
                                                    <path d="M7 11l5 5 5-5" />
                                                    <path d="M12 4v12" />
                                                </svg>
                                            </a>
                                        </div>
                                        @endforeach

                                        <!-- Videos for this block -->
                                        @foreach($block->videos as $video)
                                        <div class="flex items-center gap-4 p-4 bg-white bg-opacity-5 backdrop-blur-sm rounded-lg mb-3 cursor-pointer" onclick="window.open('{{ $video->video_link }}', '_blank')">
                                            <div>
                                                <div class="w-10 h-10 rounded bg-red-500 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm text-blue-100">voir la vidéo</div>
                                                <div class="text-white font-semibold">{{ $video->title ?? 'Vidéo' }}</div>
                                            </div>
                                            <a href="{{ $video->video_link }}" target="_blank" class="ml-2 p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
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
                </div>
                @endif
            </div>
        @endif
    </div>
</section>

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
