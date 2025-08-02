@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-green-900 via-green-800 to-green-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Niveaux Collège
            </h1>
            <p class="text-xl md:text-2xl text-green-100 mb-8 max-w-3xl mx-auto">
                Programme éducatif complet pour les années du collège
            </p>
            <div class="w-24 h-1 bg-green-400 mx-auto rounded-full"></div>
        </div>
    </div>
</section>

<!-- Years Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Choisissez Votre Année
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Sélectionnez l'année scolaire correspondant au niveau de votre enfant
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach (['1ère année', '2ème année', '3ème année'] as $index => $year)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-6xl font-bold mb-2">{{ $index + 1 }}</div>
                                <div class="text-xl font-medium">Année</div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-3 py-1 text-sm font-medium">
                                Collège
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $year }}</h3>
                        <p class="text-gray-600 mb-6">
                            Programme complet adapté aux adolescents de {{ $year }} du collège
                        </p>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Matières approfondies
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Préparation au lycée
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Orientation scolaire
                            </div>
                        </div>
                        
                        <a href="{{ url('/courses/college/year/' . ($index + 1)) }}" 
                           class="block w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white text-center py-3 px-6 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                            Voir les matières
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Pourquoi Choisir Notre Collège ?
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Une formation solide pour préparer l'avenir académique de votre enfant
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Formation Complète</h3>
                <p class="text-gray-600">Toutes les matières essentielles pour une formation équilibrée</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Préparation au Lycée</h3>
                <p class="text-gray-600">Acquisition des compétences nécessaires pour réussir au lycée</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Orientation Scolaire</h3>
                <p class="text-gray-600">Guidance pour choisir la filière adaptée au lycée</p>
            </div>
        </div>
    </div>
</section>
@endsection
