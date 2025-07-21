@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-6 text-blue-700">
            Matériaux - {{ $year->name }} / {{ $level->name }}
        </h1>

        @if($materials->isEmpty())
            <div class="text-gray-600">Aucune ressource disponible pour cette année.</div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($materials as $material)
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold">{{ $material->title }}</h2>
                        <p class="text-sm text-gray-500 mb-2">Type: {{ $material->type }}</p>

                        @if ($material->pdf_path)
                            <a href="{{ asset('storage/' . $material->pdf_path) }}" target="_blank"
                               class="block text-blue-600 hover:underline">📄 Voir le PDF</a>
                        @endif

                        @if ($material->video_link)
                            <a href="{{ $material->video_link }}" target="_blank"
                               class="block text-blue-600 hover:underline">▶️ Voir la Vidéo</a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
