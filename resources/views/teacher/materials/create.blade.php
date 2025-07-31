@extends('layouts.teacher')

@section('title', 'Ajouter un Nouveau Matériel')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Ajouter un Nouveau Matériel</h1>
        <p class="text-gray-600">Créer de nouveaux matériels éducatifs avec plusieurs blocs</p>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('teacher.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">📋 Informations de Base</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <!-- Course Name -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Nom du cours (ex: Mathématiques) *
                    </label>
                    <input type="text" name="title" id="title" required 
                           value="{{ old('title') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Entrez le nom du cours">
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Level -->
                <div>
                    <label for="level_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Niveau *
                    </label>
                    <select name="level_id" id="level_id" required 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Sélectionner le niveau...</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                {{ $level->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('level_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Year -->
                <div>
                    <label for="year_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Année
                    </label>
                    <select name="year_id" id="year_id" 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Sélectionner l'année...</option>
                        @foreach($years as $year)
                            <option value="{{ $year->id }}" {{ old('year_id') == $year->id ? 'selected' : '' }}>
                                {{ $year->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('year_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Field -->
                <div>
                    <label for="field_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Filière
                    </label>
                    <select name="field_id" id="field_id" disabled
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-100 text-gray-500">
                        <option value="">Sélectionner la filière...</option>
                        @foreach($fields as $field)
                            <option value="{{ $field->id }}" {{ old('field_id') == $field->id ? 'selected' : '' }}>
                                {{ $field->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('field_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Material Blocks -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
                <h3 class="text-lg font-semibold text-gray-900">📚 Blocs de Matériel</h3>
                <button type="button" onclick="addBlock()" 
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition w-full sm:w-auto">
                    ➕ Ajouter un Bloc
                </button>
            </div>

            <div id="blocks-container" class="space-y-4 md:space-y-6">
                <!-- Block template will be added here -->
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
            <a href="{{ route('teacher.materials.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-center">
                Annuler
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Créer le Matériel
            </button>
        </div>
    </form>

    <script>
        let blockIndex = 0;
        const blockColors = [
            'border-blue-200 bg-blue-50',
            'border-green-200 bg-green-50', 
            'border-purple-200 bg-purple-50',
            'border-yellow-200 bg-yellow-50',
            'border-pink-200 bg-pink-50',
            'border-indigo-200 bg-indigo-50'
        ];

        // Initialize with one block
        document.addEventListener('DOMContentLoaded', function() {
            addBlock();
        });

        // Add new block
        function addBlock() {
            const container = document.getElementById('blocks-container');
            const blockDiv = document.createElement('div');
            const colorClass = blockColors[blockIndex % blockColors.length];
            blockDiv.className = `block-item border-2 rounded-lg p-4 ${colorClass}`;
            blockDiv.innerHTML = `
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                    <h4 class="font-medium text-gray-900">Bloc ${blockIndex + 1}</h4>
                    <button type="button" onclick="removeBlock(this)" 
                            class="text-red-600 hover:text-red-800 text-sm">
                        🗑️ Supprimer le Bloc
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <!-- Semester -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Semestre *</label>
                        <select name="semesters[${blockIndex}]" required 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Sélectionner le semestre...</option>
                            <option value="Semestre 1">Semestre 1</option>
                            <option value="Semestre 2">Semestre 2</option>
                        </select>
                    </div>

                    <!-- Material Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type de Matériel *</label>
                        <select name="material_types[${blockIndex}]" required 
                                onchange="toggleExamType(this, ${blockIndex})"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Sélectionner le type...</option>
                            <option value="Cours">Cours</option>
                            <option value="Séries">Séries</option>
                            <option value="Devoirs semestre 1">Devoirs semestre 1</option>
                            <option value="Devoirs semestre 2">Devoirs semestre 2</option>
                            <option value="Examens">Examens</option>
                        </select>
                    </div>

                    <!-- Exam Type (conditional) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type d'Examen</label>
                        <select name="exam_types[${blockIndex}]" id="exam_type_${blockIndex}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-100 text-gray-500 exam-type-select" style="display: none;" disabled>
                            <option value="">Sélectionner le type d'examen...</option>
                            <option value="إمتحانات محلية">إمتحانات محلية</option>
                            <option value="إمتحانات إقليمية">إمتحانات إقليمية</option>
                            <option value="Examens Locaux">Examens Locaux</option>
                            <option value="Examens Régionaux">Examens Régionaux</option>
                            <option value="Examens Nationaux Blanc">Examens Nationaux Blanc</option>
                            <option value="Examens Nationaux">Examens Nationaux</option>
                        </select>
                    </div>
                </div>

                <!-- PDFs -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">📄 PDFs Matériel</label>
                    <div class="pdf-container space-y-2">
                        <div class="pdf-row flex flex-col sm:flex-row gap-2 sm:gap-3">
                            <input type="file" name="pdfs[${blockIndex}][]" accept=".pdf" 
                                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <input type="text" name="pdf_titles[${blockIndex}][]" placeholder="Titre du PDF (optionnel)" 
                                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <button type="button" onclick="removePdfRow(this)" 
                                    class="px-2 py-2 text-red-600 hover:text-red-800 self-center">🗑️</button>
                        </div>
                    </div>
                    <button type="button" onclick="addPdfRow(${blockIndex})" 
                            class="mt-2 text-green-600 hover:text-green-800 text-sm">
                        ➕ Ajouter un autre PDF
                    </button>
                </div>

                <!-- Video Links -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">🎥 Liens Vidéo YouTube</label>
                    <div class="video-container space-y-2">
                        <div class="video-row flex flex-col sm:flex-row gap-2 sm:gap-3">
                            <input type="url" name="video_links[${blockIndex}][]" placeholder="URL de la vidéo" 
                                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <input type="text" name="video_titles[${blockIndex}][]" placeholder="Titre de la vidéo (optionnel)" 
                                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <button type="button" onclick="removeVideoRow(this)" 
                                    class="px-2 py-2 text-red-600 hover:text-red-800 self-center">🗑️</button>
                        </div>
                    </div>
                    <button type="button" onclick="addVideoRow(${blockIndex})" 
                            class="mt-2 text-green-600 hover:text-green-800 text-sm">
                        ➕ Ajouter une autre vidéo
                    </button>
                </div>
            `;
            
            container.appendChild(blockDiv);
            blockIndex++;
        }

        // Remove block
        function removeBlock(button) {
            button.closest('.block-item').remove();
        }

        // Toggle exam type visibility
        function toggleExamType(select, blockIndex) {
            const examTypeSelect = document.getElementById(`exam_type_${blockIndex}`);
            if (select.value === 'Examens') {
                examTypeSelect.style.display = 'block';
                examTypeSelect.disabled = false;
                examTypeSelect.classList.remove('bg-gray-100', 'text-gray-500');
                examTypeSelect.classList.add('bg-white', 'text-gray-900');
                examTypeSelect.required = true;
            } else {
                examTypeSelect.style.display = 'none';
                examTypeSelect.disabled = true;
                examTypeSelect.classList.add('bg-gray-100', 'text-gray-500');
                examTypeSelect.classList.remove('bg-white', 'text-gray-900');
                examTypeSelect.required = false;
                examTypeSelect.value = '';
            }
        }

        // Add PDF row
        function addPdfRow(blockIndex) {
            const container = document.querySelector(`[name="pdfs[${blockIndex}][]"]`).closest('.pdf-container');
            const newRow = document.createElement('div');
            newRow.className = 'pdf-row flex flex-col sm:flex-row gap-2 sm:gap-3';
            newRow.innerHTML = `
                <input type="file" name="pdfs[${blockIndex}][]" accept=".pdf" 
                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <input type="text" name="pdf_titles[${blockIndex}][]" placeholder="Titre du PDF (optionnel)" 
                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <button type="button" onclick="removePdfRow(this)" 
                        class="px-2 py-2 text-red-600 hover:text-red-800 self-center">🗑️</button>
            `;
            container.appendChild(newRow);
        }

        // Remove PDF row
        function removePdfRow(button) {
            button.closest('.pdf-row').remove();
        }

        // Add video row
        function addVideoRow(blockIndex) {
            const container = document.querySelector(`[name="video_links[${blockIndex}][]"]`).closest('.video-container');
            const newRow = document.createElement('div');
            newRow.className = 'video-row flex flex-col sm:flex-row gap-2 sm:gap-3';
            newRow.innerHTML = `
                <input type="url" name="video_links[${blockIndex}][]" placeholder="URL de la vidéo" 
                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <input type="text" name="video_titles[${blockIndex}][]" placeholder="Titre de la vidéo (optionnel)" 
                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <button type="button" onclick="removeVideoRow(this)" 
                        class="px-2 py-2 text-red-600 hover:text-red-800 self-center">🗑️</button>
            `;
            container.appendChild(newRow);
        }

        // Remove video row
        function removeVideoRow(button) {
            button.closest('.video-row').remove();
        }

        // Dynamic year loading based on level
        document.getElementById('level_id').addEventListener('change', function() {
            const levelId = this.value;
            const yearSelect = document.getElementById('year_id');
            const fieldSelect = document.getElementById('field_id');
            
            // Reset year dropdown
            yearSelect.innerHTML = '<option value="">Sélectionner l\'année...</option>';
            
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
                fetch(`/teacher/materials/years/${levelId}`)
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
    </script>
@endsection
