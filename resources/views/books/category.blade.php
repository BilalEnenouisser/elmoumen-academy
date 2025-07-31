@extends('layouts.app')

@section('content')
@php
    $whatsappNumber = \App\Models\WhatsAppNumber::getActiveNumber();
@endphp
<div class="max-w-7xl mx-auto py-8 px-4">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Accueil
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('books.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ml-2">Livres</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $category->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">📚 {{ $category->name }}</h1>
        @if($category->description)
            <p class="text-lg text-gray-600 mb-4">{{ $category->description }}</p>
        @endif
        <p class="text-gray-500">{{ $books->total() }} livre(s) dans cette catégorie</p>
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
            {{ $books->links() }}
        </div>
    @else
        <!-- No Results -->
        <div class="text-center py-12">
            <div class="text-6xl mb-4">📚</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun livre dans cette catégorie</h3>
            <p class="text-gray-600 mb-4">Aucun livre n'est disponible dans la catégorie "{{ $category->name }}" pour le moment.</p>
            <a href="{{ route('books.index') }}" 
               class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                Voir Tous les Livres
            </a>
        </div>
    @endif

    <!-- Back to Categories -->
    <div class="mt-12 text-center">
        <a href="{{ route('books.index') }}" 
           class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Retour à Toutes les Catégories
        </a>
    </div>
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