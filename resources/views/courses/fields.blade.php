@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-purple-900 via-purple-800 to-purple-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Choisissez Votre Filière
            </h1>
            <p class="text-xl md:text-2xl text-purple-100 mb-8 max-w-3xl mx-auto">
                {{ $year->name }} - {{ $level->name }}
            </p>
            <div class="w-24 h-1 bg-purple-400 mx-auto rounded-full"></div>
        </div>
    </div>
</section>

<!-- Fields Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        @if ($fields->isEmpty())
            <div class="text-center">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Aucune filière disponible</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Aucune filière n'est actuellement disponible. Veuillez revenir plus tard.
                </p>
            </div>
        @else
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Sélectionnez Votre Filière
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Choisissez la filière qui correspond à vos ambitions et intérêts
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($fields as $field)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <div class="text-4xl font-bold mb-2">
                                        @if(str_contains(strtolower($field->name), 'sciences'))
                                            🔬
                                        @elseif(str_contains(strtolower($field->name), 'math'))
                                            📐
                                        @elseif(str_contains(strtolower($field->name), 'lettres'))
                                            📚
                                        @elseif(str_contains(strtolower($field->name), 'économie'))
                                            💰
                                        @elseif(str_contains(strtolower($field->name), 'technique'))
                                            ⚙️
                                        @else
                                            🎓
                                        @endif
                                    </div>
                                    <div class="text-lg font-medium">{{ $field->name }}</div>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-3 py-1 text-sm font-medium">
                                    Filière
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $field->name }}</h3>
                            <p class="text-gray-600 mb-6">
                                Formation spécialisée pour préparer votre avenir professionnel
                            </p>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Programme spécialisé
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Préparation au bac
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Orientation universitaire
                                </div>
                            </div>
                            
                            <a href="{{ route('courses.field', [
                                'level' => $level->slug,
                                'year' => $year->slug,
                                'field' => $field->slug
                            ]) }}" 
                               class="block w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white text-center py-3 px-6 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                                Voir les matières
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Pourquoi Choisir une Filière Spécialisée ?
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Une formation adaptée pour préparer votre avenir académique et professionnel
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
                <p class="text-gray-600">Programme adapté aux exigences spécifiques de chaque filière</p>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Orientation Universitaire</h3>
                <p class="text-gray-600">Guidance pour choisir les études supérieures adaptées</p>
            </div>
        </div>
    </div>
</section>
@endsection
