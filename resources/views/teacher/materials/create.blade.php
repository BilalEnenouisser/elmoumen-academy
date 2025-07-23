@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Ajouter un Matériel</h1>

    <form action="{{ route('teacher.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <x-input-label for="name" value="Nom du matériel" />
        <x-text-input name="name" class="w-full" required />

        <x-input-label for="type" value="Type" />
        <select name="type" class="w-full rounded border-gray-300">
            <option value="Cours">Cours</option>
            <option value="Séries">Séries</option>
            <option value="Autres">Autres</option>
        </select>

        <x-input-label for="level_id" value="Niveau" />
        <select name="level_id" class="w-full rounded border-gray-300">
            @foreach($levels as $level)
                <option value="{{ $level->id }}">{{ $level->name }}</option>
            @endforeach
        </select>

        <x-input-label for="year_id" value="Année (optionnel)" />
        <select name="year_id" class="w-full rounded border-gray-300">
            <option value="">---</option>
            @foreach($years as $year)
                <option value="{{ $year->id }}">{{ $year->name }}</option>
            @endforeach
        </select>

        <x-input-label for="field_id" value="Filière (optionnel)" />
        <select name="field_id" class="w-full rounded border-gray-300">
            <option value="">---</option>
            @foreach($fields as $field)
                <option value="{{ $field->id }}">{{ $field->name }}</option>
            @endforeach
        </select>

       

        <x-input-label for="pdf_path" value="Fichier PDF (facultatif)" />
        <input type="file" name="pdf_path" class="w-full border-gray-300 rounded">

        <x-input-label for="video_url" value="Lien vidéo (facultatif)" />
        <x-text-input name="video_url" class="w-full" />

        <x-input-label for="thumbnail" value="Thumbnail (URL facultatif)" />
        <x-text-input name="thumbnail" class="w-full" />

        <x-primary-button class="mt-4">Ajouter</x-primary-button>
    </form>
</div>
@endsection
