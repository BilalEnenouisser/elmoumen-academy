@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl mb-4">Liste des vidéos</h2>

    <a href="{{ route('admin.videos.create') }}" class="bg-blue-500 text-white px-4 py-2 mb-4 inline-block">➕ Ajouter Vidéo</a>

    @foreach($videos as $video)
        <div class="border p-4 mb-3">
            <img src="{{ $video->thumbnail }}" alt="" class="w-40 h-24 object-cover inline-block mr-4">
            <strong>{{ $video->title }}</strong> | Catégorie: {{ ucfirst($video->category) }} <br>
            <a href="{{ $video->video_url }}" class="text-blue-600" target="_blank">Voir la vidéo 🎥</a>

            <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline-block ml-4">
                @csrf @method('DELETE')
                <button class="text-red-500">Supprimer ❌</button>
            </form>
        </div>
    @endforeach

    {{ $videos->links() }}
@endsection
