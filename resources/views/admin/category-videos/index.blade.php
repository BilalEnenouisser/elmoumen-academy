@extends('layouts.admin')

@section('title', 'Gestion des Vidéos par Catégorie')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-2xl font-bold">📹 Gestion des Vidéos par Catégorie</h1>
        <a href="{{ route('admin.category-videos.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">
            ➕ Ajouter une Vidéo
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mobile Cards View -->
    <div class="lg:hidden space-y-4">
        @foreach ($videos as $video)
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-start gap-3 mb-3">
                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-20 h-16 object-cover rounded flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 truncate">{{ $video->title }}</h3>
                        <div class="flex gap-2 mt-1">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">{{ $video->category->name }}</span>
                            @if($video->is_active)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Actif</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Inactif</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.category-videos.edit', $video->id) }}" 
                       class="flex-1 text-center bg-blue-100 text-blue-700 px-3 py-2 rounded text-sm hover:bg-blue-200 transition-colors">
                        Modifier
                    </a>
                    <form action="{{ route('admin.category-videos.destroy', $video->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full text-center bg-red-100 text-red-700 px-3 py-2 rounded text-sm hover:bg-red-200 transition-colors"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vidéo ?')">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Desktop Table View -->
    <div class="hidden lg:block">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Miniature</th>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Titre</th>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Catégorie</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">Statut</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($videos as $video)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4">
                                <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-16 h-12 object-cover rounded">
                            </td>
                            <td class="p-4 text-sm text-gray-900">{{ $video->title }}</td>
                            <td class="p-4">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">{{ $video->category->name }}</span>
                            </td>
                            <td class="p-4 text-center">
                                @if($video->is_active)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Actif</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Inactif</span>
                                @endif
                            </td>
                            <td class="p-4 text-center space-x-2">
                                <a href="{{ route('admin.category-videos.edit', $video->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors">
                                    Modifier
                                </a>
                                <form action="{{ route('admin.category-videos.destroy', $video->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800 transition-colors"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vidéo ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $videos->links() }}
    </div>
@endsection 