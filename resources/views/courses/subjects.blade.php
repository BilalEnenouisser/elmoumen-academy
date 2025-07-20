{{-- resources/views/courses/subject.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">
            Materials for {{ $subject->name }} ({{ $field->name }} - {{ $year->name }})
        </h1>

        @if ($materials->count())
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($materials as $material)
                    <li class="p-4 bg-white rounded-xl shadow-md">
                        <h2 class="font-semibold text-lg">{{ $material->title }}</h2>
                        <p>{{ $material->description }}</p>

                        @if($material->file)
                            <a href="{{ asset('storage/' . $material->file) }}" class="text-blue-600 underline mt-2 block" target="_blank">Download</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p>No materials available for this subject.</p>
        @endif
    </div>
@endsection
