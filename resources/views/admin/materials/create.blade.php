@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Ajouter un matériel</h1>

<form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @csrf

    <!-- Level -->
    <div>
        <label>Niveau</label>
        <select name="level_id" id="level-select" class="w-full border rounded p-2" required>
            <option value="">-- Choisir niveau --</option>
            @foreach ($levels as $level)
                <option value="{{ $level->id }}">{{ $level->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Year -->
    <div>
        <label>Année</label>
        <select name="year_id" id="year-select" class="w-full border rounded p-2">
            <option value="">-- Choisir année --</option>
        </select>
    </div>

    <!-- Field -->
    <div>
        <label>Filière (si Lycée)</label>
        <select name="field_id" id="field-select" class="w-full border rounded p-2">
            <option value="">-- Choisir filière --</option>
        </select>
    </div>

    <!-- Subject -->
    <div>
        <label>Matière</label>
        <select name="subject_id" class="w-full border rounded p-2" required>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Type -->
    <div>
        <label>Type</label>
        <select name="type" class="w-full border rounded p-2" required>
            <option value="Cours">Cours</option>
            <option value="Séries">Séries</option>
        </select>
    </div>

    <!-- Title -->
    <div>
        <label>Titre</label>
        <input type="text" name="title" class="w-full border rounded p-2" required>
    </div>

    <!-- PDF -->
    <div>
        <label>Fichier PDF</label>
        <input type="file" name="pdf_path" accept="application/pdf" class="w-full border rounded p-2">
    </div>

    <!-- Video -->
    <div>
        <label>Lien Vidéo (YouTube)</label>
        <input type="url" name="video_link" class="w-full border rounded p-2">
    </div>

    <!-- Thumbnail -->
    <div>
        <label>Miniature Vidéo</label>
        <input type="file" name="thumbnail_path" accept="image/*" class="w-full border rounded p-2">
    </div>

    <div class="col-span-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter</button>
    </div>
</form>
@endsection
