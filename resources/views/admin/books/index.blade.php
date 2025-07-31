@extends('layouts.admin')

@section('title', 'Gestion des Livres')

@section('content')
<div x-data="{ 
    showDeleteModal: false, 
    bookToDelete: null,
    bookName: ''
}">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-2xl font-bold">📚 Gestion des Livres</h1>
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

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow p-4 lg:p-6 mb-6">
        <form method="GET" action="{{ route('admin.books.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Rechercher</label>
                    <input type="text" 
                           id="search" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Nom du livre, description, catégorie..."
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                    <select id="category" 
                            name="category" 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors w-full">
                        🔍 Rechercher
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Mobile Cards View -->
    <div class="lg:hidden space-y-4">
        @foreach ($books as $book)
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-start gap-3 mb-3">
                    @if($book->image_path)
                        <img src="{{ asset('storage/' . $book->image_path) }}" 
                             alt="{{ $book->name }}" 
                             class="w-20 h-24 object-cover rounded flex-shrink-0">
                    @else
                        <div class="w-20 h-24 bg-gray-200 rounded flex items-center justify-center flex-shrink-0">
                            <span class="text-gray-400 text-xs">Aucune image</span>
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 truncate">{{ $book->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $book->category->name }}</p>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ Str::limit($book->description, 100) }}</p>
                        <div class="flex items-center gap-2 mt-2">
                            @if($book->has_discount)
                                <span class="text-sm text-gray-500 line-through">{{ number_format($book->price, 2) }} DH</span>
                                <span class="text-sm font-semibold text-green-600">{{ number_format($book->final_price, 2) }} DH</span>
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">-{{ $book->discount_percentage }}%</span>
                            @else
                                <span class="text-sm font-semibold text-gray-900">{{ number_format($book->price, 2) }} DH</span>
                            @endif
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold ml-auto">
                                {{ $book->clicks_count }} clics
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.books.edit', $book) }}" 
                       class="flex-1 text-center bg-blue-100 text-blue-700 px-3 py-2 rounded text-sm hover:bg-blue-200 transition-colors">
                        Modifier
                    </a>
                    <button 
                        @click="bookToDelete = {{ $book->id }}; bookName = '{{ addslashes($book->name) }}'; showDeleteModal = true"
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
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Image</th>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Nom</th>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Catégorie</th>
                        <th class="p-4 text-left text-sm font-medium text-gray-900">Description</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">Prix</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">Clics</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">Statut</th>
                        <th class="p-4 text-center text-sm font-medium text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($books as $book)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4">
                                @if($book->image_path)
                                    <img src="{{ asset('storage/' . $book->image_path) }}" 
                                         alt="{{ $book->name }}" 
                                         class="w-16 h-20 object-cover rounded">
                                @else
                                    <div class="w-16 h-20 bg-gray-200 rounded flex items-center justify-center">
                                        <span class="text-gray-400 text-xs">Aucune image</span>
                                    </div>
                                @endif
                            </td>
                            <td class="p-4 text-sm text-gray-900">{{ $book->name }}</td>
                            <td class="p-4 text-sm text-gray-600">{{ $book->category->name }}</td>
                            <td class="p-4 text-sm text-gray-600 max-w-xs">
                                <div class="truncate" title="{{ $book->description }}">
                                    {{ Str::limit($book->description, 100) }}
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <div class="space-y-1">
                                    @if($book->has_discount)
                                        <div class="text-sm text-gray-500 line-through">{{ number_format($book->price, 2) }} DH</div>
                                        <div class="text-sm font-semibold text-green-600">{{ number_format($book->final_price, 2) }} DH</div>
                                        <div class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">-{{ $book->discount_percentage }}%</div>
                                    @else
                                        <div class="text-sm font-semibold text-gray-900">{{ number_format($book->price, 2) }} DH</div>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">
                                        {{ $book->clicks_count }} clics
                                    </span>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                @if($book->is_active)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Actif</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Inactif</span>
                                @endif
                            </td>
                            <td class="p-4 text-center space-x-2">
                                <a href="{{ route('admin.books.edit', $book) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors">
                                    Modifier
                                </a>
                                <button 
                                    @click="bookToDelete = {{ $book->id }}; bookName = '{{ addslashes($book->name) }}'; showDeleteModal = true"
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

    <!-- Pagination -->
    <div class="mt-6">
        {{ $books->links() }}
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
                        Êtes-vous sûr de vouloir supprimer le livre <span class="font-semibold text-gray-900" x-text="bookName"></span> ? 
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
                    <form :action="`/admin/books/${bookToDelete}`" method="POST" class="inline">
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