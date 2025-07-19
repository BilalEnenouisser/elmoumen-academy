@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">📚 Liste des Matériaux</h1>

<a href="{{ route('admin.materials.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">➕ Ajouter</a>

<table class="w-full bg-white rounded shadow overflow-hidden text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2">Titre</th>
            <th class="p-2">Niveau</th>
            <th class="p-2">Matière</th>
            <th class="p-2">Type</th>
            <th class="p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($materials as $material)
            <tr class="border-b">
                <td class="p-2">{{ $material->title }}</td>
                <td class="p-2">{{ $material->level->name }}</td>
                <td class="p-2">{{ $material->subject->name }}</td>
                <td class="p-2">{{ $material->type }}</td>
                <td class="p-2 space-x-2 text-center">
                    <!-- Future: Edit/Delete buttons -->
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
