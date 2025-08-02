@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="relative w-full min-h-[400px] flex items-center justify-center overflow-hidden" style="background: linear-gradient(120deg, #002347 0%, #0a3d62 100%);">
    <!-- Background image overlay -->
    <img src="{{ asset('images/bg1.jpg') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-60 pointer-events-none z-0">
    
    <div class="relative z-20 text-center text-white px-6">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
            {{ $category->name }}
        </h1>
        @if($category->description)
            <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto mb-8">
                {{ $category->description }}
            </p>
        @endif
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#videos" class="bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white px-8 py-4 rounded-full font-medium transition shadow-lg">
                Voir les Vidéos
            </a>
            <a href="{{ url('/') }}" class="border-2 border-white text-white px-8 py-4 rounded-full font-medium hover:bg-white hover:text-gray-900 transition">
                Retour à l'Accueil
            </a>
        </div>
    </div>
</div>

<!-- Videos Section -->
<section id="videos" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Vidéos {{ $category->name }}
            </h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Découvrez notre collection de vidéos éducatives spécialement sélectionnées pour vous aider dans votre apprentissage
            </p>
        </div>

        @if($videos->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucune vidéo disponible</h3>
                <p class="text-gray-600 text-lg mb-8">
                    Nous travaillons actuellement sur de nouvelles vidéos pour cette catégorie. Revenez bientôt !
                </p>
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour à l'Accueil
                </a>
            </div>
        @else
            <!-- Videos Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($videos as $video)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group">
                    <!-- Video Thumbnail -->
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $video->thumbnail_url }}" 
                             alt="{{ $video->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        
                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="bg-white bg-opacity-90 rounded-full p-4 transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                    <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Video Duration Badge -->
                        <div class="absolute top-4 right-4">
                            <div class="bg-black bg-opacity-70 text-white px-2 py-1 rounded text-sm font-medium">
                                Vidéo
                            </div>
                        </div>
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                            {{ $video->title }}
                        </h3>
                        
                        @if($video->description)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ $video->description }}
                            </p>
                        @endif
                        
                        <!-- Video Stats -->
                        <div class="flex items-center justify-between mb-4 text-sm text-gray-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <span>Vidéo éducative</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $video->order ?? 'N/A' }}</span>
                            </div>
                        </div>
                        
                        <!-- Watch Button -->
                        <a href="{{ $video->video_link }}" 
                           target="_blank" 
                           class="block w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-center py-3 px-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg"
                           onclick="trackVideoClick({{ $video->id }})">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                                </svg>
                                Regarder la Vidéo
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($videos->hasPages())
                <div class="flex justify-center">
                    <div class="bg-white rounded-xl shadow-lg p-4">
                        {{ $videos->links() }}
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pourquoi Nos Vidéos ?</h2>
            <p class="text-gray-600 text-lg">Découvrez les avantages de notre plateforme vidéo éducative</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Qualité Professionnelle</h3>
                <p class="text-gray-600">
                    Nos vidéos sont produites avec des équipements professionnels pour garantir une qualité d'image et de son optimale.
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Contenu Structuré</h3>
                <p class="text-gray-600">
                    Chaque vidéo suit un programme pédagogique structuré pour faciliter votre apprentissage et progression.
                </p>
            </div>
            
            <!-- Feature 3 -->
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Accès 24/7</h3>
                <p class="text-gray-600">
                    Regardez nos vidéos à tout moment, où que vous soyez. Apprenez à votre rythme selon votre disponibilité.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-cyan-400 to-blue-500">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            Prêt à Commencer Votre Apprentissage ?
        </h2>
        <p class="text-xl text-white mb-8 opacity-90">
            Rejoignez des milliers d'étudiants qui ont déjà transformé leur avenir avec nos vidéos éducatives
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#videos" class="bg-white text-gray-900 px-8 py-4 rounded-full font-medium hover:bg-gray-100 transition shadow-lg">
                Commencer à Regarder
            </a>
            <a href="{{ url('/') }}" class="border-2 border-white text-white px-8 py-4 rounded-full font-medium hover:bg-white hover:text-gray-900 transition">
                Découvrir Plus
            </a>
        </div>
    </div>
</section>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
function trackVideoClick(videoId) {
    fetch(`/track/video-click/${videoId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
}
</script>

@endsection 