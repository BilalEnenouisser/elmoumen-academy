@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-6 text-blue-700">
            Ressources pour {{ $subject->name }} ({{ $field->name }} / {{ $year->name }} / {{ $level->name }})
        </h1>

        @if($materials->isEmpty())
            <div class="text-gray-600">Aucune ressource disponible pour cette matière.</div>
        @else
            <div class="space-y-4">
                @foreach ($materials as $material)
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold">{{ $material->title }}</h2>
                        <p class="text-gray-500">{{ $material->description }}</p>
                        @if($material->url)
                            <a href="{{ $material->url }}" target="_blank"
                               class="inline-block mt-2 text-blue-600 hover:underline">
                                Télécharger / Voir
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
