@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-6 text-blue-700">Niveaux pour {{ $level->name }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($years as $year)
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold">{{ $year->name }}</h2>
                    <p class="mt-2 text-gray-500">Année scolaire</p>
                    <a href="{{ route('courses.year', ['level' => $level->slug, 'year' => $year->slug]) }}"
   class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
   Voir les matières
</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
