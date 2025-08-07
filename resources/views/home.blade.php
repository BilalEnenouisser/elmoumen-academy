@extends('layouts.app')

@section('content')



<!-- Hero Section -->
    

<div class="relative w-full min-h-[600px] md:min-h-[700px] flex items-center justify-center overflow-hidden" style="background: linear-gradient(120deg, #002347 0%, #0a3d62 100%);">
    <!-- Background image overlay -->
    <img src="{{ asset('images/bg1.jpg') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-60 pointer-events-none z-0">

    <!-- Centered and bottom-aligned person image - hidden on mobile -->
    <img src="{{ asset('images/image1.png') }}" alt="Person" class="hidden md:block absolute left-[55%] bottom-0 transform -translate-x-1/2  h-[400px] lg:h-[600px] object-contain drop-shadow-2xl">

    <div class="relative z-20 flex flex-col md:flex-row w-full max-w-7xl mx-auto items-center justify-between px-6 sm:px-8 py-12 md:py-16">
        <!-- Left: Text -->
        <div class="w-full md:w-1/2 max-w-lg text-center md:text-left text-white mb-12 md:mb-0">
            <h1 class="text-4xl sm:text-5xl font-normal	leading-[1.3] mb-6">
                <span class="text-cyan-400">Bienvenue sur</span> El Moumen Academy<br>
                votre avenir <br>
                commence ici
            </h1>
            <p class="mb-8 text-base sm:text-sm text-gray-200">Un accompagnement pédagogique personnalisé pour chaque élève, tous niveaux confondus, avec des résultats prouvés et durables.</p>
            <a href="#Individual" class="inline-block bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white px-6 py-3 sm:px-8 sm:py-3 rounded-full   shadow-lg transition">Voir les cours individuels</a>
        </div>

        <!-- Right: Play Button - centered on mobile -->
        <div class="w-full md:w-1/6 flex justify-center md:justify-end mt-8 md:mt-0">
            <button class="flex items-center justify-center w-20 h-20 sm:w-24 sm:h-24 rounded-full border-2 border-cyan-400 bg-white bg-opacity-10 hover:bg-opacity-20 transition shadow-lg">
                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-cyan-400" fill="currentColor" viewBox="0 0 48 48">
                    <circle cx="24" cy="24" r="23" fill="none"/>
                    <polygon points="20,16 34,24 20,32" fill="currentColor"/>
                </svg>
            </button>
        </div>
    </div>
</div>




<!-- Section 2: Academic Level Cards -->




@php
    $cards = [
        ['title' => 'Primaire', 'images' => 'primaire.jpg', 'link' => '/courses/primaire'],
        ['title' => 'Collège', 'images' => 'college.jpg', 'link' => '/courses/college'],
        ['title' => 'Lycée', 'images' => 'lycee.jpg', 'link' => '/courses/lycee'],
        ['title' => 'Concours', 'images' => 'concours.jpg', 'link' => '/courses/concours'],
    ];
@endphp

<div class="w-full bg-[#001226] py-20 px-2">
    <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($cards as $card)
            <a href="{{ $card['link'] }}" class="block group">
                <div class="relative rounded-2xl overflow-hidden border-2 border-[#001226]">
                    <!-- Background image - now clearly visible -->
                    <img src="{{ asset('images/' . $card['images']) }}" 
                         alt="{{ $card['title'] }}" 
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    
                    <!-- Reduced opacity gradient (now using 70% opacity) -->
                    <div class="absolute inset-0 bg-gradient-to-t from-[#001226ee] to-[#00122600]"></div>
                    
                    <!-- Text -->
                    <div class="absolute bottom-4 left-0 w-full text-center z-10">
                        <span class="text-white text-xl font-medium	 drop-shadow-lg">{{ $card['title'] }}</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>


<!-- Section 3: Pub Marquee Bar -->
@php
    $marquees = \App\Models\Marquee::latest()->get();
@endphp

@if($marquees->count())
    <div class="bg-[#DEE7F1] pt-14   px-6 rounded-lg shadow-sm">
        <!-- Centered Title -->
        <div class="text-center mb-3">
            <h3 class="text-gray-800 text-2xl md:text-3xl text-center mb-16 leading-tight font-[Montserrat]">Les Annonces</h3>
        </div>
        
        <!-- Marquee Content -->
        <div class="bg-white p-3 rounded-md border border-blue-100">
            <marquee behavior="scroll" direction="left" scrollamount="6" class="text-blue-900">
                @foreach($marquees as $item)
                    <span class="inline-flex items-center mr-8">
                        <svg class="w-4 h-4 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ $item->text }}
                    </span>
                @endforeach
            </marquee>
        </div>
    </div>
@endif

<section class="w-full py-32" style="background-color: #DEE7F1;">
    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-10 px-4">
        <!-- Left: Image and Info -->
        <div class="flex-1 flex flex-col">
            <div class="rounded-2xl overflow-hidden mb-6">
                <img src="{{ asset('images/about-us.jpg') }}" alt="À Propos" class="w-full h-64 md:h-80 object-cover" />
            </div>
            <h2 class="text-3xl md:text-4xl font-normal  mb-2 text-gray-800 font-[Montserrat]">El Moumen Academy</h2>
            <p class="text-gray-600 mb-6">
            Centre dirigé par des enseignants expérimentés avec suivi annuel, orientation, soutien intensif et activités pédagogiques variées.
            </p>
            <div class="flex flex-row gap-4">
                <div class="flex-1 flex flex-col items-center border-r border-gray-300 last:border-none">
                    <span class="text-3xl font-bold text-gray-800">100%</span>
                    <span class="text-gray-500">Réussite</span>
                </div>
                <div class="flex-1 flex flex-col items-center border-r border-gray-300 last:border-none">
                    <span class="text-3xl font-bold text-gray-800">300+</span>
                    <span class="text-gray-500">Élèves </span>
                </div>
                <div class="flex-1 flex flex-col items-center">
                    <span class="text-3xl font-bold text-gray-800">9+</span>
                    <span class="text-gray-500">Enseignants</span>
                </div>
            </div>
        </div>
        <!-- Right: Vision, Mission, Social -->
        <div class="flex-1 flex flex-col justify-center">
            <h2 class="text-4xl md:text-5xl font-normal mb-8 text-gray-800 font-[Montserrat] leading-tight">
            Un centre engagé pour<br>votre réussite scolaire
            </h2>
            <div class="space-y-6 mb-8">
                <div class="flex items-center bg-white rounded-2xl shadow-md p-6 gap-6">
                    <div class="bg-[#0F2239] rounded-full p-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"></path>
                            <path d="M2 20c0-4.418 7.163-8 10-8s10 3.582 10 8"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl   text-gray-800 mb-1">Notre Vision</h3>
                        <p class="text-gray-600 text-base">Assurer un futur brillant à chaque élève grâce à un encadrement pédagogique humain, professionnel et constant..</p>
                    </div>
                </div>
                <div class="flex items-center bg-white rounded-2xl shadow-md p-6 gap-6">
                    <div class="bg-[#0F2239] rounded-full p-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 8v4l3 3"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl   text-gray-800 mb-1">Notre Mission</h3>
                        <p class="text-gray-600 text-base">Encadrer, motiver et accompagner chaque élève de façon individuelle pour garantir réussite et développement personnel durable.</p>
                    </div>
                </div>
            </div>
            <hr class="mb-4 border-gray-300">
            <div class="flex items-center justify-between">
                <span class="text-lg text-gray-700 font-medium">Réseaux Sociaux :</span>
                <div class="flex gap-4">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/centreelmoumen/" target="_blank" class="bg-[#0F2239] text-white rounded-full p-2 hover:bg-blue-700 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <!-- Facebook -->
                    <a href="https://web.facebook.com/centreelmoumen" target="_blank" class="bg-[#0F2239] text-white rounded-full p-2 hover:bg-blue-700 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@abdelwahedelmoumen?_t=ZS-8ygKXDqNurs&_r=1" target="_blank" class="bg-[#0F2239] text-white rounded-full p-2 hover:bg-blue-700 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 2.26-3.87 3.85-6.41 4.04-2.23.16-4.48-.31-6.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                        </svg>
                    </a>
                    <!-- Kwai -->
                    <a href="https://www.kwai.com/@abdelwahedelmo883" target="_blank" class="bg-[#0F2239] text-white rounded-full p-2 hover:bg-blue-700 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </a>
                    <!-- YouTube -->
                    <a href="https://www.youtube.com/@AbdelwahedElMoumen" target="_blank" class="bg-[#0F2239] text-white rounded-full p-2 hover:bg-blue-700 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="py-32 px-6 bg-white">
    <div class="max-w-4xl  mx-auto text-center">
        <h2 class="text-4xl font-bold mb-4 font-[Montserrat]">Pourquoi nous faire confiance ?</h2>
        <p class="text-gray-600 mb-6">Résultats excellents, pédagogie innovante, suivi personnalisé, ambiance motivante, événements éducatifs tout au long de l’année scolaire.</p>
        <img src="{{ asset('images/imageElMoumen2.png') }}" class="mx-auto rounded shadow" alt="Academy Presentation">
    </div>
</section>


<!-- Section 3: Advice Cards section  - RTL Adjusted -->
<section class="relative w-full py-20" dir="rtl">
    <!-- Background image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/bgsec.jpg') }}" alt="Background" class="w-full h-full object-cover object-center" />
        <div class="absolute inset-0" style="background: rgba(0,7,25,0.72);"></div>
    </div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        <h2 class="text-white text-4xl md:text-5xl font-bold text-center mb-16 leading-tight font-[Montserrat]">
            نصـــــائــــــح
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2  lg:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="backdrop-blur-lg bg-white/10 cursor-pointer rounded-2xl p-6 flex flex-col text-right shadow-lg" onclick="window.location.href='{{ route('videos.category', 'abaa') }}'">
                <!-- Image -->
                <div class="relative mb-4">
                    <img src="{{ asset('images/blog/1.jpeg') }}" alt="مدونة 1" class="w-full h-60 object-cover rounded-xl">
                    <!-- Tag -->
                    <div class="absolute bottom-2 right-2 bg-white text-blue-800 px-3 py-1 rounded-lg text-sm font-semibold">آباء</div>
                </div>
                <!-- Title -->
                <h3 class="text-white text-xl font-bold mb-2">فضاء خاص بالآباء</h3>
                <!-- Description -->
                <p class="text-blue-100 mb-4 text-sm">
                    اكتشف استراتيجيات فعالة للتميز في دوراتك عبر الإنترنت والحفاظ على التحفيز.
                </p>
                <!-- Button -->
                <button class="bg-white text-blue-800 px-4 py-2 rounded-lg font-semibold mt-auto flex items-center justify-center transition-colors duration-200 hover:bg-gray-100">
                    شاهد الفيديوهات
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
            
            <!-- Card 2 -->
            <div class="backdrop-blur-lg bg-white/10 cursor-pointer rounded-2xl p-6 flex flex-col text-right shadow-lg" onclick="window.location.href='{{ route('videos.category', 'talamid') }}'">
                <!-- Image -->
                <div class="relative mb-4">
                    <img src="{{ asset('images/blog/3.jpg') }}" alt="مدونة 2" class="w-full h-60 object-cover rounded-xl">
                    <!-- Tag -->
                    <div class="absolute bottom-2 right-2 bg-white text-blue-800 px-3 py-1 rounded-lg text-sm font-semibold">تلاميذ</div>
                </div>
                <!-- Title -->
                <h3 class="text-white text-xl font-bold mb-2">فضاء خاص بالتلاميذ</h3>
                <!-- Description -->
                <p class="text-blue-100 mb-4 text-sm">
                    زِدْ إنتاجيتك وقدرتك على الاستيعاب باستخدام هذه التقنيات المجربة.
                </p>
                <!-- Button -->
                <button class="bg-white text-blue-800 px-4 py-2 rounded-lg font-semibold mt-auto flex items-center justify-center transition-colors duration-200 hover:bg-gray-100">
                    شاهد الفيديوهات
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
            
            <!-- Card 3 -->
            <div class="backdrop-blur-lg bg-white/10 cursor-pointer rounded-2xl p-6 flex flex-col text-right shadow-lg" onclick="window.location.href='{{ route('videos.category', 'ajji') }}'">
                <!-- Image -->
                <div class="relative mb-4">
                    <img src="{{ asset('images/blog/2.jpg') }}" alt="مدونة 3" class="w-full h-60 object-cover rounded-xl">
                    <!-- Tag -->
                    <div class="absolute bottom-2 right-2 bg-white text-blue-800 px-3 py-1 rounded-lg text-sm font-semibold">أجي تغير حياتك</div>
                </div>
                <!-- Title -->
                <h3 class="text-white text-xl font-bold mb-2">فضاء خاص بالناس لي باغين يغيرو حياتهم</h3>
                <!-- Description -->
                <p class="text-blue-100 mb-4 text-sm">
                    انضم إلى ندوتنا المجانية لتعلم كيفية التحضير والنجاح في اختباراتك.
                </p>
                <!-- Button -->
                <button class="bg-white text-blue-800 px-4 py-2 rounded-lg font-semibold mt-auto flex items-center justify-center transition-colors duration-200 hover:bg-gray-100">
                    شاهد الفيديوهات
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>



<!-- Section 5: Animated Numbers or Counters -->
<section class="py-32 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="bg-[#001226] rounded-2xl p-12 backdrop-blur-lg">
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Counter 1: Successfully Trained -->
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mr-4">
                        <svg class="w-8 h-8" style="color: #001226;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-3xl md:text-4xl font-bold text-white" x-data="{ count: 0, target: 10 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
                        <div class="text-white text-sm">Enseignants</div>
                    </div>
                </div>

                <!-- Counter 2: Classes Completed -->
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mr-4">
                        <svg class="w-8 h-8" style="color: #001226;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-3xl md:text-4xl font-bold text-white" x-data="{ count: 0, target: 500 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
                        <div class="text-white text-sm">Cours terminés</div>
                    </div>
                </div>

                <!-- Counter 3: Satisfaction Rate -->
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mr-4">
                        <svg class="w-8 h-8" style="color: #001226;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-3xl md:text-4xl font-bold text-white" x-data="{ count: 0, target: 100 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '%'"></div>
                        <div class="text-white text-sm">Réussite</div>
                    </div>
                </div>

                <!-- Counter 4: Students Community -->
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mr-4">
                        <svg class="w-8 h-8" style="color: #001226;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-3xl md:text-4xl font-bold text-white" x-data="{ count: 0, target: 3 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
                        <div class="text-white text-sm">Partenaires </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 3.5: Book Slider -->
@include('components.book-slider')

<!-- Section 4: Courses Individual -->

@php
    $whatsappNumber = \App\Models\WhatsAppNumber::getActiveNumber();
@endphp

<section id="Individual" class="relative w-full py-20">
    <div class="absolute inset-0">
        <img src="{{ asset('images/bgsec.jpg') }}" alt="Background" class="w-full h-full object-cover object-center" />
        <div class="absolute inset-0" style="background: rgba(0,7,25,0.72);"></div>
    </div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        <!-- Section Title -->
        <div class="text-center mb-16">
            <h2 class="text-3xl text-white md:text-4xl font-bold text-gray-900 mb-4">Cours Individuels</h2>
        </div>
        
        
        <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-8 md:p-12 shadow-xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Side - Image -->
                <div class="space-y-6">
                    <div class="relative h-full">
                        <img src="{{ asset('images/about-us.jpg') }}" alt="Cours Individuels" class="w-full h-full object-cover rounded-xl shadow-lg" />
                        <div class="absolute inset-0 rounded-xl" style="background-color: rgba(1, 14, 44, 0.6);"></div>
                    </div>
                </div>

                <!-- Right Side - Contact Form -->
                <div class="space-y-6">
                    <div class="text-center lg:text-left">
                        <h3 class="text-white text-2xl font-bold mb-2">Envoyez-nous un Message</h3>
                        <p class="text-blue-100">Nous vous répondrons dans les plus brefs délais</p>
                    </div>

                    <form id="contactForm" class="space-y-4">
                        <div>
                            <label for="name" class="block text-white font-medium mb-2">Votre Nom</label>
                            <input type="text" id="name" name="name" required 
                                   class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/60 focus:outline-none focus:border-blue-400 transition-colors"
                                   placeholder="Entrez votre nom complet">
                        </div>

                        <div>
                            <label for="message" class="block text-white font-medium mb-2">Votre Message</label>
                            <textarea id="message" name="message" rows="4" required
                                      class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/60 focus:outline-none focus:border-blue-400 transition-colors resize-none"
                                      placeholder="Décrivez votre besoin ou posez votre question..."></textarea>
                        </div>

                        @if($whatsappNumber)
                        <button type="button" onclick="sendWhatsAppMessage()" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-300 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                            Envoyer sur WhatsApp
                        </button>
                        @else
                        <div class="text-center text-red-300 bg-red-500/20 p-4 rounded-lg">
                            WhatsApp non configuré. Veuillez contacter l'administrateur.
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function sendWhatsAppMessage() {
    const name = document.getElementById('name').value.trim();
    const message = document.getElementById('message').value.trim();
    
    if (!name || !message) {
        alert('Veuillez remplir tous les champs');
        return;
    }
    
    @if($whatsappNumber)
    const whatsappText = `Bonjour! Je m'appelle ${name}. ${message}`;
    const whatsappUrl = `{{ $whatsappNumber->whatsapp_url }}?text=${encodeURIComponent(whatsappText)}`;
    window.open(whatsappUrl, '_blank');
    @endif
}
</script>






<!-- Section 6: Testimonials or Quotes -->
<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Questions fréquentes importantes</h2>
            <p class="text-gray-600 text-lg">Réponses claires à vos interrogations les plus fréquentes concernant nos services éducatifs, activités et organisation interne.</p>
        </div>
        
        <div class="space-y-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="flex items-center justify-between w-full p-6 text-left" onclick="toggleContactFAQ(1)">
                    <span class="font-medium text-gray-900">Quels niveaux sont acceptés ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="faq-content-contact-1" class="hidden px-6 pb-6">
                    <p class="text-gray-600">→ Tous niveaux : primaire, collège, lycée.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="flex items-center justify-between w-full p-6 text-left" onclick="toggleContactFAQ(2)">
                    <span class="font-medium text-gray-900">Avez-vous des cours en ligne ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="faq-content-contact-2" class="hidden px-6 pb-6">
                    <p class="text-gray-600">→ Oui, en direct via réseaux sociaux.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="flex items-center justify-between w-full p-6 text-left" onclick="toggleContactFAQ(3)">
                    <span class="font-medium text-gray-900">Y a-t-il des cours gratuits disponibles ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="faq-content-contact-3" class="hidden px-6 pb-6">
                    <p class="text-gray-600">Oui, nous proposons des cours d'essai gratuits et certaines ressources éducatives gratuites. Contactez-nous pour plus d'informations sur nos offres gratuites.</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="flex items-center justify-between w-full p-6 text-left" onclick="toggleContactFAQ(4)">
                    <span class="font-medium text-gray-900">Y a-t-il des cours gratuits ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="faq-content-contact-4" class="hidden px-6 pb-6">
                    <p class="text-gray-600">→ Oui, pendant les périodes d’examens.</p>
                </div>
            </div>
            

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="flex items-center justify-between w-full p-6 text-left" onclick="toggleContactFAQ(5)">
                    <span class="font-medium text-gray-900">Fournissez-vous les manuels ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="faq-content-contact-5" class="hidden px-6 pb-6">
                    <p class="text-gray-600">→ Oui, adaptés selon le niveau.</p>
                </div>
            </div>
            
        </div>
    </div>
</section>

<script>
function toggleContactFAQ(id) {
    const content = document.getElementById(`faq-content-contact-${id}`);
    const icon = document.getElementById(`faq-icon-${id}`);
    
    // Close all other FAQ items
    document.querySelectorAll('[id^="faq-content-contact-"]').forEach(item => {
        if (item.id !== `faq-content-contact-${id}`) {
            item.classList.add('hidden');
            const otherIcon = document.getElementById(`faq-icon-${item.id.split('-').pop()}`);
            if (otherIcon) {
                otherIcon.style.transform = 'rotate(0deg)';
            }
        }
    });
    
    // Toggle current item
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        content.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>

<!-- Alpine.js CDN (if not already included) -->
<script src="//unpkg.com/alpinejs" defer></script>

<!-- Flowbite JavaScript for Accordion -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>





@php
    $testimonials = \App\Models\Testimonial::active()->orderBy('created_at', 'desc')->take(6)->get();
@endphp

<!-- Section 4.5: Testimonials Slider -->
<section class="relative w-full py-20">
    <!-- Background image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/bgsec.jpg') }}" alt="Background" class="w-full h-full object-cover object-center" />
        <div class="absolute inset-0" style="background: rgba(0,7,25,0.72);"></div>
    </div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl text-white md:text-4xl font-bold text-gray-900 mb-4">Avis et Témoignages</h2>
            <p class="text-gray-600  text-white text-lg">Découvrez les témoignages sincères de nos élèves, parents et partenaires sur leur expérience avec notre académie.</p>
        </div>
        
        @if($testimonials->count() > 0)
            <!-- Testimonials Swiper Container -->
            <div class="swiper testimonials-swiper">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-6 relative shadow-lg h-full">
                            <!-- Decorative Line -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-r-full"></div>
                            <!-- Content -->
                            <div class="pt-4">
                                <p class="text-white text-opacity-90 mb-6 leading-relaxed text-base">
                                    "{{ $testimonial->message }}"
                                </p>
                                <div class="flex items-center">
                                    @if($testimonial->image)
                                        <img src="{{ Storage::url($testimonial->image) }}" 
                                             alt="{{ $testimonial->name }}" 
                                             class="w-10 h-10 rounded-full object-cover mr-3">
                                    @else
                                        <div class="w-10 h-10 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-bold text-sm">{{ strtoupper(substr($testimonial->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="text-white font-bold text-base">{{ $testimonial->name }}</h4>
                                        <p class="text-cyan-400 text-xs">{{ $testimonial->role }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Navigation Arrows (hidden on mobile) -->
                <div class="swiper-button-next testimonials-swiper-button-next hidden lg:flex"></div>
                <div class="swiper-button-prev testimonials-swiper-button-prev hidden lg:flex"></div>
                
                <!-- Pagination -->
                <div class="swiper-pagination testimonials-swiper-pagination"></div>
            </div>
        @else
            <!-- No testimonials message -->
            <div class="text-center">
                <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-8 max-w-2xl mx-auto">
                    <p class="text-white text-opacity-90 text-lg mb-4">
                        Aucun témoignage disponible pour le moment.
                    </p>
                    <p class="text-white text-opacity-70">
                        Les témoignages de nos étudiants apparaîtront ici.
                    </p>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
/* Custom Testimonials Swiper Styles */
.testimonials-swiper {
    padding: 0 60px 40px 60px;
}

.testimonials-swiper .swiper-slide {
    height: auto;
}

.testimonials-swiper-button-next,
.testimonials-swiper-button-prev {
    color: white;
    background: rgba(255, 255, 255, 0.2);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    backdrop-blur-sm;
    transition: all 0.3s ease;
}

.testimonials-swiper-button-next:hover,
.testimonials-swiper-button-prev:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

.testimonials-swiper-button-next::after,
.testimonials-swiper-button-prev::after {
    font-size: 16px;
    font-weight: bold;
}

.testimonials-swiper-pagination {
    bottom: 0;
}

.testimonials-swiper-pagination .swiper-pagination-bullet {
    background: rgba(255, 255, 255, 0.3);
    opacity: 1;
}

.testimonials-swiper-pagination .swiper-pagination-bullet-active {
    background: #06b6d4;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .testimonials-swiper {
        padding: 0 20px 40px 20px;
    }
    
    .testimonials-swiper-button-next,
    .testimonials-swiper-button-prev {
        display: none !important;
    }
}
</style>

<script>
// Initialize Testimonials Swiper
document.addEventListener('DOMContentLoaded', function() {
    const testimonialsSwiper = new Swiper('.testimonials-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.testimonials-swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.testimonials-swiper-button-next',
            prevEl: '.testimonials-swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
        // Enable touch/swipe gestures
        allowTouchMove: true,
        // Enable mouse drag
        allowMouseEvents: true,
    });
});
</script>



<!-- Map and Info Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Section Title and Description -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 font-[Montserrat]">Localisation et Informations</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Découvrez où nous nous trouvons et comment nous contacter. Notre équipe est disponible pour répondre à toutes vos questions.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Map Column -->
            <div class="order-2 lg:order-1">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden h-full">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d980.1277641196476!2d-6.765718982304768!3d34.066770846356235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76902afb2fff9%3A0xd4a7ae12def833da!2scentre%20el%20moumen!5e1!3m2!1sar!2sma!4v1754102221617!5m2!1sar!2sma" class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            <p class="text-lg font-semibold">Carte Interactive</p>
                            <p class="text-sm">Localisation d'Elmoumen Academy</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Column -->
            <div class="order-1 lg:order-2">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Informations de Contact</h3>
                    
                    <!-- Contact Info Items -->
                    <div class="space-y-6 mb-8">
                        <!-- Phone -->
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-[#001226] rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Téléphone</h4>
                                <p class="text-gray-600">+212 600 000 000</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-[#001226] rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Email</h4>
                                <p class="text-gray-600">contact@elmoumen-academy.ma</p>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-[#001226] rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Heures d'Ouverture</h4>
                                <p class="text-gray-600">Lun-Ven: 8h-18h | Sam: 9h-16h</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="border-t pt-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Envoyez-nous un message</h4>
                        
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                <ul class="list-disc list-inside text-sm">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('messages.store') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label for="home_name" class="block text-gray-700 mb-1">Nom Complet *</label>
                                <input type="text" id="home_name" name="name" required 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#001226] focus:border-[#001226] transition"
                                       placeholder="Votre nom complet">
                            </div>
                            <div>
                                <label for="home_phone" class="block text-gray-700 mb-1">Numéro de Téléphone *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm">+212</span>
                                    </div>
                                    <input type="tel" id="home_phone" name="phone" required 
                                           class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#001226] focus:border-[#001226] transition"
                                           placeholder="600112233"
                                           pattern="[0-9]{9}" 
                                           title="Veuillez entrer un numéro de téléphone valide (9 chiffres)">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Exemple: 600112233 (sans le +212)</p>
                            </div>
                            <div>
                                <label for="home_subject" class="block text-gray-700 mb-1">Sujet *</label>
                                <select id="home_subject" name="subject" required 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#001226] focus:border-[#001226] transition">
                                    <option value="">Sélectionnez un sujet</option>
                                    <option value="inscription">Inscription aux cours</option>
                                    <option value="information">Demande d'information</option>
                                    <option value="support">Support technique</option>
                                    <option value="partnership">Partenariat</option>
                                    <option value="other">Autre</option>
                                </select>
                            </div>
                            <div>
                                <label for="home_message" class="block text-gray-700 mb-1">Message *</label>
                                <textarea id="home_message" name="message" rows="4" required 
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#001226] focus:border-[#001226] transition resize-none"
                                          placeholder="Décrivez votre demande en détail..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-[#001226] hover:bg-[#0a1a2e] text-white py-3 rounded-lg font-medium transition duration-300 shadow-lg hover:shadow-xl">
                                Envoyer le Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
