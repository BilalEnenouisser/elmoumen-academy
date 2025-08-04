@extends('layouts.admin')

@section('title', 'Ajouter un Enseignant')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">👨‍🏫 Ajouter un Enseignant</h1>
    <p class="text-gray-600">Créer un nouveau compte enseignant avec toutes les informations nécessaires</p>
</div>

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <!-- Basic Information -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">📋 Informations de Base</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom complet *
                </label>
                <input type="text" name="name" id="name" required 
                       value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Entrez le nom complet">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email *
                </label>
                <input type="email" name="email" id="email" required 
                       value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Entrez l'email">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Mot de passe *
                </label>
                <input type="password" name="password" id="password" required 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Entrez le mot de passe">
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                    Rôle *
                </label>
                <input type="text" name="role" id="role" required 
                       value="{{ old('role') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Ex: Professeur de Mathématiques">
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">📝 Description</h3>
        
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                Description *
            </label>
            <textarea name="description" id="description" rows="4" required 
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                      placeholder="Décrivez l'expérience et les compétences de l'enseignant">{{ old('description') }}</textarea>
        </div>
    </div>

    <!-- Image Upload -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">🖼️ Photo de Profil</h3>
        
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                Image (optionnel)
            </label>
            <input type="file" name="image" id="image" accept="image/*"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <p class="text-sm text-gray-500 mt-1">
                Formats acceptés: JPG, PNG, GIF. Taille maximale: 2MB. 
                Si aucune image n'est fournie, la première lettre du nom sera affichée avec un fond coloré.
            </p>
        </div>
    </div>

    <!-- Settings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">⚙️ Paramètres</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Display Order -->
            <div>
                <label for="display_order" class="block text-sm font-medium text-gray-700 mb-2">
                    Ordre d'affichage
                </label>
                <input type="number" name="display_order" id="display_order" 
                       value="{{ old('display_order', 0) }}" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="0">
                <p class="text-sm text-gray-500 mt-1">Ordre d'affichage dans la page À propos</p>
            </div>

            <!-- Active Status -->
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" 
                       {{ old('is_active', true) ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                    Compte actif
                </label>
            </div>

            <!-- Show in About -->
            <div class="flex items-center">
                <input type="checkbox" name="show_in_about" id="show_in_about" 
                       {{ old('show_in_about', false) ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="show_in_about" class="ml-2 block text-sm text-gray-900">
                    Afficher dans la page À propos
                </label>
            </div>
        </div>
    </div>

    <!-- Submit Buttons -->
    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
        <a href="{{ route('admin.teachers.index') }}" 
           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-center">
            Annuler
        </a>
        <button type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Créer l'Enseignant
        </button>
    </div>
</form>
@endsection
