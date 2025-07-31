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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $book->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Book Details -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <!-- Book Image -->
        <div class="space-y-4">
            <div class="relative">
                @if($book->image_path)
                    <img src="{{ asset('storage/' . $book->image_path) }}" 
                         alt="{{ $book->name }}" 
                         class="w-full rounded-lg shadow-lg">
                @else
                    <div class="w-full h-96 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400 text-8xl">📖</span>
                    </div>
                @endif
                
                <!-- Discount Badge -->
                @if($book->has_discount)
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-2 rounded-full text-sm font-bold">
                        -{{ $book->discount_percentage }}%
                    </div>
                @endif
                
                <!-- Category Badge -->
                <div class="absolute bottom-4 left-4 bg-blue-500 text-white px-3 py-2 rounded text-sm">
                    {{ $book->category->name }}
                </div>
            </div>
        </div>

        <!-- Book Info -->
        <div class="space-y-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $book->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $book->description }}</p>
            </div>

            <!-- Price Section -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Prix</h3>
                <div class="flex items-center gap-4">
                    @if($book->has_discount)
                        <div class="text-3xl font-bold text-green-600">{{ number_format($book->final_price, 2) }} DH</div>
                        <div class="text-xl text-gray-500 line-through">{{ number_format($book->price, 2) }} DH</div>
                        <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                            Économisez {{ number_format($book->price - $book->final_price, 2) }} DH
                        </div>
                    @else
                        <div class="text-3xl font-bold text-gray-900">{{ number_format($book->price, 2) }} DH</div>
                    @endif
                </div>
            </div>

            <!-- Category Info -->
            <div class="bg-blue-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Catégorie</h3>
                <p class="text-blue-700">{{ $book->category->name }}</p>
                @if($book->category->description)
                    <p class="text-gray-600 mt-2">{{ $book->category->description }}</p>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                @if($whatsappNumber)
                    <a href="{{ $whatsappNumber->whatsapp_url }}?text=Bonjour! Je souhaite acheter le livre '{{ $book->name }}' au prix de {{ number_format($book->final_price, 2) }} DH. Pouvez-vous me donner plus d'informations?" 
                       target="_blank"
                       onclick="trackBookClick({{ $book->id }})"
                       class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium text-center">
                        📱 Acheter par WhatsApp
                    </a>
                @else
                    <button class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium">
                        🛒 Ajouter au Panier
                    </button>
                @endif
                <button class="flex-1 bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                    ❤️ Ajouter aux Favoris
                </button>
            </div>

            <!-- Additional Info -->
            <div class="border-t pt-6">
                <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                    <div>
                        <span class="font-medium">Référence:</span> BK-{{ $book->id }}
                    </div>
                    <div>
                        <span class="font-medium">Disponibilité:</span> 
                        <span class="text-green-600">En stock</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Books -->
    @if($relatedBooks->count() > 0)
    <div class="border-t pt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">📚 Livres Similaires</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedBooks as $relatedBook)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <!-- Book Image -->
                <div class="relative h-40 overflow-hidden">
                    @if($relatedBook->image_path)
                        <img src="{{ asset('storage/' . $relatedBook->image_path) }}" 
                             alt="{{ $relatedBook->name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <span class="text-gray-400 text-3xl">📖</span>
                        </div>
                    @endif
                    
                    <!-- Discount Badge -->
                    @if($relatedBook->has_discount)
                        <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                            -{{ $relatedBook->discount_percentage }}%
                        </div>
                    @endif
                </div>

                <!-- Book Info -->
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-2 text-sm line-clamp-2">{{ $relatedBook->name }}</h3>
                    
                    <!-- Price -->
                    <div class="flex items-center gap-2 mb-3">
                        @if($relatedBook->has_discount)
                            <span class="text-xs text-gray-500 line-through">{{ number_format($relatedBook->price, 2) }} DH</span>
                            <span class="text-sm font-bold text-green-600">{{ number_format($relatedBook->final_price, 2) }} DH</span>
                        @else
                            <span class="text-sm font-bold text-gray-900">{{ number_format($relatedBook->price, 2) }} DH</span>
                        @endif
                    </div>
                    
                                         @if($whatsappNumber)
                         <a href="{{ $whatsappNumber->whatsapp_url }}?text=Bonjour! Je souhaite acheter le livre '{{ $relatedBook->name }}' au prix de {{ number_format($relatedBook->final_price, 2) }} DH. Pouvez-vous me donner plus d'informations?" 
                            target="_blank"
                            onclick="trackBookClick({{ $relatedBook->id }})"
                            class="block w-full bg-green-600 text-white text-center px-3 py-2 rounded text-sm hover:bg-green-700 transition-colors">
                             📱 Acheter
                         </a>
                     @else
                         <a href="{{ route('books.show', $relatedBook->slug) }}" 
                            class="block w-full bg-green-600 text-white text-center px-3 py-2 rounded text-sm hover:bg-green-700 transition-colors">
                             Voir Détails
                         </a>
                     @endif
                </div>
            </div>
            @endforeach
        </div>
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