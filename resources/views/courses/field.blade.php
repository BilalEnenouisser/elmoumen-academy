@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-purple-900 via-purple-800 to-purple-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Matériaux d'Étude
            </h1>
            <p class="text-xl md:text-2xl text-purple-100 mb-8 max-w-3xl mx-auto">
                {{ $field->name }} - {{ $year->name }} - {{ $level->name }}
            </p>
            <div class="w-24 h-1 bg-purple-400 mx-auto rounded-full"></div>
        </div>
    </div>
</section>

<!-- Materials Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        @if($materials->isEmpty())
            <div class="text-center">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Aucune ressource disponible</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Aucune ressource n'est actuellement disponible pour cette filière. Veuillez revenir plus tard.
                </p>
            </div>
        @else
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Ressources Pédagogiques
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Découvrez tous les cours, exercices et évaluations disponibles pour cette filière
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($materials as $material)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <div class="text-4xl font-bold mb-2">
                                        @if($material->blocks->first()?->type == 'Cours')
                                            📚
                                        @elseif($material->blocks->first()?->type == 'Exercices')
                                            ✏️
                                        @elseif($material->blocks->first()?->type == 'Examens')
                                            📝
                                        @else
                                            📖
                                        @endif
                                    </div>
                                    <div class="text-lg font-medium">{{ $material->title }}</div>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-3 py-1 text-sm font-medium">
                                    {{ $material->blocks->first()?->type ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $material->title }}</h3>
                            <p class="text-gray-600 mb-6">
                                Type: {{ $material->blocks->first()?->type ?? 'N/A' }}
                            </p>
                            
                            <div class="space-y-3">
                                @if ($material->pdf_path)
                                    <a href="{{ asset('storage/' . $material->pdf_path) }}" target="_blank"
                                       class="flex items-center gap-3 w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Voir le PDF
                                    </a>
                                @endif

                                @if ($material->video_link)
                                    <a href="{{ $material->video_link }}" target="_blank"
                                       class="flex items-center gap-3 w-full bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/>
                                        </svg>
                                        Voir la Vidéo
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Field Info Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                À Propos de la Filière {{ $field->name }}
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Découvrez les spécificités de cette filière et ses débouchés professionnels
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Formation Spécialisée</h3>
                <p class="text-gray-600">Programme adapté aux exigences spécifiques de cette filière</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Débouchés Professionnels</h3>
                <p class="text-gray-600">Préparation aux métiers et secteurs d'activité correspondants</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Préparation au Bac</h3>
                <p class="text-gray-600">Entraînement intensif pour réussir l'examen du baccalauréat</p>
            </div>
        </div>
    </div>
</section>
@endsection
