@extends('layouts.admin')

@section('title', 'Modifier le Message')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Modifier le Message</h1>
        <a href="{{ route('admin.marquees.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200">
            ← Retour
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.marquees.update', $marquee) }}" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="text" class="block text-sm font-medium text-gray-700 mb-2">Texte du Message</label>
                    <input type="text" 
                           id="text"
                           name="text" 
                           value="{{ old('text', $marquee->text) }}"
                           placeholder="Entrez le texte du message..." 
                           class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('text') border-red-500 @enderror" 
                           required>
                    @error('text')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Auteur (optionnel)</label>
                    <input type="text" 
                           id="author"
                           name="author" 
                           value="{{ old('author', $marquee->author) }}"
                           placeholder="Nom de l'auteur..." 
                           class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('author') border-red-500 @enderror">
                    @error('author')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition-colors">
                        💾 Mettre à Jour
                    </button>
                    <a href="{{ route('admin.marquees.index') }}" 
                       class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 transition-colors">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection 