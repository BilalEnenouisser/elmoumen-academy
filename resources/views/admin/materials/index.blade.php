@extends('layouts.admin')

@section('title', 'Gestion des Matériels')

@section('content')
<div x-data="{ 
    showDeleteModal: false, 
    materialToDelete: null,
    materialName: ''
}">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-2xl font-bold">📚 Liste des Matériels</h1>
        <a href="{{ route('admin.materials.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">
            ➕ Ajouter un Matériel
        </a>
    </div>

    <!-- Mobile Cards View -->
    <div class="lg:hidden space-y-4">
        @foreach ($materials as $material)
            <div class="bg-white rounded-lg shadow p-4">
                <div class="mb-3">
                    <h3 class="font-semibold text-gray-900 mb-1">{{ $material->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $material->level->name }}</p>
                    <p class="text-sm text-gray-500">{{ $material->blocks->first()?->type ?? 'N/A' }}</p>
                </div>
                
                <div class="flex gap-2 mb-3">
                    @php
                        $totalPdfs = $material->blocks->sum(function($block) { return $block->pdfs->count(); });
                        $teacherPdfs = $material->blocks->flatMap(function($block) { 
                            return $block->pdfs->whereNotNull('teacher_id'); 
                        });
                    @endphp
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                        {{ $totalPdfs }} PDF(s)
                        @if($teacherPdfs->count() > 0)
                            <br><span class="text-xs text-gray-600">
                                {{ $teacherPdfs->count() }} par enseignants
                            </span>
                        @endif
                    </span>
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">
                        {{ $material->blocks->sum(function($block) { return $block->videos->count(); }) }} Vidéo(s)
                    </span>
                </div>
                
                <div class="flex gap-2">
                    <a href="{{ route('admin.materials.edit', $material) }}" 
                       class="flex-1 text-center bg-blue-100 text-blue-700 px-3 py-2 rounded text-sm hover:bg-blue-200 transition-colors">
                        Modifier
                    </a>
                    <button 
                        @click="materialToDelete = {{ $material->id }}; materialName = '{{ addslashes($material->title) }}'; showDeleteModal = true"
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
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Titre</th>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Niveau</th>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Type</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">PDFs</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">Vidéos</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($materials as $material)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 text-sm text-gray-900">{{ $material->title }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $material->level->name }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $material->blocks->first()?->type ?? 'N/A' }}</td>
                            <td class="p-4 text-center">
                                @php
                                    $totalPdfs = $material->blocks->sum(function($block) { return $block->pdfs->count(); });
                                    $teacherPdfs = $material->blocks->flatMap(function($block) { 
                                        return $block->pdfs->whereNotNull('teacher_id'); 
                                    });
                                @endphp
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                                    {{ $totalPdfs }} PDF(s)
                                    @if($teacherPdfs->count() > 0)
                                        <br><span class="text-xs text-gray-600">
                                            {{ $teacherPdfs->count() }} par enseignants
                                        </span>
                                    @endif
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">
                                    {{ $material->blocks->sum(function($block) { return $block->videos->count(); }) }} Vidéo(s)
                                </span>
                            </td>
                            <td class="p-4 text-center space-x-2">
                                <a href="{{ route('admin.materials.edit', $material) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors">
                                    Modifier
                                </a>
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
