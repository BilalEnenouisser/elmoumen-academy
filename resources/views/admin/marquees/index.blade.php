@extends('layouts.admin')

@section('title', 'Gestion du Bandeau d\'Annonce')

@section('content')
    <h1 class="text-2xl font-bold mb-6">📢 Bandeau d'Annonce (Marquee)</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    <!-- Add New Message Form -->
    <div class="bg-white rounded-lg shadow p-4 lg:p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Ajouter un Nouveau Message</h2>
        <form method="POST" action="{{ route('admin.marquees.store') }}" class="space-y-4">
            @csrf
            <div>
                <label for="text" class="block text-sm font-medium text-gray-700 mb-2">Texte du Message</label>
                <input type="text" 
                       id="text"
                       name="text" 
                       placeholder="Entrez le texte du message..." 
                       class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                       required>
            </div>
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Auteur (optionnel)</label>
                <input type="text" 
                       id="author"
                       name="author" 
                       placeholder="Nom de l'auteur..." 
                       class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition-colors">
                ➕ Ajouter le Message
            </button>
        </form>
    </div>

    <!-- Existing Messages -->
    <div class="bg-white rounded-lg shadow p-4 lg:p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Messages Existants</h2>
        
        @if($marquees->count() > 0)
            <div class="space-y-3">
                @foreach($marquees as $item)
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <div class="flex items-start gap-2">
                                <span class="text-lg">🔔</span>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $item->text }}</p>
                                    @if($item->author)
                                        <p class="text-sm text-gray-500">Par : {{ $item->author }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('admin.marquees.destroy', $item) }}" class="flex-shrink-0">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm hover:bg-red-200 transition-colors"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Aucun message d'annonce pour le moment.</p>
        @endif
    </div>
@endsection
