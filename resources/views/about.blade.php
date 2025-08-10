@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="relative w-full min-h-[500px] flex items-center justify-center overflow-hidden" style="background: linear-gradient(120deg, #002347 0%, #0a3d62 100%);">
    <!-- Background image overlay -->
    <img src="{{ asset('images/bg1.jpg') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-60 pointer-events-none z-0">
    
    <div class="relative z-20 text-center text-white px-6">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
            À Propos de<br>
            <span class="text-cyan-400">El Moumen Academy</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto mb-8">
        Un centre éducatif novateur, soutenu par des enseignants qualifiés, dédié à la réussite et au développement personnel.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#books" class="bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white px-8 py-4 rounded-full font-medium transition shadow-lg">
            Découvrir les livres
            </a>
            <a href="{{ url('/') }}#Individual" class="border-2 border-white text-white px-8 py-4 rounded-full font-medium hover:bg-white hover:text-gray-900 transition">
            Voir nos cours
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
                <div class="text-4xl font-bold text-white mb-2" x-data="{ count: 0, target: 10 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
                <p class="text-gray-300">Professeurs Qualifiés</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-cyan-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="text-4xl font-bold text-white mb-2" x-data="{ count: 0, target: 500 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
                <p class="text-gray-300">Étudiants Satisfaits</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-cyan-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-4xl font-bold text-white mb-2" x-data="{ count: 0, target: 100 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '%'"></div>
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
            Explorez des moments forts de nos activités pédagogiques, événements ludiques, et sorties éducatives durant l’année.
            </p>
        </div>
        
        <!-- Full Width Swiper Gallery -->
        <div class="gallery-swiper-container">
            <div class="swiper gallery-swiper">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                     <div class="swiper-slide">
                        <div class="gallery-slide-content">
                            <img src="{{ asset('images/slider/4.jpg') }}" alt="Notre Académie" class="gallery-image">
                            <div class="gallery-overlay">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery-slide-content">
                            <img src="{{ asset('images/slider/4.jpg') }}" alt="Notre Académie" class="gallery-image">
                            <div class="gallery-overlay">
                            </div>
                        </div>
                    </div>
<!-- Full Width Swiper Gallery 
                    <div class="swiper-slide">
                        <div class="gallery-slide-content">
                            <img src="{{ asset('images/slider/2.jpg') }}" alt="Notre Académie" class="gallery-image">
                            <div class="gallery-overlay">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="gallery-slide-content">
                            <img src="{{ asset('images/slider/3.jpg') }}" alt="Notre Académie" class="gallery-image">
                            <div class="gallery-overlay">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="gallery-slide-content">
                            <img src="{{ asset('images/slider/1.jpg') }}" alt="Notre Académie" class="gallery-image">
                            <div class="gallery-overlay">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="gallery-slide-content">
                            <img src="{{ asset('images/slider/5.jpg') }}" alt="Notre Académie" class="gallery-image">
                            <div class="gallery-overlay">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="gallery-slide-content">
                            <img src="{{ asset('images/slider/6.jpg') }}" alt="Notre Académie" class="gallery-image">
                            <div class="gallery-overlay">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="gallery-slide-content">
                            <img src="{{ asset('images/slider/7.jpg') }}" alt="Notre Académie" class="gallery-image">
                            <div class="gallery-overlay">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="gallery-slide-content">
                            <img src="{{ asset('images/slider/8.jpg') }}" alt="Notre Académie" class="gallery-image">
                            <div class="gallery-overlay">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="gallery-slide-content">
                            <img src="{{ asset('images/slider/9.jpg') }}" alt="Notre Académie" class="gallery-image">
                            <div class="gallery-overlay">
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="gallery-slide-content">
                            <img src="{{ asset('images/slider/10.jpg') }}" alt="Notre Académie" class="gallery-image">
                            <div class="gallery-overlay">
                            </div>
                        </div>
                    </div>
                   -->
                </div>
                
                <!-- Navigation Arrows -->
                <div class="swiper-button-next gallery-swiper-button-next"></div>
                <div class="swiper-button-prev gallery-swiper-button-prev"></div>
                
                <!-- Pagination -->
                <div class="swiper-pagination gallery-swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section id="mission" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-[Montserrat]">Nos fondements éducatifs</h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
            Découvrez notre engagement pédagogique fondé sur la mission éducative et la vision d’avenir d’El Moumen Academy.
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
                Notre mission est d’accompagner chaque élève tout au long de son parcours scolaire avec une pédagogie différenciée, un encadrement régulier, et une écoute active afin de garantir sa réussite académique, son épanouissement personnel et le développement de ses compétences clés.
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
                Créer un environnement éducatif propice au développement intellectuel, émotionnel et social de chaque élève, en assurant une égalité des chances et un accompagnement humain et structuré tout au long de sa scolarité.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nos valeurs clés</h2>
            <p class="text-gray-600 text-lg">Des principes solides guidant chaque action : excellence, accessibilité, innovation et accompagnement bienveillant au quotidien.</p>
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
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Notre équipe enseignante</h2>
            <p class="text-gray-300 text-lg">Des professeurs passionnés, expérimentés et engagés dans l’encadrement pédagogique personnalisé de chaque élève inscrit.</p>
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
            
        @endif
    </div>
</section>

<!-- Buy Books Section with Background and Blurred Cards -->
<section id="books" class="relative w-full py-20">
    <!-- Background image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/bgsec.jpg') }}" alt="Background" class="w-full h-full object-cover object-center" />
        <div class="absolute inset-0" style="background: rgba(0,7,25,0.72);"></div>
    </div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-white text-4xl md:text-5xl font-bold mb-4 leading-tight font-[Montserrat]">
                Achetez Nos Livres Éducatifs
            </h2>
            <p class="text-blue-100 text-xl max-w-3xl mx-auto">
                Découvrez notre collection de livres spécialisés pour tous les niveaux d'enseignement
            </p>
        </div>


   
        <!-- Book Slider Container -->
        <div class="relative">
            <!-- Swiper Container -->
            <div class="swiper about-book-swiper">
                <div class="swiper-wrapper">
                    @forelse($books as $book)
                    <div class="swiper-slide">
                        <div class="backdrop-blur-lg bg-white/10 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group flex flex-col h-full">
                            <!-- Book Cover -->
                            <div class="relative h-64 flex-shrink-0 rounded-t-2xl overflow-hidden" style="background-color: #001226;">
                                @if($book->image_path)
                                    <div class="w-full h-full flex items-center justify-center p-4">
                                        <img src="{{ asset('storage/' . $book->image_path) }}" 
                                             alt="{{ $book->name }}" 
                                             class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-center text-white">
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
                                            <p class="text-lg font-semibold">{{ $book->category->name ?? 'Livre' }}</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Discount Badge -->
                                @if($book->has_discount)
                                    <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                        -{{ $book->discount_percentage }}%
                                    </div>
                                @endif
                            </div>

                            <!-- Book Info -->
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex-grow">
                                    <h3 class="text-white text-xl font-bold mb-2 line-clamp-2">{{ $book->name }}</h3>
                                    <p class="text-blue-100 mb-4 text-sm line-clamp-2">{{ Str::limit($book->description, 80) }}</p>
                                </div>
                                
                                <!-- Price and WhatsApp Button -->
                                <div class="mt-auto flex-shrink-0">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="w-1/2">
                                            @if($book->has_discount)
                                                <span class="text-sm text-blue-200 line-through block">{{ number_format($book->price, 2) }} DH</span>
                                                <span class="text-lg font-bold text-white block">{{ number_format($book->final_price, 2) }} DH</span>
                                            @else
                                                <span class="text-lg font-bold text-white block">{{ number_format($book->price, 2) }} DH</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($whatsappNumber)
                                        <a href="{{ $whatsappNumber->whatsapp_url }}?text=Bonjour! Je souhaite acheter le livre '{{ $book->name }}' au prix de {{ number_format($book->final_price, 2) }} DH. Pouvez-vous me donner plus d'informations?" 
                                           target="_blank"
                                           onclick="trackBookClick({{ $book->id }})"
                                           class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center gap-1 w-full justify-center whitespace-nowrap">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                            </svg>
                                            Acheter
                                        </a>
                                    @else
                                        <a href="{{ route('books.show', $book) }}" 
                                           class="bg-gray-800 text-white px-3 py-2 rounded-lg text-sm font-semibold hover:bg-gray-700 transition-colors w-full justify-center">
                                            Voir Détails
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <!-- Fallback Cards when no books are available -->
                    @for($i = 1; $i <= 4; $i++)
                    <div class="swiper-slide">
                        <div class="backdrop-blur-lg bg-white/10 rounded-2xl shadow-lg group flex flex-col h-full">
                            <!-- Book Cover -->
                            <div class="relative h-64 flex-shrink-0 rounded-t-2xl overflow-hidden flex items-center justify-center" style="background-color: #001226;">
                                <div class="text-center text-white">
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
                                    <p class="text-lg font-semibold">
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

                            <!-- Book Info -->
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex-grow">
                                    <h3 class="text-white text-xl font-bold mb-2">
                                        @switch($i)
                                            @case(1)
                                                Manuel de Mathématiques
                                                @break
                                            @case(2)
                                                Physique Moderne
                                                @break
                                            @case(3)
                                                Chimie Générale
                                                @break
                                            @case(4)
                                                Biologie Cellulaire
                                                @break
                                        @endswitch
                                    </h3>
                                    <p class="text-blue-100 mb-4 text-sm">
                                        @switch($i)
                                            @case(1)
                                                Livre complet pour maîtriser les mathématiques de votre niveau
                                                @break
                                            @case(2)
                                                Concepts fondamentaux de la physique avec exercices pratiques
                                                @break
                                            @case(3)
                                                Guide essentiel pour comprendre la chimie moderne
                                                @break
                                            @case(4)
                                                Exploration complète du monde cellulaire et moléculaire
                                                @break
                                        @endswitch
                                    </p>
                                </div>
                                
                                <!-- Price and Button -->
                                <div class="mt-auto flex-shrink-0">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="w-1/2">
                                            <span class="text-lg font-bold text-white block">
                                                @switch($i)
                                                    @case(1)
                                                        120.00 DH
                                                        @break
                                                    @case(2)
                                                        150.00 DH
                                                        @break
                                                    @case(3)
                                                        135.00 DH
                                                        @break
                                                    @case(4)
                                                        140.00 DH
                                                        @break
                                                @endswitch
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <button class="bg-gray-600 text-white px-3 py-2 rounded-lg text-sm font-semibold w-full opacity-50 cursor-not-allowed">
                                        Bientôt Disponible
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                    @endforelse
                </div>
                
                <!-- Navigation Arrows (hidden on mobile) -->
                <div class="swiper-button-next about-book-swiper-button-next hidden lg:flex"></div>
                <div class="swiper-button-prev about-book-swiper-button-prev hidden lg:flex"></div>
                
                <!-- Pagination -->
                <div class="swiper-pagination about-book-swiper-pagination"></div>
            </div>
        </div>

        <!-- View All Books Button -->
        <div class="text-center mt-12">
            <a href="{{ route('books.index') }}" 
               class="inline-flex items-center gap-2 bg-white text-[#001226] px-8 py-4 rounded-full hover:bg-gray-100 transition-colors font-semibold shadow-lg">
                Voir Tous les Livres
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<style>
/* Custom Swiper Styles for About Books */
.about-book-swiper {
    padding: 0 60px 40px 60px;
}

.about-book-swiper .swiper-slide {
    display: flex !important;
    height: auto !important;
    min-height: 500px;
}

.about-book-swiper .swiper-slide > div {
    width: 100%;
    display: flex;
    flex-direction: column;
}

.about-book-swiper-button-next,
.about-book-swiper-button-prev {
    color: white;
    background: rgba(255, 255, 255, 0.2);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    backdrop-blur-sm;
    transition: all 0.3s ease;
}

.about-book-swiper-button-next:hover,
.about-book-swiper-button-prev:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

.about-book-swiper-button-next::after,
.about-book-swiper-button-prev::after {
    font-size: 16px;
    font-weight: bold;
}

.about-book-swiper-pagination {
    bottom: 0;
}

.about-book-swiper-pagination .swiper-pagination-bullet {
    background: rgba(255, 255, 255, 0.3);
    opacity: 1;
}

.about-book-swiper-pagination .swiper-pagination-bullet-active {
    background: #06b6d4;
}

/* Ensure button and price section is always visible */
.about-book-swiper .swiper-slide .flex-shrink-0 {
    flex-shrink: 0 !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .about-book-swiper {
        padding: 0 20px 40px 20px;
    }
    
    .about-book-swiper-button-next,
    .about-book-swiper-button-prev {
        display: none !important;
    }
}
</style>

<script>
// Initialize About Book Swiper
document.addEventListener('DOMContentLoaded', function() {
    const aboutBookSwiper = new Swiper('.about-book-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.about-book-swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.about-book-swiper-button-next',
            prevEl: '.about-book-swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        },
        // Enable touch/swipe gestures
        allowTouchMove: true,
        // Enable mouse drag
        allowMouseEvents: true,
    });
});

function trackBookClick(bookId) {
    fetch(`/books/${bookId}/click`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).catch(error => {
        console.error('Error tracking book click:', error);
    });
}
</script>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-cyan-400 to-blue-500">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
        Commencez aujourd’hui
        </h2>
        <p class="text-xl text-white mb-8 opacity-90">
        Faites le premier pas vers la réussite scolaire avec nos cours personnalisés et notre équipe dédiée.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ url('/contact') }}" class="bg-white text-gray-900 px-8 py-4 rounded-full font-medium hover:bg-gray-100 transition shadow-lg">
            Nous contacter
            </a>
            <a href="{{ url('/') }}#Individual" class="border-2 border-white text-white px-8 py-4 rounded-full font-medium hover:bg-white hover:text-gray-900 transition">
            Voir les cours
            </a>
        </div>
    </div>
</section>

<style>
/* Gallery Swiper Styles */
.gallery-swiper-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
}

.gallery-swiper {
    width: 100%;
    height: 500px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

.gallery-swiper .swiper-slide {
    position: relative;
    width: 100%;
    height: 100%;
}

.gallery-slide-content {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease-in-out;
}

.gallery-swiper .swiper-slide-active .gallery-image {
    transform: scale(1.05);
}

.gallery-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
    color: white;
    padding: 40px 30px 30px;
    transform: translateY(100%);
    transition: transform 0.4s ease-in-out;
}

.gallery-swiper .swiper-slide-active .gallery-overlay {
    transform: translateY(0);
}

.gallery-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 8px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.6s ease-in-out 0.2s;
}

.gallery-description {
    font-size: 1rem;
    opacity: 0.9;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.6s ease-in-out 0.4s;
}

.gallery-swiper .swiper-slide-active .gallery-title,
.gallery-swiper .swiper-slide-active .gallery-description {
    opacity: 1;
    transform: translateY(0);
}

/* Navigation Buttons */
.gallery-swiper-button-next,
.gallery-swiper-button-prev {
    color: white;
    background: rgba(255, 255, 255, 0.15);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.gallery-swiper-button-next:hover,
.gallery-swiper-button-prev:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: scale(1.1);
}

.gallery-swiper-button-next::after,
.gallery-swiper-button-prev::after {
    font-size: 18px;
    font-weight: bold;
}

/* Pagination */
.gallery-swiper-pagination {
    bottom: 20px;
}

.gallery-swiper-pagination .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background: rgba(255, 255, 255, 0.3);
    opacity: 1;
    transition: all 0.3s ease;
}

.gallery-swiper-pagination .swiper-pagination-bullet-active {
    background: #06b6d4;
    transform: scale(1.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    .gallery-swiper {
        height: 400px;
        border-radius: 15px;
    }
    
    .gallery-overlay {
        padding: 30px 20px 20px;
    }
    
    .gallery-title {
        font-size: 1.25rem;
    }
    
    .gallery-description {
        font-size: 0.9rem;
    }
    
    .gallery-swiper-button-next,
    .gallery-swiper-button-prev {
        width: 40px;
        height: 40px;
    }
    
    .gallery-swiper-button-next::after,
    .gallery-swiper-button-prev::after {
        font-size: 16px;
    }
}

@media (max-width: 480px) {
    .gallery-swiper {
        height: 350px;
        border-radius: 12px;
    }
    
    .gallery-overlay {
        padding: 25px 15px 15px;
    }
    
    .gallery-title {
        font-size: 1.1rem;
    }
    
    .gallery-description {
        font-size: 0.85rem;
    }
}
</style>

<script>
// Initialize Gallery Swiper when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Gallery Swiper
    const gallerySwiper = new Swiper('.gallery-swiper', {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        speed: 800,
        effect: 'slide',
        pagination: {
            el: '.gallery-swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: '.gallery-swiper-button-next',
            prevEl: '.gallery-swiper-button-prev',
        },
        // Enhanced touch/swipe gestures
        allowTouchMove: true,
        touchRatio: 1,
        touchAngle: 45,
        grabCursor: true,
        // Smooth transitions
        roundLengths: true,
        // Callbacks for animations
        on: {
            slideChangeTransitionStart: function () {
                // Add any custom animation logic here if needed
            },
            slideChangeTransitionEnd: function () {
                // Trigger any post-transition effects
            }
        }
    });
    
    // Pause autoplay on hover
    const swiperContainer = document.querySelector('.gallery-swiper');
    if (swiperContainer) {
        swiperContainer.addEventListener('mouseenter', () => {
            gallerySwiper.autoplay.stop();
        });
        
        swiperContainer.addEventListener('mouseleave', () => {
            gallerySwiper.autoplay.start();
        });
    }
});
</script>

@endsection 