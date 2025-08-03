@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-cover bg-center bg-fixed text-white py-20" style="background-image: url('{{ asset('images/bgsec.jpg') }}');">
    <div class="absolute inset-0" style="background-color: rgba(31, 41, 55, 0.85);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Filières – Année {{ $year->name }}
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Sélectionnez une filière pour accéder aux modules
            </p>
            <div class="w-24 h-1 bg-blue-400 mx-auto rounded-full"></div>
        </div>
    </div>
</section>

<!-- Fields Section -->
<section class="relative bg-cover bg-center bg-fixed py-20" style="background-image: url('{{ asset('images/bgsec.jpg') }}');">
    <div class="absolute inset-0" style="background-color: rgba(0,7,25,0.72);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        @if($fields->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($fields as $field)
                <div class="bg-white bg-opacity-15 backdrop-blur-lg border border-white border-opacity-30 rounded-2xl overflow-hidden shadow-xl hover:bg-white hover:bg-opacity-25 hover:transform hover:-translate-y-2 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-white">{{ $field->name }}</h2>
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <p class="text-blue-100 mb-4">
                            Filière {{ $field->name }} pour l'année {{ $year->name }}
                        </p>
                        
                        <a href="{{ route('courses.field', ['level' => $field->level->slug, 'year' => $year->slug, 'field' => $field->slug]) }}" 
                           class="block w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white text-center py-3 px-4 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-white mb-2">Aucune filière disponible</h3>
                <p class="text-blue-100">Les filières pour cette année seront bientôt disponibles.</p>
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
                Pourquoi Choisir Notre Lycée ?
            </h2>
            <p class="text-lg text-blue-100 max-w-2xl mx-auto">
                Une formation d'excellence pour préparer l'enseignement supérieur
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center bg-white bg-opacity-15 backdrop-blur-lg border border-white border-opacity-30 rounded-2xl p-6 shadow-xl">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Filières Spécialisées</h3>
                <p class="text-blue-100">Formation adaptée selon les filières choisies</p>
            </div>

            <div class="text-center bg-white bg-opacity-15 backdrop-blur-lg border border-white border-opacity-30 rounded-2xl p-6 shadow-xl">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Préparation au Bac</h3>
                <p class="text-blue-100">Entraînement intensif pour réussir l'examen du baccalauréat</p>
            </div>

            <div class="text-center bg-white bg-opacity-15 backdrop-blur-lg border border-white border-opacity-30 rounded-2xl p-6 shadow-xl">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Orientation Universitaire</h3>
                <p class="text-blue-100">Guidance pour choisir les études supérieures</p>
            </div>
        </div>
    </div>
</section>
@endsection
