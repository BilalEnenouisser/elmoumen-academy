@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">📚 Mes Matériels</h1>

<a href="{{ route('teacher.materials.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">➕ Ajouter</a>

@if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full bg-white rounded shadow overflow-hidden text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2">Titre</th>
            <th class="p-2">Niveau</th>
            <th class="p-2">Type</th>
            <th class="p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($materials as $material)
            <tr class="border-b">
                <td class="p-2">{{ $material->name }}</td>
                <td class="p-2">{{ $material->level->name ?? '-' }}</td>
                <td class="p-2">{{ $material->blocks->first()?->type ?? 'N/A' }}</td>
                <td class="p-2 space-x-2 text-center">
                    <a href="{{ route('teacher.materials.edit', $material) }}" class="text-blue-600 hover:underline">Modifier</a>
                    <form action="{{ route('teacher.materials.destroy', $material) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce matériel ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">Aucun matériel trouvé.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
