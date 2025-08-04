@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Matériaux d'Étude
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                {{ $year->name }} - {{ $level->name }}
            </p>
            <div class="w-24 h-1 bg-blue-400 mx-auto rounded-full"></div>
        </div>
    </div>
</section>

<!-- Materials Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        @if($materials->isEmpty())
            <div class="text-center">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Aucune ressource disponible</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Aucune ressource n'est actuellement disponible pour cette année. Veuillez revenir plus tard.
                </p>
            </div>
        @else
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Ressources Pédagogiques
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
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
                    $concourMaterials = $materials->filter(function($material) {
                        return $material->blocks->where('semester', 'Concour')->count() > 0;
                    });
                @endphp
                
                @if($semester1Materials->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                        <h3 class="text-2xl font-bold text-white mb-2">Semestre 1</h3>
                        <p class="text-blue-100">Première partie de l'année scolaire</p>
                    </div>
                    <div class="p-8">
                        <div class="space-y-6">
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
                            <div class="bg-gray-50 rounded-xl shadow-sm overflow-hidden">
                                <!-- Material Header (Accordion Button) -->
                                <button @click="openAccordion = openAccordion === '{{ $material->id }}' ? null : '{{ $material->id }}'"
                                    class="w-full flex items-center justify-between px-6 py-4 rounded-xl {{ $mainButtonColor }} {{ $mainBorderColor }} border {{ $mainTextColor }} text-xl font-semibold focus:outline-none transition-all duration-300 hover:shadow-md">
                                    <span>{{ $material->title }}</span>
                                    <svg :class="{'rotate-180': openAccordion === '{{ $material->id }}'}" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                
                                <!-- Expanded Content - All blocks for this material -->
                                <div x-show="openAccordion === '{{ $material->id }}'" x-transition class="p-6 space-y-4">
                                    @foreach($material->blocks->where('semester', 'Semestre 1')->sortBy('order') as $block)
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
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
                                        <div class="flex items-center justify-between mb-4 px-4 py-3 rounded-lg {{ $blockColor }} {{ $borderColor }} border {{ $textColor }}">
                                            <span class="font-semibold">{{ $block->type }}</span>
                                            @if($block->material_type == 'Examens' && $block->exam_type)
                                                <span class="text-sm opacity-75">{{ $block->exam_type }}</span>
                                            @endif
                                        </div>
                                        
                                        <!-- PDFs for this block -->
                                        @foreach($block->pdfs as $pdf)
                                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg mb-3 hover:bg-gray-100 transition-colors">
                                            <div>
                                                <img src="{{ asset('images/pdf-icon.png') }}" alt="PDF" class="w-10 h-10" />
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-gray-900 font-semibold">{{ $pdf->title ?? 'PDF' }}</div>
                                                <div class="text-sm text-gray-500">PDF • {{ $block->type }}</div>
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
                                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg mb-3 hover:bg-gray-100 transition-colors cursor-pointer" onclick="window.open('{{ $video->video_link }}', '_blank')">
                                            <div>
                                                <div class="w-10 h-10 rounded bg-red-500 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm text-gray-500">voir la vidéo</div>
                                                <div class="text-gray-900 font-semibold">{{ $video->title ?? 'Vidéo' }}</div>
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
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                        <h3 class="text-2xl font-bold text-white mb-2">Semestre 2</h3>
                        <p class="text-green-100">Deuxième partie de l'année scolaire</p>
                    </div>
                    <div class="p-8">
                        <div class="space-y-6">
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
                            <div class="bg-gray-50 rounded-xl shadow-sm overflow-hidden">
                                <!-- Material Header (Accordion Button) -->
                                <button @click="openAccordion = openAccordion === '{{ $material->id }}' ? null : '{{ $material->id }}'"
                                    class="w-full flex items-center justify-between px-6 py-4 rounded-xl {{ $mainButtonColor }} {{ $mainBorderColor }} border {{ $mainTextColor }} text-xl font-semibold focus:outline-none transition-all duration-300 hover:shadow-md">
                                    <span>{{ $material->title }}</span>
                                    <svg :class="{'rotate-180': openAccordion === '{{ $material->id }}'}" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                
                                <!-- Expanded Content - All blocks for this material -->
                                <div x-show="openAccordion === '{{ $material->id }}'" x-transition class="p-6 space-y-4">
                                    @foreach($material->blocks->where('semester', 'Semestre 2')->sortBy('order') as $block)
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
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
                                        <div class="flex items-center justify-between mb-4 px-4 py-3 rounded-lg {{ $blockColor }} {{ $borderColor }} border {{ $textColor }}">
                                            <span class="font-semibold">{{ $block->type }}</span>
                                            @if($block->material_type == 'Examens' && $block->exam_type)
                                                <span class="text-sm opacity-75">{{ $block->exam_type }}</span>
                                            @endif
                                        </div>
                                        
                                        <!-- PDFs for this block -->
                                        @foreach($block->pdfs as $pdf)
                                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg mb-3 hover:bg-gray-100 transition-colors">
                                            <div>
                                                <img src="{{ asset('images/pdf-icon.png') }}" alt="PDF" class="w-10 h-10" />
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-gray-900 font-semibold">{{ $pdf->title ?? 'PDF' }}</div>
                                                <div class="text-sm text-gray-500">PDF • {{ $block->type }}</div>
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
                                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg mb-3 hover:bg-gray-100 transition-colors cursor-pointer" onclick="window.open('{{ $video->video_link }}', '_blank')">
                                            <div>
                                                <div class="w-10 h-10 rounded bg-red-500 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm text-gray-500">voir la vidéo</div>
                                                <div class="text-gray-900 font-semibold">{{ $video->title ?? 'Vidéo' }}</div>
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
                
                @if($concourMaterials->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-8 py-6">
                        <h3 class="text-2xl font-bold text-white mb-2">Concours</h3>
                        <p class="text-purple-100">Préparation aux concours d'entrée</p>
                    </div>
                    <div class="p-8">
                        <div class="space-y-6">
                            @foreach($concourMaterials as $material)
                            @php
                                // Determine the color for the main accordion button based on material types
                                $mainButtonColor = 'bg-white';
                                $mainBorderColor = 'border-gray-200';
                                $mainTextColor = 'text-gray-800';
                                
                                $concourBlocks = $material->blocks->where('semester', 'Concour');
                                $hasConcour = $concourBlocks->where('material_type', 'Concour')->count() > 0;
                                
                                if ($hasConcour) {
                                    $mainButtonColor = 'bg-purple-50';
                                    $mainBorderColor = 'border-purple-200';
                                    $mainTextColor = 'text-purple-800';
                                }
                            @endphp
                            <div class="bg-gray-50 rounded-xl shadow-sm overflow-hidden">
                                <!-- Material Header (Accordion Button) -->
                                <button @click="openAccordion = openAccordion === '{{ $material->id }}' ? null : '{{ $material->id }}'"
                                    class="w-full flex items-center justify-between px-6 py-4 rounded-xl {{ $mainButtonColor }} {{ $mainBorderColor }} border {{ $mainTextColor }} text-xl font-semibold focus:outline-none transition-all duration-300 hover:shadow-md">
                                    <span>{{ $material->title }}</span>
                                    <svg :class="{'rotate-180': openAccordion === '{{ $material->id }}'}" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                
                                <!-- Expanded Content - All blocks for this material -->
                                <div x-show="openAccordion === '{{ $material->id }}'" x-transition class="p-6 space-y-4">
                                    @foreach($material->blocks->where('semester', 'Concour')->sortBy('order') as $block)
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        @php
                                            $blockColor = 'bg-white';
                                            $borderColor = 'border-gray-200';
                                            $textColor = 'text-gray-800';
                                            if ($block->material_type == 'Concour') {
                                                $blockColor = 'bg-purple-50';
                                                $borderColor = 'border-purple-200';
                                                $textColor = 'text-purple-800';
                                            }
                                        @endphp
                                        
                                        <!-- Block Type Header -->
                                        <div class="flex items-center justify-between mb-4 px-4 py-3 rounded-lg {{ $blockColor }} {{ $borderColor }} border {{ $textColor }}">
                                            <span class="font-semibold">
                                                @if($block->concour_type)
                                                    {{ $block->concour_type }}
                                                @elseif($block->name)
                                                    {{ $block->name }}
                                                @else
                                                    {{ $block->material_type }}
                                                @endif
                                            </span>
                                            @if($block->material_type == 'Concour' && $block->concour_type)
                                                <span class="text-sm opacity-75">{{ $block->concour_type }}</span>
                                            @endif
                                        </div>
                                        
                                        <!-- PDFs for this block -->
                                        @foreach($block->pdfs as $pdf)
                                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg mb-3 hover:bg-gray-100 transition-colors">
                                            <div>
                                                <img src="{{ asset('images/pdf-icon.png') }}" alt="PDF" class="w-10 h-10" />
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-gray-900 font-semibold">{{ $pdf->title ?? 'PDF' }}</div>
                                                <div class="text-sm text-gray-500">PDF • {{ $block->material_type }}</div>
                                            </div>
                                            <a href="{{ asset('storage/' . $pdf->pdf_path) }}" target="_blank" class="ml-2 p-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors" onclick="trackPdfDownload({{ $pdf->id }})">
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
                                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg mb-3 hover:bg-gray-100 transition-colors cursor-pointer" onclick="window.open('{{ $video->video_link }}', '_blank')">
                                            <div>
                                                <div class="w-10 h-10 rounded bg-red-500 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm text-gray-500">voir la vidéo</div>
                                                <div class="text-gray-900 font-semibold">{{ $video->title ?? 'Vidéo' }}</div>
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
