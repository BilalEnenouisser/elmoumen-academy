@extends('layouts.teacher')

@section('title', 'Modifier le Matériel')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Modifier le Matériel</h1>
        <p class="text-gray-600">Modifier les matériels éducatifs et leurs contenus</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Current Material Info -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <h3 class="font-semibold text-gray-900 mb-2">📋 Informations du Matériel</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div>
                <span class="font-medium">Titre:</span> {{ $material->title }}
            </div>
            <div>
                <span class="font-medium">Niveau:</span> {{ $material->level->name }}
            </div>
            <div>
                <span class="font-medium">Année:</span> {{ $material->year->name }}
            </div>
            @if($material->field)
                <div>
                    <span class="font-medium">Filière:</span> {{ $material->field->name }}
                </div>
            @endif
            @if($material->subject)
                <div>
                    <span class="font-medium">Matière:</span> {{ $material->subject->name }}
                </div>
            @endif
        </div>
    </div>

    <!-- Your Current PDFs -->
    @if($teacherPdfs->count() > 0)
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">📄 Vos PDFs Actuels</h3>
            <div class="space-y-3">
                @foreach($teacherPdfs as $pdf)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 18h12V6l-4-4H4v16z"/>
                            </svg>
                            <div>
                                <div class="font-medium">{{ $pdf->title }}</div>
                                <div class="text-sm text-gray-500">{{ $pdf->materialBlock->material_type }} - {{ $pdf->materialBlock->semester }}</div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ asset('storage/' . $pdf->pdf_path) }}" 
                               target="_blank" 
                               class="text-blue-600 hover:text-blue-800 text-sm">
                                👁️ Voir
                            </a>
                            <form action="{{ route('teacher.materials.pdf.delete', $pdf) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Supprimer ce PDF ?')" 
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Add New Content Form -->
    <div class="bg-white rounded-lg shadow p-4 md:p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
            <h3 class="text-lg font-semibold text-gray-900">📚 Ajouter de Nouveaux Blocs</h3>
            <button type="button" onclick="addBlock()" 
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition w-full sm:w-auto">
                ➕ Ajouter un Bloc
            </button>
        </div>
        
        <form action="{{ route('teacher.materials.update', $material) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div id="blocks-container" class="space-y-4 md:space-y-6">
                <!-- Block template will be added here -->
            </div>

            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                <a href="{{ route('teacher.materials.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-center">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Ajouter le Contenu
                </button>
            </div>
        </form>
    </div>

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
        let blockIndex = 0;
        
        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
        
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
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
                                onchange="toggleMaterialType(this, ${blockIndex})"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Sélectionner le type...</option>
                            <option value="Cours">Cours</option>
                            <option value="Séries">Séries</option>
                            <option value="Devoirs">Devoirs</option>
                            <option value="Examens">Examens</option>
                        </select>
                    </div>
                </div>

                <!-- Conditional Fields -->
                <div class="conditional-fields mb-4">
                    <!-- Devoir Type (always visible but disabled) -->
                    <div id="devoir_type_container_${blockIndex}" class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type de Devoir *</label>
                        <select name="devoir_types[${blockIndex}]" id="devoir_type_${blockIndex}"
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
                        <select name="exam_types[${blockIndex}]" id="exam_type_${blockIndex}"
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
            
            // Reset all dropdowns first
            devoirTypeSelect.value = '';
            examTypeSelect.value = '';
            
            // Disable and style all dropdowns by default
            devoirTypeSelect.disabled = true;
            devoirTypeSelect.required = false;
            devoirTypeSelect.classList.add('bg-gray-100', 'text-gray-500');
            devoirTypeSelect.classList.remove('bg-white', 'text-gray-900');
            
            examTypeSelect.disabled = true;
            examTypeSelect.required = false;
            examTypeSelect.classList.add('bg-gray-100', 'text-gray-500');
            examTypeSelect.classList.remove('bg-white', 'text-gray-900');
            
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

        // Override the default confirm for PDF deletion
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[onsubmit*="confirm"]');
            deleteForms.forEach(form => {
                form.onsubmit = function(e) {
                    e.preventDefault();
                    window.itemToDelete = form;
                    document.getElementById('deleteModal').classList.remove('hidden');
                    return false;
                };
            });
        });

        // Close delete modal
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            window.itemToDelete = null;
        }

        // Confirm delete
        function confirmDelete() {
            if (window.itemToDelete) {
                window.itemToDelete.submit();
                closeDeleteModal();
            }
        }
    </script>
@endsection
