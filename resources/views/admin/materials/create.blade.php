@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-bold mb-4">➕ Ajouter un Matériel</h1>

@if($errors->any())
    <div class="text-red-500 mb-4">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <!-- Basic Material Info -->
    <div class="bg-gray-50 p-4 rounded-lg">
        <h2 class="text-lg font-semibold mb-4">Informations de base</h2>
        
        <input name="title" type="text" placeholder="Nom du cours (ex: Mathématiques)" class="w-full p-2 border rounded mb-3" required>

        <select name="level_id" id="level_id" class="w-full p-2 border rounded mb-3" required>
            <option value="">Niveau</option>
            @foreach($levels as $level)
                <option value="{{ $level->id }}">{{ $level->name }}</option>
            @endforeach
        </select>

        <select name="year_id" class="w-full p-2 border rounded mb-3">
            <option value="">Année</option>
            @foreach($years as $year)
                <option value="{{ $year->id }}">{{ $year->name }}</option>
            @endforeach
        </select>

        <div id="field-wrapper" class="hidden">
            <select name="field_id" id="field_id" class="w-full p-2 border rounded">
                <option value="">Filière</option>
                @foreach($fields as $field)
                    <option value="{{ $field->id }}">{{ $field->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Material Blocks -->
    <div id="blocks-wrapper" class="space-y-6">
        <!-- Block 1 -->
        <div class="block-container border-2 border-blue-200 rounded-lg p-4 bg-blue-50">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-blue-800">Bloc 1</h3>
                <button type="button" onclick="removeBlock(this)" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Supprimer le bloc</button>
            </div>
            
            <input name="block_types[]" type="text" placeholder="Type (ex: Cours, Séries, Autres)" class="w-full p-2 border rounded mb-4" required>

            <!-- PDFs Section -->
            <div class="mb-4">
                <h4 class="font-semibold mb-2">📄 PDFs Matériel</h4>
                <div class="pdfs-wrapper space-y-2">
                    <div class="pdf-group flex gap-2">
                        <input type="file" name="pdfs[0][]" accept=".pdf" class="flex-1 p-2 border rounded">
                        <input type="text" name="pdf_titles[0][]" placeholder="Titre du PDF" class="flex-1 p-2 border rounded">
                    </div>
                </div>
                <button type="button" onclick="addPdf(this)" class="mt-2 bg-blue-500 text-white px-3 py-1 rounded text-sm">+ Ajouter un autre PDF</button>
            </div>

            <!-- Videos Section -->
            <div>
                <h4 class="font-semibold mb-2">🎥 Liens Vidéo YouTube</h4>
                <div class="videos-wrapper space-y-2">
                    <div class="video-group flex gap-2">
                        <input type="url" name="video_links[0][]" placeholder="Lien vidéo YouTube" class="flex-1 p-2 border rounded">
                        <input type="text" name="video_titles[0][]" placeholder="Titre de la vidéo" class="flex-1 p-2 border rounded">
                        <button type="button" onclick="removeVideo(this)" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                    </div>
                </div>
                <button type="button" onclick="addVideo(this)" class="mt-2 bg-green-500 text-white px-3 py-1 rounded text-sm">+ Ajouter une vidéo</button>
            </div>
        </div>
    </div>

    <!-- Add New Block Button -->
    <div class="text-center">
        <button type="button" onclick="addBlock()" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold">
            ➕ Ajouter un nouveau bloc
        </button>
    </div>

    <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold w-full">Enregistrer le matériel</button>
</form>

<script>
    let blockCounter = 1;

    document.addEventListener('DOMContentLoaded', function () {
        const levelSelect = document.getElementById('level_id');
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

        levelSelect.addEventListener('change', toggleField);
        toggleField();
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
            
            <input name="block_types[]" type="text" placeholder="Type (ex: Cours, Séries, Autres)" class="w-full p-2 border rounded mb-4" required>

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
</script>
@endsection
