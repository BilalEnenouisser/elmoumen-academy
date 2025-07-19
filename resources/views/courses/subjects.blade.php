@extends('layouts.front')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">
        📘 {{ $level->name }} — {{ $year->name }}
        @if(isset($field)) / {{ $field->name }} @endif
    </h1>
    <h2 class="text-lg mb-6">Choisissez une matière</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($subjects as $subject)
            <a href="{{ route('courses.subject', [
                'level' => $level->name,
                'year' => $year->id,
                'field' => $field->id ?? 0,
                'subject' => $subject->id
            ]) }}"
            class="block p-6 border rounded-lg shadow hover:bg-green-100 transition">
                <h3 class="text-lg font-semibold">{{ $subject->name }}</h3>
            </a>
        @endforeach
    </div>
</div>
@endsection
