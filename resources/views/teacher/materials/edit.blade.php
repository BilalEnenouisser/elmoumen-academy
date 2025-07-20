@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Modifier le Matériel</h1>

    <form action="{{ route('teacher.materials.update', $material) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <x-input-label for="name" value="Nom du matériel" />
        <x-text-input name="name" class="w-full" value="{{ old('name', $material->name) }}" required />

        <x-input-label for="type" value="Type" />
        <select name="type" class="w-full rounded border-gray-300">
            <option value="Cours" {{ $material->type == 'Cours' ? 'selected' : '' }}>Cours</option>
            <option value="Séries" {{ $material->type == 'Séries' ? 'selected' : '' }}>Séries</option>
            <option value="Autres" {{ $material->type == 'Autres' ? 'selected' : '' }}>Autres</option>
        </select>

        <x-input-label for="level_id" value="Niveau" />
        <select name="level_id" class="w-full rounded border-gray-300">
            @foreach($levels as $level)
                <option value="{{ $level->id }}" {{ $material->level_id == $level->id ? 'selected' : '' }}>
                    {{ $level->name }}
                </option>
            @endforeach
        </select>

        <x-input-label for="year_id" value="Année (optionnel)" />
        <select name="year_id" class="w-full rounded border-gray-300">
            <option value="">---</option>
            @foreach($years as $year)
                <option value="{{ $year->id }}" {{ $material->year_id == $year->id ? 'selected' : '' }}>
                    {{ $year->name }}
                </option>
            @endforeach
        </select>

        <x-input-label for="field_id" value="Filière (optionnel)" />
        <select name="field_id" class="w-full rounded border-gray-300">
            <option value="">---</option>
            @foreach($fields as $field)
                <option value="{{ $field->id }}" {{ $material->field_id == $field->id ? 'selected' : '' }}>
                    {{ $field->name }}
                </option>
            @endforeach
        </select>

        <x-input-label for="subject_id" value="Matière (optionnel)" />
        <select name="subject_id" class="w-full rounded border-gray-300">
            <option value="">---</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ $material->subject_id == $subject->id ? 'selected' : '' }}>
                    {{ $subject->name }}
                </option>
            @endforeach
        </select>

        <x-input-label for="pdf_path" value="Nouveau PDF (facultatif)" />
        <input type="file" name="pdf_path" class="w-full border-gray-300 rounded">

        @if($material->pdf_path)
            <p class="text-sm text-gray-500 mt-1">
                Fichier actuel: <a href="{{ asset('storage/' . $material->pdf_path) }}" target="_blank" class="text-blue-500 underline">Voir PDF</a>
            </p>
        @endif

        <x-input-label for="video_url" value="Lien vidéo (facultatif)" />
        <x-text-input name="video_url" class="w-full" value="{{ old('video_url', $material->video_url) }}" />

        <x-input-label for="thumbnail" value="Thumbnail (URL facultatif)" />
        <x-text-input name="thumbnail" class="w-full" value="{{ old('thumbnail', $material->thumbnail) }}" />

        <x-primary-button class="mt-4">Mettre à jour</x-primary-button>
    </form>
</div>
@endsection
