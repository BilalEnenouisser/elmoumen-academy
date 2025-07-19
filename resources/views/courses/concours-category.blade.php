@extends('layouts.app')

@section('content')
<section class="px-6 py-12 bg-white">
    <h1 class="text-2xl font-bold mb-6 text-center">Matières – Concours {{ ucfirst($category) }}</h1>

    <div class="space-y-6">
        @foreach (['Mathématiques', 'Physique', 'Français'] as $subject)
        <div class="border rounded p-4 shadow">
            <h2 class="text-xl font-semibold mb-2">{{ $subject }}</h2>

            <div class="pl-4">
                <!-- Cours -->
                <h3 class="text-lg font-bold text-blue-600">📘 Cours :</h3>
                <ul class="mb-4">
                    <li>
                        <a href="#" class="text-blue-500 underline">Cours {{ $subject }} - Concours.pdf</a><br>
                        <a href="https://youtube.com" target="_blank" class="text-red-500">▶️ Vidéo</a>
                    </li>
                </ul>

                <!-- Séries -->
                <h3 class="text-lg font-bold text-green-600">📝 Séries :</h3>
                <ul>
                    <li>
                        <a href="#" class="text-blue-500 underline">Série 1 - {{ $subject }} - Concours.pdf</a>
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
