@extends('layouts.admin')

@section('title', 'Tableau de Bord')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Bienvenue au Panneau d'Administration</h1>

    <!-- Analytics Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Utilisateurs Totaux</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_users'] }}</p>
                </div>
            </div>
        </div>

        <!-- Online Users -->
        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Utilisateurs En Ligne</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['online_users'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Teachers -->
        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Enseignants Totaux</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_teachers'] }}</p>
                </div>
            </div>
        </div>

        <!-- Online Teachers -->
        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Enseignants En Ligne</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['online_teachers'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6 mb-8">
        <!-- PDF Downloads -->
        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">📄 Téléchargements PDF</h3>
                <span class="text-2xl font-bold text-green-600">{{ $stats['total_pdf_downloads'] }}</span>
            </div>
            <div class="space-y-2">
                @foreach($stats['top_downloaded_pdfs'] as $pdf)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600 truncate">{{ $pdf->materialPdf->title ?? 'PDF' }}</span>
                        <span class="font-semibold ml-2">{{ $pdf->download_count }} téléchargements</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Video Clicks -->
        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">🎬 Clics Vidéo</h3>
                <span class="text-2xl font-bold text-green-600">{{ $stats['total_video_clicks'] }}</span>
            </div>
            <div class="space-y-2">
                @foreach($stats['top_clicked_videos'] as $video)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600 truncate">{{ $video->categoryVideo->title ?? 'Vidéo' }}</span>
                        <span class="font-semibold ml-2">{{ $video->click_count }} clics</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Page Views -->
        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">👁️ Vues de Pages</h3>
                <span class="text-2xl font-bold text-green-600">{{ $stats['total_page_views'] }}</span>
            </div>
            <p class="text-sm text-gray-600">Total des vues de pages suivies</p>
        </div>
    </div>

    <!-- Teacher Upload Stats -->
    <div class="bg-white rounded-lg shadow p-4 lg:p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">👨‍🏫 Activité de Téléchargement des Enseignants</h3>
        <div class="space-y-3">
            @foreach($stats['teacher_upload_stats'] as $teacher)
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                    <div class="min-w-0 flex-1">
                        <span class="font-medium block truncate">{{ $teacher->teacher->name ?? 'Enseignant Inconnu' }}</span>
                        <span class="text-sm text-gray-500 block truncate">{{ $teacher->teacher->email ?? '' }}</span>
                    </div>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold ml-2">
                        {{ $teacher->upload_count }} PDFs
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 lg:gap-6">
        <!-- Teachers -->
        <a href="{{ route('admin.teachers.index') }}" class="p-4 lg:p-6 bg-white rounded shadow hover:bg-green-50 transition">
            <h2 class="text-lg font-semibold text-green-600">👨‍🏫 Gérer les Enseignants</h2>
            <p class="text-gray-600 mt-2">Ajouter, modifier ou supprimer des enseignants.</p>
        </a>

        <!-- Materials -->
        <a href="{{ route('admin.materials.index') }}" class="p-4 lg:p-6 bg-white rounded shadow hover:bg-green-50 transition">
            <h2 class="text-lg font-semibold text-green-600">📚 Gérer les Matériels</h2>
            <p class="text-gray-600 mt-2">Télécharger des PDFs, vidéos ou autres matériels.</p>
        </a>

        <!-- Marquee -->
        <a href="{{ route('admin.marquees.index') }}" class="p-4 lg:p-6 bg-white rounded shadow hover:bg-green-50 transition">
            <h2 class="text-lg font-semibold text-green-600">📢 Gérer le Bandeau d'Annonce</h2>
            <p class="text-gray-600 mt-2">Ajouter ou supprimer des messages d'annonce.</p>
        </a>

        <!-- Messages -->
        <a href="{{ route('admin.messages.index') }}" class="p-4 lg:p-6 bg-white rounded shadow hover:bg-green-50 transition">
            <h2 class="text-lg font-semibold text-green-600">✉️ Voir les Messages</h2>
            <p class="text-gray-600 mt-2">Voir les soumissions du formulaire de contact.</p>
        </a>

        <!-- Structure -->
        <a href="{{ route('admin.structure') }}" class="p-4 lg:p-6 bg-white rounded shadow hover:bg-green-50 transition">
            <h2 class="text-lg font-semibold text-green-600">🏛️ Gestion de la Structure</h2>
            <p class="text-gray-600 mt-2">Gérer les niveaux, années, filières</p>
        </a>

        <!-- Videos -->
        <a href="{{ route('admin.category-videos.index') }}" class="p-4 lg:p-6 bg-white rounded shadow hover:bg-green-50 transition">
            <h2 class="text-lg font-semibold text-green-600">🎬 Vidéos</h2>
            <p class="text-gray-600 mt-2">Gérer les vidéos par catégories (آباء, تلاميذ, أجي تغير حياتك).</p>
        </a>
    </div>
@endsection
