@extends('layouts.admin')

@section('content')
<div x-data="{ 
    showDeleteModal: false, 
    materialToDelete: null,
    materialName: ''
}">
    <h1 class="text-2xl font-bold mb-6">📚 Liste des Matériaux</h1>

    <a href="{{ route('admin.materials.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-green-700 transition-colors">➕ Ajouter</a>

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
                <tr class="border-b hover:bg-gray-50">
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
                        <a href="{{ route('admin.materials.edit', $material) }}" class="text-blue-600 hover:text-blue-800 transition-colors">Modifier</a>
                        <button 
                            @click="materialToDelete = {{ $material->id }}; materialName = '{{ addslashes($material->title) }}'; showDeleteModal = true"
                            class="text-red-600 hover:text-red-800 transition-colors cursor-pointer">
                            Supprimer
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

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
                        Confirmer la suppression
                    </h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Êtes-vous sûr de vouloir supprimer le matériel <span class="font-semibold text-gray-900" x-text="materialName"></span> ? 
                        Cette action est irréversible et supprimera également tous les PDFs et vidéos associés.
                    </p>
                </div>
                
                <!-- Modal Actions -->
                <div class="flex justify-center space-x-3">
                    <button 
                        @click="showDeleteModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Annuler
                    </button>
                    <form :action="`/admin/materials/${materialToDelete}`" method="POST" class="inline">
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
