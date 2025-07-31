@extends('layouts.app')

@section('content')
@php
    $whatsappNumber = \App\Models\WhatsAppNumber::getActiveNumber();
@endphp
<div class="max-w-7xl mx-auto py-8 px-4">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">📚 Notre Collection de Livres</h1>
        <p class="text-lg text-gray-600">Découvrez notre sélection de livres éducatifs de qualité</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('books.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Rechercher</label>
                    <input type="text" 
                           id="search" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Nom du livre, description..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>

                <!-- Category Filter -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                    <select id="category" 
                            name="category" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }} ({{ $category->books_count }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="flex items-end">
                    <button type="submit" 
                            class="w-full bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        🔍 Filtrer
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Count -->
    <div class="mb-6">
        <p class="text-gray-600">
            {{ $books->total() }} livre(s) trouvé(s)
            @if(request('search') || request('category'))
                <a href="{{ route('books.index') }}" class="text-green-600 hover:text-green-700 ml-2">
                    (Effacer les filtres)
                </a>
            @endif
        </p>
    </div>

    <!-- Books Grid -->
    @if($books->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($books as $book)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                <!-- Book Image -->
                <div class="relative h-48 overflow-hidden">
                    @if($book->image_path)
                        <img src="{{ asset('storage/' . $book->image_path) }}" 
                             alt="{{ $book->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <span class="text-gray-400 text-4xl">📖</span>
                        </div>
                    @endif
                    
                    <!-- Discount Badge -->
                    @if($book->has_discount)
                        <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                            -{{ $book->discount_percentage }}%
                        </div>
                    @endif
                    
                    <!-- Category Badge -->
                    <div class="absolute bottom-2 left-2 bg-blue-500 text-white px-2 py-1 rounded text-xs">
                        {{ $book->category->name }}
                    </div>
                </div>

                <!-- Book Info -->
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $book->name }}</h3>
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($book->description, 80) }}</p>
                    
                    <!-- Price -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            @if($book->has_discount)
                                <span class="text-sm text-gray-500 line-through">{{ number_format($book->price, 2) }} DH</span>
                                <span class="text-lg font-bold text-green-600">{{ number_format($book->final_price, 2) }} DH</span>
                            @else
                                <span class="text-lg font-bold text-gray-900">{{ number_format($book->price, 2) }} DH</span>
                            @endif
                        </div>
                        
                        @if($whatsappNumber)
                            <a href="{{ $whatsappNumber->whatsapp_url }}?text=Bonjour! Je souhaite acheter le livre '{{ $book->name }}' au prix de {{ number_format($book->final_price, 2) }} DH. Pouvez-vous me donner plus d'informations?" 
                               target="_blank"
                               onclick="trackBookClick({{ $book->id }})"
                               class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition-colors">
                                📱 Acheter
                            </a>
                        @else
                            <a href="{{ route('books.show', $book->slug) }}" 
                               class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition-colors">
                                Voir Détails
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $books->appends(request()->query())->links() }}
        </div>
    @else
        <!-- No Results -->
        <div class="text-center py-12">
            <div class="text-6xl mb-4">📚</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun livre trouvé</h3>
            <p class="text-gray-600 mb-4">
                @if(request('search') || request('category'))
                    Essayez de modifier vos critères de recherche.
                @else
                    Aucun livre n'est disponible pour le moment.
                @endif
            </p>
            @if(request('search') || request('category'))
                <a href="{{ route('books.index') }}" 
                   class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                    Voir Tous les Livres
                </a>
            @endif
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
function trackBookClick(bookId) {
    fetch(`/books/${bookId}/click`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Book click tracked:', data);
    })
    .catch(error => {
        console.error('Error tracking book click:', error);
    });
}
</script>
@endsection 