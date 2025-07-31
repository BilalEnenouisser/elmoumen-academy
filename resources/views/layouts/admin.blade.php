<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration – @yield('title', 'Elmoumen Academy')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex bg-gray-100 min-h-screen">

    <!-- Mobile Menu Button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="mobile-menu-button" class="p-2 bg-white rounded shadow">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-white shadow h-screen p-4 space-y-4 sticky top-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40">
        <h2 class="text-xl font-bold text-green-600 mb-6">Panneau d'Administration</h2>
        
        <nav class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-2 p-2 rounded transition @if(request()->routeIs('admin.dashboard')) bg-green-50 text-green-600 @else text-gray-700 hover:bg-green-50 hover:text-green-600 @endif">
                📊 Tableau de Bord
            </a>

            <!-- Messages -->
            <a href="{{ route('admin.messages.index') }}" 
               class="flex items-center gap-2 p-2 rounded transition @if(request()->routeIs('admin.messages*')) bg-green-50 text-green-600 @else text-gray-700 hover:bg-green-50 hover:text-green-600 @endif">
                ✉️ Messages 
                @if(method_exists(\App\Models\Message::class, 'unread'))
                    ({{ \App\Models\Message::unread()->count() }})
                @endif
            </a>

            <!-- Teachers -->
            <a href="{{ route('admin.teachers.index') }}" 
               class="flex items-center gap-2 p-2 rounded transition @if(request()->routeIs('admin.teachers*')) bg-green-50 text-green-600 @else text-gray-700 hover:bg-green-50 hover:text-green-600 @endif">
                👨‍🏫 Enseignants
            </a>

            <!-- Materials -->
            <a href="{{ route('admin.materials.index') }}" 
               class="flex items-center gap-2 p-2 rounded transition @if(request()->routeIs('admin.materials*')) bg-green-50 text-green-600 @else text-gray-700 hover:bg-green-50 hover:text-green-600 @endif">
                📚 Matériels
            </a>

            <!-- Structure -->
            <a href="{{ route('admin.structure') }}" 
               class="flex items-center gap-2 p-2 rounded transition @if(request()->routeIs('admin.structure')) bg-green-50 text-green-600 @else text-gray-700 hover:bg-green-50 hover:text-green-600 @endif">
                🏛️ Structure
            </a>

            <!-- Marquees -->
            <a href="{{ route('admin.marquees.index') }}" 
               class="flex items-center gap-2 p-2 rounded transition @if(request()->routeIs('admin.marquees.index')) bg-green-50 text-green-600 @else text-gray-700 hover:bg-green-50 hover:text-green-600 @endif">
                📢 Bandeau d'Annonce
            </a>

            <!-- Videos -->
            <a href="{{ route('admin.category-videos.index') }}" 
               class="flex items-center gap-2 p-2 rounded transition @if(request()->routeIs('admin.category-videos*')) bg-green-50 text-green-600 @else text-gray-700 hover:bg-green-50 hover:text-green-600 @endif">
                🎬 Vidéos
            </a>
        </nav>

        <!-- Admin Info -->
        @auth
        <div class="mt-6 border-t pt-4 text-sm text-gray-600">
            Connecté en tant que :
            <div class="font-semibold text-green-700">{{ Auth::user()->name }}</div>
            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
        </div>
        @endauth

        <!-- Logout -->
        <div class="absolute bottom-4 left-4 right-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left p-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded transition flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <main class="flex-1 p-4 lg:p-6 overflow-auto">
        <!-- Page Header -->
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h1 class="text-2xl font-bold">@yield('title')</h1>
            @yield('actions')
        </div>

        <!-- Content -->
        <div class="bg-white rounded-lg shadow p-4 lg:p-6">
            @yield('content')
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-overlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        document.getElementById('mobile-menu-button').addEventListener('click', toggleSidebar);

        // Close sidebar when clicking on a link (mobile)
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    toggleSidebar();
                }
            });
        });
    </script>

</body>
</html>
