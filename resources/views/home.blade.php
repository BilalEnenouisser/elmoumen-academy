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
            <h1 class="text-4xl sm:text-5xl font-bold leading-tight mb-6">
                <span class="text-cyan-400">Transforming</span> Lives<br>
                Through Online<br>
                Education.
            </h1>
            <p class="mb-8 text-base sm:text-lg text-gray-200">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
            <a href="#" class="inline-block bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white px-6 py-3 sm:px-8 sm:py-3 rounded-full font-semibold shadow-lg transition">Learn More</a>
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
                        <span class="text-white text-xl font-semibold drop-shadow-lg">{{ $card['title'] }}</span>
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
    <div class="bg-[#DEE7F1] py-4 px-6 rounded-lg shadow-sm">
        <!-- Centered Title -->
        <div class="text-center mb-3">
            <h3 class="text-[#1E3A8A]  text-lg tracking-wide">Les Annonces</h3>
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




<!-- Section 4: About the Academy -->
<section class="py-12 px-6 bg-white">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-2xl font-bold mb-4">Pourquoi Elmoumen Academy ?</h2>
        <p class="text-gray-600 mb-6">Nous fournissons une éducation de haute qualité avec des professeurs certifiés et une approche interactive de l’apprentissage.</p>
        <img src="https://placehold.co/600x300" class="mx-auto rounded shadow" alt="Academy Presentation">
    </div>
</section>

<!-- Section 5: Animated Numbers or Counters (Optional with JS later) -->
<section class="py-12 px-6 bg-gray-100 text-center">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-xl font-bold text-blue-700">
        <div><span>+1000</span><p class="text-sm font-normal text-gray-500">Étudiants</p></div>
        <div><span>+30</span><p class="text-sm font-normal text-gray-500">Enseignants</p></div>
        <div><span>100%</span><p class="text-sm font-normal text-gray-500">Succès</p></div>
        <div><span>24/7</span><p class="text-sm font-normal text-gray-500">Support</p></div>
    </div>
</section>

<!-- Section 6: Testimonials or Quotes -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Ce que disent nos parents</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-white p-8 rounded-xl shadow-md">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                        <span class="text-blue-600 font-bold">A</span>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold">Amina B.</h4>
                        <p class="text-gray-500 text-sm">Mère de Youssef (CM2)</p>
                    </div>
                </div>
                <p class="text-gray-700 italic">
                    "Grâce à Elmoumen Academy, mon fils a retrouvé confiance en lui et ses résultats se sont nettement améliorés."
                </p>
                <div class="mt-4 flex text-yellow-400">
                    ★★★★★
                </div>
            </div>
            <!-- Add 2 more testimonials -->
        </div>
    </div>
</section>

<!-- Section 7: Call to Action -->
<section class="py-12 px-6 bg-blue-50 text-center">
    <h2 class="text-2xl font-bold mb-4">Rejoignez notre communauté</h2>
    <p class="mb-6 text-gray-600">Inscrivez-vous dès maintenant pour accéder aux ressources pédagogiques.</p>
    <a href="/contact" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Contactez-nous</a>
</section>

<!-- Section 8: 3 Cards (Mothers, Parents, Students) -->
<h2 class="text-xl font-bold my-4">Nos vidéos</h2>

@foreach(['mothers', 'parents', 'students'] as $category)
    <h3 class="text-lg font-semibold mt-4 mb-2 capitalize">{{ $category }}</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach(\App\Models\Video::where('category', $category)->latest()->take(3)->get() as $video)
            <div class="border p-3 rounded shadow">
                <img src="{{ $video->thumbnail }}" class="w-full h-40 object-cover rounded mb-2">
                <h4 class="font-bold">{{ $video->title }}</h4>
                <a href="{{ $video->video_url }}" target="_blank" class="text-blue-500 block mt-2">Voir 🎬</a>
            </div>
        @endforeach
    </div>
@endforeach


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
