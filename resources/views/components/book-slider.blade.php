@php
    $featuredBooks = \App\Models\Book::with('category')
        ->active()
        ->orderByRaw('CASE WHEN reduced_price IS NOT NULL AND reduced_price < price THEN 1 ELSE 2 END')
        ->orderBy('created_at', 'desc')
        ->limit(4)
        ->get();
    
    $whatsappNumber = \App\Models\WhatsAppNumber::getActiveNumber();
@endphp

@if($featuredBooks->count() > 0)
<section class="py-12 bg-gradient-to-br from-green-50 to-blue-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">📚 Livres Recommandés</h2>
            <p class="text-gray-600">Découvrez nos meilleurs livres avec des réductions exclusives</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredBooks as $book)
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

        <!-- View All Books Button -->
        <div class="text-center mt-8">
            <a href="{{ route('books.index') }}" 
               class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                📚 Voir Tous les Livres
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<script>
function trackBookClick(bookId) {
    console.log('trackBookClick called with bookId:', bookId);
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('CSRF token not found!');
        return;
    }
    
    console.log('CSRF token found:', csrfToken.getAttribute('content'));
    
    fetch(`/books/${bookId}/click`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Book click tracked successfully:', data);
    })
    .catch(error => {
        console.error('Error tracking book click:', error);
    });
}
</script>
@endif 