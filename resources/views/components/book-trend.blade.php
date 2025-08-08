@php
    $trendingBooks = \App\Models\Book::with('category')
        ->active()
        ->orderByRaw('CASE WHEN reduced_price IS NOT NULL AND reduced_price < price THEN 1 ELSE 2 END')
        ->orderBy('created_at', 'desc')
        ->limit(2)
        ->get();

    $whatsappNumber = \App\Models\WhatsAppNumber::getActiveNumber();
@endphp

@if($trendingBooks->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Livres populaires actuels</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Explorez les livres récemment ajoutés et plébiscités par nos élèves pour améliorer leurs résultats scolaires.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            @foreach($trendingBooks as $book)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row">
                <!-- Left: Book Image -->
                <div class="md:w-1/3 w-full bg-[#001226] flex items-center justify-center p-6">
                    @if($book->image_path)
                        <img src="{{ asset('storage/' . $book->image_path) }}" alt="{{ $book->name }}" class="w-full h-52 md:h-64 object-contain" />
                    @else
                        <div class="text-center text-white py-10">
                            <span class="block text-6xl">📖</span>
                            <span class="block mt-2 font-semibold">{{ $book->name }}</span>
                        </div>
                    @endif
                </div>

                <!-- Right: Details -->
                <div class="flex-1 p-6 md:p-8 flex flex-col">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-xl md:text-2xl font-semibold text-gray-900">{{ $book->name }}</h3>
                            @if($book->category)
                                <p class="text-sm text-gray-500 mt-1">{{ $book->category->name }}</p>
                            @endif
                        </div>
                        @if($book->has_discount)
                            <span class="text-xs font-semibold bg-red-100 text-red-600 px-2 py-1 rounded">-{{ $book->discount_percentage }}%</span>
                        @endif
                    </div>

                    <div class="mt-4">
                        @if($book->has_discount)
                            <div class="flex items-baseline gap-2">
                                <span class="text-2xl font-bold text-green-600">{{ number_format($book->final_price, 2) }} DH</span>
                                <span class="text-sm line-through text-gray-400">{{ number_format($book->price, 2) }} DH</span>
                            </div>
                        @else
                            <span class="text-2xl font-bold text-gray-900">{{ number_format($book->price, 2) }} DH</span>
                        @endif
                    </div>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('books.show', $book->slug) }}" class="px-5 py-2.5 rounded-lg bg-[#001226] text-white hover:bg-[#0a1a2e] transition">
                            Voir le livre
                        </a>
                        @if($whatsappNumber)
                            <a href="{{ $whatsappNumber->whatsapp_url }}?text={{ urlencode('Bonjour, je suis intéressé par le livre: ' . $book->name) }}" target="_blank" class="px-5 py-2.5 rounded-lg border border-green-600 text-green-700 hover:bg-green-50 transition">
                                Acheter via WhatsApp
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


