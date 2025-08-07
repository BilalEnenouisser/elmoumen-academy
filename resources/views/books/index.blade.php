@extends('layouts.app')

@section('content')
@php
    $whatsappNumber = \App\Models\WhatsAppNumber::getActiveNumber();
@endphp

<!-- Books Index with Background -->
<section class="relative w-full min-h-screen py-20">
    <!-- Background image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/bgsec.jpg') }}" alt="Background" class="w-full h-full object-cover object-center" />
        <div class="absolute inset-0" style="background: rgba(0,7,25,0.72);"></div>
    </div>
    
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-white text-4xl md:text-5xl font-bold mb-4 leading-tight font-[Montserrat]">
                📚 Notre Collection de Livres
            </h1>
            <p class="text-blue-100 text-xl max-w-3xl mx-auto">
                Découvrez notre sélection de livres éducatifs de qualité pour tous les niveaux
            </p>
        </div>

        <!-- Search and Filter Section -->
        <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-6 mb-8 shadow-lg">
            <form method="GET" action="{{ route('books.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-white mb-2">Rechercher</label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Nom du livre, description..."
                               class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/60 focus:outline-none focus:border-blue-400 transition-colors">
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-white mb-2">Catégorie</label>
                        <select id="category" 
                                name="category" 
                                class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:border-blue-400 transition-colors">
                            <option value="" class="text-gray-900">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }} class="text-gray-900">
                                    {{ $category->name }} ({{ $category->books_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Button -->
                    <div class="flex items-end">
                        <button type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors font-semibold flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Filtrer
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results Count -->
        <div class="mb-8">
            <p class="text-blue-100 text-lg">
                {{ $books->total() }} livre(s) trouvé(s)
                @if(request('search') || request('category'))
                    <a href="{{ route('books.index') }}" class="text-cyan-400 hover:text-cyan-300 ml-2 underline">
                        (Effacer les filtres)
                    </a>
                @endif
            </p>
        </div>

        <!-- Books Grid -->
        @if($books->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($books as $book)
                <div class="backdrop-blur-lg bg-white/10 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group flex flex-col h-full">
                    <!-- Book Image -->
                    <div class="relative h-64 flex-shrink-0 rounded-t-2xl overflow-hidden" style="background-color: #001226;">
                        @if($book->image_path)
                            <div class="w-full h-full flex items-center justify-center p-4">
                                <img src="{{ asset('storage/' . $book->image_path) }}" 
                                     alt="{{ $book->name }}" 
                                     class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center text-white">
                                    <span class="text-6xl mb-2 block">📖</span>
                                    <p class="text-lg font-semibold">{{ $book->category->name }}</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Discount Badge -->
                        @if($book->has_discount)
                            <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                -{{ $book->discount_percentage }}%
                            </div>
                        @endif
                        
                        <!-- Category Badge -->
                        <div class="absolute bottom-3 left-3 bg-blue-500 text-white px-3 py-1 rounded-lg text-sm font-semibold">
                            {{ $book->category->name }}
                        </div>
                    </div>

                    <!-- Book Info -->
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex-grow">
                            <h3 class="text-white text-xl font-bold mb-2 line-clamp-2">{{ $book->name }}</h3>
                            <p class="text-blue-100 mb-4 text-sm line-clamp-2">{{ Str::limit($book->description, 80) }}</p>
                        </div>
                        
                        <!-- Price and Button -->
                        <div class="mt-auto flex-shrink-0">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex flex-col">
                                    @if($book->has_discount)
                                        <span class="text-sm text-blue-200 line-through">{{ number_format($book->price, 2) }} DH</span>
                                        <span class="text-lg font-bold text-white">{{ number_format($book->final_price, 2) }} DH</span>
                                    @else
                                        <span class="text-lg font-bold text-white">{{ number_format($book->price, 2) }} DH</span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($whatsappNumber)
                                <a href="{{ $whatsappNumber->whatsapp_url }}?text=Bonjour! Je souhaite acheter le livre '{{ $book->name }}' au prix de {{ number_format($book->final_price, 2) }} DH. Pouvez-vous me donner plus d'informations?" 
                                   target="_blank"
                                   onclick="trackBookClick({{ $book->id }})"
                                   class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center gap-2 w-full justify-center">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                    Acheter
                                </a>
                            @else
                                <a href="{{ route('books.show', $book->slug) }}" 
                                   class="bg-gray-800 hover:bg-gray-700 text-white px-3 py-2 rounded-lg text-sm font-semibold transition-colors w-full text-center">
                                    Voir Détails
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-4">
                    {{ $books->appends(request()->query())->links() }}
                </div>
            </div>
        @else
            <!-- No Results -->
            <div class="text-center py-20">
                <div class="backdrop-blur-lg bg-white/10 rounded-2xl p-12 max-w-2xl mx-auto">
                    <div class="text-8xl mb-6">📚</div>
                    <h3 class="text-2xl font-semibold text-white mb-4">Aucun livre trouvé</h3>
                    <p class="text-blue-100 mb-6 text-lg">
                        @if(request('search') || request('category'))
                            Essayez de modifier vos critères de recherche.
                        @else
                            Aucun livre n'est disponible pour le moment.
                        @endif
                    </p>
                    @if(request('search') || request('category'))
                        <a href="{{ route('books.index') }}" 
                           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg transition-colors font-semibold">
                            Voir Tous les Livres
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Custom pagination styles for dark theme */
.pagination {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
}

.pagination .page-link {
    color: white !important;
    background-color: rgba(255, 255, 255, 0.1) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    padding: 0.5rem 0.75rem;
    border-radius: 0.5rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background-color: rgba(255, 255, 255, 0.2) !important;
    border-color: rgba(255, 255, 255, 0.3) !important;
    color: white !important;
}

.pagination .page-item.active .page-link {
    background-color: #06b6d4 !important;
    border-color: #06b6d4 !important;
    color: white !important;
}

.pagination .page-item.disabled .page-link {
    color: rgba(255, 255, 255, 0.5) !important;
    background-color: rgba(255, 255, 255, 0.05) !important;
}

/* Books grid responsive improvements */
.backdrop-blur-lg {
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
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