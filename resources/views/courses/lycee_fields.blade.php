@extends('layouts.front')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">🎓 {{ $level->name }} — {{ $year->name }}</h1>
    <h2 class="text-lg mb-6">Choisissez une filière</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($fields as $field)
            <a href="{{ route('courses.field', [
                'level' => $level->slug,
                'year' => $year->slug,
                'field' => $field->slug
            ]) }}" 
            class="block p-6 border rounded-lg shadow hover:bg-blue-100 transition">
                <h3 class="text-xl font-semibold">{{ $field->name }}</h3>
            </a>
        @endforeach
    </div>
</div>
@endsection
