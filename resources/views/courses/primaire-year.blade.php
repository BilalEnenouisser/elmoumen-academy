@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-cover bg-center bg-fixed text-white py-20" style="background-image: url('{{ asset('images/bgsec.jpg') }}');">
    <div class="absolute inset-0" style="background-color: rgba(31, 41, 55, 0.85);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Modules – Année {{ $year->name }}
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Sélectionnez un module pour accéder aux matériels éducatifs
            </p>
            <div class="w-24 h-1 bg-blue-400 mx-auto rounded-full"></div>
        </div>
    </div>
</section>

<!-- Subjects Section -->
<section class="relative bg-cover bg-center bg-fixed py-20" style="background-image: url('{{ asset('images/bgsec.jpg') }}');">
    <div class="absolute inset-0" style="background-color: rgba(0,7,25,0.72);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        @if($subjects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($subjects as $subject)
                <div class="bg-white bg-opacity-15 backdrop-blur-lg border border-white border-opacity-30 rounded-2xl overflow-hidden shadow-xl hover:bg-white hover:bg-opacity-25 hover:transform hover:-translate-y-2 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-white">{{ $subject->name }}</h2>
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <p class="text-blue-100 mb-4">
                            Module {{ $subject->name }} pour l'année {{ $subject->year->name }}
                        </p>
                        
                        <a href="{{ route('courses.materials', ['level' => $subject->level->slug, 'year' => $subject->year->slug, 'subject' => $subject->slug]) }}" 
                           class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-center py-3 px-4 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                            Voir les modules
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-white bg-opacity-20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-white mb-2">Aucun module disponible</h3>
                <p class="text-blue-100">Les modules pour cette année seront bientôt disponibles.</p>
            </div>
        @endif
    </div>
</section>

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
