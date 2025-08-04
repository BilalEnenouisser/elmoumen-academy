@extends('layouts.admin')

@section('title', 'Gestion de la Structure Académique')

@section('content')
    <h1 class="text-2xl font-bold mb-6">🏛️ Gestion de la Structure Académique</h1>

    <!-- Years Section -->
    <div class="bg-white rounded-lg shadow p-4 lg:p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">🎓 Années</h2>
        
        <form method="POST" action="{{ route('admin.years.store') }}" enctype="multipart/form-data" class="mb-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <input type="text" 
                       name="name" 
                       placeholder="Nom de l'année" 
                       class="border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                       required>
                <select name="level_id" 
                        class="border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                        required>
                    <option value="">Sélectionner un Niveau</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
                <input type="file" 
                       name="image" 
                       accept="image/*"
                       class="border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition-colors">
                    ➕ Ajouter
                </button>
            </div>
            <p class="text-sm text-gray-500 mt-2">Image optionnelle (JPEG, PNG, JPG, GIF - max 2MB)</p>
        </form>

        <div class="space-y-3">
            @foreach($years as $year)
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center gap-4 flex-1">
                    @if($year->image)
                        <img src="{{ asset($year->image) }}" 
                             alt="{{ $year->name }}" 
                             class="w-16 h-16 object-cover rounded-lg border border-gray-300">
                    @else
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <span class="font-medium text-gray-900">{{ $year->name }} ({{ $year->level->name }})</span>
                        @if($year->image)
                            <p class="text-sm text-gray-500">Image: {{ basename($year->image) }}</p>
                        @else
                            <p class="text-sm text-gray-500">Aucune image</p>
                        @endif
                    </div>
                </div>
                <div class="flex gap-2 flex-shrink-0">
                    <a href="{{ route('admin.years.edit', $year) }}" 
                       class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm hover:bg-blue-200 transition-colors">
                        ✏️ Modifier
                    </a>
                    <form method="POST" action="{{ route('admin.years.destroy', $year) }}" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm hover:bg-red-200 transition-colors"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette année ?')">
                            🗑️ Supprimer
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Fields Section -->
    <div class="bg-white rounded-lg shadow p-4 lg:p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">🔬 Filières</h2>
        
        <form method="POST" action="{{ route('admin.fields.store') }}" class="mb-6">
            @csrf
            <div class="flex flex-col sm:flex-row gap-3">
                <input type="text" 
                       name="name" 
                       placeholder="Nom de la filière" 
                       class="border border-gray-300 rounded-md p-3 flex-grow focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                       required>
                <select name="year_id" 
                        class="border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                        required>
                    <option value="">Sélectionner une Année</option>
                    @foreach($years as $year)
                        @if(strtolower($year->level->name) === 'lycée' || strtolower($year->level->name) === 'lycee')
                            <option value="{{ $year->id }}">{{ $year->name }} ({{ $year->level->name }})</option>
                        @endif
                    @endforeach
                </select>
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition-colors">
                    ➕ Ajouter
                </button>
            </div>
        </form>

        <div class="space-y-2">
            @foreach($fields as $field)
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 p-3 bg-gray-50 rounded-lg">
                <div class="flex-1">
                    <span class="font-medium text-gray-900">{{ $field->name }}</span>
                    <div class="text-sm text-gray-600">
                        {{ $field->level->name }}
                        @if($field->year)
                            - {{ $field->year->name }}
                        @endif
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.fields.destroy', $field) }}" class="flex-shrink-0">
                    @csrf @method('DELETE')
                    <button type="submit" 
                            class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm hover:bg-red-200 transition-colors"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?')">
                        Supprimer
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Subjects Section -->
    <div class="bg-white rounded-lg shadow p-4 lg:p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">📚 Matières</h2>
        
        <form method="POST" action="{{ route('admin.subjects.store') }}" class="mb-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <input type="text" 
                       name="name" 
                       placeholder="Nom de la matière" 
                       class="border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                       required>
                <select name="level_id" 
                        id="subject_level_id"
                        class="border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                        required>
                    <option value="">Sélectionner un Niveau</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                    @endforeach
                </select>
                <select name="year_id" 
                        id="subject_year_id"
                        class="border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                        required>
                    <option value="">Sélectionner une Année</option>
                </select>
                <select name="field_id" 
                        id="subject_field_id"
                        class="border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-gray-100 text-gray-500" 
                        disabled>
                    <option value="">Sélectionner une Filière</option>
                </select>
            </div>
            <div class="mt-3">
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition-colors">
                    ➕ Ajouter
                </button>
            </div>
        </form>

        <div class="space-y-2">
            @foreach($subjects as $subject)
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 p-3 bg-gray-50 rounded-lg">
                <div class="flex-1">
                    <span class="font-medium text-gray-900">{{ $subject->name }}</span>
                    <div class="text-sm text-gray-600">
                        {{ $subject->level->name }} - {{ $subject->year->name }}
                        @if($subject->field)
                            - {{ $subject->field->name }}
                        @endif
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.subjects.destroy', $subject) }}" class="flex-shrink-0">
                    @csrf @method('DELETE')
                    <button type="submit" 
                            class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm hover:bg-red-200 transition-colors"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette matière ?')">
                        Supprimer
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        // Dynamic year loading for subjects
        document.getElementById('subject_level_id').addEventListener('change', function() {
            const levelId = this.value;
            const yearSelect = document.getElementById('subject_year_id');
            const fieldSelect = document.getElementById('subject_field_id');
            
            // Reset year dropdown
            yearSelect.innerHTML = '<option value="">Sélectionner une Année</option>';
            
            // Handle field dropdown visibility
            if (levelId) {
                const selectedLevel = this.options[this.selectedIndex].text.toLowerCase();
                if (selectedLevel.includes('lycée') || selectedLevel.includes('lycee')) {
                    fieldSelect.disabled = false;
                    fieldSelect.classList.remove('bg-gray-100', 'text-gray-500');
                    fieldSelect.classList.add('bg-white', 'text-gray-900');
                } else {
                    fieldSelect.disabled = true;
                    fieldSelect.classList.add('bg-gray-100', 'text-gray-500');
                    fieldSelect.classList.remove('bg-white', 'text-gray-900');
                    fieldSelect.value = '';
                }
                
                // Load years for selected level
                fetch(`/admin/subjects/years/${levelId}`)
                    .then(response => response.json())
                    .then(years => {
                        years.forEach(year => {
                            yearSelect.innerHTML += `<option value="${year.id}">${year.name}</option>`;
                        });
                    });
            } else {
                fieldSelect.disabled = true;
                fieldSelect.classList.add('bg-gray-100', 'text-gray-500');
                fieldSelect.classList.remove('bg-white', 'text-gray-900');
                fieldSelect.value = '';
            }
        });

        // Dynamic field loading for subjects
        document.getElementById('subject_year_id').addEventListener('change', function() {
            const yearId = this.value;
            const fieldSelect = document.getElementById('subject_field_id');
            
            if (yearId) {
                fetch(`/admin/subjects/fields/${yearId}`)
                    .then(response => response.json())
                    .then(fields => {
                        fieldSelect.innerHTML = '<option value="">Sélectionner une Filière</option>';
                        fields.forEach(field => {
                            fieldSelect.innerHTML += `<option value="${field.id}">${field.name}</option>`;
                        });
                    });
            }
        });
    </script>
@endsection