@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">➕ Ajouter une Vidéo</h1>

@if($errors->any())
    <div class="text-red-500 mb-4">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.category-videos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-2xl">
    @csrf

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Titre de la vidéo</label>
        <input name="title" type="text" value="{{ old('title') }}" placeholder="Titre de la vidéo" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
        <textarea name="description" rows="3" placeholder="Description de la vidéo" class="w-full p-2 border rounded">{{ old('description') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
        <select name="video_category_id" class="w-full p-2 border rounded" required>
            <option value="">Sélectionner une catégorie</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('video_category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Lien de la vidéo (YouTube)</label>
        <input name="video_link" type="url" value="{{ old('video_link') }}" placeholder="https://www.youtube.com/watch?v=..." class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Miniature (optionnel)</label>
        <input name="thumbnail" type="file" accept="image/*" class="w-full p-2 border rounded">
        <p class="text-sm text-gray-500 mt-1">Si non fournie, la miniature sera extraite automatiquement de YouTube</p>
    </div>

    <div>
        <label class="flex items-center">
            <input name="is_active" type="checkbox" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="mr-2">
            <span class="text-sm font-medium text-gray-700">Vidéo active</span>
        </label>
    </div>

    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-semibold">Enregistrer la vidéo</button>
</form>
@endsection 