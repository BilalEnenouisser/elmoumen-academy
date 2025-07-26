@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6 text-blue-700">
        Matériaux - {{ $year->name }} / {{ $level->name }}
    </h1>

    @if($materials->isEmpty())
        <div class="text-gray-600">Aucune ressource disponible pour cette année.</div>
    @else
        <div class="space-y-6">
            @foreach ($materials as $index => $material)
            <div x-data="{ open: false }" class="bg-[#F5F7FA] rounded-2xl shadow p-4">
                <!-- Matière Name (Accordion Button) -->
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-4 rounded-xl bg-white text-[#0F2239] text-2xl font-[Montserrat] focus:outline-none transition">
                    <span>{{ $material->title }}</span>
                    <svg :class="{'rotate-180': open}" class="w-7 h-7 transition-transform" fill="none" stroke="#0F2239" stroke-width="3" viewBox="0 0 24 24">
                        <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <!-- Expanded Content -->
                <div x-show="open" x-transition class="mt-4 space-y-6">
                    @foreach($material->blocks as $block)
                    <div class="bg-white rounded-xl p-4 shadow">
                        <h3 class="text-lg font-semibold text-[#0F2239] mb-4 border-b pb-2">{{ $block->type }}</h3>
                        
                        <!-- PDFs for this block -->
                        @foreach($block->pdfs as $pdf)
                        <div class="flex items-center gap-4 mb-3 p-3 bg-gray-50 rounded-lg">
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
                        <div class="flex items-center gap-4 mb-3 p-3 bg-gray-50 rounded-lg cursor-pointer" onclick="window.open('{{ $video->video_link }}', '_blank')">
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
            </div>
            @endforeach
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
