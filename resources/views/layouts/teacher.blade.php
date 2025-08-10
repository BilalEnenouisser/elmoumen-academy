<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Teacher – @yield('title', 'Elmoumen Academy')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex bg-gray-100 min-h-screen">

    <!-- Mobile Menu Button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="teacher-mobile-menu-button" class="p-2 bg-white rounded shadow">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside id="teacher-sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow p-4 space-y-4 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40 lg:relative lg:h-screen lg:sticky lg:top-0">
        <h2 class="text-xl font-bold text-green-600 mb-6">Teacher Panel</h2>
        
        <nav class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('teacher.dashboard') }}" 
               class="flex items-center gap-2 p-2 rounded transition @if(request()->routeIs('teacher.dashboard')) bg-green-50 text-green-600 @else text-gray-700 hover:bg-green-50 hover:text-green-600 @endif">
                📊 Dashboard
            </a>

            <!-- Materials -->
            <a href="{{ route('teacher.materials.index') }}" 
               class="flex items-center gap-2 p-2 rounded transition @if(request()->routeIs('teacher.materials*')) bg-green-50 text-green-600 @else text-gray-700 hover:bg-green-50 hover:text-green-600 @endif">
                📚 My Materials
            </a>

            <!-- Add New Material -->
            <a href="{{ route('teacher.materials.create') }}" 
               class="flex items-center gap-2 p-2 rounded transition @if(request()->routeIs('teacher.materials.create')) bg-green-50 text-green-600 @else text-gray-700 hover:bg-green-50 hover:text-green-600 @endif">
                ➕ Add New Material
            </a>
        </nav>

        <!-- Teacher Info -->
        @auth('teacher')
        <div class="mt-6 border-t pt-4 text-sm text-gray-600">
            Logged in as:
            <div class="font-semibold text-green-700">{{ Auth::guard('teacher')->user()->name }}</div>
            <div class="text-xs text-gray-500">{{ Auth::guard('teacher')->user()->email }}</div>
        </div>
        @endauth

        <!-- Logout -->
        <div class="absolute bottom-4 left-4 right-4">
            <form method="POST" action="{{ route('teacher.logout') }}">
                @csrf
                <button type="submit" class="w-full text-left p-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded transition flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Mobile Overlay -->
    <div id="teacher-mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden" onclick="toggleTeacherSidebar()"></div>

    <!-- Main Content -->
    <main class="flex-1 p-4 lg:p-6 overflow-auto w-full">
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
        function toggleTeacherSidebar() {
            const sidebar = document.getElementById('teacher-sidebar');
            const overlay = document.getElementById('teacher-mobile-overlay');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        document.getElementById('teacher-mobile-menu-button').addEventListener('click', toggleTeacherSidebar);

        // Close sidebar on nav click (mobile)
        document.querySelectorAll('#teacher-sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    toggleTeacherSidebar();
                }
            });
        });
    </script>

</body>
</html> 