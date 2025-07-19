@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">👨‍🏫 Liste des enseignants</h1>

<a href="{{ route('admin.teachers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter enseignant</a>

<table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 text-left">Nom</th>
            <th class="p-3 text-left">Email</th>
            <th class="p-3">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teachers as $teacher)
            <tr class="border-b">
                <td class="p-3">{{ $teacher->name }}</td>
                <td class="p-3">{{ $teacher->email }}</td>
                <td class="p-3 text-center space-x-2">
                    <a href="{{ route('admin.teachers.edit', $teacher) }}" class="text-blue-600">Modifier</a>
                    <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
