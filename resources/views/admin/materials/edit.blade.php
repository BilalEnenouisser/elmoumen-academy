@extends('layouts.admin')

@section('content')
<div x-data="{ 
    showDeletePdfModal: false,
    showDeleteVideoModal: false,
    pdfToDelete: null,
    videoToDelete: null,
    itemName: ''
}">
<h1 class="text-xl font-bold mb-4">✏️ Modifier le Matériel</h1>

@if($errors->any())
    <div class="text-red-500 mb-4">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Basic Material Info -->
    <div class="bg-gray-50 p-4 rounded-lg">
        <h2 class="text-lg font-semibold mb-4">Informations de base</h2>
        
        <input name="title" type="text" value="{{ old('title', $material->title) }}" placeholder="Nom du cours (ex: Mathématiques)" class="w-full p-2 border rounded mb-3" required>

        <select name="level_id" id="level_id" class="w-full p-2 border rounded mb-3" required>
            <option value="">Niveau</option>
            @foreach($levels as $level)
                <option value="{{ $level->id }}" {{ $material->level_id == $level->id ? 'selected' : '' }}>
                    {{ $level->name }}
                </option>
            @endforeach
        </select>

        <select name="year_id" id="year_id" class="w-full p-2 border rounded mb-3">
            <option value="">Année</option>
            @foreach($years as $year)
                <option value="{{ $year->id }}" {{ $material->year_id == $year->id ? 'selected' : '' }}>
                    {{ $year->name }}
                </option>
            @endforeach
        </select>

        <div id="field-wrapper" class="{{ $material->level && str_contains(strtolower($material->level->name), 'lycée') ? '' : 'hidden' }}">
            <select name="field_id" id="field_id" class="w-full p-2 border rounded">
                <option value="">Filière</option>
                @foreach($fields as $field)
                    <option value="{{ $field->id }}" {{ $material->field_id == $field->id ? 'selected' : '' }}>
                        {{ $field->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Material Blocks -->
    <div id="blocks-wrapper" class="space-y-6">
        @foreach($material->blocks as $index => $block)
        <div class="block-container border-2 border-blue-200 rounded-lg p-4 bg-blue-50">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-blue-800">Bloc {{ $index + 1 }}</h3>
                <button type="button" onclick="removeBlock(this)" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Supprimer le bloc</button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <select name="semesters[]" class="w-full p-2 border rounded" required>
                    <option value="">Semestre</option>
                    <option value="Semestre 1" {{ $block->semester == 'Semestre 1' ? 'selected' : '' }}>Semestre 1</option>
                    <option value="Semestre 2" {{ $block->semester == 'Semestre 2' ? 'selected' : '' }}>Semestre 2</option>
                </select>
                
                <select name="material_types[]" class="material-type-select w-full p-2 border rounded" required>
                    <option value="">Type de matériel</option>
                    <option value="Cours" {{ $block->material_type == 'Cours' ? 'selected' : '' }}>Cours</option>
                    <option value="Séries" {{ $block->material_type == 'Séries' ? 'selected' : '' }}>Séries</option>
                    <option value="Devoirs semestre 1" {{ $block->material_type == 'Devoirs semestre 1' ? 'selected' : '' }}>Devoirs semestre 1</option>
                    <option value="Devoirs semestre 2" {{ $block->material_type == 'Devoirs semestre 2' ? 'selected' : '' }}>Devoirs semestre 2</option>
                    <option value="Examens" {{ $block->material_type == 'Examens' ? 'selected' : '' }}>Examens</option>
                </select>
                
                <select name="exam_types[]" class="exam-type-select w-full p-2 border rounded {{ $block->material_type == 'Examens' ? '' : 'hidden' }}">
                    <option value="">Type d'examen</option>
                    <option value="إمتحانات محلية" {{ $block->exam_type == 'إمتحانات محلية' ? 'selected' : '' }}>إمتحانات محلية</option>
                    <option value="إمتحانات إقليمية" {{ $block->exam_type == 'إمتحانات إقليمية' ? 'selected' : '' }}>إمتحانات إقليمية</option>
                    <option value="Examens Locaux" {{ $block->exam_type == 'Examens Locaux' ? 'selected' : '' }}>Examens Locaux</option>
                    <option value="Examens Régionaux" {{ $block->exam_type == 'Examens Régionaux' ? 'selected' : '' }}>Examens Régionaux</option>
                    <option value="Examens Nationaux Blanc" {{ $block->exam_type == 'Examens Nationaux Blanc' ? 'selected' : '' }}>Examens Nationaux Blanc</option>
                    <option value="Examens Nationaux" {{ $block->exam_type == 'Examens Nationaux' ? 'selected' : '' }}>Examens Nationaux</option>
                </select>
            </div>
            


            <!-- PDFs Section -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">📄 PDFs Matériel</h4>
                
                <!-- Existing PDFs -->
                @if($block->pdfs->count() > 0)
                <div class="mb-3 p-3 bg-gray-100 rounded">
                    <h5 class="font-medium mb-2">PDFs existants:</h5>
                    @foreach($block->pdfs as $pdf)
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-sm">{{ $pdf->title ?? 'PDF' }}</span>
                        <a href="{{ asset('storage/' . $pdf->pdf_path) }}" target="_blank" class="text-blue-500 text-sm">Voir</a>
                        <button 
                            type="button" 
                            @click="pdfToDelete = {{ $pdf->id }}; itemName = '{{ addslashes($pdf->title ?? 'PDF') }}'; showDeletePdfModal = true"
                            class="text-red-500 text-sm hover:text-red-700 transition-colors">
                            Supprimer
                        </button>
                    </div>
                    @endforeach
                </div>
                @endif
                
                <!-- Add New PDFs -->
                <div class="pdfs-wrapper space-y-2">
                    <div class="pdf-group flex gap-2">
                        <input type="file" name="pdfs[{{ $index }}][]" accept=".pdf" class="flex-1 p-2 border rounded">
                        <input type="text" name="pdf_titles[{{ $index }}][]" placeholder="Titre du PDF" class="flex-1 p-2 border rounded">
                    </div>
                </div>
                <button type="button" onclick="addPdf(this)" class="mt-2 bg-blue-500 text-white px-3 py-1 rounded text-sm">+ Ajouter un autre PDF</button>
            </div>

            <!-- Videos Section -->
            <div>
                <h4 class="font-semibold mb-2">🎥 Liens Vidéo YouTube</h4>
                
                <!-- Existing Videos -->
                @if($block->videos->count() > 0)
                <div class="mb-3 p-3 bg-gray-100 rounded">
                    <h5 class="font-medium mb-2">Vidéos existantes:</h5>
                    @foreach($block->videos as $video)
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-sm">{{ $video->title ?? 'Vidéo' }}</span>
                        <a href="{{ $video->video_link }}" target="_blank" class="text-blue-500 text-sm">Voir</a>
                        <button 
                            type="button" 
                            @click="videoToDelete = {{ $video->id }}; itemName = '{{ addslashes($video->title ?? 'Vidéo') }}'; showDeleteVideoModal = true"
                            class="text-red-500 text-sm hover:text-red-700 transition-colors">
                            Supprimer
                        </button>
                    </div>
                    @endforeach
                </div>
                @endif
                
                <!-- Add New Videos -->
                <div class="videos-wrapper space-y-2">
                    <div class="video-group flex gap-2">
                        <input type="url" name="video_links[{{ $index }}][]" placeholder="Lien vidéo YouTube" class="flex-1 p-2 border rounded">
                        <input type="text" name="video_titles[{{ $index }}][]" placeholder="Titre de la vidéo" class="flex-1 p-2 border rounded">
                        <button type="button" onclick="removeVideo(this)" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                    </div>
                </div>
                <button type="button" onclick="addVideo(this)" class="mt-2 bg-green-500 text-white px-3 py-1 rounded text-sm">+ Ajouter une vidéo</button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Add New Block Button -->
    <div class="text-center">
        <button type="button" onclick="addBlock()" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold">
            ➕ Ajouter un nouveau bloc
        </button>
    </div>

    <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold w-full">💾 Enregistrer les modifications</button>
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
                        Confirmer la suppression
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
                        Confirmer la suppression
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
    let blockCounter = {{ $material->blocks->count() }};

    document.addEventListener('DOMContentLoaded', function () {
        const levelSelect = document.getElementById('level_id');
        const yearSelect = document.getElementById('year_id');
        const fieldWrapper = document.getElementById('field-wrapper');

        function toggleField() {
            const selectedText = levelSelect.options[levelSelect.selectedIndex]?.text.toLowerCase();
            if (selectedText.includes('lycée')) {
                fieldWrapper.classList.remove('hidden');
            } else {
                fieldWrapper.classList.add('hidden');
                document.getElementById('field_id').value = '';
            }
        }

        function updateYears() {
            const selectedLevelId = levelSelect.value;
            if (selectedLevelId) {
                fetch(`/admin/materials/years/${selectedLevelId}`)
                    .then(response => response.json())
                    .then(years => {
                        yearSelect.innerHTML = '<option value="">Année</option>';
                        years.forEach(year => {
                            yearSelect.innerHTML += `<option value="${year.id}">${year.name}</option>`;
                        });
                        // Restore selected year if it exists
                        const currentYearId = '{{ $material->year_id }}';
                        if (currentYearId) {
                            yearSelect.value = currentYearId;
                        }
                    });
            } else {
                yearSelect.innerHTML = '<option value="">Année</option>';
            }
        }

        function setupMaterialTypeListeners() {
            document.querySelectorAll('.material-type-select').forEach(select => {
                select.addEventListener('change', function() {
                    const block = this.closest('.block-container');
                    const examTypeSelect = block.querySelector('.exam-type-select');
                    
                    if (this.value === 'Examens') {
                        examTypeSelect.classList.remove('hidden');
                        examTypeSelect.required = true;
                    } else {
                        examTypeSelect.classList.add('hidden');
                        examTypeSelect.required = false;
                        examTypeSelect.value = '';
                    }
                });
            });
        }

        levelSelect.addEventListener('change', function() {
            toggleField();
            updateYears();
        });
        
        // Initial setup
        toggleField();
        setupMaterialTypeListeners();
        
        // Setup listeners for dynamically added blocks
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('material-type-select')) {
                const block = e.target.closest('.block-container');
                const examTypeSelect = block.querySelector('.exam-type-select');
                
                if (e.target.value === 'Examens') {
                    examTypeSelect.classList.remove('hidden');
                    examTypeSelect.required = true;
                } else {
                    examTypeSelect.classList.add('hidden');
                    examTypeSelect.required = false;
                    examTypeSelect.value = '';
                }
            }
        });
    });

    function addBlock() {
        blockCounter++;
        const wrapper = document.getElementById('blocks-wrapper');
        const block = document.createElement('div');
        block.className = 'block-container border-2 border-blue-200 rounded-lg p-4 bg-blue-50';
        block.innerHTML = `
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-blue-800">Bloc ${blockCounter}</h3>
                <button type="button" onclick="removeBlock(this)" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Supprimer le bloc</button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <select name="semesters[]" class="w-full p-2 border rounded" required>
                    <option value="">Semestre</option>
                    <option value="Semestre 1">Semestre 1</option>
                    <option value="Semestre 2">Semestre 2</option>
                </select>
                
                <select name="material_types[]" class="material-type-select w-full p-2 border rounded" required>
                    <option value="">Type de matériel</option>
                    <option value="Cours">Cours</option>
                    <option value="Séries">Séries</option>
                    <option value="Devoirs semestre 1">Devoirs semestre 1</option>
                    <option value="Devoirs semestre 2">Devoirs semestre 2</option>
                    <option value="Examens">Examens</option>
                </select>
                
                <select name="exam_types[]" class="exam-type-select w-full p-2 border rounded hidden">
                    <option value="">Type d'examen</option>
                    <option value="إمتحانات محلية">إمتحانات محلية</option>
                    <option value="إمتحانات إقليمية">إمتحانات إقليمية</option>
                    <option value="Examens Locaux">Examens Locaux</option>
                    <option value="Examens Régionaux">Examens Régionaux</option>
                    <option value="Examens Nationaux Blanc">Examens Nationaux Blanc</option>
                    <option value="Examens Nationaux">Examens Nationaux</option>
                </select>
            </div>
            


            <!-- PDFs Section -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">📄 PDFs Matériel</h4>
                <div class="pdfs-wrapper space-y-2">
                    <div class="pdf-group flex gap-2">
                        <input type="file" name="pdfs[${blockCounter-1}][]" accept=".pdf" class="flex-1 p-2 border rounded">
                        <input type="text" name="pdf_titles[${blockCounter-1}][]" placeholder="Titre du PDF" class="flex-1 p-2 border rounded">
                    </div>
                </div>
                <button type="button" onclick="addPdf(this)" class="mt-2 bg-blue-500 text-white px-3 py-1 rounded text-sm">+ Ajouter un autre PDF</button>
            </div>

            <!-- Videos Section -->
            <div>
                <h4 class="font-semibold mb-2">🎥 Liens Vidéo YouTube</h4>
                <div class="videos-wrapper space-y-2">
                    <div class="video-group flex gap-2">
                        <input type="url" name="video_links[${blockCounter-1}][]" placeholder="Lien vidéo YouTube" class="flex-1 p-2 border rounded">
                        <input type="text" name="video_titles[${blockCounter-1}][]" placeholder="Titre de la vidéo" class="flex-1 p-2 border rounded">
                        <button type="button" onclick="removeVideo(this)" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                    </div>
                </div>
                <button type="button" onclick="addVideo(this)" class="mt-2 bg-green-500 text-white px-3 py-1 rounded text-sm">+ Ajouter une vidéo</button>
            </div>
        `;
        wrapper.appendChild(block);
    }

    function removeBlock(button) {
        if (document.querySelectorAll('.block-container').length > 1) {
            button.closest('.block-container').remove();
            updateBlockNumbers();
        } else {
            alert('Vous devez avoir au moins un bloc.');
        }
    }

    function updateBlockNumbers() {
        const blocks = document.querySelectorAll('.block-container');
        blocks.forEach((block, index) => {
            const title = block.querySelector('h3');
            title.textContent = `Bloc ${index + 1}`;
        });
    }

    function addPdf(button) {
        const block = button.closest('.block-container');
        const wrapper = block.querySelector('.pdfs-wrapper');
        const blockIndex = Array.from(document.querySelectorAll('.block-container')).indexOf(block);
        
        const group = document.createElement('div');
        group.className = 'pdf-group flex gap-2';
        group.innerHTML = `
            <input type="file" name="pdfs[${blockIndex}][]" accept=".pdf" class="flex-1 p-2 border rounded">
            <input type="text" name="pdf_titles[${blockIndex}][]" placeholder="Titre du PDF" class="flex-1 p-2 border rounded">
            <button type="button" onclick="removePdf(this)" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
        `;
        wrapper.appendChild(group);
    }

    function removePdf(button) {
        button.parentElement.remove();
    }

    function addVideo(button) {
        const block = button.closest('.block-container');
        const wrapper = block.querySelector('.videos-wrapper');
        const blockIndex = Array.from(document.querySelectorAll('.block-container')).indexOf(block);
        
        const group = document.createElement('div');
        group.className = 'video-group flex gap-2';
        group.innerHTML = `
            <input type="url" name="video_links[${blockIndex}][]" placeholder="Lien vidéo YouTube" class="flex-1 p-2 border rounded">
            <input type="text" name="video_titles[${blockIndex}][]" placeholder="Titre de la vidéo" class="flex-1 p-2 border rounded">
            <button type="button" onclick="removeVideo(this)" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
        `;
        wrapper.appendChild(group);
    }

    function removeVideo(button) {
        button.parentElement.remove();
    }

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
</script>
@endsection
