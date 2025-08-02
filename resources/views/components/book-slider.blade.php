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
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Livres Recommandés</h2>
            <p class="text-gray-600">Découvrez nos meilleurs livres avec des réductions exclusives</p>
        </div>

        <!-- Book Slider Container -->
        <div class="relative">
            <!-- Navigation Arrows - Outside the section (hidden on mobile) -->
            <button class="hidden lg:block absolute -left-12 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:bg-gray-50 transition-colors" onclick="slideBooks('prev')">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <button class="hidden lg:block absolute -right-12 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:bg-gray-50 transition-colors" onclick="slideBooks('next')">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Mobile Navigation Arrows (visible on mobile) -->
            <button class="lg:hidden absolute left-2 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-2 shadow-lg hover:bg-gray-50 transition-colors" onclick="slideBooksMobile('prev')">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <button class="lg:hidden absolute right-2 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-2 shadow-lg hover:bg-gray-50 transition-colors" onclick="slideBooksMobile('next')">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Desktop Slider Track (hidden on mobile) -->
            <div class="hidden lg:block overflow-hidden">
                <div id="bookSlider" class="flex transition-transform duration-300 ease-in-out">
                    @foreach($featuredBooks->chunk(4) as $chunkIndex => $bookChunk)
                    <div class="flex w-full px-12 gap-6 min-w-full">
                        @foreach($bookChunk as $book)
                        <div class="flex-1 min-w-0">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                                <!-- Book Cover with Dark Blue Background -->
                                <div class="relative h-64" style="background-color: #001226; overflow: hidden;">
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
                                <div class="px-4 py-3 bg-gray-50 border-b">
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
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 text-lg">{{ $book->name }}</h3>
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ Str::limit($book->description, 80) }}</p>
                                    
                                    <!-- Price and WhatsApp Button -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex flex-col">
                                            @if($book->has_discount)
                                                <span class="text-sm text-gray-500 line-through">{{ number_format($book->price, 2) }} DH</span>
                                                <span class="text-lg font-bold text-gray-900">{{ number_format($book->final_price, 2) }} DH</span>
                                            @else
                                                <span class="text-lg font-bold text-gray-900">{{ number_format($book->price, 2) }} DH</span>
                                            @endif
                                        </div>
                                        
                                        @if($whatsappNumber)
                                            <a href="{{ $whatsappNumber->whatsapp_url }}?text=Bonjour! Je souhaite acheter le livre '{{ $book->name }}' au prix de {{ number_format($book->final_price, 2) }} DH. Pouvez-vous me donner plus d'informations?" 
                                               target="_blank"
                                               onclick="trackBookClick({{ $book->id }})"
                                               class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition-colors flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                                </svg>
                                                Achat via WhatsApp
                                            </a>
                                        @else
                                            <a href="{{ route('books.show', $book->slug) }}" 
                                               class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition-colors">
                                                Voir Détails
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Mobile Slider Track (visible on mobile) -->
            <div class="lg:hidden overflow-hidden">
                <div id="bookSliderMobile" class="flex transition-transform duration-300 ease-in-out">
                    @foreach($featuredBooks as $book)
                    <div class="w-full px-4 min-w-full">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                            <!-- Book Cover with Dark Blue Background -->
                            <div class="relative h-48" style="background-color: #001226; overflow: hidden;">
                                @if($book->image_path)
                                    <div class="w-full h-full flex items-center justify-center p-4">
                                        <img src="{{ asset('storage/' . $book->image_path) }}" 
                                             alt="{{ $book->name }}" 
                                             class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-center text-white">
                                            <span class="text-4xl mb-2 block">📖</span>
                                            <p class="text-base font-semibold">{{ $book->name }}</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Discount Badge -->
                                @if($book->has_discount)
                                    <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                        -{{ $book->discount_percentage }}%
                                    </div>
                                @endif
                            </div>

                            <!-- Metadata Section -->
                            <div class="px-3 py-2 bg-gray-50 border-b">
                                <div class="flex items-center justify-between text-xs text-gray-600">
                                    <div class="flex items-center gap-1">
                                        <!-- Category Icon -->
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                        </svg>
                                        <span>{{ $book->category->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <!-- Time Icon -->
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>{{ $book->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Book Info -->
                            <div class="p-3">
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 text-base">{{ $book->name }}</h3>
                                <p class="text-xs text-gray-600 mb-3 line-clamp-2">{{ Str::limit($book->description, 60) }}</p>
                                
                                <!-- Price and WhatsApp Button -->
                                <div class="flex items-center justify-between">
                                    <div class="flex flex-col">
                                        @if($book->has_discount)
                                            <span class="text-xs text-gray-500 line-through">{{ number_format($book->price, 2) }} DH</span>
                                            <span class="text-base font-bold text-gray-900">{{ number_format($book->final_price, 2) }} DH</span>
                                        @else
                                            <span class="text-base font-bold text-gray-900">{{ number_format($book->price, 2) }} DH</span>
                                        @endif
                                    </div>
                                    
                                    @if($whatsappNumber)
                                        <a href="{{ $whatsappNumber->whatsapp_url }}?text=Bonjour! Je souhaite acheter le livre '{{ $book->name }}' au prix de {{ number_format($book->final_price, 2) }} DH. Pouvez-vous me donner plus d'informations?" 
                                           target="_blank"
                                           onclick="trackBookClick({{ $book->id }})"
                                           class="bg-gray-800 text-white px-3 py-1 rounded text-xs hover:bg-gray-700 transition-colors flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                            </svg>
                                            Acheter
                                        </a>
                                    @else
                                        <a href="{{ route('books.show', $book->slug) }}" 
                                           class="bg-gray-800 text-white px-3 py-1 rounded text-xs hover:bg-gray-700 transition-colors">
                                            Détails
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Pagination Dots -->
            <div class="flex justify-center mt-6 space-x-2">
                <!-- Desktop pagination dots -->
                <div class="hidden lg:flex space-x-2">
                    @for($i = 0; $i < ceil($featuredBooks->count() / 4); $i++)
                        <button class="w-3 h-3 rounded-full transition-colors {{ $i === 0 ? 'bg-blue-600' : 'bg-blue-300' }}" 
                                onclick="goToSlide({{ $i }})" 
                                id="dot-{{ $i }}"></button>
                    @endfor
                </div>
                <!-- Mobile pagination dots -->
                <div class="lg:hidden flex space-x-2">
                    @for($i = 0; $i < $featuredBooks->count(); $i++)
                        <button class="w-2 h-2 rounded-full transition-colors {{ $i === 0 ? 'bg-blue-600' : 'bg-blue-300' }}" 
                                onclick="goToSlideMobile({{ $i }})" 
                                id="dot-mobile-{{ $i }}"></button>
                    @endfor
                </div>
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

<!-- Book Purchase Section -->
<section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Achetez Nos Livres
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Découvrez notre collection de livres éducatifs et profitez de nos offres spéciales
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Featured Book Display -->
            <div class="relative">
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    @if($featuredBooks->first() && $featuredBooks->first()->image_path)
                        <img src="{{ asset('storage/' . $featuredBooks->first()->image_path) }}" 
                             alt="{{ $featuredBooks->first()->name }}" 
                             class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center">
                            <div class="text-center text-white">
                                <span class="text-8xl mb-4 block">📚</span>
                                <p class="text-2xl font-bold">Livre Éducatif</p>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Floating Badge -->
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-full font-bold shadow-lg">
                        -25%
                    </div>
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute -top-4 -left-4 w-8 h-8 bg-yellow-400 rounded-full opacity-60"></div>
                <div class="absolute -bottom-4 -right-4 w-6 h-6 bg-pink-400 rounded-full opacity-60"></div>
            </div>

            <!-- Purchase Information -->
            <div class="space-y-8">
                @if($featuredBooks->first())
                    @php $featuredBook = $featuredBooks->first(); @endphp
                    
                    <!-- Book Title -->
                    <div>
                        <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            {{ $featuredBook->name }}
                        </h3>
                        <div class="w-20 h-1 bg-blue-600 rounded-full"></div>
                    </div>

                    <!-- Book Description -->
                    <div>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            {{ $featuredBook->description ?: 'Un livre éducatif exceptionnel conçu pour enrichir vos connaissances et développer vos compétences. Parfait pour les étudiants de tous niveaux.' }}
                        </p>
                    </div>

                    <!-- Price Information -->
                    <div class="bg-white rounded-xl p-6 shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-gray-900">Prix</span>
                            <div class="flex items-center gap-3">
                                @if($featuredBook->has_discount)
                                    <span class="text-xl text-gray-500 line-through">{{ number_format($featuredBook->price, 2) }} DH</span>
                                    <span class="text-3xl font-bold text-red-600">{{ number_format($featuredBook->final_price, 2) }} DH</span>
                                @else
                                    <span class="text-3xl font-bold text-blue-600">{{ number_format($featuredBook->price, 2) }} DH</span>
                                @endif
                            </div>
                        </div>
                        
                        @if($featuredBook->has_discount)
                            <div class="bg-green-100 border border-green-200 rounded-lg p-3">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-green-800 font-semibold">Économisez {{ number_format($featuredBook->price - $featuredBook->final_price, 2) }} DH</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Features -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Livraison gratuite</span>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Livraison rapide</span>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Qualité garantie</span>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Support client</span>
                        </div>
                    </div>

                    <!-- WhatsApp Purchase Button -->
                    @if($whatsappNumber)
                        <div class="space-y-4">
                            <a href="{{ $whatsappNumber->whatsapp_url }}?text=Bonjour! Je souhaite acheter le livre '{{ $featuredBook->name }}' au prix de {{ number_format($featuredBook->final_price, 2) }} DH. Pouvez-vous me donner plus d'informations sur la livraison et le paiement?" 
                               target="_blank"
                               onclick="trackBookClick({{ $featuredBook->id }})"
                               class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-4 px-6 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <div class="flex items-center justify-center gap-3">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                    Achat via WhatsApp
                                </div>
                            </a>
                            
                            <p class="text-sm text-gray-500 text-center">
                                Cliquez pour commander via WhatsApp et profiter de notre service client personnalisé
                            </p>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</section>

<script>
// Desktop slider variables
let currentSlide = 0;
const totalSlides = {{ ceil($featuredBooks->count() / 4) }};

// Mobile slider variables
let currentSlideMobile = 0;
const totalSlidesMobile = {{ $featuredBooks->count() }};

// Desktop slider functions
function slideBooks(direction) {
    if (direction === 'next') {
        currentSlide = (currentSlide + 1) % totalSlides;
    } else {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    }
    updateSlider();
}

function goToSlide(slideIndex) {
    currentSlide = slideIndex;
    updateSlider();
}

function updateSlider() {
    const slider = document.getElementById('bookSlider');
    const translateX = -currentSlide * 100;
    
    slider.style.transform = `translateX(${translateX}%)`;
    
    // Update pagination dots
    document.querySelectorAll('[id^="dot-"]').forEach((dot, index) => {
        if (index === currentSlide) {
            dot.classList.remove('bg-blue-300');
            dot.classList.add('bg-blue-600');
        } else {
            dot.classList.remove('bg-blue-600');
            dot.classList.add('bg-blue-300');
        }
    });
}

// Mobile slider functions
function slideBooksMobile(direction) {
    if (direction === 'next') {
        currentSlideMobile = (currentSlideMobile + 1) % totalSlidesMobile;
    } else {
        currentSlideMobile = (currentSlideMobile - 1 + totalSlidesMobile) % totalSlidesMobile;
    }
    updateSliderMobile();
}

function goToSlideMobile(slideIndex) {
    currentSlideMobile = slideIndex;
    updateSliderMobile();
}

function updateSliderMobile() {
    const slider = document.getElementById('bookSliderMobile');
    const translateX = -currentSlideMobile * 100;
    
    slider.style.transform = `translateX(${translateX}%)`;
    
    // Update mobile pagination dots
    document.querySelectorAll('[id^="dot-mobile-"]').forEach((dot, index) => {
        if (index === currentSlideMobile) {
            dot.classList.remove('bg-blue-300');
            dot.classList.add('bg-blue-600');
        } else {
            dot.classList.remove('bg-blue-600');
            dot.classList.add('bg-blue-300');
        }
    });
}

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

// Auto-slide every 5 seconds (desktop)
setInterval(() => {
    if (window.innerWidth >= 1024) { // lg breakpoint
        slideBooks('next');
    }
}, 5000);

// Auto-slide every 5 seconds (mobile)
setInterval(() => {
    if (window.innerWidth < 1024) { // below lg breakpoint
        slideBooksMobile('next');
    }
}, 5000);
</script>
@endif 