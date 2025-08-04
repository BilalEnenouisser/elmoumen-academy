@extends('layouts.admin')

@section('title', 'Modifier un Enseignant')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">👨‍🏫 Modifier un Enseignant</h1>
    <p class="text-gray-600">Modifier les informations de l'enseignant</p>
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

<form action="{{ route('admin.teachers.update', $teacher) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

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
                       value="{{ old('name', $teacher->name) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Entrez le nom complet">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email *
                </label>
                <input type="email" name="email" id="email" required 
                       value="{{ old('email', $teacher->email) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Entrez l'email">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Mot de passe (laisser vide si inchangé)
                </label>
                <input type="password" name="password" id="password" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Entrez le nouveau mot de passe">
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                    Rôle *
                </label>
                <input type="text" name="role" id="role" required 
                       value="{{ old('role', $teacher->role) }}"
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
                      placeholder="Décrivez l'expérience et les compétences de l'enseignant">{{ old('description', $teacher->description) }}</textarea>
        </div>
    </div>

    <!-- Image Upload -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">🖼️ Photo de Profil</h3>
        
        <!-- Current Image -->
        @if($teacher->image_path)
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Image actuelle</label>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $teacher->image_path) }}" 
                         alt="{{ $teacher->name }}" 
                         class="w-20 h-20 rounded-full object-cover">
                    <div>
                        <p class="text-sm text-gray-600">Image actuelle</p>
                        <p class="text-xs text-gray-500">Sélectionnez une nouvelle image pour la remplacer</p>
                    </div>
                </div>
            </div>
        @else
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Avatar actuel</label>
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 rounded-full {{ $teacher->avatar_color }} flex items-center justify-center text-white font-bold text-2xl">
                        {{ $teacher->first_letter }}
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Avatar avec initiale</p>
                        <p class="text-xs text-gray-500">Sélectionnez une image pour remplacer l'avatar</p>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- New Image Upload -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                Nouvelle image (optionnel)
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
                       value="{{ old('display_order', $teacher->display_order) }}" min="0"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="0">
                <p class="text-sm text-gray-500 mt-1">Ordre d'affichage dans la page À propos</p>
            </div>

            <!-- Active Status -->
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" 
                       {{ old('is_active', $teacher->is_active) ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                    Compte actif
                </label>
            </div>

            <!-- Show in About -->
            <div class="flex items-center">
                <input type="checkbox" name="show_in_about" id="show_in_about" 
                       {{ old('show_in_about', $teacher->show_in_about) ? 'checked' : '' }}
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
            Mettre à Jour
        </button>
    </div>
</form>
@endsection
