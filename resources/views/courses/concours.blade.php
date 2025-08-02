@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-red-900 via-red-800 to-red-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Concours Préparatoires
            </h1>
            <p class="text-xl md:text-2xl text-red-100 mb-8 max-w-3xl mx-auto">
                Préparation intensive pour les concours d'entrée aux grandes écoles
            </p>
            <div class="w-24 h-1 bg-red-400 mx-auto rounded-full"></div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Choisissez Votre Filière
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Sélectionnez la filière correspondant à vos ambitions professionnelles
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach (['Médecine', 'Informatique', 'Génie Civil', 'Commerce'] as $category)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-4xl font-bold mb-2">
                                    @if($category == 'Médecine')
                                        🏥
                                    @elseif($category == 'Informatique')
                                        💻
                                    @elseif($category == 'Génie Civil')
                                        🏗️
                                    @else
                                        💼
                                    @endif
                                </div>
                                <div class="text-lg font-medium">{{ $category }}</div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-3 py-1 text-sm font-medium">
                                Concours
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $category }}</h3>
                        <p class="text-gray-600 mb-6">
                            Préparation intensive pour les concours d'entrée en {{ $category }}
                        </p>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Cours spécialisés
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Entraînement intensif
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Simulacres d'examens
                            </div>
                        </div>
                        
                        <a href="{{ url('/courses/concours/' . strtolower(str_replace(' ', '-', $category))) }}" 
                           class="block w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-center py-3 px-6 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
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
                Pourquoi Choisir Nos Concours ?
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Une préparation d'excellence pour réussir vos concours d'entrée
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Programme Spécialisé</h3>
                <p class="text-gray-600">Cours adaptés aux exigences spécifiques de chaque concours</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Entraînement Intensif</h3>
                <p class="text-gray-600">Exercices pratiques et simulacres d'examens réguliers</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Accompagnement Personnalisé</h3>
                <p class="text-gray-600">Suivi individualisé et conseils d'orientation</p>
            </div>
        </div>
    </div>
</section>

<!-- Success Rate Section -->
<section class="py-20 bg-gradient-to-br from-gray-900 to-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Nos Résultats
            </h2>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                Un taux de réussite exceptionnel pour nos candidats
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-red-400 mb-2">95%</div>
                <div class="text-lg text-gray-300">Taux de réussite</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-blue-400 mb-2">500+</div>
                <div class="text-lg text-gray-300">Étudiants admis</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-green-400 mb-2">50+</div>
                <div class="text-lg text-gray-300">Années d'expérience</div>
            </div>
        </div>
    </div>
</section>
@endsection
