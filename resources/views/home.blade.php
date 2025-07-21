@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-50 to-white py-16 px-6">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-8">
        <div class="md:w-1/2 space-y-6">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
                Excellence Éducative à <span class="text-blue-600">Elmoumen Academy</span>
            </h1>
            <p class="text-lg text-gray-600">
                Un accompagnement personnalisé pour la réussite scolaire de vos enfants
            </p>
            <div class="flex gap-4">
                <a href="/courses" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-md transition">
                    Explorer nos cours
                </a>
                <a href="#contact" class="border border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-3 rounded-lg transition">
                    Nous contacter
                </a>
            </div>
        </div>
        <div class="md:w-1/2">
            <img src="{{ asset('images/hero-image.jpg') }}" alt="Students learning" 
                 class="rounded-xl shadow-xl w-full h-auto">
        </div>
    </div>
</section>


    <!-- Section 2: Academic Level Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <!-- Primaire Card -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">
        <div class="bg-blue-100 p-4 text-center">
            <svg class="w-12 h-12 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-2">Primaire</h3>
            <p class="text-gray-600 mb-4">Fondations solides pour les jeunes apprenants</p>
            <a href="/courses/primaire" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Voir les cours
            </a>
        </div>
    </div>


    <!-- Primaire Card -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">
        <div class="bg-blue-100 p-4 text-center">
            <svg class="w-12 h-12 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-2">college</h3>
            <p class="text-gray-600 mb-4">Fondations solides pour les jeunes apprenants</p>
            <a href="/courses/college" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Voir les cours
            </a>
        </div>
    </div>


    <!-- Primaire Card -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">
        <div class="bg-blue-100 p-4 text-center">
            <svg class="w-12 h-12 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-2">lycee</h3>
            <p class="text-gray-600 mb-4">Fondations solides pour les jeunes apprenants</p>
            <a href="/courses/lycee" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Voir les cours
            </a>
        </div>
    </div>


    <!-- Primaire Card -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">
        <div class="bg-blue-100 p-4 text-center">
            <svg class="w-12 h-12 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-2">concours</h3>
            <p class="text-gray-600 mb-4">Fondations solides pour les jeunes apprenants</p>
            <a href="/courses/concours" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Voir les cours
            </a>
        </div>
    </div>
    <!-- Repeat for other levels with different colors/icons -->
</div>


<!-- Section 3: Pub Marquee Bar -->
@php
    $marquees = \App\Models\Marquee::latest()->get();
@endphp

@if($marquees->count())
    <div class="bg-yellow-100 py-4">
        <marquee behavior="scroll" direction="left" scrollamount="6" class="text-lg text-yellow-800">
            @foreach($marquees as $item)
                🟡 {{ $item->text }} &nbsp;&nbsp;&nbsp;
            @endforeach
        </marquee>
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
