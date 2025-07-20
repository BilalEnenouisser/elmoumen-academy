@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Mes Matériaux</h1>

    <a href="{{ route('teacher.materials.create') }}"
       class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter un Matériel</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Niveau</th>
                    <th class="px-4 py-2">Matière</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materials as $material)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $material->name }}</td>
                    <td class="px-4 py-2">{{ $material->type }}</td>
                    <td class="px-4 py-2">{{ $material->level->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $material->subject->name ?? '-' }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('teacher.materials.edit', $material) }}"
                           class="text-blue-600 hover:underline">Modifier</a>

                        <form action="{{ route('teacher.materials.destroy', $material) }}" method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Supprimer ce matériel ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">Aucun matériel trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
