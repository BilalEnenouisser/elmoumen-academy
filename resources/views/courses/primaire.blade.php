@extends('layouts.app')

@section('content')
<section class="px-6 py-12 bg-white">
    <h1 class="text-2xl font-bold text-center mb-8">Niveaux - Primaire</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @for ($i = 1; $i <= 6; $i++)
            <a href="{{ url('/courses/primaire/year/' . $i) }}" class="block bg-gray-100 rounded shadow p-4 text-center hover:shadow-md transition">
                <img src="https://placehold.co/400x200?text=Année+{{ $i }}" alt="Année {{ $i }}" class="rounded mb-4">
                <h3 class="text-lg font-semibold">Année {{ $i }}</h3>
            </a>
        @endfor
    </div>
</section>
@endsection
