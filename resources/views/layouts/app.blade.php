<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elmoumen Academy</title>

    @vite('resources/css/app.css')

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">Elmoumen Academy</a>

            <!-- Center nav links -->
            <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
                <li><a href="{{ url('/') }}" class="hover:text-blue-600">ACCUEIL</a></li>
                <li><a href="{{ url('/about') }}" class="hover:text-blue-600">ABOUT</a></li>

                <li class="relative" x-data="{ mega: false }" @mouseenter="mega = true" @mouseleave="mega = false">
                    <a href="#" class="hover:text-blue-600">COURS</a>
                    <!-- Mega Menu -->
                    <div x-show="mega" x-transition
                        class="absolute top-full left-0 w-64 bg-white border shadow-lg mt-2 py-2 z-50">
                        <a href="{{ url('/courses/primaire') }}" class="block px-4 py-2 hover:bg-gray-100">Primaire</a>
                        <a href="{{ url('/courses/college') }}" class="block px-4 py-2 hover:bg-gray-100">Collège</a>
                        <a href="{{ url('/courses/lycee') }}" class="block px-4 py-2 hover:bg-gray-100">Lycée</a>
                        <a href="{{ url('/courses/concours') }}" class="block px-4 py-2 hover:bg-gray-100">Concours</a>
                    </div>
                </li>

                <li><a href="{{ url('/contact') }}" class="hover:text-blue-600">CONTACT</a></li>
            </ul>

            <!-- Right: WhatsApp or phone -->
            <div class="flex items-center space-x-4">
                <a href="https://wa.me/212612345678" target="_blank"
                   class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm">
                    WhatsApp
                </a>
            </div>

            <!-- Mobile hamburger -->
            <div class="md:hidden">
                <button @click="open = !open" class="text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" class="md:hidden bg-white border-t shadow">
            <ul class="space-y-2 px-4 py-4">
                <li><a href="{{ url('/') }}" class="block hover:text-blue-600">ACCUEIL</a></li>
                <li><a href="{{ url('/about') }}" class="block hover:text-blue-600">ABOUT</a></li>
                <li><a href="{{ url('/courses/primaire') }}" class="block hover:text-blue-600">Primaire</a></li>
                <li><a href="{{ url('/courses/college') }}" class="block hover:text-blue-600">Collège</a></li>
                <li><a href="{{ url('/courses/lycee') }}" class="block hover:text-blue-600">Lycée</a></li>
                <li><a href="{{ url('/courses/concours') }}" class="block hover:text-blue-600">Concours</a></li>
                <li><a href="{{ url('/contact') }}" class="block hover:text-blue-600">CONTACT</a></li>
                <li>
                    <a href="https://wa.me/212612345678" target="_blank"
                       class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        WhatsApp
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Elmoumen Academy. Tous droits réservés.
        </div>
    </footer>
</body>
</html>
