@extends('layouts.admin')

@section('title', 'Gestion de la Structure Académique')

@section('content')
    <h1 class="text-2xl font-bold mb-6">🏛️ Gestion de la Structure Académique</h1>

    <!-- Years Section -->
    <div class="bg-white rounded-lg shadow p-4 lg:p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">🎓 Années</h2>
        
        <form method="POST" action="{{ route('admin.years.store') }}" class="mb-6">
            @csrf
            <div class="flex flex-col sm:flex-row gap-3">
                <input type="text" 
                       name="name" 
                       placeholder="Nom de l'année" 
                       class="border border-gray-300 rounded-md p-3 flex-grow focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                       required>
                <select name="level_id" 
                        class="border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                        required>
                    <option value="">Sélectionner un Niveau</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition-colors">
                    ➕ Ajouter
                </button>
            </div>
        </form>

        <div class="space-y-2">
            @foreach($years as $year)
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 p-3 bg-gray-50 rounded-lg">
                <span class="font-medium text-gray-900">{{ $year->name }} ({{ $year->level->name }})</span>
                <form method="POST" action="{{ route('admin.years.destroy', $year) }}" class="flex-shrink-0">
                    @csrf @method('DELETE')
                    <button type="submit" 
                            class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm hover:bg-red-200 transition-colors"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette année ?')">
                        Supprimer
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Fields Section -->
    <div class="bg-white rounded-lg shadow p-4 lg:p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">🔬 Filières</h2>
        
        <form method="POST" action="{{ route('admin.fields.store') }}" class="mb-6">
            @csrf
            <div class="flex flex-col sm:flex-row gap-3">
                <input type="text" 
                       name="name" 
                       placeholder="Nom de la filière" 
                       class="border border-gray-300 rounded-md p-3 flex-grow focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                       required>
                <select name="level_id" 
                        class="border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                        required>
                    <option value="">Sélectionner un Niveau</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition-colors">
                    ➕ Ajouter
                </button>
            </div>
        </form>

        <div class="space-y-2">
            @foreach($fields as $field)
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 p-3 bg-gray-50 rounded-lg">
                <span class="font-medium text-gray-900">{{ $field->name }} ({{ $field->level->name }})</span>
                <form method="POST" action="{{ route('admin.fields.destroy', $field) }}" class="flex-shrink-0">
                    @csrf @method('DELETE')
                    <button type="submit" 
                            class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm hover:bg-red-200 transition-colors"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?')">
                        Supprimer
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
@endsection