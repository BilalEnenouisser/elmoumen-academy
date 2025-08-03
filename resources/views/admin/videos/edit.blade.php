@extends('layouts.admin')

@section('title', 'Modifier la Vidéo')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Modifier la Vidéo</h1>
        <a href="{{ route('admin.videos.index') }}" 
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
            <form method="POST" action="{{ route('admin.videos.update', $video) }}" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre de la Vidéo</label>
                    <input type="text" 
                           id="title"
                           name="title" 
                           value="{{ old('title', $video->title) }}"
                           placeholder="Entrez le titre de la vidéo..." 
                           class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('title') border-red-500 @enderror" 
                           required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">URL de la Miniature</label>
                    <input type="url" 
                           id="thumbnail"
                           name="thumbnail" 
                           value="{{ old('thumbnail', $video->thumbnail) }}"
                           placeholder="https://example.com/thumbnail.jpg" 
                           class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('thumbnail') border-red-500 @enderror" 
                           required>
                    @error('thumbnail')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">URL de la Vidéo</label>
                    <input type="url" 
                           id="video_url"
                           name="video_url" 
                           value="{{ old('video_url', $video->video_url) }}"
                           placeholder="https://example.com/video.mp4" 
                           class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('video_url') border-red-500 @enderror" 
                           required>
                    @error('video_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                    <select id="category"
                            name="category" 
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('category') border-red-500 @enderror" 
                            required>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="mothers" {{ old('category', $video->category) == 'mothers' ? 'selected' : '' }}>Mères</option>
                        <option value="parents" {{ old('category', $video->category) == 'parents' ? 'selected' : '' }}>Parents</option>
                        <option value="students" {{ old('category', $video->category) == 'students' ? 'selected' : '' }}>Étudiants</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition-colors">
                        💾 Mettre à Jour
                    </button>
                    <a href="{{ route('admin.videos.index') }}" 
                       class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 transition-colors">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection 