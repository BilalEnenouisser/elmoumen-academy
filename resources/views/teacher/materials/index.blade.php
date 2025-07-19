@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Mes Matériels Pédagogiques</h1>
    
    <a href="{{ route('teacher.materials.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        Ajouter un nouveau matériel
    </a>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">Titre</th>
                    <th class="px-6 py-3 text-left">Type</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($materials as $material)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $material->title }}</td>
                        <td class="px-6 py-4">{{ $material->type }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('teacher.materials.edit', $material) }}" class="text-blue-600 mr-3">Modifier</a>
                            <form action="{{ route('teacher.materials.destroy', $material) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                            Aucun matériel trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection