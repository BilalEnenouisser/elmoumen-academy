@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Academic Structure Management</h1>

    <!-- Years Section -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">🎓 Years</h2>
        
        <form method="POST" action="{{ route('admin.years.store') }}" class="mb-4">
            @csrf
            <div class="flex gap-2">
                <input type="text" name="name" placeholder="Year name" class="border rounded p-2 flex-grow" required>
                <select name="level_id" class="border rounded p-2" required>
                    <option value="">Select Level</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add</button>
            </div>
        </form>

        <ul class="divide-y">
            @foreach($years as $year)
            <li class="py-2 flex justify-between items-center">
                <span>{{ $year->name }} ({{ $year->level->name }})</span>
                <form method="POST" action="{{ route('admin.years.destroy', $year) }}">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Fields Section -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">🔬 Fields</h2>
        
        <form method="POST" action="{{ route('admin.fields.store') }}" class="mb-4">
            @csrf
            <div class="flex gap-2">
                <input type="text" name="name" placeholder="Field name" class="border rounded p-2 flex-grow" required>
                <select name="level_id" class="border rounded p-2" required>
                    <option value="">Select Level</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add</button>
            </div>
        </form>

        <ul class="divide-y">
            @foreach($fields as $field)
            <li class="py-2 flex justify-between items-center">
                <span>{{ $field->name }} ({{ $field->level->name }})</span>
                <form method="POST" action="{{ route('admin.fields.destroy', $field) }}">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Subjects Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">📘 Subjects</h2>
        
        <form method="POST" action="{{ route('admin.subjects.store') }}" class="mb-4">
            @csrf
            <div class="flex gap-2">
                <input type="text" name="name" placeholder="Subject name" class="border rounded p-2 flex-grow" required>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add</button>
            </div>
        </form>

        <ul class="divide-y">
            @foreach($subjects as $subject)
            <li class="py-2 flex justify-between items-center">
                <span>{{ $subject->name }}</span>
                <form method="POST" action="{{ route('admin.subjects.destroy', $subject) }}">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection