@extends('layouts.front')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">🎓 {{ $level->name }} — Choisissez une année</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($years as $year)
            <a href="{{ route('courses.year', ['level' => $level->name, 'year' => $year->id]) }}" 
               class="block p-6 border rounded-lg shadow hover:bg-blue-100 transition">
                <h2 class="text-xl font-semibold">{{ $year->name }}</h2>
            </a>
        @endforeach
    </div>
</div>
@endsection
