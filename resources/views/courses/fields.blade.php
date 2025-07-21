@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">🎓 Choose a field for {{ $year->name }} ({{ $level->name }})</h1>

    @if ($fields->isEmpty())
        <p class="text-red-500">No fields available. Please add some in the admin panel.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($fields as $field)
                <a href="{{ route('courses.field', [
                    'level' => $level->slug,
                    'year' => $year->slug,
                    'field' => $field->slug
                ]) }}" class="block p-4 bg-white border shadow hover:bg-gray-100 text-center rounded">
                    {{ $field->name }}
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
