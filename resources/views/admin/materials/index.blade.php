@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">📚 Liste des Matériaux</h1>

<a href="{{ route('admin.materials.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">➕ Ajouter</a>

<table class="w-full bg-white rounded shadow overflow-hidden text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2">Titre</th>
            <th class="p-2">Niveau</th>
            <th class="p-2">Type</th>
            <th class="p-2">PDFs</th>
            <th class="p-2">Vidéos</th>
            <th class="p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($materials as $material)
            <tr class="border-b">
                <td class="p-2">{{ $material->title }}</td>
                <td class="p-2">{{ $material->level->name }}</td>
                <td class="p-2">{{ $material->blocks->first()?->type ?? 'N/A' }}</td>
                <td class="p-2 text-center">
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">{{ $material->blocks->sum(function($block) { return $block->pdfs->count(); }) }} PDF(s)</span>
                </td>
                <td class="p-2 text-center">
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">{{ $material->blocks->sum(function($block) { return $block->videos->count(); }) }} Vidéo(s)</span>
                </td>
                <td class="p-2 space-x-2 text-center">
                    <a href="{{ route('admin.materials.edit', $material) }}" class="text-blue-600 hover:underline">Modifier</a>

                    <form action="{{ route('admin.materials.destroy', $material) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce matériel ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
