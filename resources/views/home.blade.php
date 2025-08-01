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
                <span class="text-cyan-400">Transforming</span> Lives<br>
                Through Online<br>
                Education.
            </h1>
            <p class="mb-8 text-base sm:text-sm text-gray-200">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit <br>tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
            <a href="#" class="inline-block bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white px-6 py-3 sm:px-8 sm:py-3 rounded-full   shadow-lg transition">Learn More</a>
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
            <h3 class="text-gray-600  text-4xl md:text-5xl font-bold text-center mb-16 leading-tight font-[Montserrat]">Les Annonces</h3>
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
                <img src="{{ asset('images/about-us.jpg') }}" alt="About Us" class="w-full h-64 md:h-80 object-cover" />
            </div>
            <h2 class="text-3xl md:text-4xl font-normal  mb-2 text-gray-800 font-[Montserrat]">Empowering Growth Through</h2>
            <p class="text-gray-600 mb-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1 flex flex-col items-center border-r border-gray-300 last:border-none">
                    <span class="text-3xl font-bold text-gray-800">24</span>
                    <span class="text-gray-500">Company</span>
                </div>
                <div class="flex-1 flex flex-col items-center border-r border-gray-300 last:border-none">
                    <span class="text-3xl font-bold text-gray-800">75+</span>
                    <span class="text-gray-500">Team</span>
                </div>
                <div class="flex-1 flex flex-col items-center">
                    <span class="text-3xl font-bold text-gray-800">24</span>
                    <span class="text-gray-500">Experience</span>
                </div>
            </div>
        </div>
        <!-- Right: Vision, Mission, Social -->
        <div class="flex-1 flex flex-col justify-center">
            <h2 class="text-4xl md:text-5xl font-normal mb-8 text-gray-800 font-[Montserrat] leading-tight">
                Empowering Growth<br>Through Online Learning
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
                        <h3 class="text-2xl   text-gray-800 mb-1">EduByte Vision</h3>
                        <p class="text-gray-600 text-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
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
                        <h3 class="text-2xl   text-gray-800 mb-1">EduByte Mission</h3>
                        <p class="text-gray-600 text-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                    </div>
                </div>
            </div>
            <hr class="mb-4 border-gray-300">
            <div class="flex items-center justify-between">
                <span class="text-lg text-gray-700 font-medium">Social Media :</span>
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

<section class="py-12 px-6 bg-white">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-2xl font-bold mb-4">Pourquoi Elmoumen Academy ?</h2>
        <p class="text-gray-600 mb-6">Nous fournissons une éducation de haute qualité avec des professeurs certifiés et une approche interactive de l’apprentissage.</p>
        <img src="https://placehold.co/600x300" class="mx-auto rounded shadow" alt="Academy Presentation">
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
<section class="py-20 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="bg-[#001226] rounded-2xl p-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Counter 1: Successfully Trained -->
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-3xl md:text-4xl font-bold text-white">3K+</div>
                        <div class="text-white text-sm">Formés avec succès</div>
                    </div>
                </div>

                <!-- Counter 2: Classes Completed -->
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-3xl md:text-4xl font-bold text-white">15K+</div>
                        <div class="text-white text-sm">Cours terminés</div>
                    </div>
                </div>

                <!-- Counter 3: Satisfaction Rate -->
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-3xl md:text-4xl font-bold text-white">97K+</div>
                        <div class="text-white text-sm">Taux de satisfaction</div>
                    </div>
                </div>

                <!-- Counter 4: Students Community -->
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-3xl md:text-4xl font-bold text-white">102K+</div>
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
    <!-- Background image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/bgsec.jpg') }}" alt="Background" class="w-full h-full object-cover object-center" />
        <div class="absolute inset-0" style="background: rgba(0,7,25,0.72);"></div>
    </div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        <h2 class="text-white text-4xl md:text-5xl font-bold text-center mb-16 leading-tight font-[Montserrat]">
            Check Out Educate Features<br>Win Any Exam
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
                <h3 class="text-white text-2xl font-bold mb-3 text-center">Best Coaching</h3>
                <!-- Description -->
                <p class="text-white text-opacity-80 text-center mb-8">
                    In pellentesque massa vida placerat duis. Cursus sit amet dictum sit amet.
                </p>
                <!-- Button -->
                <a href="#" class="flex items-center gap-2 bg-[#0F2239] text-white px-6 py-3 rounded-full font-medium shadow hover:bg-[#1a335c] transition">
                    View Details
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
<!-- FAQ Section with Accordion -->
<section class="py-20 bg-[#DEE7F1]">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-[#0F2239]">Frequently Asked Questions</h2>
        <div class="space-y-6" x-data="{ open: 0 }">
            <div class="bg-white rounded-xl shadow p-6 cursor-pointer" @click="open === 1 ? open = 0 : open = 1">
                <h3 class="font-semibold text-lg mb-2 flex items-center justify-between">
                    How do I register?
                    <span x-show="open !== 1">+</span>
                    <span x-show="open === 1">-</span>
                </h3>
                <div x-show="open === 1" class="text-gray-600 mt-2" x-transition>
                    Click the "Get Started" button and fill out the registration form to join our academy.
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-6 cursor-pointer" @click="open === 2 ? open = 0 : open = 2">
                <h3 class="font-semibold text-lg mb-2 flex items-center justify-between">
                    Are the courses free?
                    <span x-show="open !== 2">+</span>
                    <span x-show="open === 2">-</span>
                </h3>
                <div x-show="open === 2" class="text-gray-600 mt-2" x-transition>
                    We offer both free and premium courses. Check the course details for more information.
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-6 cursor-pointer" @click="open === 3 ? open = 0 : open = 3">
                <h3 class="font-semibold text-lg mb-2 flex items-center justify-between">
                    Can I contact the teachers?
                    <span x-show="open !== 3">+</span>
                    <span x-show="open === 3">-</span>
                </h3>
                <div x-show="open === 3" class="text-gray-600 mt-2" x-transition>
                    Yes, you can message teachers directly through your dashboard after registering.
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Alpine.js CDN (if not already included) -->
<script src="//unpkg.com/alpinejs" defer></script>



<!-- Section 7: Call to Action -->
<section class="py-12 px-6 bg-blue-50 text-center">
    <h2 class="text-2xl font-bold mb-4">Rejoignez notre communauté</h2>
    <p class="mb-6 text-gray-600">Inscrivez-vous dès maintenant pour accéder aux ressources pédagogiques.</p>
    <a href="/contact" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Contactez-nous</a>
</section>

<

<!-- Contact Section -->
<section id="contact" class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="bg-blue-600 rounded-xl shadow-xl overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2 p-8 md:p-12 text-white">
                    <h2 class="text-3xl font-bold mb-4">Prêt à commencer ?</h2>
                    <p class="mb-6">Contactez-nous pour plus d'informations sur nos programmes.</p>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            +212 600 000 000
                        </div>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            contact@elmoumen-academy.ma
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 bg-white p-8 md:p-12">
                    <form class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-1">Nom complet</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Email</label>
                            <input type="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Message</label>
                            <textarea rows="4" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition">
                            Envoyer le message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
