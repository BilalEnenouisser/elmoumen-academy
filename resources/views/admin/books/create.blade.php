@extends('layouts.admin')

@section('title', 'Ajouter un Nouveau Livre')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">📚 Ajouter un Nouveau Livre</h1>
        <p class="text-gray-600">Créer un nouveau livre avec image, prix et réduction</p>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">📋 Informations de Base</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <!-- Book Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nom du Livre *
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           required 
                           value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Ex: Mathématiques Avancées">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Catégorie *
                    </label>
                    <select name="category_id" 
                            id="category_id" 
                            required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Sélectionner une catégorie...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="mt-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description *
                </label>
                <textarea name="description" 
                          id="description" 
                          required
                          rows="4"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                          placeholder="Description détaillée du livre...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Pricing -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">💰 Prix et Réduction</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <!-- Original Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                        Prix Original (DH) *
                    </label>
                    <input type="number" 
                           name="price" 
                           id="price" 
                           required
                           step="0.01"
                           min="0"
                           value="{{ old('price') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Ex: 1000.00">
                    @error('price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Reduced Price -->
                <div>
                    <label for="reduced_price" class="block text-sm font-medium text-gray-700 mb-2">
                        Prix Réduit (DH) <span class="text-gray-500">(optionnel)</span>
                    </label>
                    <input type="number" 
                           name="reduced_price" 
                           id="reduced_price" 
                           step="0.01"
                           min="0"
                           value="{{ old('reduced_price') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Ex: 800.00">
                    <p class="text-xs text-gray-500 mt-1">Laissez vide si pas de réduction</p>
                    @error('reduced_price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Price Preview -->
            <div id="price-preview" class="mt-4 p-3 bg-gray-50 rounded-lg" style="display: none;">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Aperçu du Prix:</h4>
                <div class="flex items-center gap-2">
                    <span id="original-price" class="text-lg font-semibold text-gray-900"></span>
                    <span id="reduced-price" class="text-lg font-semibold text-green-600"></span>
                    <span id="discount-badge" class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs"></span>
                </div>
            </div>
        </div>

        <!-- Image Upload -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">🖼️ Image du Livre</h3>
            
            <div class="space-y-4">
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Image du Livre <span class="text-gray-500">(optionnel)</span>
                    </label>
                    <input type="file" 
                           name="image" 
                           id="image" 
                           accept="image/*"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p class="text-xs text-gray-500 mt-1">Formats acceptés: JPEG, PNG, JPG, GIF (max 2MB)</p>
                    @error('image')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Preview -->
                <div id="image-preview" class="hidden">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Aperçu de l'Image:</h4>
                    <div class="w-32 h-40 border border-gray-300 rounded-lg overflow-hidden">
                        <img id="preview-img" src="" alt="Aperçu" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">📊 Statut</h3>
            
            <div class="flex items-center">
                <input type="checkbox" 
                       name="is_active" 
                       id="is_active" 
                       value="1"
                       {{ old('is_active', true) ? 'checked' : '' }}
                       class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                    Activer ce livre (visible pour les utilisateurs)
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
            <a href="{{ route('admin.books.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-center">
                Annuler
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                📚 Créer le Livre
            </button>
        </div>
    </form>

    <script>
        // Price preview functionality
        const priceInput = document.getElementById('price');
        const reducedPriceInput = document.getElementById('reduced_price');
        const pricePreview = document.getElementById('price-preview');
        const originalPriceSpan = document.getElementById('original-price');
        const reducedPriceSpan = document.getElementById('reduced-price');
        const discountBadge = document.getElementById('discount-badge');

        function updatePricePreview() {
            const price = parseFloat(priceInput.value) || 0;
            const reducedPrice = parseFloat(reducedPriceInput.value) || 0;

            if (price > 0) {
                originalPriceSpan.textContent = `${price.toFixed(2)} DH`;
                
                if (reducedPrice > 0 && reducedPrice < price) {
                    reducedPriceSpan.textContent = `${reducedPrice.toFixed(2)} DH`;
                    const discount = Math.round(((price - reducedPrice) / price) * 100);
                    discountBadge.textContent = `-${discount}%`;
                    pricePreview.style.display = 'block';
                } else {
                    reducedPriceSpan.textContent = '';
                    discountBadge.textContent = '';
                    pricePreview.style.display = 'none';
                }
            } else {
                pricePreview.style.display = 'none';
            }
        }

        priceInput.addEventListener('input', updatePricePreview);
        reducedPriceInput.addEventListener('input', updatePricePreview);

        // Image preview functionality
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.classList.add('hidden');
            }
        });

        // Initial price preview
        updatePricePreview();
    </script>
@endsection 