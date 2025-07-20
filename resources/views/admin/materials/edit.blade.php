@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-bold mb-4">✏️ Modifier le Matériel</h1>

@if($errors->any())
    <div class="text-red-500 mb-4">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <input name="title" type="text" value="{{ old('title', $material->title) }}" placeholder="Nom du cours" class="w-full p-2 border rounded" required>

    <select name="type" class="w-full p-2 border rounded" required>
        <option value="">Type</option>
        <option value="Cours" {{ $material->type == 'Cours' ? 'selected' : '' }}>Cours</option>
        <option value="Séries" {{ $material->type == 'Séries' ? 'selected' : '' }}>Séries</option>
        <option value="Autres" {{ $material->type == 'Autres' ? 'selected' : '' }}>Autres</option>
    </select>

    <select name="level_id" class="w-full p-2 border rounded" required>
        <option value="">Niveau</option>
        @foreach($levels as $level)
            <option value="{{ $level->id }}" {{ $material->level_id == $level->id ? 'selected' : '' }}>
                {{ $level->name }}
            </option>
        @endforeach
    </select>

    <select name="year_id" class="w-full p-2 border rounded">
        <option value="">Année</option>
        @foreach($years as $year)
            <option value="{{ $year->id }}" {{ $material->year_id == $year->id ? 'selected' : '' }}>
                {{ $year->name }}
            </option>
        @endforeach
    </select>

    <select name="field_id" class="w-full p-2 border rounded">
        <option value="">Filière</option>
        @foreach($fields as $field)
            <option value="{{ $field->id }}" {{ $material->field_id == $field->id ? 'selected' : '' }}>
                {{ $field->name }}
            </option>
        @endforeach
    </select>

    <select name="subject_id" class="w-full p-2 border rounded" required>
        <option value="">Matière</option>
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" {{ $material->subject_id == $subject->id ? 'selected' : '' }}>
                {{ $subject->name }}
            </option>
        @endforeach
    </select>

    <label class="block">Changer le fichier PDF (optionnel)</label>
    <input name="pdf_path" type="file" accept=".pdf" class="w-full p-2 border rounded">

    <label class="block">Lien vidéo YouTube</label>
    <input name="video_link" type="url" value="{{ old('video_link', $material->video_link) }}" class="w-full p-2 border rounded">

    <label class="block">Image miniature (fichier image)</label>
    <input name="thumbnail_path" type="file" accept="image/*" class="w-full p-2 border rounded">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">💾 Enregistrer les modifications</button>
</form>
@endsection
