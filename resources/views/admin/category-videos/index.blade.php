@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">📹 Gestion des Vidéos par Catégorie</h1>

<a href="{{ route('admin.category-videos.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">➕ Ajouter une vidéo</a>

@if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full bg-white rounded shadow overflow-hidden text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2">Miniature</th>
            <th class="p-2">Titre</th>
            <th class="p-2">Catégorie</th>
            <th class="p-2">Statut</th>
            <th class="p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($videos as $video)
            <tr class="border-b">
                <td class="p-2">
                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-16 h-12 object-cover rounded">
                </td>
                <td class="p-2">{{ $video->title }}</td>
                <td class="p-2">
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">{{ $video->category->name }}</span>
                </td>
                <td class="p-2">
                    @if($video->is_active)
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Actif</span>
                    @else
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Inactif</span>
                    @endif
                </td>
                                       <td class="p-2 space-x-2 text-center">
                           <a href="{{ route('admin.category-videos.edit', $video->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                           <form action="{{ route('admin.category-videos.destroy', $video->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cette vidéo ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $videos->links() }}
</div>
@endsection 