@extends('layouts.admin')

@section('title', 'Gestion des Catégories de Livres')

@section('content')
<div x-data="{ 
    showDeleteModal: false, 
    categoryToDelete: null,
    categoryName: ''
}">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-2xl font-bold">🏷️ Gestion des Catégories de Livres</h1>
        <a href="{{ route('admin.books.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">
            ➕ Ajouter un Livre
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Add New Category Form -->
    <div class="bg-white rounded-lg shadow p-4 lg:p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Ajouter une Nouvelle Catégorie</h2>
        <form method="POST" action="{{ route('admin.books.categories.store') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nom de la Catégorie *
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           required
                           value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Ex: Mathématiques, Littérature...">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="1"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                              placeholder="Description de la catégorie...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                ➕ Ajouter la Catégorie
            </button>
        </form>
    </div>

    <!-- Categories List -->
    <div class="bg-white rounded-lg shadow p-4 lg:p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Catégories Existantes</h2>
        
        @if($categories->count() > 0)
            <!-- Mobile Cards View -->
            <div class="lg:hidden space-y-4">
                @foreach($categories as $category)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
                                @if($category->description)
                                    <p class="text-sm text-gray-600 mt-1">{{ $category->description }}</p>
                                @endif
                                <p class="text-sm text-gray-500 mt-2">{{ $category->books_count }} livre(s)</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button 
                                @click="editCategory({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description ?? '') }}')"
                                class="flex-1 text-center bg-blue-100 text-blue-700 px-3 py-2 rounded text-sm hover:bg-blue-200 transition-colors">
                                Modifier
                            </button>
                            <button 
                                @click="categoryToDelete = {{ $category->id }}; categoryName = '{{ addslashes($category->name) }}'; showDeleteModal = true"
                                class="flex-1 text-center bg-red-100 text-red-700 px-3 py-2 rounded text-sm hover:bg-red-200 transition-colors">
                                Supprimer
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop Table View -->
            <div class="hidden lg:block">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4 text-left text-sm font-medium text-gray-900">Nom</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-900">Description</th>
                            <th class="p-4 text-center text-sm font-medium text-gray-900">Nombre de Livres</th>
                            <th class="p-4 text-center text-sm font-medium text-gray-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="p-4 text-sm text-gray-900 font-medium">{{ $category->name }}</td>
                                <td class="p-4 text-sm text-gray-600">
                                    {{ $category->description ?: 'Aucune description' }}
                                </td>
                                <td class="p-4 text-center">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                                        {{ $category->books_count }} livre(s)
                                    </span>
                                </td>
                                <td class="p-4 text-center space-x-2">
                                    <button 
                                        @click="editCategory({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description ?? '') }}')"
                                        class="text-blue-600 hover:text-blue-800 transition-colors">
                                        Modifier
                                    </button>
                                    <button 
                                        @click="categoryToDelete = {{ $category->id }}; categoryName = '{{ addslashes($category->name) }}'; showDeleteModal = true"
                                        class="text-red-600 hover:text-red-800 transition-colors cursor-pointer">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Aucune catégorie créée pour le moment.</p>
        @endif
    </div>

    <!-- Edit Category Modal -->
    <div x-show="showEditModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto"
         x-on:keydown.escape.window="showEditModal = false"
         style="display: none;">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showEditModal = false"></div>
        
        <!-- Modal -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div x-show="showEditModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative bg-white rounded-lg shadow-xl max-w-md w-full p-6"
                 @click.stop
                 style="display: none;">
                
                <h3 class="text-lg font-medium text-gray-900 mb-4">Modifier la Catégorie</h3>
                
                <form :action="`/admin/books/categories/${editCategoryId}`" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                        <input type="text" 
                               name="name" 
                               x-model="editCategoryName"
                               required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" 
                                  x-model="editCategoryDescription"
                                  rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                @click="showEditModal = false"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 transition-colors">
                            Annuler
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 transition-colors">
                            Mettre à Jour
                        </button>
                    </div>
                </form>
            </div>
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
                        Êtes-vous sûr de vouloir supprimer la catégorie <span class="font-semibold text-gray-900" x-text="categoryName"></span> ? 
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
                    <form :action="`/admin/books/categories/${categoryToDelete}`" method="POST" class="inline">
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

<script>
    function editCategory(id, name, description) {
        // This would need to be implemented with a proper modal or redirect to edit page
        // For now, we'll redirect to a simple edit form
        window.location.href = `/admin/books/categories/${id}/edit?name=${encodeURIComponent(name)}&description=${encodeURIComponent(description)}`;
    }
</script>
@endsection 