<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher – @yield('title', 'Elmoumen Academy')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow h-screen p-4 space-y-4 sticky top-0">
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
        @auth
        <div class="mt-6 border-t pt-4 text-sm text-gray-600">
            Logged in as:
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
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto">
        <!-- Page Header -->
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold">@yield('title')</h1>
            @yield('actions')
        </div>

        <!-- Content -->
        <div class="bg-white rounded-lg shadow p-6">
            @yield('content')
        </div>
    </main>

</body>
</html> 