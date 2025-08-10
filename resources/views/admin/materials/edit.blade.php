@extends('layouts.admin')

@section('title', 'Modifier le Matériel')

@section('content')
<div x-data="{ 
    showDeletePdfModal: false,
    showDeleteVideoModal: false,
    pdfToDelete: null,
    videoToDelete: null,
    itemName: ''
}">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">✏️ Modifier le Matériel</h1>
        <p class="text-gray-600">Modifier les matériels éducatifs et leurs contenus</p>
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

    <form action="{{ route('admin.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

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
                           value="{{ old('title', $material->title) }}"
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
                            <option value="{{ $level->id }}" {{ $material->level_id == $level->id ? 'selected' : '' }}>
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
                            <option value="{{ $year->id }}" {{ $material->year_id == $year->id ? 'selected' : '' }}>
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
                    <select name="field_id" id="field_id" 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 {{ $material->level && str_contains(strtolower($material->level->name), 'lycée') ? '' : 'bg-gray-100 text-gray-500' }}"
                            {{ $material->level && str_contains(strtolower($material->level->name), 'lycée') ? '' : 'disabled' }}>
                        <option value="">Sélectionner la filière...</option>
                        @foreach($fields as $field)
                            <option value="{{ $field->id }}" {{ $material->field_id == $field->id ? 'selected' : '' }}>
                                {{ $field->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('field_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Matière
                    </label>
                    <select name="subject_id" id="subject_id" 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-100 text-gray-500"
                            disabled>
                        <option value="">Sélectionner la matière...</option>
                    </select>
                    @error('subject_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Material Blocks -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900">📚 Blocs de Matériel</h3>
            </div>

            <div id="blocks-container" class="space-y-4 md:space-y-6">
                @foreach($material->blocks as $index => $block)
                <div class="block-item border-2 rounded-lg p-4 {{ $index % 2 == 0 ? 'border-blue-200 bg-blue-50' : 'border-green-200 bg-green-50' }}">
                    <input type="hidden" name="block_ids[]" value="{{ $block->id }}">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                        <h4 class="font-medium text-gray-900">Bloc {{ $index + 1 }}</h4>
                        <button type="button" onclick="removeBlock(this)" 
                                class="text-red-600 hover:text-red-800 text-sm">
                            🗑️ Supprimer le Bloc
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Semester -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Semestre *</label>
                            <select name="semesters[]" required 
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">Sélectionner le semestre...</option>
                                <option value="Semestre 1" {{ $block->semester == 'Semestre 1' ? 'selected' : '' }}>Semestre 1</option>
                                <option value="Semestre 2" {{ $block->semester == 'Semestre 2' ? 'selected' : '' }}>Semestre 2</option>
                                <option value="Concour" {{ $block->semester == 'Concour' ? 'selected' : '' }}>Concour</option>
                            </select>
                        </div>

                        <!-- Material Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type de Matériel *</label>
                            <select name="material_types[]" required 
                                    onchange="toggleMaterialType(this, {{ $index }})"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">Sélectionner le type...</option>
                                <option value="Cours" {{ $block->material_type == 'Cours' ? 'selected' : '' }}>Cours</option>
                                <option value="Séries" {{ $block->material_type == 'Séries' ? 'selected' : '' }}>Séries</option>
                                <option value="Devoirs" {{ $block->material_type == 'Devoirs' ? 'selected' : '' }}>Devoirs</option>
                                <option value="Examens" {{ $block->material_type == 'Examens' ? 'selected' : '' }}>Examens</option>
                                <option value="Concour" {{ $block->material_type == 'Concour' ? 'selected' : '' }}>Concour</option>
                            </select>
                        </div>
                    </div>

                    <!-- Conditional Fields -->
                    <div class="conditional-fields mb-4">
                        <!-- Devoir Type (always visible but disabled) -->
                        <div id="devoir_type_container_{{ $index }}" class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type de Devoir *</label>
                            <select name="devoir_types[]" id="devoir_type_{{ $index }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 {{ $block->material_type == 'Devoirs' ? 'bg-white text-gray-900' : 'bg-gray-100 text-gray-500' }}" 
                                    {{ $block->material_type == 'Devoirs' ? '' : 'disabled' }}>
                                <option value="">Sélectionner le type de devoir...</option>
                                <option value="Devoir 1" {{ $block->name == 'Devoir 1' ? 'selected' : '' }}>Devoir 1</option>
                                <option value="Devoir 2" {{ $block->name == 'Devoir 2' ? 'selected' : '' }}>Devoir 2</option>
                                <option value="Devoir 3" {{ $block->name == 'Devoir 3' ? 'selected' : '' }}>Devoir 3</option>
                                <option value="Devoir 4" {{ $block->name == 'Devoir 4' ? 'selected' : '' }}>Devoir 4</option>
                            </select>
                        </div>

                        <!-- Exam Type (always visible but disabled) -->
                        <div id="exam_type_container_{{ $index }}" class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type d'Examen *</label>
                            <select name="exam_types[]" id="exam_type_{{ $index }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 {{ $block->material_type == 'Examens' ? 'bg-white text-gray-900' : 'bg-gray-100 text-gray-500' }}" 
                                    {{ $block->material_type == 'Examens' ? '' : 'disabled' }}>
                                <option value="">Sélectionner le type d'examen...</option>
                                <option value="إمتحانات محلية" {{ $block->exam_type == 'إمتحانات محلية' ? 'selected' : '' }}>إمتحانات محلية</option>
                                <option value="إمتحانات إقليمية" {{ $block->exam_type == 'إمتحانات إقليمية' ? 'selected' : '' }}>إمتحانات إقليمية</option>
                                <option value="Examens Locaux" {{ $block->exam_type == 'Examens Locaux' ? 'selected' : '' }}>Examens Locaux</option>
                                <option value="Examens Régionaux" {{ $block->exam_type == 'Examens Régionaux' ? 'selected' : '' }}>Examens Régionaux</option>
                                <option value="Examens Nationaux Blanc" {{ $block->exam_type == 'Examens Nationaux Blanc' ? 'selected' : '' }}>Examens Nationaux Blanc</option>
                                <option value="Examens Nationaux" {{ $block->exam_type == 'Examens Nationaux' ? 'selected' : '' }}>Examens Nationaux</option>
                            </select>
                        </div>

                        <!-- Concour Type (always visible but disabled) -->
                        <div id="concour_type_container_{{ $index }}" class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type de Concour *</label>
                            <select name="concour_types[]" id="concour_type_{{ $index }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 {{ $block->material_type == 'Concour' ? 'bg-white text-gray-900' : 'bg-gray-100 text-gray-500' }}" 
                                    {{ $block->material_type == 'Concour' ? '' : 'disabled' }}>
                                <option value="">Sélectionner le type de concour...</option>
                                <option value="Concour 1" {{ $block->concour_type == 'Concour 1' ? 'selected' : '' }}>Concour 1</option>
                                <option value="Concour 2" {{ $block->concour_type == 'Concour 2' ? 'selected' : '' }}>Concour 2</option>
                                <option value="Concour 3" {{ $block->concour_type == 'Concour 3' ? 'selected' : '' }}>Concour 3</option>
                                <option value="Concour 4" {{ $block->concour_type == 'Concour 4' ? 'selected' : '' }}>Concour 4</option>
                                <option value="Concour 5" {{ $block->concour_type == 'Concour 5' ? 'selected' : '' }}>Concour 5</option>
                                <option value="Concour 6" {{ $block->concour_type == 'Concour 6' ? 'selected' : '' }}>Concour 6</option>
                                <option value="Concour 7" {{ $block->concour_type == 'Concour 7' ? 'selected' : '' }}>Concour 7</option>
                                <option value="Concour 8" {{ $block->concour_type == 'Concour 8' ? 'selected' : '' }}>Concour 8</option>
                                <option value="Concour 9" {{ $block->concour_type == 'Concour 9' ? 'selected' : '' }}>Concour 9</option>
                                <option value="Concour 10" {{ $block->concour_type == 'Concour 10' ? 'selected' : '' }}>Concour 10</option>
                            </select>
                        </div>
                    </div>

                    <!-- PDFs -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">📄 PDFs Matériel</label>
                        
                        <!-- Existing PDFs -->
                        @if($block->pdfs->count() > 0)
                        <div class="mb-3 p-3 bg-gray-100 rounded-lg">
                            <h5 class="font-medium mb-2 text-sm">PDFs existants:</h5>
                            @foreach($block->pdfs as $pdf)
                            <div class="flex items-center gap-2 mb-1 text-sm">
                                <span class="text-gray-700">{{ $pdf->title ?? 'PDF' }}</span>
                                @if($pdf->teacher)
                                    <span class="text-xs text-blue-600">(par {{ $pdf->teacher->name }})</span>
                                @else
                                    <span class="text-xs text-gray-500">(par Admin)</span>
                                @endif
                                <a href="{{ asset('storage/' . $pdf->pdf_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs">Voir</a>
                                <button 
                                    type="button" 
                                    @click="pdfToDelete = {{ $pdf->id }}; itemName = '{{ addslashes($pdf->title ?? 'PDF') }}'; showDeletePdfModal = true"
                                    class="text-red-600 hover:text-red-800 text-xs transition-colors">
                                    Supprimer
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        
                        <!-- Add New PDFs -->
                        <div class="pdf-container space-y-2">
                            <div class="pdf-row flex flex-col sm:flex-row gap-2 sm:gap-3">
                                <input type="file" name="pdfs[{{ $index }}][]" accept=".pdf" 
                                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <input type="text" name="pdf_titles[{{ $index }}][]" placeholder="Titre du PDF (optionnel)" 
                                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <button type="button" onclick="removePdfRow(this)" 
                                        class="px-2 py-2 text-red-600 hover:text-red-800 self-center">🗑️</button>
                            </div>
                        </div>
                        <button type="button" onclick="addPdfRow({{ $index }})" 
                                class="mt-2 text-green-600 hover:text-green-800 text-sm">
                            ➕ Ajouter un autre PDF
                        </button>
                    </div>

                    <!-- Video Links -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">🎥 Liens Vidéo YouTube</label>
                        
                        <!-- Existing Videos -->
                        @if($block->videos->count() > 0)
                        <div class="mb-3 p-3 bg-gray-100 rounded-lg">
                            <h5 class="font-medium mb-2 text-sm">Vidéos existantes:</h5>
                            @foreach($block->videos as $video)
                            <div class="flex items-center gap-2 mb-1 text-sm">
                                <span class="text-gray-700">{{ $video->title ?? 'Vidéo' }}</span>
                                @if($video->teacher)
                                    <span class="text-xs text-blue-600">(par {{ $video->teacher->name }})</span>
                                @else
                                    <span class="text-xs text-gray-500">(par Admin)</span>
                                @endif
                                <a href="{{ $video->video_link }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs">Voir</a>
                                <button 
                                    type="button" 
                                    @click="videoToDelete = {{ $video->id }}; itemName = '{{ addslashes($video->title ?? 'Vidéo') }}'; showDeleteVideoModal = true"
                                    class="text-red-600 hover:text-red-800 text-xs transition-colors">
                                    Supprimer
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        
                        <!-- Add New Videos -->
                        <div class="video-container space-y-2">
                            <div class="video-row flex flex-col sm:flex-row gap-2 sm:gap-3">
                                <input type="url" name="video_links[{{ $index }}][]" placeholder="URL de la vidéo" 
                                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <input type="text" name="video_titles[{{ $index }}][]" placeholder="Titre de la vidéo (optionnel)" 
                                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <button type="button" onclick="removeVideoRow(this)" 
                                        class="px-2 py-2 text-red-600 hover:text-red-800 self-center">🗑️</button>
                            </div>
                        </div>
                        <button type="button" onclick="addVideoRow({{ $index }})" 
                                class="mt-2 text-green-600 hover:text-green-800 text-sm">
                            ➕ Ajouter une autre vidéo
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <button type="button" onclick="addBlock()" 
                    class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition w-full">
                ➕ Ajouter un Bloc
            </button>
        </div>

        <!-- Submit Button -->
        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
            <a href="{{ route('admin.materials.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-center">
                Annuler
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                💾 Enregistrer les Modifications
            </button>
        </div>
    </form>

    <!-- Delete PDF Confirmation Modal -->
    <div x-show="showDeletePdfModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto"
         x-on:keydown.escape.window="showDeletePdfModal = false"
         style="display: none;">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showDeletePdfModal = false"></div>
        
        <!-- Modal -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div x-show="showDeletePdfModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative bg-white rounded-lg shadow-xl max-w-md w-full p-6"
                 @click.stop
                 style="display: none;">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-center mb-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                </div>
                
                <!-- Modal Content -->
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        Confirmer la Suppression
                    </h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Êtes-vous sûr de vouloir supprimer le PDF <span class="font-semibold text-gray-900" x-text="itemName"></span> ? 
                        Cette action est irréversible.
                    </p>
                </div>
                
                <!-- Modal Actions -->
                <div class="flex justify-center space-x-3">
                    <button 
                        @click="showDeletePdfModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Annuler
                    </button>
                    <button 
                        @click="deletePdf(pdfToDelete); showDeletePdfModal = false"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Video Confirmation Modal -->
    <div x-show="showDeleteVideoModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto"
         x-on:keydown.escape.window="showDeleteVideoModal = false"
         style="display: none;">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="showDeleteVideoModal = false"></div>
        
        <!-- Modal -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div x-show="showDeleteVideoModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative bg-white rounded-lg shadow-xl max-w-md w-full p-6"
                 @click.stop
                 style="display: none;">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-center mb-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                </div>
                
                <!-- Modal Content -->
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        Confirmer la Suppression
                    </h3>
                    <p class="text-sm text-gray-500 mb-6">
                        Êtes-vous sûr de vouloir supprimer la vidéo <span class="font-semibold text-gray-900" x-text="itemName"></span> ? 
                        Cette action est irréversible.
                    </p>
                </div>
                
                <!-- Modal Actions -->
                <div class="flex justify-center space-x-3">
                    <button 
                        @click="showDeleteVideoModal = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Annuler
                    </button>
                    <button 
                        @click="deleteVideo(videoToDelete); showDeleteVideoModal = false"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let blockIndex = {{ $material->blocks->count() }};
    const blockColors = [
        'border-blue-200 bg-blue-50',
        'border-green-200 bg-green-50', 
        'border-purple-200 bg-purple-50',
        'border-yellow-200 bg-yellow-50',
        'border-pink-200 bg-pink-50',
        'border-indigo-200 bg-indigo-50'
    ];

    // Add new block
    function addBlock() {
        const container = document.getElementById('blocks-container');
        const blockDiv = document.createElement('div');
        const colorClass = blockColors[blockIndex % blockColors.length];
        blockDiv.className = `block-item border-2 rounded-lg p-4 ${colorClass}`;
        blockDiv.innerHTML = `
            <input type="hidden" name="block_ids[]" value="">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                <h4 class="font-medium text-gray-900">Bloc ${blockIndex + 1}</h4>
                <button type="button" onclick="removeBlock(this)" 
                        class="text-red-600 hover:text-red-800 text-sm">
                    🗑️ Supprimer le Bloc
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Semester -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Semestre *</label>
                    <select name="semesters[]" required 
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Sélectionner le semestre...</option>
                        <option value="Semestre 1">Semestre 1</option>
                        <option value="Semestre 2">Semestre 2</option>
                        <option value="Concour">Concour</option>
                    </select>
                </div>

                <!-- Material Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type de Matériel *</label>
                                            <select name="material_types[]" required 
                                onchange="toggleMaterialType(this, ${blockIndex})"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Sélectionner le type...</option>
                            <option value="Cours">Cours</option>
                            <option value="Séries">Séries</option>
                            <option value="Devoirs">Devoirs</option>
                            <option value="Examens">Examens</option>
                            <option value="Concour">Concour</option>
                        </select>
                </div>
            </div>

            <!-- Conditional Fields -->
            <div class="conditional-fields mb-4">
                <!-- Devoir Type (always visible but disabled) -->
                <div id="devoir_type_container_${blockIndex}" class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type de Devoir *</label>
                    <select name="devoir_types[]" id="devoir_type_${blockIndex}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-100 text-gray-500" disabled>
                        <option value="">Sélectionner le type de devoir...</option>
                        <option value="Devoir 1">Devoir 1</option>
                        <option value="Devoir 2">Devoir 2</option>
                        <option value="Devoir 3">Devoir 3</option>
                        <option value="Devoir 4">Devoir 4</option>
                    </select>
                </div>

                <!-- Exam Type (always visible but disabled) -->
                <div id="exam_type_container_${blockIndex}" class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type d'Examen *</label>
                    <select name="exam_types[]" id="exam_type_${blockIndex}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-100 text-gray-500" disabled>
                        <option value="">Sélectionner le type d'examen...</option>
                        <option value="إمتحانات محلية">إمتحانات محلية</option>
                        <option value="إمتحانات إقليمية">إمتحانات إقليمية</option>
                        <option value="Examens Locaux">Examens Locaux</option>
                        <option value="Examens Régionaux">Examens Régionaux</option>
                        <option value="Examens Nationaux Blanc">Examens Nationaux Blanc</option>
                        <option value="Examens Nationaux">Examens Nationaux</option>
                    </select>
                </div>

                <!-- Concour Type (always visible but disabled) -->
                <div id="concour_type_container_${blockIndex}" class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type de Concour *</label>
                    <select name="concour_types[]" id="concour_type_${blockIndex}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-100 text-gray-500" disabled>
                        <option value="">Sélectionner le type de concour...</option>
                        <option value="Concour 1">Concour 1</option>
                        <option value="Concour 2">Concour 2</option>
                        <option value="Concour 3">Concour 3</option>
                        <option value="Concour 4">Concour 4</option>
                        <option value="Concour 5">Concour 5</option>
                        <option value="Concour 6">Concour 6</option>
                        <option value="Concour 7">Concour 7</option>
                        <option value="Concour 8">Concour 8</option>
                        <option value="Concour 9">Concour 9</option>
                        <option value="Concour 10">Concour 10</option>
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
                        <button type="button" onclick="removePdfRow(this, ${blockIndex})" 
                                class="px-2 py-2 text-red-600 hover:text-red-800 self-center pdf-delete-btn" style="display: none;">🗑️</button>
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
                        <button type="button" onclick="removeVideoRow(this, ${blockIndex})" 
                                class="px-2 py-2 text-red-600 hover:text-red-800 self-center video-delete-btn" style="display: none;">🗑️</button>
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

    // Remove block with custom modal
    function removeBlock(button) {
        const blocksContainer = document.getElementById('blocks-container');
        const blocks = blocksContainer.querySelectorAll('.block-item');
        
        if (blocks.length === 1) {
            alert('Impossible de supprimer le dernier bloc. Il doit y avoir au moins un bloc.');
            return;
        }
        
        // Store the button for later use
        window.blockToDelete = button;
        
        // Show custom modal
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    // Close delete modal
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        window.blockToDelete = null;
    }

    // Confirm delete block
    function confirmDeleteBlock() {
        if (window.blockToDelete) {
            window.blockToDelete.closest('.block-item').remove();
            closeDeleteModal();
        }
    }

    // Toggle material type visibility
    function toggleMaterialType(select, blockIndex) {
        const devoirTypeSelect = document.getElementById(`devoir_type_${blockIndex}`);
        const examTypeSelect = document.getElementById(`exam_type_${blockIndex}`);
        const concourTypeSelect = document.getElementById(`concour_type_${blockIndex}`);
        
        // Reset all dropdowns first
        devoirTypeSelect.value = '';
        examTypeSelect.value = '';
        concourTypeSelect.value = '';
        
        // Disable and style all dropdowns by default
        devoirTypeSelect.disabled = true;
        devoirTypeSelect.required = false;
        devoirTypeSelect.classList.add('bg-gray-100', 'text-gray-500');
        devoirTypeSelect.classList.remove('bg-white', 'text-gray-900');
        
        examTypeSelect.disabled = true;
        examTypeSelect.required = false;
        examTypeSelect.classList.add('bg-gray-100', 'text-gray-500');
        examTypeSelect.classList.remove('bg-white', 'text-gray-900');
        
        concourTypeSelect.disabled = true;
        concourTypeSelect.required = false;
        concourTypeSelect.classList.add('bg-gray-100', 'text-gray-500');
        concourTypeSelect.classList.remove('bg-white', 'text-gray-900');
        
        if (select.value === 'Devoirs') {
            devoirTypeSelect.disabled = false;
            devoirTypeSelect.required = true;
            devoirTypeSelect.classList.remove('bg-gray-100', 'text-gray-500');
            devoirTypeSelect.classList.add('bg-white', 'text-gray-900');
        } else if (select.value === 'Examens') {
            examTypeSelect.disabled = false;
            examTypeSelect.required = true;
            examTypeSelect.classList.remove('bg-gray-100', 'text-gray-500');
            examTypeSelect.classList.add('bg-white', 'text-gray-900');
        } else if (select.value === 'Concour') {
            concourTypeSelect.disabled = false;
            concourTypeSelect.required = true;
            concourTypeSelect.classList.remove('bg-gray-100', 'text-gray-500');
            concourTypeSelect.classList.add('bg-white', 'text-gray-900');
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
            <button type="button" onclick="removePdfRow(this, ${blockIndex})" 
                    class="px-2 py-2 text-red-600 hover:text-red-800 self-center pdf-delete-btn">🗑️</button>
        `;
        container.appendChild(newRow);
        
        // Show delete buttons for all PDF rows in this block
        updatePdfDeleteButtons(blockIndex);
    }

    // Remove PDF row
    function removePdfRow(button, blockIndex) {
        button.closest('.pdf-row').remove();
        updatePdfDeleteButtons(blockIndex);
    }

    // Update PDF delete buttons visibility
    function updatePdfDeleteButtons(blockIndex) {
        const container = document.querySelector(`[name="pdfs[${blockIndex}][]"]`).closest('.pdf-container');
        const rows = container.querySelectorAll('.pdf-row');
        const deleteButtons = container.querySelectorAll('.pdf-delete-btn');
        
        // Show delete buttons only if there's more than one row
        deleteButtons.forEach(btn => {
            btn.style.display = rows.length > 1 ? 'block' : 'none';
        });
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
            <button type="button" onclick="removeVideoRow(this, ${blockIndex})" 
                    class="px-2 py-2 text-red-600 hover:text-red-800 self-center video-delete-btn">🗑️</button>
        `;
        container.appendChild(newRow);
        
        // Show delete buttons for all video rows in this block
        updateVideoDeleteButtons(blockIndex);
    }

    // Remove video row
    function removeVideoRow(button, blockIndex) {
        button.closest('.video-row').remove();
        updateVideoDeleteButtons(blockIndex);
    }

    // Update video delete buttons visibility
    function updateVideoDeleteButtons(blockIndex) {
        const container = document.querySelector(`[name="video_links[${blockIndex}][]"]`).closest('.video-container');
        const rows = container.querySelectorAll('.video-row');
        const deleteButtons = container.querySelectorAll('.video-delete-btn');
        
        // Show delete buttons only if there's more than one row
        deleteButtons.forEach(btn => {
            btn.style.display = rows.length > 1 ? 'block' : 'none';
        });
    }

    // Delete PDF function
    function deletePdf(pdfId) {
        fetch(`/admin/materials/pdf/${pdfId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Erreur lors de la suppression du PDF');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur lors de la suppression du PDF');
        });
    }

    // Delete video function
    function deleteVideo(videoId) {
        fetch(`/admin/materials/video/${videoId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Erreur lors de la suppression de la vidéo');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur lors de la suppression de la vidéo');
        });
    }

    // Dynamic year loading based on level
    document.getElementById('level_id').addEventListener('change', function() {
        const levelId = this.value;
        const yearSelect = document.getElementById('year_id');
        const fieldSelect = document.getElementById('field_id');
        const subjectSelect = document.getElementById('subject_id');
        
        // Reset all dependent dropdowns
        yearSelect.innerHTML = '<option value="">Sélectionner l\'année...</option>';
        fieldSelect.innerHTML = '<option value="">Sélectionner la filière...</option>';
        subjectSelect.innerHTML = '<option value="">Sélectionner la matière...</option>';
        
        // Disable all dependent dropdowns
        fieldSelect.disabled = true;
        fieldSelect.classList.add('bg-gray-100', 'text-gray-500');
        fieldSelect.classList.remove('bg-white', 'text-gray-900');
        
        subjectSelect.disabled = true;
        subjectSelect.classList.add('bg-gray-100', 'text-gray-500');
        subjectSelect.classList.remove('bg-white', 'text-gray-900');
        
        if (levelId) {
            // Load years for selected level
            fetch(`/admin/materials/years/${levelId}`)
                .then(response => response.json())
                .then(years => {
                    years.forEach(year => {
                        yearSelect.innerHTML += `<option value="${year.id}">${year.name}</option>`;
                    });
                    // Restore selected year if it exists
                    const currentYearId = '{{ $material->year_id }}';
                    if (currentYearId) {
                        yearSelect.value = currentYearId;
                        // Trigger year change event to load fields/subjects
                        yearSelect.dispatchEvent(new Event('change'));
                    }
                });
        }
    });

    // Dynamic field loading based on level and year
    document.getElementById('year_id').addEventListener('change', function() {
        const levelId = document.getElementById('level_id').value;
        const yearId = this.value;
        const fieldSelect = document.getElementById('field_id');
        const subjectSelect = document.getElementById('subject_id');
        
        // Reset dependent dropdowns
        fieldSelect.innerHTML = '<option value="">Sélectionner la filière...</option>';
        subjectSelect.innerHTML = '<option value="">Sélectionner la matière...</option>';
        
        // Disable subject dropdown
        subjectSelect.disabled = true;
        subjectSelect.classList.add('bg-gray-100', 'text-gray-500');
        subjectSelect.classList.remove('bg-white', 'text-gray-900');
        
        if (levelId && yearId) {
            const selectedLevel = document.getElementById('level_id').options[document.getElementById('level_id').selectedIndex].text.toLowerCase();
            
            // Check if it's Lycée level
            if (selectedLevel.includes('lycée') || selectedLevel.includes('lycee')) {
                // Enable field dropdown and load fields
                fieldSelect.disabled = false;
                fieldSelect.classList.remove('bg-gray-100', 'text-gray-500');
                fieldSelect.classList.add('bg-white', 'text-gray-900');
                
                fetch(`/admin/materials/fields/${levelId}/${yearId}`)
                    .then(response => response.json())
                    .then(fields => {
                        fields.forEach(field => {
                            fieldSelect.innerHTML += `<option value="${field.id}">${field.name}</option>`;
                        });
                        // Restore selected field if it exists
                        const currentFieldId = '{{ $material->field_id }}';
                        if (currentFieldId) {
                            fieldSelect.value = currentFieldId;
                            // Trigger field change event to load subjects
                            fieldSelect.dispatchEvent(new Event('change'));
                        }
                    });
            } else {
                // For non-Lycée levels, load subjects directly (no fields)
                subjectSelect.disabled = false;
                subjectSelect.classList.remove('bg-gray-100', 'text-gray-500');
                subjectSelect.classList.add('bg-white', 'text-gray-900');
                
                fetch(`/admin/materials/subjects/${levelId}/${yearId}`)
                    .then(response => response.json())
                    .then(subjects => {
                        subjects.forEach(subject => {
                            subjectSelect.innerHTML += `<option value="${subject.id}">${subject.name}</option>`;
                        });
                        // Restore selected subject if it exists
                        const currentSubjectId = '{{ $material->subject_id }}';
                        if (currentSubjectId) {
                            subjectSelect.value = currentSubjectId;
                        }
                    });
            }
        } else {
            fieldSelect.disabled = true;
            fieldSelect.classList.add('bg-gray-100', 'text-gray-500');
            fieldSelect.classList.remove('bg-white', 'text-gray-900');
        }
    });

    // Dynamic subject loading based on level, year and field
    document.getElementById('field_id').addEventListener('change', function() {
        const levelId = document.getElementById('level_id').value;
        const yearId = document.getElementById('year_id').value;
        const fieldId = this.value;
        const subjectSelect = document.getElementById('subject_id');
        
        // Reset subject dropdown
        subjectSelect.innerHTML = '<option value="">Sélectionner la matière...</option>';
        
        if (levelId && yearId && fieldId) {
            // Enable subject dropdown and load subjects
            subjectSelect.disabled = false;
            subjectSelect.classList.remove('bg-gray-100', 'text-gray-500');
            subjectSelect.classList.add('bg-white', 'text-gray-900');
            
            fetch(`/admin/materials/subjects/${levelId}/${yearId}/${fieldId}`)
                .then(response => response.json())
                .then(subjects => {
                    subjects.forEach(subject => {
                        subjectSelect.innerHTML += `<option value="${subject.id}">${subject.name}</option>`;
                    });
                    // Restore selected subject if it exists
                    const currentSubjectId = '{{ $material->subject_id }}';
                    if (currentSubjectId) {
                        subjectSelect.value = currentSubjectId;
                    }
                });
        } else {
            subjectSelect.disabled = true;
            subjectSelect.classList.add('bg-gray-100', 'text-gray-500');
            subjectSelect.classList.remove('bg-white', 'text-gray-900');
        }
    });

    // Initialize form on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Trigger level change to populate dependent dropdowns
        const levelSelect = document.getElementById('level_id');
        if (levelSelect.value) {
            levelSelect.dispatchEvent(new Event('change'));
        }
    });
</script>

<!-- Custom Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Confirmer la suppression</h3>
            <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-6">
            <p class="text-gray-600 mb-4">Êtes-vous sûr de vouloir supprimer ce bloc ? Cette action ne peut pas être annulée.</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Annuler
                </button>
                <button id="confirmDeleteBtn" onclick="confirmDeleteBlock()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Supprimer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>
@endsection
