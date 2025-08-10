@extends('layouts.app')

@section('content')
<section class="min-h-[80vh] md:min-h-[85vh] bg-gray-900 text-white flex items-center justify-center">
    <div class="max-w-4xl w-full px-6 text-center">
        <h1 class="text-white font-extrabold leading-none tracking-tight text-[120px] md:text-[200px] lg:text-[240px]">404</h1>
        <p class="mt-2 text-2xl md:text-3xl font-bold">Page non trouvée</p>
        <p class="mt-3 text-base md:text-lg text-gray-300 max-w-2xl mx-auto">
            Désolé, la page que vous cherchez n'existe pas ou a été déplacée.
        </p>

        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-6 py-3 md:px-8 md:py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                Retour à l'accueil
            </a>
            <button onclick="history.back()" class="inline-flex items-center justify-center px-6 py-3 md:px-8 md:py-4 bg-gray-700 hover:bg-gray-800 text-white rounded-md transition">
                Revenir en arrière
            </button>
        </div>

        <div class="mt-12 text-sm text-gray-400">
            <p>URL demandée: <span class="font-mono break-all">{{ request()->fullUrl() }}</span></p>
        </div>
    </div>
</section>
@endsection


