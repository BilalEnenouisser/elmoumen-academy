@extends('layouts.admin')

@section('title', 'Modifier l\'Année')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">✏️ Modifier l'Année</h1>
            <a href="{{ route('admin.structure') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                ← Retour
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form method="POST" action="{{ route('admin.years.update', $year) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom de l'Année *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $year->name) }}"
                               class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Level -->
                    <div>
                        <label for="level_id" class="block text-sm font-medium text-gray-700 mb-2">Niveau *</label>
                        <select id="level_id" 
                                name="level_id" 
                                class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                                required>
                            <option value="">Sélectionner un Niveau</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->id }}" {{ old('level_id', $year->level_id) == $level->id ? 'selected' : '' }}>
                                    {{ $level->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('level_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="mt-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    
                    <!-- Current Image Preview -->
                    @if($year->image)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Image actuelle :</p>
                            <img src="{{ asset($year->image) }}" 
                                 alt="Image actuelle" 
                                 class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                        </div>
                    @endif
                    
                    <input type="file" 
                           id="image" 
                           name="image" 
                           accept="image/*"
                           class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <p class="text-sm text-gray-500 mt-1">Formats acceptés : JPEG, PNG, JPG, GIF (max 2MB)</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.structure') }}" 
                       class="bg-gray-500 text-white px-6 py-3 rounded-md hover:bg-gray-600 transition-colors">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition-colors">
                        💾 Mettre à Jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection 