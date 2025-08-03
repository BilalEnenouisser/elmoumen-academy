@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-cover bg-center bg-fixed text-white py-20" style="background-image: url('{{ asset('images/bgsec.jpg') }}');">
    <div class="absolute inset-0" style="background-color: rgba(0,7,25,0.72);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Niveaux Primaire
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Découvrez nos programmes éducatifs adaptés pour chaque année du primaire
            </p>
            <div class="w-24 h-1 bg-blue-400 mx-auto rounded-full"></div>
        </div>
    </div>
</section>

<!-- Separator -->
<div class="relative bg-cover bg-center bg-fixed py-8" style="background-image: url('{{ asset('images/bgsec.jpg') }}');">
    <div class="absolute inset-0" style="background-color: rgba(0,7,25,0.72);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="flex justify-center">
            <div class="w-24 h-1 bg-blue-400 rounded-full opacity-50"></div>
        </div>
    </div>
</div>

<!-- Years Section -->
<section class="relative bg-cover bg-center bg-fixed py-20" style="background-image: url('{{ asset('images/bgsec.jpg') }}');">
    <div class="absolute inset-0" style="background-color: rgba(0,7,25,0.72);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Choisissez Votre Année
            </h2>
            <p class="text-lg text-blue-100 max-w-2xl mx-auto">
                Sélectionnez l'année scolaire correspondant au niveau de votre enfant
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @for ($i = 1; $i <= 6; $i++)
                <div class="bg-white bg-opacity-15 backdrop-blur-lg border border-white border-opacity-30 rounded-2xl overflow-hidden shadow-xl hover:bg-white hover:bg-opacity-25 hover:transform hover:-translate-y-2 transition-all duration-300">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-6xl font-bold mb-2">{{ $i }}</div>
                                <div class="text-xl font-medium">Année</div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-3 py-1 text-sm font-medium">
                                Primaire
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-3">Année {{ $i }}</h3>
                        <p class="text-blue-100 mb-6">
                            Programme complet adapté aux enfants de {{ $i }}ère année du primaire
                        </p>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm text-blue-100">
                                <svg class="w-4 h-4 mr-2 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Matières fondamentales
                            </div>
                            <div class="flex items-center text-sm text-blue-100">
                                <svg class="w-4 h-4 mr-2 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Exercices interactifs
                            </div>
                            <div class="flex items-center text-sm text-blue-100">
                                <svg class="w-4 h-4 mr-2 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Suivi personnalisé
                            </div>
                        </div>
                        
                        <a href="{{ url('/courses/primaire/year/' . $i) }}" 
                           class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-center py-3 px-6 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                            Voir les matières
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>

<!-- Separator -->
<div class="relative bg-cover bg-center bg-fixed py-8" style="background-image: url('{{ asset('images/bgsec.jpg') }}');">
    <div class="absolute inset-0" style="background-color: rgba(0,7,25,0.72);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="flex justify-center">
            <div class="w-24 h-1 bg-blue-400 rounded-full opacity-50"></div>
        </div>
    </div>
</div>

<!-- Features Section -->
<section class="relative bg-cover bg-center bg-fixed py-20" style="background-image: url('{{ asset('images/bgsec.jpg') }}');">
    <div class="absolute inset-0" style="background-color: rgba(0,7,25,0.72);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Pourquoi Choisir Notre Primaire ?
            </h2>
            <p class="text-lg text-blue-100 max-w-2xl mx-auto">
                Une approche pédagogique moderne et adaptée aux besoins de chaque enfant
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center bg-white bg-opacity-15 backdrop-blur-lg border border-white border-opacity-30 rounded-2xl p-6 shadow-xl">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Programme Complet</h3>
                <p class="text-blue-100">Cours, exercices et évaluations pour toutes les matières fondamentales</p>
            </div>

            <div class="text-center bg-white bg-opacity-15 backdrop-blur-lg border border-white border-opacity-30 rounded-2xl p-6 shadow-xl">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Apprentissage Interactif</h3>
                <p class="text-blue-100">Vidéos, animations et exercices pratiques pour un apprentissage engageant</p>
            </div>

            <div class="text-center bg-white bg-opacity-15 backdrop-blur-lg border border-white border-opacity-30 rounded-2xl p-6 shadow-xl">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Suivi Personnalisé</h3>
                <p class="text-blue-100">Accompagnement individualisé pour chaque élève</p>
            </div>
        </div>
    </div>
</section>
@endsection
