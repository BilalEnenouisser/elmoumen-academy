@extends('layouts.admin')

@section('title', 'Gestion des Enseignants')

@section('content')
<div x-data="{ 
    showDeleteModal: false, 
    teacherToDelete: null,
    teacherName: ''
}">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-2xl font-bold">👨‍🏫 Gestion des Enseignants</h1>
        <a href="{{ route('admin.teachers.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
            ➕ Ajouter un Enseignant
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Mobile Cards View -->
    <div class="lg:hidden space-y-4">
        @foreach ($teachers as $teacher)
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center gap-3 mb-3">
                    @if($teacher->image_path)
                        <img src="{{ asset('storage/' . $teacher->image_path) }}" 
                             alt="{{ $teacher->name }}" 
                             class="w-12 h-12 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 rounded-full {{ $teacher->avatar_color }} flex items-center justify-center text-white font-bold text-lg">
                            {{ $teacher->first_letter }}
                        </div>
                    @endif
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">{{ $teacher->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $teacher->email }}</p>
                        <p class="text-sm text-blue-600">{{ $teacher->role }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-2 py-1 text-xs rounded-full {{ $teacher->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $teacher->is_active ? 'Actif' : 'Inactif' }}
                    </span>
                    <span class="px-2 py-1 text-xs rounded-full {{ $teacher->show_in_about ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $teacher->show_in_about ? 'Visible' : 'Caché' }}
                    </span>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.teachers.edit', $teacher) }}" 
                       class="flex-1 text-center bg-blue-100 text-blue-700 px-3 py-2 rounded text-sm hover:bg-blue-200 transition-colors">
                        Modifier
                    </a>
                    <form action="{{ route('admin.teachers.toggle-status', $teacher) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" 
                                class="w-full text-center {{ $teacher->is_active ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }} px-3 py-2 rounded text-sm hover:opacity-80 transition-colors">
                            {{ $teacher->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.teachers.toggle-show-in-about', $teacher) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" 
                                class="w-full text-center {{ $teacher->show_in_about ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }} px-3 py-2 rounded text-sm hover:opacity-80 transition-colors">
                            {{ $teacher->show_in_about ? 'Cacher' : 'Afficher' }}
                        </button>
                    </form>
                    <button 
                        @click="teacherToDelete = {{ $teacher->id }}; teacherName = '{{ addslashes($teacher->name) }}'; showDeleteModal = true"
                        class="flex-1 text-center bg-red-100 text-red-700 px-3 py-2 rounded text-sm hover:bg-red-200 transition-colors">
                        Supprimer
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Desktop Table View -->
    <div class="hidden lg:block">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Photo</th>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Nom</th>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Email</th>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Rôle</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">Statut</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">Affichage</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($teachers as $teacher)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4">
                                @if($teacher->image_path)
                                    <img src="{{ asset('storage/' . $teacher->image_path) }}" 
                                         alt="{{ $teacher->name }}" 
                                         class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-full {{ $teacher->avatar_color }} flex items-center justify-center text-white font-bold text-sm">
                                        {{ $teacher->first_letter }}
                                    </div>
                                @endif
                            </td>
                            <td class="p-4 text-sm text-gray-900">{{ $teacher->name }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $teacher->email }}</td>
                            <td class="p-4 text-sm text-blue-600">{{ $teacher->role }}</td>
                            <td class="p-4 text-center">
                                <span class="px-2 py-1 text-xs rounded-full {{ $teacher->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $teacher->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-2 py-1 text-xs rounded-full {{ $teacher->show_in_about ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $teacher->show_in_about ? 'Visible' : 'Caché' }}
                                </span>
                            </td>
                            <td class="p-4 text-center space-x-2">
                                <a href="{{ route('admin.teachers.edit', $teacher) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors">
                                    Modifier
                                </a>
                                <form action="{{ route('admin.teachers.toggle-status', $teacher) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="text-{{ $teacher->is_active ? 'yellow' : 'green' }}-600 hover:text-{{ $teacher->is_active ? 'yellow' : 'green' }}-800 transition-colors">
                                        {{ $teacher->is_active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.teachers.toggle-show-in-about', $teacher) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="text-{{ $teacher->show_in_about ? 'purple' : 'blue' }}-600 hover:text-{{ $teacher->show_in_about ? 'purple' : 'blue' }}-800 transition-colors">
                                        {{ $teacher->show_in_about ? 'Cacher' : 'Afficher' }}
                                    </button>
                                </form>
                                <button 
                                    @click="teacherToDelete = {{ $teacher->id }}; teacherName = '{{ addslashes($teacher->name) }}'; showDeleteModal = true"
                                    class="text-red-600 hover:text-red-800 transition-colors cursor-pointer">
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto"
         x-on:keydown.escape.window="showDeleteModal = false"
         style="display: none;">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showDeleteModal = false"></div>
        
        <!-- Modal -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div x-show="showDeleteModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative bg-white rounded-lg shadow-xl max-w-md w-full p-6"
                 @click.stop
                 style="display: none;">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-center mb-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                </div>
                
                <!-- Modal Content -->
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        Confirmer la Suppression
                    </h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Êtes-vous sûr de vouloir supprimer l'enseignant <span class="font-semibold text-gray-900" x-text="teacherName"></span> ? 
                        Cette action est irréversible.
                    </p>
                </div>
                
                <!-- Modal Actions -->
                <div class="flex justify-center space-x-3">
                    <button 
                        @click="showDeleteModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Annuler
                    </button>
                    <form :action="`/admin/teachers/${teacherToDelete}`" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
