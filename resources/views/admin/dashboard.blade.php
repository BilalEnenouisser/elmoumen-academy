@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Welcome to the Admin Panel</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <!-- Teachers -->
        <a href="{{ route('admin.teachers.index') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">👨‍🏫 Manage Teachers</h2>
            <p class="text-gray-600 mt-2">Add, edit, or remove teachers.</p>
        </a>

        <!-- Materials -->
        <a href="{{ route('admin.materials.index') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">📚 Manage Materials</h2>
            <p class="text-gray-600 mt-2">Upload PDFs, videos, or other materials.</p>
        </a>

        <!-- Marquee -->
        <a href="{{ route('admin.marquees.index') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">📢 Manage Marquee Bar</h2>
            <p class="text-gray-600 mt-2">Add or remove announcement messages.</p>
        </a>

        <!-- Messages -->
        <a href="{{ route('admin.messages.index') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">✉️ View Messages</h2>
            <p class="text-gray-600 mt-2">See contact form submissions from users.</p>
        </a>

        <!-- Structure -->
        <a href="{{ route('admin.structure') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">🏛️ Structure Management</h2>
            <p class="text-gray-600 mt-2">Manage levels, years, fields</p>
        </a>

        <!-- Videos -->
        <a href="{{ route('admin.videos.index') }}" class="p-6 bg-white rounded shadow hover:bg-blue-50 transition">
            <h2 class="text-lg font-semibold text-blue-600">🎬 Videos</h2>
            <p class="text-gray-600 mt-2">Manage embedded educational videos.</p>
        </a>
    </div>
@endsection
