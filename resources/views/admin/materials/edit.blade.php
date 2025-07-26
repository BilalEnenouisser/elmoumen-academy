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

    <input name="type" type="text" value="{{ old('type', $material->blocks->first()?->type) }}" placeholder="Type (ex: Cours, Séries, Autres)" class="w-full p-2 border rounded" required>

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

    <!-- Current PDFs -->
    @if($material->pdfs->count() > 0)
    <div class="border p-4 rounded">
        <h3 class="font-semibold mb-3">📄 PDFs actuels</h3>
        @foreach($material->pdfs as $pdf)
        <div class="flex items-center gap-2 mb-2">
            <span class="text-sm">{{ $pdf->title ?? 'PDF' }}</span>
            <a href="{{ asset('storage/' . $pdf->pdf_path) }}" target="_blank" class="text-blue-500 text-sm">Voir</a>
            <button type="button" onclick="deletePdf({{ $pdf->id }})" class="text-red-500 text-sm">Supprimer</button>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Add New PDFs -->
    <div class="border p-4 rounded">
        <h3 class="font-semibold mb-3">📄 Ajouter de nouveaux PDFs</h3>
        <div id="pdfs-wrapper" class="space-y-3">
            <div class="pdf-group flex gap-2">
                <input type="file" name="pdfs[]" accept=".pdf" class="flex-1 p-2 border rounded">
                <input type="text" name="pdf_titles[]" placeholder="Titre du PDF" class="flex-1 p-2 border rounded">
            </div>
        </div>
        <button type="button" onclick="addPdf()" class="mt-2 bg-blue-500 text-white px-3 py-1 rounded text-sm">+ Ajouter un autre PDF</button>
    </div>

    <!-- Current Videos -->
    @if($material->videos->count() > 0)
    <div class="border p-4 rounded">
        <h3 class="font-semibold mb-3">🎥 Vidéos actuelles</h3>
        @foreach($material->videos as $video)
        <div class="flex items-center gap-2 mb-2">
            <span class="text-sm">{{ $video->title ?? 'Vidéo' }}</span>
            <a href="{{ $video->video_link }}" target="_blank" class="text-blue-500 text-sm">Voir</a>
            <button type="button" onclick="deleteVideo({{ $video->id }})" class="text-red-500 text-sm">Supprimer</button>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Add New Videos -->
    <div class="border p-4 rounded">
        <h3 class="font-semibold mb-3">🎥 Ajouter de nouvelles vidéos</h3>
        <div id="videos-wrapper" class="space-y-3">
            <div class="video-group flex gap-2">
                <input type="url" name="video_links[]" placeholder="Lien vidéo YouTube" class="flex-1 p-2 border rounded">
                <input type="text" name="video_titles[]" placeholder="Titre de la vidéo" class="flex-1 p-2 border rounded">
                <button type="button" onclick="removeVideo(this)" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
            </div>
        </div>
        <button type="button" onclick="addVideo()" class="mt-2 bg-green-500 text-white px-3 py-1 rounded text-sm">+ Ajouter une vidéo</button>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">💾 Enregistrer les modifications</button>
</form>

<script>
    function addPdf() {
        const wrapper = document.getElementById('pdfs-wrapper');
        const group = document.createElement('div');
        group.className = 'pdf-group flex gap-2';
        group.innerHTML = `
            <input type="file" name="pdfs[]" accept=".pdf" class="flex-1 p-2 border rounded">
            <input type="text" name="pdf_titles[]" placeholder="Titre du PDF" class="flex-1 p-2 border rounded">
            <button type="button" onclick="removePdf(this)" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
        `;
        wrapper.appendChild(group);
    }

    function removePdf(button) {
        button.parentElement.remove();
    }

    function addVideo() {
        const wrapper = document.getElementById('videos-wrapper');
        const group = document.createElement('div');
        group.className = 'video-group flex gap-2';
        group.innerHTML = `
            <input type="url" name="video_links[]" placeholder="Lien vidéo YouTube" class="flex-1 p-2 border rounded">
            <input type="text" name="video_titles[]" placeholder="Titre de la vidéo" class="flex-1 p-2 border rounded">
            <button type="button" onclick="removeVideo(this)" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
        `;
        wrapper.appendChild(group);
    }

    function removeVideo(button) {
        button.parentElement.remove();
    }

    function deletePdf(pdfId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce PDF ?')) {
            // You'll need to implement this endpoint
            fetch(`/admin/materials/pdf/${pdfId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(() => location.reload());
        }
    }

    function deleteVideo(videoId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette vidéo ?')) {
            // You'll need to implement this endpoint
            fetch(`/admin/materials/video/${videoId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(() => location.reload());
        }
    }
</script>
@endsection
