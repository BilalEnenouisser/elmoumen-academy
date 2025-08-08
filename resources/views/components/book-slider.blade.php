@php
    $featuredBooks = \App\Models\Book::with('category')
        ->active()
        ->orderByRaw('CASE WHEN reduced_price IS NOT NULL AND reduced_price < price THEN 1 ELSE 2 END')
        ->orderBy('created_at', 'desc')
        ->limit(8)
        ->get();
    
    $whatsappNumber = \App\Models\WhatsAppNumber::getActiveNumber();
@endphp

@if($featuredBooks->count() > 0)
<section class="py-12" style="background-color: #dee7f1;">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Nos meilleurs livres</h2>
            <p class="text-gray-600">Accédez à des livres scolaires soigneusement conçus pour renforcer l'apprentissage et compléter les cours individuels.</p>
        </div>

        <!-- Book Slider Container -->
        <div class="relative">
            <!-- Swiper Container -->
            <div class="swiper book-swiper">
                <div class="swiper-wrapper">
                    @foreach($featuredBooks as $book)
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group flex flex-col h-full">
                            <!-- Book Cover with Dark Blue Background -->
                            <div class="relative h-64 flex-shrink-0" style="background-color: #001226; overflow: hidden;">
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
                                            <p class="text-lg font-semibold">{{ $book->name }}</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Discount Badge -->
                                @if($book->has_discount)
                                    <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                        -{{ $book->discount_percentage }}%
                                    </div>
                                @endif
                            </div>

                            <!-- Metadata Section -->
                            <div class="px-4 py-3 bg-gray-50 border-b flex-shrink-0">
                                <div class="flex items-center justify-between text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <!-- Category Icon -->
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                        </svg>
                                        <span>{{ $book->category->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <!-- Time Icon -->
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>{{ $book->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Book Info -->
                            <div class="p-4 flex flex-col flex-grow">
                                <div class="flex-grow">
                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 text-lg">{{ $book->name }}</h3>
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ Str::limit($book->description, 80) }}</p>
                                </div>
                                
                                <!-- Price and WhatsApp Button -->
                                <div class="flex items-center justify-between w-full mt-auto pt-4 border-t border-gray-200 flex-shrink-0">
                                    <div class="w-1/2">
                                        @if($book->has_discount)
                                            <span class="text-sm text-gray-500 line-through block">{{ number_format($book->price, 2) }} DH</span>
                                            <span class="text-lg font-bold text-gray-900 block">{{ number_format($book->final_price, 2) }} DH</span>
                                        @else
                                            <span class="text-lg font-bold text-gray-900 block">{{ number_format($book->price, 2) }} DH</span>
                                        @endif
                                    </div>
                                    
                                    <div class="w-1/2">
                                        @if($whatsappNumber)
                                            <a href="{{ $whatsappNumber->whatsapp_url }}?text=Bonjour! Je souhaite acheter le livre '{{ $book->name }}' au prix de {{ number_format($book->final_price, 2) }} DH. Pouvez-vous me donner plus d'informations?" 
                                               target="_blank"
                                               onclick="trackBookClick({{ $book->id }})"
                                               class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm transition-colors flex items-center gap-1 w-full justify-center whitespace-nowrap">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                                </svg>
                                                Acheter
                                            </a>
                                        @else
                                            <a href="{{ route('books.show', $book->slug) }}" 
                                               class="bg-gray-800 text-white px-3 py-2 rounded-lg text-sm hover:bg-gray-700 transition-colors w-full justify-center whitespace-nowrap">
                                                Voir Détails
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Navigation Arrows (hidden on mobile) -->
                <div class="swiper-button-next book-swiper-button-next hidden lg:flex"></div>
                <div class="swiper-button-prev book-swiper-button-prev hidden lg:flex"></div>
                
                <!-- Pagination -->
                <div class="swiper-pagination book-swiper-pagination"></div>
            </div>
        </div>

        <!-- View All Books Button -->
        <div class="text-center mt-8">
            <a href="{{ route('books.index') }}" 
               class="inline-flex items-center gap-2 bg-[#001226] text-white px-6 py-3 rounded-lg hover:bg-[#0a1a2e] transition-colors">
                Voir Tous les Livres
            </a>
        </div>
    </div>
</section>

<style>
/* Custom Swiper Styles for Books */
.book-swiper {
    padding: 0 60px 40px 60px;
}

.book-swiper .swiper-slide {
    height: auto;
}

.book-swiper-button-next,
.book-swiper-button-prev {
    color: #1f2937;
    background: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.book-swiper-button-next:hover,
.book-swiper-button-prev:hover {
    background: #f3f4f6;
    transform: scale(1.1);
}

.book-swiper-button-next::after,
.book-swiper-button-prev::after {
    font-size: 16px;
    font-weight: bold;
}

.book-swiper-pagination {
    bottom: 0;
}

.book-swiper-pagination .swiper-pagination-bullet {
    background: #d1d5db;
    opacity: 1;
}

.book-swiper-pagination .swiper-pagination-bullet-active {
    background: #3b82f6;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .book-swiper {
        padding: 0 20px 40px 20px;
    }
    
    .book-swiper-button-next,
    .book-swiper-button-prev {
        display: none !important;
    }
}

/* Ensure price and WhatsApp button are always visible */
.book-swiper .swiper-slide {
    display: flex !important;
    height: auto !important;
    min-height: 500px;
}

.book-swiper .swiper-slide > div {
    width: 100%;
    display: flex;
    flex-direction: column;
}

.book-swiper .swiper-slide .flex-grow {
    min-height: 120px;
}

.book-swiper .swiper-slide .mt-auto {
    margin-top: auto !important;
}

.book-swiper .swiper-slide .pt-4 {
    padding-top: 1rem !important;
}

.book-swiper .swiper-slide .border-t {
    border-top: 1px solid #e5e7eb !important;
}

/* Ensure button and price section is always visible */
.book-swiper .swiper-slide .flex-shrink-0 {
    flex-shrink: 0 !important;
}
</style>

<script>
// Initialize Book Swiper
document.addEventListener('DOMContentLoaded', function() {
    const bookSwiper = new Swiper('.book-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.book-swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.book-swiper-button-next',
            prevEl: '.book-swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        },
        // Enable touch/swipe gestures
        allowTouchMove: true,
        // Enable mouse drag
        allowMouseEvents: true,
    });
});

function trackBookClick(bookId) {
    fetch(`/books/${bookId}/click`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).catch(error => {
        console.error('Error tracking book click:', error);
    });
}
</script>
@endif 