@extends('layouts.front')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">📘 {{ $subject->name }}</h1>

    @forelse ($materials as $type => $items)
        <h2 class="text-xl font-semibold mt-8 mb-3">{{ ucfirst($type) }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($items as $material)
                <div class="p-5 border rounded shadow hover:bg-gray-50 transition">
                    <h3 class="text-lg font-bold mb-2">{{ $material->title }}</h3>
                    @if ($material->pdf_path)
                        <a href="{{ asset('storage/' . $material->pdf_path) }}" class="text-blue-600 hover:underline" download>
                            📄 Télécharger PDF
                        </a><br>
                    @endif
                    @if ($material->video_link)
                        <a href="{{ $material->video_link }}" target="_blank" class="block mt-3">
                            @if ($material->thumbnail_path)
                                <img src="{{ asset('storage/' . $material->thumbnail_path) }}" 
                                     alt="Thumbnail" class="w-full rounded mb-2">
                            @endif
                            🎬 Voir la vidéo
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @empty
        <p class="text-gray-500 mt-6">Aucun contenu disponible pour cette matière.</p>
    @endforelse
</div>
@endsection
