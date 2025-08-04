@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="relative w-full min-h-[500px] flex items-center justify-center overflow-hidden" style="background: linear-gradient(120deg, #002347 0%, #0a3d62 100%);">
    <!-- Background image overlay -->
    <img src="{{ asset('images/bg1.jpg') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-60 pointer-events-none z-0">
    
    <div class="relative z-20 text-center text-white px-6">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
            À Propos de<br>
            <span class="text-cyan-400">Elmoumen Academy</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto mb-8">
            Votre partenaire de confiance pour une éducation d'excellence depuis plus de 5 ans
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#mission" class="bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white px-8 py-4 rounded-full font-medium transition shadow-lg">
                Notre Mission
            </a>
            <a href="#contact" class="border-2 border-white text-white px-8 py-4 rounded-full font-medium hover:bg-white hover:text-gray-900 transition">
                Nous Contacter
            </a>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<section class="py-20 bg-[#001226]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Nos Chiffres Clés</h2>
            <p class="text-gray-300 text-lg">Une croissance constante et des résultats exceptionnels</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-cyan-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-4xl font-bold text-white mb-2" x-data="{ count: 0, target: 5 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
                <p class="text-gray-300">Années d'Expérience</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-cyan-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="text-4xl font-bold text-white mb-2" x-data="{ count: 0, target: 50 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
                <p class="text-gray-300">Professeurs Qualifiés</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-cyan-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="text-4xl font-bold text-white mb-2" x-data="{ count: 0, target: 1000 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
                <p class="text-gray-300">Étudiants Satisfaits</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-cyan-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-4xl font-bold text-white mb-2" x-data="{ count: 0, target: 95 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '%'"></div>
                <p class="text-gray-300">Taux de Réussite</p>
            </div>
        </div>
    </div>
</section>

<!-- Image Gallery Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-[Montserrat]">Notre Académie en Images</h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Découvrez notre environnement d'apprentissage moderne et nos installations
            </p>
        </div>
        
        <!-- Image Slider -->
        <div id="gallery" class="relative w-full max-w-4xl mx-auto" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-64 md:h-96 overflow-hidden rounded-2xl shadow-2xl">
                 <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/about-us.jpg') }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Notre Académie">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img src="{{ asset('images/college.jpg') }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Salle de Classe">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/lycee.jpg') }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Laboratoire">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/primaire.jpg') }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Bibliothèque">
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/concours.jpg') }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Espace d'Étude">
                </div>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-1/2 start-4 z-30 flex items-center justify-center h-10 w-10 rounded-full bg-white/30 hover:bg-white/50 focus:ring-4 focus:ring-white focus:outline-none transition-all duration-300" data-carousel-prev>
                <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Précédent</span>
            </button>
            <button type="button" class="absolute top-1/2 end-4 z-30 flex items-center justify-center h-10 w-10 rounded-full bg-white/30 hover:bg-white/50 focus:ring-4 focus:ring-white focus:outline-none transition-all duration-300" data-carousel-next>
                <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Suivant</span>
            </button>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section id="mission" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-[Montserrat]">Notre Mission & Vision</h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Nous nous engageons à transformer l'éducation en ligne et à rendre l'apprentissage accessible à tous
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Mission -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="w-16 h-16 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Notre Mission</h3>
                <p class="text-gray-600 leading-relaxed">
                    Fournir une éducation de qualité supérieure accessible à tous les étudiants, 
                    quel que soit leur niveau ou leur situation géographique. Nous nous engageons 
                    à créer un environnement d'apprentissage innovant et inclusif qui favorise 
                    l'excellence académique et le développement personnel.
                </p>
            </div>
            
            <!-- Vision -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Notre Vision</h3>
                <p class="text-gray-600 leading-relaxed">
                    Devenir la référence en matière d'éducation en ligne au Maroc, en créant 
                    une plateforme qui révolutionne l'apprentissage et permet à chaque étudiant 
                    d'atteindre son plein potentiel. Nous aspirons à former les leaders de demain 
                    avec des compétences adaptées aux défis du 21ème siècle.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nos Valeurs</h2>
            <p class="text-gray-600 text-lg">Les principes qui guident notre action quotidienne</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Excellence -->
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Excellence</h3>
                <p class="text-gray-600">
                    Nous visons l'excellence dans tout ce que nous faisons, de la qualité de nos cours 
                    à l'accompagnement de nos étudiants.
                </p>
            </div>
            
            <!-- Innovation -->
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Innovation</h3>
                <p class="text-gray-600">
                    Nous adoptons les dernières technologies et méthodes pédagogiques pour 
                    offrir une expérience d'apprentissage moderne et efficace.
                </p>
            </div>
            
            <!-- Accessibilité -->
            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Accessibilité</h3>
                <p class="text-gray-600">
                    Nous croyons que l'éducation doit être accessible à tous, sans barrières 
                    géographiques, économiques ou sociales.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-20 bg-[#001226]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Notre Équipe</h2>
            <p class="text-gray-300 text-lg">Des experts passionnés par l'éducation</p>
        </div>
        
        @php
            $teachers = \App\Models\Teacher::showInAbout()->orderBy('display_order')->get();
            $teachersChunks = $teachers->chunk(4);
        @endphp
        
        @if($teachers->count() > 0)
            @foreach($teachersChunks as $chunk)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                    @foreach($chunk as $teacher)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            @if($teacher->image_path && !empty($teacher->image_path) && file_exists(storage_path('app/public/' . $teacher->image_path)))
                                <div class="h-64 relative overflow-hidden">
                                    <img src="{{ asset('storage/' . $teacher->image_path) }}" 
                                         alt="{{ $teacher->name }}" 
                                         class="w-full h-full object-cover">
                                </div>
                            @else
                                @php
                                    $avatarColor = $teacher->avatar_color ?: 'background-color: #3b82f6;';
                                    $firstLetter = $teacher->first_letter ?: 'T';
                                @endphp
                                <div class="h-64 flex items-center justify-center" style="{{ $avatarColor }}">
                                    <span class="text-6xl font-bold text-white">{{ $firstLetter }}</span>
                                </div>
                            @endif
                            <div class="p-6 text-center">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $teacher->name }}</h3>
                                <p class="text-cyan-600 font-medium mb-3">{{ $teacher->role }}</p>
                                <p class="text-gray-600 text-sm">
                                    {{ Str::limit($teacher->description, 120) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <!-- Fallback Team Members -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="h-64 bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Dr. Ahmed Elmoumen</h3>
                        <p class="text-cyan-600 font-medium mb-3">Fondateur & Directeur</p>
                        <p class="text-gray-600 text-sm">
                            Expert en pédagogie avec plus de 15 ans d'expérience dans l'éducation en ligne.
                        </p>
                    </div>
                </div>
                
                <!-- Team Member 2 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="h-64 bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Prof. Fatima Zahra</h3>
                        <p class="text-cyan-600 font-medium mb-3">Responsable Pédagogique</p>
                        <p class="text-gray-600 text-sm">
                            Spécialiste en sciences de l'éducation et en développement de programmes d'études.
                        </p>
                    </div>
                </div>
                
                <!-- Team Member 3 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="h-64 bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Ing. Youssef Benali</h3>
                        <p class="text-cyan-600 font-medium mb-3">Responsable Technique</p>
                        <p class="text-gray-600 text-sm">
                            Expert en technologies éducatives et en développement de plateformes d'apprentissage.
                        </p>
                    </div>
                </div>
                
                <!-- Team Member 4 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="h-64 bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Prof. Sara Alami</h3>
                        <p class="text-cyan-600 font-medium mb-3">Experte en Langues</p>
                        <p class="text-gray-600 text-sm">
                            Spécialiste en langues étrangères et en méthodes d'apprentissage innovantes.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Buy Books Section -->
<section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Achetez Nos Livres Éducatifs
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Découvrez notre collection de livres spécialisés pour tous les niveaux d'enseignement
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($books as $book)
            <!-- Book Card -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group">
                <div class="relative">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center relative overflow-hidden">
                        @if($book->image_path)
                            <img src="{{ asset('storage/' . $book->image_path) }}" 
                                 alt="{{ $book->name }}" 
                                 class="absolute inset-0 w-full h-full object-cover opacity-80"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        @endif
                        <div class="text-center text-white relative z-10 {{ $book->image_path ? 'hidden' : 'flex flex-col' }}">
                            <span class="text-6xl mb-2 block">
                                @switch($book->category->name ?? '')
                                    @case('Mathématiques')
                                        📐
                                        @break
                                    @case('Physique')
                                        ⚡
                                        @break
                                    @case('Chimie')
                                        🧪
                                        @break
                                    @case('Biologie')
                                        🧬
                                        @break
                                    @default
                                        📚
                                @endswitch
                            </span>
                            <p class="text-lg font-medium">{{ $book->category->name ?? 'Livre' }}</p>
                        </div>
                    </div>
                    @if($book->has_discount)
                    <div class="absolute top-4 right-4">
                        <div class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                            -{{ $book->discount_percentage }}%
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $book->name }}</h3>
                    <p class="text-gray-600 mb-4 text-sm">
                        {{ Str::limit($book->description, 100) }}
                    </p>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex flex-col">
                            @if($book->has_discount)
                                <span class="text-sm text-gray-500 line-through">{{ number_format($book->price, 2) }} DH</span>
                                <span class="text-lg font-bold text-blue-600">{{ number_format($book->final_price, 2) }} DH</span>
                            @else
                                <span class="text-lg font-bold text-blue-600">{{ number_format($book->final_price, 2) }} DH</span>
                            @endif
                        </div>
                        @if($book->has_discount)
                        <div class="text-xs text-gray-500">
                            Économisez {{ number_format($book->price - $book->final_price, 2) }} DH
                        </div>
                        @endif
                    </div>
                    
                    @if($whatsappNumber)
                    <a href="{{ $whatsappNumber->whatsapp_url }}?text=Bonjour! Je souhaite acheter le livre '{{ $book->name }}' au prix de {{ number_format($book->final_price, 2) }} DH. Pouvez-vous me donner plus d'informations?"
                       target="_blank"
                       class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                        Acheter via WhatsApp
                    </a>
                    @else
                    <a href="{{ route('books.show', $book) }}"
                       class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                        Voir Détails
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <!-- Fallback Cards when no books are available -->
            @for($i = 1; $i <= 4; $i++)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group">
                <div class="relative">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center relative overflow-hidden">
                        <div class="text-center text-white relative z-10">
                            <span class="text-6xl mb-2 block">
                                @switch($i)
                                    @case(1)
                                        📐
                                        @break
                                    @case(2)
                                        ⚡
                                        @break
                                    @case(3)
                                        🧪
                                        @break
                                    @case(4)
                                        🧬
                                        @break
                                @endswitch
                            </span>
                            <p class="text-lg font-medium">
                                @switch($i)
                                    @case(1)
                                        Mathématiques
                                        @break
                                    @case(2)
                                        Physique
                                        @break
                                    @case(3)
                                        Chimie
                                        @break
                                    @case(4)
                                        Biologie
                                        @break
                                @endswitch
                            </p>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4">
                        <div class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                            -20%
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        @switch($i)
                            @case(1)
                                Mathématiques Avancées
                                @break
                            @case(2)
                                Physique Moderne
                                @break
                            @case(3)
                                Chimie Organique
                                @break
                            @case(4)
                                Biologie Cellulaire
                                @break
                        @endswitch
                    </h3>
                    <p class="text-gray-600 mb-4 text-sm">
                        Cours complets avec exercices pratiques et corrigés détaillés pour tous les niveaux.
                    </p>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-500 line-through">120.00 DH</span>
                            <span class="text-lg font-bold text-blue-600">96.00 DH</span>
                        </div>
                        <div class="text-xs text-gray-500">Économisez 24 DH</div>
                    </div>
                    
                    <a href="{{ route('books.index') }}" 
                       class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                        Voir Nos Livres
                    </a>
                </div>
            </div>
            @endfor
            @endforelse
        </div>

        <!-- View All Books Button -->
        <div class="text-center mt-12">
            <a href="{{ route('books.index') }}" 
               class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Voir Tous Nos Livres
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-cyan-400 to-blue-500">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            Prêt à Commencer Votre Voyage Éducatif ?
        </h2>
        <p class="text-xl text-white mb-8 opacity-90">
            Rejoignez des milliers d'étudiants qui ont déjà transformé leur avenir avec Elmoumen Academy
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="bg-white text-gray-900 px-8 py-4 rounded-full font-medium hover:bg-gray-100 transition shadow-lg">
                Commencer Maintenant
            </a>
            <a href="#contact" class="border-2 border-white text-white px-8 py-4 rounded-full font-medium hover:bg-white hover:text-gray-900 transition">
                En Savoir Plus
            </a>
        </div>
    </div>
</section>

@endsection 