@extends('layouts.app')

@section('content')
<section class="px-6 py-12 bg-white">
    <h1 class="text-2xl font-bold text-center mb-8">Concours Préparatoires</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach (['Médecine', 'Informatique', 'Génie Civil', 'Commerce'] as $category)
            <a href="{{ url('/courses/concours/' . strtolower(str_replace(' ', '-', $category))) }}" class="block bg-gray-100 rounded shadow p-4 text-center hover:shadow-md transition">
                <img src="https://placehold.co/400x200?text={{ urlencode($category) }}" alt="{{ $category }}" class="rounded mb-4">
                <h3 class="text-lg font-semibold">{{ $category }}</h3>
            </a>
        @endforeach
    </div>
</section>
@endsection
