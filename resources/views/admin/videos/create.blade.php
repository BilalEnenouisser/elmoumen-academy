@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl mb-4">Ajouter une Vidéo</h2>

    <form action="{{ route('admin.videos.store') }}" method="POST" class="space-y-4">
        @csrf

        <input name="title" type="text" placeholder="Titre" class="w-full p-2 border rounded" required>

        <select name="category" class="w-full p-2 border rounded" required>
            <option value="">Catégorie</option>
            <option value="mothers">Mères</option>
            <option value="parents">Parents</option>
            <option value="students">Étudiants</option>
        </select>

        <input name="thumbnail" type="url" placeholder="Lien de l'image miniature" class="w-full p-2 border rounded" required>
        <input name="video_url" type="url" placeholder="Lien de la vidéo (YouTube)" class="w-full p-2 border rounded" required>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Ajouter Vidéo</button>
    </form>
@endsection
