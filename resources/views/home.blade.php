@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="flex flex-col md:flex-row items-center justify-between px-6 py-12">
        <div class="w-full md:w-1/3 text-center md:text-left">
            <h1 class="text-4xl font-bold mb-4">Bienvenue à Elmoumen Academy</h1>
            <p class="text-lg mb-6">Explorez nos cours et trouvez votre voie vers la réussite.</p>
        </div>

        <div class="w-full md:w-1/3">
            <img src="https://placehold.co/300x250" alt="Teacher" class="rounded shadow">
        </div>

        <div class="w-full md:w-1/3 text-center md:text-right mt-6 md:mt-0">
            <a href="https://youtube.com" target="_blank" class="bg-red-500 text-white px-6 py-2 rounded shadow hover:bg-red-600">Voir la vidéo</a>
        </div>
    </section>


    <!-- Section 2: Academic Level Cards -->
<section class="px-6 py-10 bg-gray-50">
    <h2 class="text-2xl font-bold text-center mb-8">Nos Niveaux Académiques</h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Card 1: Primaire -->
        <a href="/courses/primaire" class="block bg-white rounded shadow hover:shadow-md transition">
            <img src="https://placehold.co/400x200" alt="Primaire" class="rounded-t">
            <div class="p-4 text-center font-semibold">Primaire</div>
        </a>

        <!-- Card 2: Collège -->
        <a href="/courses/college" class="block bg-white rounded shadow hover:shadow-md transition">
            <img src="https://placehold.co/400x200" alt="Collège" class="rounded-t">
            <div class="p-4 text-center font-semibold">Collège</div>
        </a>

        <!-- Card 3: Lycée -->
        <a href="/courses/lycee" class="block bg-white rounded shadow hover:shadow-md transition">
            <img src="https://placehold.co/400x200" alt="Lycée" class="rounded-t">
            <div class="p-4 text-center font-semibold">Lycée</div>
        </a>

        <!-- Card 4: Concours -->
        <a href="/courses/concours" class="block bg-white rounded shadow hover:shadow-md transition">
            <img src="https://placehold.co/400x200" alt="Concours" class="rounded-t">
            <div class="p-4 text-center font-semibold">Concours</div>
        </a>
    </div>
</section>


<!-- Section 3: Pub Marquee Bar -->
<section class="bg-yellow-100 py-4 overflow-hidden">
    <div class="flex items-center space-x-4 animate-marquee whitespace-nowrap text-lg font-medium text-gray-800 px-6">
        <span>📅 1ère classe aujourd'hui - 22:30</span>
        <span>📅 2ème classe aujourd'hui - 22:30</span>
        <span>📅 3ème classe aujourd'hui - 22:30</span>
        <span>📅 4ème classe aujourd'hui - 22:30</span>
        <span>📅 5ème classe aujourd'hui - 22:30</span>
    </div>
</section>


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
<section class="py-12 px-6 bg-white text-center">
    <h2 class="text-2xl font-bold mb-6">Témoignages</h2>
    <blockquote class="italic text-gray-700 max-w-xl mx-auto">“Elmoumen Academy a aidé mon fils à réussir son Bac avec mention !” – Mère de Youssef</blockquote>
</section>

<!-- Section 7: Call to Action -->
<section class="py-12 px-6 bg-blue-50 text-center">
    <h2 class="text-2xl font-bold mb-4">Rejoignez notre communauté</h2>
    <p class="mb-6 text-gray-600">Inscrivez-vous dès maintenant pour accéder aux ressources pédagogiques.</p>
    <a href="/contact" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Contactez-nous</a>
</section>

<!-- Section 8: 3 Cards (Mothers, Parents, Students) -->
<section class="py-12 px-6 bg-white">
    <h2 class="text-2xl font-bold text-center mb-8">Ressources pour</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="/resources/mothers" class="block bg-gray-50 rounded shadow p-4 hover:shadow-md transition">
            <img src="https://placehold.co/400x200" class="rounded mb-4" alt="Mothers">
            <h3 class="text-lg font-semibold mb-2">Mamans</h3>
            <p class="text-gray-600 mb-2">Conseils et soutien éducatif pour accompagner vos enfants.</p>
            <button class="bg-blue-600 text-white px-4 py-1 rounded">Voir plus</button>
        </a>

        <a href="/resources/parents" class="block bg-gray-50 rounded shadow p-4 hover:shadow-md transition">
            <img src="https://placehold.co/400x200" class="rounded mb-4" alt="Parents">
            <h3 class="text-lg font-semibold mb-2">Parents</h3>
            <p class="text-gray-600 mb-2">Articles et vidéos pour aider dans la scolarité de vos enfants.</p>
            <button class="bg-blue-600 text-white px-4 py-1 rounded">Voir plus</button>
        </a>

        <a href="/resources/students" class="block bg-gray-50 rounded shadow p-4 hover:shadow-md transition">
            <img src="https://placehold.co/400x200" class="rounded mb-4" alt="Students">
            <h3 class="text-lg font-semibold mb-2">Étudiants</h3>
            <p class="text-gray-600 mb-2">Vidéos, cours et fiches pour bien réviser.</p>
            <button class="bg-blue-600 text-white px-4 py-1 rounded">Voir plus</button>
        </a>
    </div>
</section>


<!-- Contact Section -->
<section class="bg-gray-100 py-12 px-6 text-center">
    <h2 class="text-2xl font-bold mb-6">Contactez-nous</h2>
    <p class="mb-4">📍 Adresse: Rabat, Maroc</p>
    <p class="mb-4">📞 Téléphone: +212 600 000 000</p>
    <div class="max-w-4xl mx-auto mt-6">
        <iframe class="w-full h-64 rounded shadow"
            src="https://maps.app.goo.gl/DLBhxvfLPNtTxZ55A"
            style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</section>

@endsection
