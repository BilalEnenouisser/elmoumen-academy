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
                <span class="text-cyan-400">Transformer</span> les Vies<br>
                Par l'Éducation<br>
                En Ligne.
            </h1>
            <p class="mb-8 text-base sm:text-sm text-gray-200">Rejoignez Elmoumen Academy pour une éducation d'excellence adaptée à tous les niveaux : Primaire, Collège, Lycée et Concours.</p>
            <a href="#" class="inline-block bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white px-6 py-3 sm:px-8 sm:py-3 rounded-full   shadow-lg transition">En Savoir Plus</a>
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
    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
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
            <h2 class="text-3xl md:text-4xl font-normal  mb-2 text-gray-800 font-[Montserrat]">Développer l'Excellence</h2>
            <p class="text-gray-600 mb-6">
                Elmoumen Academy s'engage à fournir une éducation de qualité supérieure avec des professeurs expérimentés et des méthodes d'apprentissage innovantes.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1 flex flex-col items-center border-r border-gray-300 last:border-none">
                    <span class="text-3xl font-bold text-gray-800">5+</span>
                    <span class="text-gray-500">Années d'Expérience</span>
                </div>
                <div class="flex-1 flex flex-col items-center border-r border-gray-300 last:border-none">
                    <span class="text-3xl font-bold text-gray-800">50+</span>
                    <span class="text-gray-500">Professeurs Qualifiés</span>
                </div>
                <div class="flex-1 flex flex-col items-center">
                    <span class="text-3xl font-bold text-gray-800">1000+</span>
                    <span class="text-gray-500">Étudiants Satisfaits</span>
                </div>
            </div>
        </div>
        <!-- Right: Vision, Mission, Social -->
        <div class="flex-1 flex flex-col justify-center">
            <h2 class="text-4xl md:text-5xl font-normal mb-8 text-gray-800 font-[Montserrat] leading-tight">
                Développer l'Excellence<br>Par l'Apprentissage en Ligne
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
                        <p class="text-gray-600 text-base">Devenir la référence en matière d'éducation en ligne au Maroc, en offrant des programmes d'excellence accessibles à tous.</p>
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
                        <p class="text-gray-600 text-base">Former les leaders de demain en offrant une éducation de qualité adaptée aux besoins de chaque étudiant.</p>
                    </div>
                </div>
            </div>
            <hr class="mb-4 border-gray-300">
            <div class="flex items-center justify-between">
                <span class="text-lg text-gray-700 font-medium">Réseaux Sociaux :</span>
                <div class="flex gap-4">
                    <a href="#" class="bg-[#0F2239] text-white rounded-full p-2 hover:bg-blue-700 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46 6c-.77.35-1.6.59-2.47.7a4.3 4.3 0 0 0 1.88-2.37 8.59 8.59 0 0 1-2.72 1.04A4.28 4.28 0 0 0 16.11 4c-2.37 0-4.29 1.92-4.29 4.29 0 .34.04.67.11.99C7.69 9.13 4.07 7.38 1.64 4.7c-.37.64-.58 1.39-.58 2.19 0 1.51.77 2.84 1.95 3.62-.72-.02-1.4-.22-1.99-.55v.06c0 2.11 1.5 3.87 3.5 4.27-.36.1-.74.16-1.13.16-.28 0-.54-.03-.8-.08.54 1.68 2.11 2.9 3.97 2.93A8.6 8.6 0 0 1 2 19.54a12.13 12.13 0 0 0 6.56 1.92c7.88 0 12.2-6.53 12.2-12.2 0-.19 0-.37-.01-.56A8.7 8.7 0 0 0 24 4.59a8.5 8.5 0 0 1-2.54.7z"/></svg>
                    </a>
                    <a href="#" class="bg-[#0F2239] text-white rounded-full p-2 hover:bg-blue-700 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.23 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.21 0 22.23 0zM7.12 20.45H3.56V9h3.56v11.45zM5.34 7.67a2.07 2.07 0 1 1 0-4.14 2.07 2.07 0 0 1 0 4.14zm15.11 12.78h-3.56v-5.6c0-1.33-.03-3.05-1.86-3.05-1.86 0-2.15 1.45-2.15 2.95v5.7h-3.56V9h3.42v1.56h.05c.48-.91 1.65-1.86 3.4-1.86 3.64 0 4.31 2.4 4.31 5.51v6.24z"/></svg>
                    </a>
                    <a href="#" class="bg-[#0F2239] text-white rounded-full p-2 hover:bg-blue-700 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M21.8 8.001c-.2-1.5-.8-2.7-2.1-3.5-1.2-.8-2.6-1-4.1-1.1-2.1-.1-4.2-.1-6.3 0-1.5.1-2.9.3-4.1 1.1-1.3.8-1.9 2-2.1 3.5-.2 1.5-.2 3.1-.2 4.6s0 3.1.2 4.6c.2 1.5.8 2.7 2.1 3.5 1.2.8 2.6 1 4.1 1.1 2.1.1 4.2.1 6.3 0 1.5-.1 2.9-.3 4.1-1.1 1.3-.8 1.9-2 2.1-3.5.2-1.5.2-3.1.2-4.6s0-3.1-.2-4.6zm-12.8 7.2v-6.4l6.4 3.2-6.4 3.2z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-32 px-6 bg-white">
    <div class="max-w-4xl  mx-auto text-center">
        <h2 class="text-4xl font-bold mb-4 font-[Montserrat]">Pourquoi Elmoumen Academy ?</h2>
        <p class="text-gray-600 mb-6">Nous fournissons une éducation de haute qualité avec des professeurs certifiés et une approche interactive de l’apprentissage.</p>
        <img src="{{ asset('images/about-us.jpg') }}" class="mx-auto rounded shadow" alt="Academy Presentation">
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
                <h3 class="text-white text-xl font-bold mb-2">فضاء خاص بالتلاميذ الذين يريدون تغيير حياتهم</h3>
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Counter 1: Successfully Trained -->
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mr-4">
                        <svg class="w-8 h-8" style="color: #001226;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-3xl md:text-4xl font-bold text-white" x-data="{ count: 0, target: 3000 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
                        <div class="text-white text-sm">Formés avec succès</div>
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
                        <div class="text-3xl md:text-4xl font-bold text-white" x-data="{ count: 0, target: 15000 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
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
                        <div class="text-3xl md:text-4xl font-bold text-white" x-data="{ count: 0, target: 97000 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
                        <div class="text-white text-sm">Taux de satisfaction</div>
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
                        <div class="text-3xl md:text-4xl font-bold text-white" x-data="{ count: 0, target: 102000 }" x-init="() => { const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { const increment = target / 100; const timer = setInterval(() => { if (count < target) { count += increment; } else { count = target; clearInterval(timer); } }, 20); observer.unobserve(entry.target); } }); }); observer.observe($el); }" x-text="Math.floor(count) + '+'"></div>
                        <div class="text-white text-sm">Communauté d'étudiants</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 3.5: Book Slider -->
@include('components.book-slider')

<!-- Section 4: Best Coaching -->

<section class="relative w-full py-20">
    <div class="absolute inset-0">
        <img src="{{ asset('images/bgsec.jpg') }}" alt="Background" class="w-full h-full object-cover object-center" />
        <div class="absolute inset-0" style="background: rgba(0,7,25,0.72);"></div>
    </div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        <h2 class="text-white text-4xl md:text-5xl font-bold text-center mb-16 leading-tight font-[Montserrat]">
            Découvrez Nos Fonctionnalités<br>Réussissez Tous Vos Examens
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @for ($i = 0; $i < 4; $i++)
            <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-10 flex flex-col items-center shadow-lg">
                <!-- Icon -->
                <div class="w-20 h-20 mb-6 flex items-center justify-center rounded-full border-2 border-dashed border-white">
                    <!-- Example SVG icon (replace as needed) -->
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 48 48">
                        <circle cx="24" cy="24" r="22" stroke-dasharray="4 2"/>
                        <rect x="14" y="20" width="20" height="10" rx="2" fill="none" stroke="currentColor"/>
                        <path d="M18 30v2a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-2" stroke="currentColor"/>
                        <circle cx="19" cy="25" r="1.5" fill="currentColor"/>
                        <circle cx="24" cy="25" r="1.5" fill="currentColor"/>
                        <circle cx="29" cy="25" r="1.5" fill="currentColor"/>
                    </svg>
                </div>
                <!-- Title -->
                <h3 class="text-white text-2xl font-bold mb-3 text-center">Meilleur Coaching</h3>
                <!-- Description -->
                <p class="text-white text-opacity-80 text-center mb-8">
                    Des professeurs expérimentés vous accompagnent dans votre parcours d'apprentissage avec des méthodes pédagogiques innovantes.
                </p>
                <!-- Button -->
                <a href="#" class="flex items-center gap-2 bg-[#0F2239] text-white px-6 py-3 rounded-full font-medium shadow hover:bg-[#1a335c] transition">
                    Voir les Détails
                    <span class="bg-white text-[#0F2239] rounded-full p-1 ml-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </a>
            </div>
            @endfor
        </div>
    </div>
</section>






<!-- Section 6: Testimonials or Quotes -->
<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Questions Fréquentes</h2>
            <p class="text-gray-600 text-lg">Trouvez rapidement des réponses à vos questions</p>
        </div>
        
        <div class="space-y-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="flex items-center justify-between w-full p-6 text-left" onclick="toggleContactFAQ(1)">
                    <span class="font-medium text-gray-900">Comment puis-je m'inscrire aux cours ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="faq-content-contact-1" class="hidden px-6 pb-6">
                    <p class="text-gray-600">Vous pouvez vous inscrire directement sur notre site web en créant un compte, ou nous contacter par téléphone ou WhatsApp pour un accompagnement personnalisé.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="flex items-center justify-between w-full p-6 text-left" onclick="toggleContactFAQ(2)">
                    <span class="font-medium text-gray-900">Quels sont les moyens de paiement acceptés ?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="faq-content-contact-2" class="hidden px-6 pb-6">
                    <p class="text-gray-600">Nous acceptons les paiements en espèces, par virement bancaire, et via les services de paiement mobile comme PayPal et les portefeuilles électroniques locaux.</p>
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





<!-- Section 4.5: Testimonials Slider -->
<section class="relative w-full py-20">
    <!-- Background image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/bgsec.jpg') }}" alt="Background" class="w-full h-full object-cover object-center" />
        <div class="absolute inset-0" style="background: rgba(0,7,25,0.72);"></div>
    </div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        <h2 class="text-white text-4xl md:text-5xl font-bold text-center mb-16 leading-tight font-[Montserrat]">
            Créer une Communauté<br>d'Apprenants à Vie
        </h2>
        
        <!-- Testimonials Slider -->
        <div class="relative" x-data="{ currentSlide: 0 }">
            <!-- Slider Container -->
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-in-out" 
                     :style="`transform: translateX(-${currentSlide * (window.innerWidth < 768 ? 100 : 33.333)}%)`">
                    
                    <!-- Testimonial 1 -->
                    <div class="w-full md:w-1/3 flex-shrink-0 px-4">
                        <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-6 relative shadow-lg h-full">
                            <!-- Decorative Line -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-r-full"></div>
                            <!-- Content -->
                            <div class="pt-4">
                                <p class="text-white text-opacity-90 mb-6 leading-relaxed text-base">
                                    "Elmoumen Academy a transformé mon approche de l'apprentissage. Les professeurs sont excellents et le contenu est très bien structuré."
                                </p>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-bold text-sm">A</span>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold text-base">Ahmed Benali</h4>
                                        <p class="text-cyan-400 text-xs">Étudiant en Terminale</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="w-full md:w-1/3 flex-shrink-0 px-4">
                        <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-6 relative shadow-lg h-full">
                            <!-- Decorative Line -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-r-full"></div>
                            <!-- Content -->
                            <div class="pt-4">
                                <p class="text-white text-opacity-90 mb-6 leading-relaxed text-base">
                                    "Grâce à Elmoumen Academy, j'ai pu améliorer mes résultats scolaires de manière significative. Je recommande vivement !"
                                </p>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-bold text-sm">F</span>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold text-base">Fatima Zahra</h4>
                                        <p class="text-cyan-400 text-xs">Étudiante en Collège</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="w-full md:w-1/3 flex-shrink-0 px-4">
                        <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-6 relative shadow-lg h-full">
                            <!-- Decorative Line -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-r-full"></div>
                            <!-- Content -->
                            <div class="pt-4">
                                <p class="text-white text-opacity-90 mb-6 leading-relaxed text-base">
                                    "Les cours sont très bien organisés et les professeurs sont toujours disponibles pour répondre à nos questions."
                                </p>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-bold text-sm">M</span>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold text-base">Mohammed Alami</h4>
                                        <p class="text-cyan-400 text-xs">Étudiant en Primaire</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 4 -->
                    <div class="w-full md:w-1/3 flex-shrink-0 px-4">
                        <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-6 relative shadow-lg h-full">
                            <!-- Decorative Line -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-r-full"></div>
                            <!-- Content -->
                            <div class="pt-4">
                                <p class="text-white text-opacity-90 mb-6 leading-relaxed text-base">
                                    "Excellente plateforme pour préparer les concours. Le contenu est riche et les exercices sont très pertinents."
                                </p>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-bold text-sm">S</span>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold text-base">Sara Bennani</h4>
                                        <p class="text-cyan-400 text-xs">Candidat Concours</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 5 -->
                    <div class="w-full md:w-1/3 flex-shrink-0 px-4">
                        <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-6 relative shadow-lg h-full">
                            <!-- Decorative Line -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-r-full"></div>
                            <!-- Content -->
                            <div class="pt-4">
                                <p class="text-white text-opacity-90 mb-6 leading-relaxed text-base">
                                    "Ma fille a fait d'énormes progrès depuis qu'elle suit les cours d'Elmoumen Academy. Je suis très satisfaite."
                                </p>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-bold text-sm">N</span>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold text-base">Nadia Tazi</h4>
                                        <p class="text-cyan-400 text-xs">Parent d'Élève</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 6 -->
                    <div class="w-full md:w-1/3 flex-shrink-0 px-4">
                        <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-6 relative shadow-lg h-full">
                            <!-- Decorative Line -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-r-full"></div>
                            <!-- Content -->
                            <div class="pt-4">
                                <p class="text-white text-opacity-90 mb-6 leading-relaxed text-base">
                                    "Interface intuitive et contenu de qualité. Elmoumen Academy est vraiment une référence en matière d'éducation en ligne."
                                </p>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-bold text-sm">Y</span>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold text-base">Youssef Idrissi</h4>
                                        <p class="text-cyan-400 text-xs">Étudiant en Lycée</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button @click="currentSlide = currentSlide === 0 ? (window.innerWidth < 768 ? 5 : 1) : currentSlide - 1" 
                    class="absolute -left-12 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full p-3 transition-all duration-300 backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <button @click="currentSlide = currentSlide === (window.innerWidth < 768 ? 5 : 1) ? 0 : currentSlide + 1" 
                    class="absolute -right-12 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full p-3 transition-all duration-300 backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Dots Indicator -->
            <div class="flex justify-center mt-8 space-x-3">
                <template x-for="i in (window.innerWidth < 768 ? 6 : 2)" :key="i">
                    <button @click="currentSlide = i - 1" 
                            :class="currentSlide === (i - 1) ? 'bg-cyan-400' : 'bg-white/30'" 
                            class="w-3 h-3 rounded-full transition-all duration-300"></button>
                </template>
            </div>
        </div>
    </div>
</section>



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
                        <form class="space-y-4">
                            <div>
                                <label class="block text-gray-700 mb-1">Nom complet</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#001226] focus:border-[#001226]">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Email</label>
                                <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#001226] focus:border-[#001226]">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Message</label>
                                <textarea rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#001226] focus:border-[#001226]"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-[#001226] hover:bg-[#0a1a2e] text-white py-3 rounded-lg font-medium transition">
                                Envoyer le message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
