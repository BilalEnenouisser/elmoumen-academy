@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">➕ Ajouter un Matériel</h1>

@if($errors->any())
    <div class="text-red-500 mb-4">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('teacher.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <input name="name" type="text" placeholder="Nom du cours (ex: Mathématiques)" class="w-full p-2 border rounded" required>

    <select name="type" class="w-full p-2 border rounded" required>
        <option value="">Type</option>
        <option value="Cours">Cours</option>
        <option value="Séries">Séries</option>
        <option value="Autres">Autres</option>
    </select>

    <select name="level_id" id="level_id" class="w-full p-2 border rounded" required>
        <option value="">Niveau</option>
        @foreach($levels as $level)
            <option value="{{ $level->id }}">{{ $level->name }}</option>
        @endforeach
    </select>

    <select name="year_id" class="w-full p-2 border rounded">
        <option value="">Année</option>
        @foreach($years as $year)
            <option value="{{ $year->id }}">{{ $year->name }}</option>
        @endforeach
    </select>

    <div id="field-wrapper" class="hidden">
        <select name="field_id" id="field_id" class="w-full p-2 border rounded">
            <option value="">Filière</option>
            @foreach($fields as $field)
                <option value="{{ $field->id }}">{{ $field->name }}</option>
            @endforeach
        </select>
    </div>

    <input name="pdf_path" type="file" accept=".pdf" class="w-full p-2 border rounded">
    <input name="video_url" type="url" placeholder="Lien vidéo YouTube (optionnel)" class="w-full p-2 border rounded">
    <input name="thumbnail" type="file" accept="image/*" class="w-full p-2 border rounded">

    <button class="bg-green-600 text-white px-4 py-2 rounded">Enregistrer</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const levelSelect = document.getElementById('level_id');
        const fieldWrapper = document.getElementById('field-wrapper');

        function toggleField() {
            const selectedText = levelSelect.options[levelSelect.selectedIndex]?.text.toLowerCase();
            if (selectedText && selectedText.includes('lycée')) {
                fieldWrapper.classList.remove('hidden');
            } else {
                fieldWrapper.classList.add('hidden');
                document.getElementById('field_id').value = '';
            }
        }

        levelSelect.addEventListener('change', toggleField);
        toggleField();
    });
</script>
@endsection
