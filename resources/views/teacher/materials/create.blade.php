@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un nouveau matériel</h2>
    
    <form action="{{ route('teacher.materials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="pdf">PDF</option>
                <option value="video">Vidéo</option>
            </select>
        </div>
        
        <div class="mb-3" id="pdf-field">
            <label for="pdf" class="form-label">Fichier PDF</label>
            <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf">
        </div>
        
        <div class="mb-3" id="video-field" style="display:none;">
            <label for="video_link" class="form-label">Lien Vidéo</label>
            <input type="url" class="form-control" id="video_link" name="video_link" placeholder="https://...">
        </div>
        
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>

<script>
    // Show/hide fields based on type selection
    document.getElementById('type').addEventListener('change', function() {
        const type = this.value;
        document.getElementById('pdf-field').style.display = type === 'pdf' ? 'block' : 'none';
        document.getElementById('video-field').style.display = type === 'video' ? 'block' : 'none';
    });
</script>
@endsection