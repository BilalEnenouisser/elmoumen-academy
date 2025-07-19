<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Elmoumen Academy</title>
    @vite('resources/css/app.css')
</head>
<body class="flex bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow h-screen p-4 space-y-4 sticky top-0">
        <h2 class="text-xl font-bold text-blue-600 mb-6">Admin Panel</h2>
        <nav class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('admin.structure') }}" 
               class="flex items-center gap-2 p-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition">
                📊 Dashboard
            </a>
            
            <!-- Teachers -->
            <a href="{{ route('admin.teachers.index') }}" 
               class="flex items-center gap-2 p-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition">
                👨‍🏫 Gérer les enseignants
            </a>
            
            <!-- Academic Structure -->
            <a href="{{ route('admin.structure') }}" 
               class="flex items-center gap-2 p-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition">
                🏛️ Structure Académique
            </a>
            
            <!-- Materials -->
            <a href="{{ route('admin.materials.index') }}" 
               class="flex items-center gap-2 p-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded transition">
                📚 Matériels Pédagogiques
            </a>
            
            <!-- Separator -->
            <div class="border-t my-2"></div>
            
            <!-- Quick Actions -->
            <div class="space-y-1">
                <h3 class="text-xs uppercase text-gray-500 font-semibold px-2">Actions Rapides</h3>
                <a href="{{ route('admin.teachers.create') }}" 
                   class="flex items-center gap-2 p-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded transition">
                    ➕ Nouvel Enseignant
                </a>
                <a href="{{ route('admin.materials.create') }}" 
                   class="flex items-center gap-2 p-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded transition">
                    ➕ Nouveau Matériel
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</body>
</html>